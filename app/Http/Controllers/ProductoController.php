<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Escuela;
use App\Models\Producto;
use App\Models\ProductoPrecio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
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

        $productos = Producto::select('productos.escuela_id','productos.ciclo_id','productos.categoria_id')
               ->addSelect('productos.subcategoria_id','productos.clasificacion1_id')
               ->addSelect('productos.nombre_producto','productos.info_adicional_producto','productos_precios.producto_precio_venta','productos_precios.id as producto_precio_id')
               ->join('productos_precios','productos_precios.producto_id','=','productos.id')
               ->where('productos.ciclo_id', $ciclo->id)
               ->where('productos.producto_disponible', true)
               ->where('productos.producto_status', true)
               ->where('productos_precios.producto_precio_actual', true)
               ->orderBy('productos.created_at','asc')
               ->get();

        if ($productos->count()!=0){
            return view('productos.productos_index',compact('ciclo', 'productos'));
        }
        else{
            return redirect(route('nuevo_producto_create'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        //Obtener el ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
                 ->where('ciclo_actual', true)
                 ->first();


        return view('productos.nuevo_producto_create', compact('escuelas', 'ciclo'));
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

            /*Tabla: PRODUCTOS*/
            'ciclo_id'         => 'required',
            'escuela_id'       => 'required',
            'categoria_id'     => 'required',
            'subcategoria_id'  => 'required',
            'clasificacion_id' => 'required',
            'nombre_producto'  => 'required'
        ]);

        if($validation->passes()){

            $revision = Producto::where('escuela_id', $request->get('escuela_id'))
                        ->where('ciclo_id', $request->get('ciclo_id'))
                        ->where('categoria_id', $request->get('categoria_id'))
                        ->where('subcategoria_id',$request->get('subcategoria_id'))
                        ->where('clasificacion1_id',$request->get('clasificacion_id'))
                        ->where('nombre_producto',mb_strtolower($request->get('nombre_producto'),'UTF-8'))
                        ->get();

            if($revision->count()!=0){
                return response()->json([
                    'coincidencia' => true,
                    'success'      => true,
                    'message'      => 'El producto que trata de guardar ya existe. Verifique los datos.'
                ], 200);
            }
            else{
                try{
                    //Iniciamos la transaccion para la insercion de los datos de inscripción
                    $resultado = DB::transaction(function () use ($request)  {

                        $now = Carbon::now('America/Mexico_City Time Zone');

                        $producto = new Producto();

                        $producto->escuela_id              = $request->get('escuela_id');
                        $producto->ciclo_id                = $request->get('ciclo_id');
                        $producto->categoria_id            = $request->get('categoria_id');
                        $producto->subcategoria_id         = $request->get('subcategoria_id');
                        $producto->clasificacion1_id       = $request->get('clasificacion_id');
                        $producto->nombre_producto         = mb_strtolower($request->get('nombre_producto'),'UTF-8');
                        $producto->info_adicional_producto = ($request->get('info_adicional_producto')===null) ? null : mb_strtolower($request->get('info_adicional_producto'),'UTF-8');
                        $producto->producto_disponible     = true;
                        $producto->producto_status         = true;
                        $producto->saldo_inicial           = 0;
                        $producto->entradas                = 0;
                        $producto->salidas                 = 0;
                        $producto->existencias             = 0;
                        $producto->created_at              = $now;
                        $producto->updated_at              = $now;

                        $producto->save();

                        $producto_precio = new ProductoPrecio();

                        $producto_precio->escuela_id                 = $request->get('escuela_id');
                        $producto_precio->ciclo_id                   = $request->get('ciclo_id');
                        $producto_precio->producto_id                = $producto->id;
                        $producto_precio->producto_precio_venta      = ($request->get('precio_venta_producto')===null) ? 0 : $request->get('precio_venta_producto');
                        $producto_precio->producto_precio_actual     = true;
                        $producto_precio->producto_precio_disponible = true;
                        $producto_precio->producto_precio_status     = true;
                        $producto_precio->created_at                 = $now;
                        $producto_precio->updated_at                 = $now;

                        $producto_precio->save();

                        return response()->json([
                            'success'   => true,
                            'message'   => 'Los datos del producto se han guardado correctamente.'
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
                            'message_user'       => '(1) Error al guardar los datos del producto.'

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
                            'message_user'       => '(2) Error al guardar los datos del producto.'

                        ],422);
                    }


                } //catch exception
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
