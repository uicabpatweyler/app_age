<?php

namespace App\Http\Controllers;

use App\Models\CuotaInscripcion;
use App\Models\GrupoAlumno;
use App\Models\PagoInscripcion;
use App\Models\SerieFolio;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class PagoCuotaInscripcionController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_inscripcion)
    {
        $inscripcion =GrupoAlumno::where('id',$id_inscripcion)->first();

        $num_recibo = SerieFolio::where('tipo',1)->first();

        /*
         * SELECT cuotas_inscripcion.cuotainscripcion_cuota FROM cuotas_inscripcion
            INNER JOIN ec_grupo_cdi ON ec_grupo_cdi.cuotainscripcion_id = cuotas_inscripcion.id
            WHERE
            ec_grupo_cdi.grupo_id = ?
         */

        $cuota = CuotaInscripcion::select('cuotainscripcion_cuota')
                ->join('ec_grupo_cdi', 'ec_grupo_cdi.cuotainscripcion_id', '=', 'cuotas_inscripcion.id')
                ->where('ec_grupo_cdi.grupo_id',$inscripcion->grupo_id)
                ->first();

        return view('pagos.pago_inscripcion_create',compact('inscripcion','cuota','num_recibo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[

            /*Tabla: PAGOS_INSCRIPCION */
            'escuela_id'     => 'required',
            'ciclo_id'       => 'required',
            'alumno_id'      => 'required',
            'grupo_id'       => 'required',
            'inscripcion_id' => 'required',
            'clasifgrupo_id' => 'required'
        ]);

        if($validation->passes()){
            try
            {
                $resultado = DB::transaction(function () use ($request) {

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $pago = new PagoInscripcion();

                    $pago->escuela_id            = $request->get('escuela_id');
                    $pago->ciclo_id              = $request->get('ciclo_id');
                    $pago->alumno_id             = $request->get('alumno_id');
                    $pago->grupo_id              = $request->get('grupo_id');
                    $pago->clasifgrupo_id        = $request->get('clasifgrupo_id');
                    $pago->inscripcion_id        = $request->get('inscripcion_id'); //La fila de la entidad GRUPOS_ALUMNOS a la que corresponde este pago 
                    $pago->user_id               = Auth::user()->id;
                    
                    $pago->serie_recibo          = $request->get('serie_recibo');
                    $pago->folio_recibo          = $request->get('folio_recibo');
                    $pago->cantidad_concepto     = $request->get('cantidad_concepto');
                    $pago->importe_cuota         = $request->get('importe_cuota');
                    $pago->porcentaje_descuento  = $request->get('porcentaje_descuento');
                    $pago->descuento_pesos       = $request->get('descuento_pesos');
                    
                    $pago->moneda                = 'MXN'; //MXN Peso Mexicano - USD Dolar Americano
                    $pago->cantidad_recibida_mxn = $request->get('importe_cuota');
                    $pago->cantidad_recibida_usd = 0;     //Lo que se recibe del cliente en Dolares
                    $pago->usd_tipodecambio      = 0;
                    $pago->forma_de_pago         = '01'; //01-Efectivo, 04-Tarjeta de crédito, 48 - Tarjeta de débito
                    $pago->referencia_pago       = null; //Para los pagos con TDC o TDD
                    $pago->tipo_tarjeta          = null; //Visa o MasterCard
                    
                    $pago->pago_cancelado        = false;
                    $pago->fecha_cancelacion     = null;
                    $pago->cancelado_por         = 0;
                    $pago->motivo_cancelacion    = null;
                    
                    $pago->created_at            = $now;
                    $pago->updated_at            = $now;

                    $pago->save();

                    //Actualizar la fila correspondiente en la tabla GRUPOS_ALUMNOS
                    $grupoAlumno=GrupoAlumno::findOrFail($request->get('inscripcion_id'));
                    $grupoAlumno->pago_inscripcion = true;

                    //Guardamos los cambios
                    $grupoAlumno->save();

                    //Actualizamos el campo folio del tipo 1 de la tabla series_folios
                    $serieFolio = SerieFolio::where('tipo', 1)->first();
                    $serieFolio->folio = $request->get('folio_recibo') + 1; //Incrementamos el numero del folio

                    //Guardamos los cambios en la tabla SERIES_FOLIOS
                    $serieFolio->save();

                    return response()->json([
                        'pago_inscripcion_id' => $pago->id,
                        'success'             => true,
                        'message'             => 'El pago de inscripción se ha procesado correctamente.'
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
        }

        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'exception' => false,
            'success'   => false,
            'message'   => $errors
        ], 422);


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
