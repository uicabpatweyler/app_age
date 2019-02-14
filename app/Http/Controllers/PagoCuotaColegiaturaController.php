<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\CuotaColegiatura;
use App\Models\DatosInscripcionAlumno;
use App\Models\DetallePagoColegiatura;
use App\Models\Escuela;
use App\Models\Grupo;
use App\Models\GrupoCdc;
use App\Models\MesPagoColegiatura;
use App\Models\PagoColegiatura;
use App\Models\SerieFolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagoCuotaColegiaturaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener el ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        $dias = DatosInscripcionAlumno::select('alumnos.alumno_primernombre','alumnos.alumno_apellidopaterno')
            ->addSelect('alumnos.alumno_apellidopaterno','alumnos.alumno_apellidomaterno')
            ->addSelect('grupos.grupo_nombre','grupos_alumnos.grupo_id','grupos_alumnos.clasifgrupo_id','grupos_alumnos.pago_inscripcion')
            ->addSelect('datos_inscripcion_alumno.escuela_id','datos_inscripcion_alumno.ciclo_id','datos_inscripcion_alumno.alumno_id')
            ->leftjoin('alumnos', 'datos_inscripcion_alumno.alumno_id', '=', 'alumnos.id')
            ->leftjoin('grupos_alumnos', 'grupos_alumnos.alumno_id', '=', 'alumnos.id')
            ->leftjoin('grupos', 'grupos_alumnos.grupo_id', '=', 'grupos.id')
            ->where('datos_inscripcion_alumno.ciclo_id',$ciclo->id)
            ->get();

        return view('pagos.pago_colegiatura_elegir_alumno', compact('dias', 'ciclo'));
    }

    public function cancelarRecColegIndex(){

        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        $pagosDeColegiatura = PagoColegiatura::where('escuela_id',1)
            ->where('ciclo_id',$ciclo->id)
            ->orderBy('folio_recibo','asc')
            ->get();

        return view ('pagos.cancelar_pago_coleg_index', compact('ciclo','pagosDeColegiatura'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($escuela_id,$ciclo_id,$grupo_id,$alumno_id)
    {
        $escuela = Escuela::where('id',$escuela_id)
                   ->where('escuela_status',true)
                   ->first();

        $alumno = Alumno::where('id',$alumno_id)
                  ->where('alumno_status',true)
                  ->first();

        $ciclo = Ciclo::where('id', $ciclo_id)
            ->where('ciclo_actual', true)
            ->first();

        $grupo = Grupo::where('id',$grupo_id)->first();

        $meses_de_pago=[];

        $cuota_colegiatura      = GrupoCdc::where('grupo_id',$grupo_id)->first();
        $colegiatura            = CuotaColegiatura::where('id',$cuota_colegiatura->cuotacolegiatura_id)->first();
        $meses_pago_colegiatura = MesPagoColegiatura::where('colegiatura_id',$colegiatura->id)
                                  ->orderBy('orden_mes','asc')
                                  ->get();

        foreach ( $meses_pago_colegiatura as  $mes_pago) {

            $consulta = DetallePagoColegiatura::where('escuela_id',$escuela_id)
                ->where('ciclo_id', $ciclo_id)
                ->where('alumno_id',$alumno_id)
                ->where('nombre_mes',$mes_pago->nombre_mes)
                ->where('pago_cancelado',false)
                ->first();

            if($consulta===null){

                $anio = Carbon::now('America/Mexico_City Time Zone')->format('Y');
                $mes  = Carbon::now('America/Mexico_City Time Zone')->format('m');
                $dia  = Carbon::now('America/Mexico_City Time Zone')->format('d');

                $now = Carbon::create($anio,$mes,$dia);

                $date1 = Carbon::parse($mes_pago->fecha2_sin_recargo);

                //Diferencia entre el dia actual y la ultima fecha sin recargo de cada mes. Si es negativo, significa
                //que se aplica el recargo
                if($now->diffInDays($date1,false)>=0){
                    $porcentaje_de_recargo = 0;
                }
                else{
                    $porcentaje_de_recargo = $mes_pago->porcentaje_recargo;
                }

                //La colegiatura del mes de  $mes_pago->nombre_mes no ha sido cubierta
                $meses_de_pago []= [
                    'orden_mes'            => $mes_pago->orden_mes,
                    'nombre_mes'           => $mes_pago->nombre_mes,
                    'fecha1_sin_recargo'   => $mes_pago->fecha1_sin_recargo->format('Y-m-d'),
                    'fecha2_sin_recargo'   => $mes_pago->fecha2_sin_recargo->format('Y-m-d'),
                    'fecha3_con_recargo'   => $mes_pago->fecha3_con_recargo->format('Y-m-d'),
                    'fecha4_con_recargo'   => $mes_pago->fecha4_con_recargo->format('Y-m-d'),
                    'porcentaje_recargo'   => $porcentaje_de_recargo,
                    'porcentaje_descuento' => $mes_pago->porcentaje_descuento,
                    'cuota_colegiatura'    => $colegiatura->cuotacolegiatura_cuota
                ];

            }

        }

        $num_recibo = SerieFolio::where('tipo',2)->first();

        return view('pagos.pago_colegiatura_create',compact('meses_de_pago','ciclo','escuela','alumno','grupo','num_recibo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try
        {
            $resultado = DB::transaction(function () use ($request) {

                $DATOS = json_decode($request->get('adicional'));

                $now = Carbon::now('America/Mexico_City Time Zone');

                $pago = new PagoColegiatura();

                $pago->escuela_id            = $DATOS[0]->escuela_id;
                $pago->ciclo_id              = $DATOS[0]->ciclo_id;
                $pago->alumno_id             = $DATOS[0]->alumno_id;;
                $pago->grupo_id              = $DATOS[0]->grupo_id;
                $pago->clasifgrupo_id        = $DATOS[0]->clasifgrupo_id;
                $pago->user_id               = Auth::user()->id;

                $pago->serie_recibo          = $DATOS[0]->serie_recibo;
                $pago->folio_recibo          = $DATOS[0]->folio_recibo;
                $pago->fecha_pago            = $DATOS[0]->fecha_pago;

                $pago->pago_cancelado        = false;
                $pago->fecha_cancelacion     = null;
                $pago->cancelado_por         = 0;
                $pago->motivo_cancelacion    = null;

                $pago->moneda                = 'MXN'; //MXN Peso Mexicano - USD Dolar Americano
                $pago->cantidad_recibida_mxn = $DATOS[0]->cantidad_recibida_mxn;
                $pago->cantidad_recibida_usd = 0;     //Lo que se recibe del cliente en Dolares
                $pago->usd_tipodecambio      = 0;
                $pago->forma_de_pago         = '01'; //01-Efectivo, 04-Tarjeta de crédito, 48 - Tarjeta de débito
                $pago->referencia_pago       = null; //Para los pagos con TDC o TDD
                $pago->tipo_tarjeta          = null; //Visa o MasterCard

                $pago->created_at            = $now;
                $pago->updated_at            = $now;

                $pago->save();

                //Actualizamos el campo folio del tipo 2 de la tabla series_folios
                $serieFolio = SerieFolio::where('tipo', 2)->first();
                $serieFolio->folio = $DATOS[0]->folio_recibo + 1; //Incrementamos el numero del folio

                //Guardamos los cambios en la tabla SERIES_FOLIOS
                $serieFolio->save();

                $DATA     = json_decode($_POST['meses']);

                for ($i=0; $i < count($DATA); $i++) {

                    $detalle_pago = new DetallePagoColegiatura();

                    $detalle_pago->pagocolegiatura_id   = $pago->id;
                    $detalle_pago->escuela_id           = $DATOS[0]->escuela_id;
                    $detalle_pago->ciclo_id             = $DATOS[0]->ciclo_id;
                    $detalle_pago->alumno_id            = $DATOS[0]->alumno_id;
                    $detalle_pago->grupo_id             = $DATOS[0]->grupo_id;
                    $detalle_pago->clasifgrupo_id       = $DATOS[0]->clasifgrupo_id;
                    $detalle_pago->orden_mes            = $DATA[$i]->orden_mes;
                    $detalle_pago->nombre_mes           = $DATA[$i]->nombre_mes;
                    $detalle_pago->cantidad_concepto    = 1;
                    $detalle_pago->importe_colegiatura  = $DATA[$i]->importe_colegiatura;
                    $detalle_pago->porcentaje_recargo   = $DATA[$i]->porcentaje_recargo;
                    $detalle_pago->recargo_pesos        = 0;
                    $detalle_pago->porcentaje_descuento = $DATA[$i]->porcentaje_descuento;
                    $detalle_pago->descuento_pesos      = 0;
                    $detalle_pago->fecha_pago           = $DATOS[0]->fecha_pago;
                    $detalle_pago->pago_cancelado       = false;
                    $detalle_pago->created_at           = $now;
                    $detalle_pago->updated_at           = $now;

                    $detalle_pago->save();

                }

                return response()->json([
                    'pago_colegiatura_id' => $pago->id,
                    'success'             => true,
                    'message'             => 'El pago se ha procesado correctamente.'
                ], 200);
            });
            return $resultado->getContent();
        }
        catch (Exception $e){
            /*
             * //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
             *
             * For error checking, use error codes, not error messages. Error messages do not change often,
             * but it is possible. Also if the database administrator changes the language setting,
             * that affects the language of error messages.
             *
             * $e->getCode() or  $e->errorInfo[0]
             */

            if($e->getCode()!=0)
            {
                return response()->json([
                    'exception'          => true,
                    'success'            => false,
                    'error_numeric_code' => $e->errorInfo[0],
                    'sqlstate_value'     => $e->errorInfo[1],
                    'message_error'      => $e->errorInfo[2],
                    'message_details'    => $e->getMessage(),
                    'message_user'       => '(1) Error al guardar los datos del pago de inscripcion'

                ],422);
            }
            else{
                return response()->json([
                    'exception'          => true,
                    'success'            => false,
                    'error_numeric_code' => 0,
                    'sqlstate_value'     => 0,
                    'message_error'      => '',
                    'message_details'    => $e->getMessage(),
                    'message_user'       => '(2) Error al guardar los datos del pago de inscripcion'

                ],422);
            }
        }


        //$DATA  = json_decode($request->get('meses'));
        //print_r($DATA);
        //echo '<br />';
        //echo ($DATOS[0]->cantidad_recibida_mxn);
        //die();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagoColegiatura = PagoColegiatura::findOrFail($id);
        return view ('pagos.cancelar_pago_coleg_edit', compact('pagoColegiatura'));
    }

    public function recuperarPagoColegiaturaDetalles($id){

        $pagoColegiatura = PagoColegiatura::findOrFail($id);
        return view('pagos.recuperar_pago_coleg_details',compact('pagoColegiatura'));
    }

    public function recuperarPagoColegiatura(Request $request)
    {
        try{
            $resultado = DB::transaction(function() use ($request){

                $colegiatura = PagoColegiatura::findOrFail($request->get('id_pago_colegiatura'));
                $colegiatura->pago_cancelado = false;
                $colegiatura->fecha_cancelacion = null;
                $colegiatura->cancelado_por = 0;
                $colegiatura->save();

                DetallePagoColegiatura::where('pagocolegiatura_id', $request->get('id_pago_colegiatura'))
                    ->update(['pago_cancelado' => false]);

                return response()->json([
                    'success'   => true,
                    'message'  => 'La recuperacion del recibo de colegiatura, se ha realizado correctamente.'
                ], 200);

            });
            return $resultado->getContent();
        }
        catch (Exception $e){

            /*
             * //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
             *
             * For error checking, use error codes, not error messages. Error messages do not change often,
             * but it is possible. Also if the database administrator changes the language setting,
             * that affects the language of error messages.
             *
             * $e->getCode() or  $e->errorInfo[0]
             */

            if($e->getCode()!=0)
            {
                return response()->json([
                    'exception'          => true,
                    'success'            => false,
                    'error_numeric_code' => $e->errorInfo[0],
                    'sqlstate_value'     => $e->errorInfo[1],
                    'message_error'      => $e->errorInfo[2],
                    'message_details'    => $e->getMessage(),
                    'message_user'       => '(1) Error al recuperar el recibo de colegiatura.'

                ],422);
            }
            else{
                return response()->json([
                    'exception'          => true,
                    'success'            => false,
                    'error_numeric_code' => 0,
                    'sqlstate_value'     => 0,
                    'message_error'      => '',
                    'message_details'    => $e->getMessage(),
                    'message_user'       => '(2) Error al recuperar el recibo de colegiatura.'

                ],422);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $resultado = DB::transaction(function() use ($request){

                $colegiatura = PagoColegiatura::findOrFail($request->get('id_pago_colegiatura'));
                $colegiatura->pago_cancelado = true;
                $colegiatura->fecha_cancelacion = $request->get('fecha_cancelacion');
                $colegiatura->cancelado_por = Auth::user()->id;
                $colegiatura->save();

                DetallePagoColegiatura::where('pagocolegiatura_id', $request->get('id_pago_colegiatura'))
                                        ->update(['pago_cancelado' => true]);

                return response()->json([
                    'success'   => true,
                    'message'  => 'La cancelacion del recibo de colegiatura, se ha realizado correctamente.'
                ], 200);

            });
            return $resultado->getContent();
        }
        catch (Exception $e){

            /*
             * //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
             *
             * For error checking, use error codes, not error messages. Error messages do not change often,
             * but it is possible. Also if the database administrator changes the language setting,
             * that affects the language of error messages.
             *
             * $e->getCode() or  $e->errorInfo[0]
             */

            if($e->getCode()!=0)
            {
                return response()->json([
                    'exception'          => true,
                    'success'            => false,
                    'error_numeric_code' => $e->errorInfo[0],
                    'sqlstate_value'     => $e->errorInfo[1],
                    'message_error'      => $e->errorInfo[2],
                    'message_details'    => $e->getMessage(),
                    'message_user'       => '(1) Error al cancelar el recibo de colegiatura.'

                ],422);
            }
            else{
                return response()->json([
                    'exception'          => true,
                    'success'            => false,
                    'error_numeric_code' => 0,
                    'sqlstate_value'     => 0,
                    'message_error'      => '',
                    'message_details'    => $e->getMessage(),
                    'message_user'       => '(2) Error al cancelar el recibo de colegiatura.'

                ],422);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
