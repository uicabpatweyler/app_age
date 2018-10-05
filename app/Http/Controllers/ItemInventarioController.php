<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use App\Models\Ciclo;
use App\Models\Escuela;
use App\Models\Producto;
use App\Models\SerieFolio;
use Illuminate\Http\Request;

class ItemInventarioController extends Controller
{

    public function listaProductosCategorias($categoria_id){

        //Obtener el ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        $productos_categoria = Producto::select('productos.id','productos.clasificacion1_id','productos.nombre_producto')
                               ->addSelect('productos.info_adicional_producto','clasificaciones_productos.clasif_nombre')
                               ->join('clasificaciones_productos','productos.clasificacion1_id','=','clasificaciones_productos.id')
                               ->where('productos.escuela_id',1)
                               ->where('productos.ciclo_id',$ciclo->id)
                               ->where('productos.categoria_id',$categoria_id)
                               ->orderBy('productos.id','asc')->get()->toArray();

        //$productos = Producto::where('categoria_id',$categoria_id)->orderBy('id','asc')->get()->toArray();

        //return dd($productos_categoria);

        return response()->json([
            'data' => $productos_categoria
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        $ciclo = Ciclo::where('ciclo_activo', false)
                 ->where('ciclo_actual', true)
                 ->first();

        $seriefolio = SerieFolio::where('tipo',3)
                      ->first();

        $categorias = CategoriaProducto::where('ciclo_id', $ciclo->id)
                      ->where('escuela_id',1)
                      ->orderBy('id','asc')
                      ->get();

        return view ('inventarios.nueva_compra',compact('ciclo','categorias','escuelas','seriefolio'));
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
        //
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
