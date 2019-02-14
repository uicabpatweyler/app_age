<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Ciclo;
use App\Models\GrupoAlumno;
use App\Models\ItemSalidaProducto;
use App\Models\KardexProducto;
use App\Models\SalidaProducto;
use App\Models\SerieFolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NuevaVentaController extends Controller
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

    public function dataTableAlumnos(){
        $alumnos = GrupoAlumno::where('escuela_id',1)
                   ->where('ciclo_id',1)
                   ->where('pago_inscripcion',true)
                   ->get();

        $array_detalle=[];

        foreach ($alumnos as $fila){

            $array_detalle[] = [
                'escuela_id' => $fila->escuela_id,
                'ciclo_id'   => $fila->ciclo_id,
                'alumno_id'  => $fila->alumno_id,
                'grupo_id'   => $fila->grupo_id,
                'escuela'    => $fila->EscuelaGrupoAlumno->escuela_nombre,
                'ciclo'      => $fila->CicloGrupoAlumno->ciclo_anioinicial.'-'.$fila->CicloGrupoAlumno->ciclo_aniofinal,
                'grupo'      => $fila->GrupoDeGrupoAlumno->grupo_nombre,
                'alumno' => ucwords($fila->AlumnoGrupoAlumno->alumno_primernombre.' '.$fila->AlumnoGrupoAlumno->alumno_segundonombre.' '.$fila->AlumnoGrupoAlumno->alumno_apellidopaterno.' '.$fila->AlumnoGrupoAlumno->alumno_apellidomaterno),
            ];
        }

        return response()->json([
            'data' => $array_detalle
        ]);
    }

    public function cancelarVentaIndex(){
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        $recibos = DB::table('salidas_producto')
            ->select('salidas_producto.id','salidas_producto.folio_recibo')
            ->addSelect('salidas_producto.fecha_venta','salidas_producto.venta_cancelada','salidas_producto.alumno_id','salidas_producto.cantidad_recibida_mxn')
            ->addSelect(DB::raw('CONCAT(alumnos.alumno_apellidopaterno," ", alumnos.alumno_apellidomaterno," ",alumnos.alumno_primernombre," ",alumnos.alumno_segundonombre) AS nombreAlumno'))
            ->join('alumnos','salidas_producto.alumno_id','=','alumnos.id')
            ->where('salidas_producto.ciclo_id',$ciclo->id)
            ->orderBy('salidas_producto.folio_recibo', 'asc')
            ->get();

        return view('ventas.cancelar_venta_index', compact('ciclo', 'recibos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        $folio = SerieFolio::where('tipo',4)->first();

        $categorias = CategoriaProducto::where('ciclo_id', $ciclo->id)
            ->where('escuela_id',1)
            ->orderBy('id','asc')
            ->get();

        return view('ventas.nueva_venta',compact('categorias','folio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $resultado = DB::transaction(function() use ($request){

                $DATOS = json_decode($request->get('encabezado'));
                $now = Carbon::now('America/Mexico_City Time Zone');

                $salida = new SalidaProducto();

                $salida->escuela_id            = $DATOS[0]->escuela_id;
                $salida->ciclo_id              = $DATOS[0]->ciclo_id;
                $salida->alumno_id             = $DATOS[0]->alumno_id;
                $salida->grupo_id              = $DATOS[0]->grupo_id;
                $salida->user_id               = Auth::user()->id;
                $salida->serie_recibo          = $DATOS[0]->serie_recibo;
                $salida->folio_recibo          = $DATOS[0]->folio_recibo;
                $salida->fecha_venta           = $DATOS[0]->fecha_venta;
                $salida->venta_cancelada       = false;
                $salida->fecha_cancelacion     = null;
                $salida->cancelado_por         = 0;
                $salida->motivo_cancelacion    = null;
                $salida->moneda                = 'MXN';
                $salida->cantidad_recibida_mxn = $DATOS[0]->cantidad_recibida_mxn;
                $salida->cantidad_recibida_usd = 0;
                $salida->usd_tipodecambio      = 0;
                $salida->forma_de_pago         = '01';
                $salida->referencia_pago       = null;
                $salida->tipo_tarjeta          = null;
                $salida->created_at            = $now;
                $salida->updated_at            = $now;

                $salida->save();

                //Actualizamos el campo folio del tipo 4 de la tabla series_folios
                $serieFolio = SerieFolio::where('tipo', 4)->first();
                $serieFolio->folio = $DATOS[0]->folio_recibo + 1; //Incrementamos el numero del folio

                //Guardamos los cambios en la tabla SERIES_FOLIOS
                $serieFolio->save();

                $ITEMS = json_decode($request->get('itemsventa'));

                $x = 1;

                for ($i=0; $i < count($ITEMS); $i++) {
                    $itemSalida = new ItemSalidaProducto();

                    $itemSalida->salidaprod_id         = $salida->id;
                    $itemSalida->escuela_id            = $DATOS[0]->escuela_id;
                    $itemSalida->ciclo_id              = $DATOS[0]->ciclo_id;
                    $itemSalida->alumno_id             = $DATOS[0]->alumno_id;
                    $itemSalida->grupo_id              = $DATOS[0]->grupo_id;
                    $itemSalida->user_id               = Auth::user()->id;
                    $itemSalida->numero_linea          = $x++;
                    $itemSalida->categoria_id          = $ITEMS[$i]->categoria_id;
                    $itemSalida->producto_id           = $ITEMS[$i]->producto_id;
                    $itemSalida->precio_unitario       = $ITEMS[$i]->precio_unitario;
                    $itemSalida->cantidad              = $ITEMS[$i]->cantidad;
                    $itemSalida->fecha_venta           = $DATOS[0]->fecha_venta;
                    $itemSalida->venta_cancelada       = false;
                    $itemSalida->created_at            = $now;
                    $itemSalida->updated_at            = $now;

                    $itemSalida->save();

                    KardexProducto::find($ITEMS[$i]->producto_id)->increment('salidas',$ITEMS[$i]->cantidad);
                    KardexProducto::find($ITEMS[$i]->producto_id)->decrement('existencia',$ITEMS[$i]->cantidad);
                }

                return response()->json([
                    'salida_id' => $salida->id,
                    'success'   => true,
                    'message'  => 'Venta procesada correctamente.'
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
                    'message_user'       => '(1) Error al guardar los datos de la venta actual.'

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
                    'message_user'       => '(2) Error al guardar los datos de la venta actual.'

                ],422);
            }
        }
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

        $salida = SalidaProducto::findOrFail($id);

        return view('ventas.cancelar_venta_edit', compact('salida'));
    }

    public function recuperarVentaDetalles($id){

        $salida = SalidaProducto::findOrFail($id);
        return view('ventas.recuperar_venta_details',compact('salida'));
    }

    public function recuperarVenta(Request $request){
        try{
            $resultado = DB::transaction(function() use ($request){

                $salida = SalidaProducto::findOrFail($request->get('id_salida_producto'));
                $salida->venta_cancelada = false;
                $salida->fecha_cancelacion = null;
                $salida->cancelado_por = 0;
                $salida->save();

                ItemSalidaProducto::where('salidaprod_id', $request->get('id_salida_producto'))
                    ->update(['venta_cancelada' => false]);

                //Obtenemos los productos contenidos en el recibo de venta que se esta recuperando
                $productosDelRecibo = ItemSalidaProducto::where('salidaprod_id', $request->get('id_salida_producto'))
                    ->where('venta_cancelada', false)
                    ->orderBy('numero_linea', 'asc')
                    ->get();

                foreach ($productosDelRecibo as $producto){
                    KardexProducto::find($producto->producto_id)->increment('salidas',$producto->cantidad);
                    KardexProducto::find($producto->producto_id)->decrement('existencia',$producto->cantidad);
                }

                return response()->json([
                    'success'   => true,
                    'message'  => 'La recuperación del recibo de venta, se ha realizado correctamente.'
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
                    'message_user'       => '(1) Error al recuperar el recibo de venta.'

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
                    'message_user'       => '(2) Error al recuperar el recibo de venta.'

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

                $salida = SalidaProducto::findOrFail($request->get('id_salida_producto'));
                $salida->venta_cancelada = true;
                $salida->fecha_cancelacion = $request->get('fecha_cancelacion');
                $salida->cancelado_por = Auth::user()->id;
                $salida->save();

                ItemSalidaProducto::where('salidaprod_id', $request->get('id_salida_producto'))
                               ->update(['venta_cancelada' => true]);

                //Obtenemos los productos contenidos en el recibo de venta que se esta cancelando
                $productosDelRecibo = ItemSalidaProducto::where('salidaprod_id', $request->get('id_salida_producto'))
                                      ->where('venta_cancelada', true)
                                      ->orderBy('numero_linea', 'asc')
                                      ->get();

                foreach ($productosDelRecibo as $producto){
                    KardexProducto::find($producto->producto_id)->increment('existencia',$producto->cantidad);
                    KardexProducto::find($producto->producto_id)->decrement('salidas',$producto->cantidad);
                }

                return response()->json([
                    'success'   => true,
                    'message'  => 'La cancelacion del recibo de venta, se ha realizado correctamente.'
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
                    'message_user'       => '(1) Error al cancelar el recibo de venta.'

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
                    'message_user'       => '(2) Error al cancelar el recibo de venta.'

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
