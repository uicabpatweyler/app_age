<?php

namespace App\Http\Controllers;

use App\Models\DatosInscripcionAlumno;
use App\Models\Ciclo;

use Illuminate\Http\Request;


class ImprHojaInscripcionController extends Controller
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

    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclo = $this->cicloEscolarPredeterminado();


        $dias = DatosInscripcionAlumno::select('alumnos.alumno_primernombre','alumnos.alumno_apellidopaterno')
            ->addSelect('alumnos.alumno_apellidopaterno','alumnos.alumno_apellidomaterno')
            ->addSelect('grupos.grupo_nombre','grupos_alumnos.id as id_ga','grupos_alumnos.grupo_id','grupos_alumnos.clasifgrupo_id','grupos_alumnos.pago_inscripcion')
            ->addSelect('datos_inscripcion_alumno.escuela_id','datos_inscripcion_alumno.ciclo_id','datos_inscripcion_alumno.alumno_id')
            ->leftjoin('alumnos', 'datos_inscripcion_alumno.alumno_id', '=', 'alumnos.id')
            ->leftjoin('grupos_alumnos', 'grupos_alumnos.alumno_id', '=', 'alumnos.id')
            ->leftjoin('grupos', 'grupos_alumnos.grupo_id', '=', 'grupos.id')
            ->where('datos_inscripcion_alumno.ciclo_id',$ciclo->id)
            ->get();

        return view('impresiones.impr_hoja_inscrip_index', compact('dias', 'ciclo'));
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
