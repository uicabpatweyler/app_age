<?php

namespace App\Http\Controllers;

use App\Models\TipoDeServicio;
use App\Models\Nivel;
use App\Models\Servicio;
use Illuminate\Http\Request;

class EscuelaController extends Controller
{
    public function listaAjaxNiveles($id){
        $niveles = Nivel::where('tiposervicio_id', $id)
            ->select('id as value', 'nivel_nombre as text')
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        array_unshift($niveles, ['value' => '-1', 'text' => '[Seleccione un nivel]']);
        return $niveles;
    }

    public function listaAjaxServicios($id){
        $servicios = Servicio::where('nivel_id', $id)
            ->select('id as value', 'servicio_nombre as text')
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        array_unshift( $servicios, ['value' => '-1', 'text' => '[Tipo de Servicio]']);
        return  $servicios;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposdeservicio = TipoDeServicio::select('id', 'tiposervicio_nombre')
                           ->where('tiposervicio_estado', 1)
                           ->OrderBy('id','ASC')
                           ->get();

       return view('escuelas.create',compact('tiposdeservicio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * views\escuelas\create.blade.php
        */
        return view('escuelas/create');
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
