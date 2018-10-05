<?php

namespace App\Http\Controllers;

use App\Models\ClasificacionProducto;
use Illuminate\Http\Request;

class ClasificacionProductoController extends Controller
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

    public function listaSubCategorias($categoria_id){
        $subcategorias = ClasificacionProducto::where('categoria_id',$categoria_id)
                         ->where('subcategoria',0)
                         ->where('clasif_disponible', true)
                         ->where('clasif_status', true)
                         ->select('id as value', 'clasif_nombre as text')
                         ->orderBy('clasif_orden','asc')
                         ->get()
                         ->toArray();
        array_unshift($subcategorias, ['value' => '', 'text' => '[Elegir SubCategoria]']);

        return $subcategorias;

    }

    public function listaClasificaciones($subcategoria_id){
        $clasificaciones = ClasificacionProducto::where('subcategoria',$subcategoria_id)
                         ->where('clasif_subcateg_padre', false)
                         ->where('clasif_disponible', true)
                         ->where('clasif_status', true)
                         ->select('id as value', 'clasif_nombre as text')
                         ->orderBy('clasif_orden','asc')
                         ->get()
                         ->toArray();

        array_unshift($clasificaciones, ['value' => '', 'text' => '[Elegir clasificacion]']);

        return $clasificaciones;

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
