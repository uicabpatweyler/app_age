<?php

namespace App\Http\Controllers;

use App\Models\CuotaInscripcion;
use App\Models\GrupoAlumno;
use Illuminate\Http\Request;

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

        return view('pagos.pago_inscripcion_create',compact('inscripcion','cuota'));
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
