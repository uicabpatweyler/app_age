<?php

namespace App\Http\Controllers;

use App\Models\GrupoAlumno;
use Illuminate\Http\Request;


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
        $alumnos = GrupoAlumno::where('escuela_id',1)->where('ciclo_id',1)->where('pago_inscripcion',true)->get();

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
