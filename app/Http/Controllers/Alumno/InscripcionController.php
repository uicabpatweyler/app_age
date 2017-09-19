<?php

namespace App\Http\Controllers\Alumno;

use App\Models\Alumno;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InscripcionController extends Controller
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

    public function inscripcion_paso1()
    {
        return view('alumnos.inscripcion.inscripcion_paso1');
    }

    public function verificaCurpAlumno($curp)
    {
        $verificarCurp = Alumno::where('alumno_curp', $curp)->count();

        return $verificarCurp;
    }

    public function inscripcion_paso2(Request $request)
    {
        $verificarCurp = $this->verificaCurpAlumno($request->get('alumno_curp'));

        if($verificarCurp!=0)
        {
            $alumnos = Alumno::where('alumno_curp', $request->get('alumno_curp'))->get();
            return view('alumnos.inscripcion.inscripcion_paso1', compact('verificarCurp','alumnos'));
        }
        else
        {
            $estados = Estado::select('id','estado_nombre')
                ->orderBy('estado_nombre', 'asc')
                ->get();
            $curp = $request->get('curp');
            $alumno_curp = $request->get('alumno_curp');
            
            return view('alumnos.inscripcion.inscripcion_paso2', compact('curp','alumno_curp','estados'));
        }
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
