<?php

namespace App\Http\Controllers;

use App\Models\GrupoCdi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GrupoCdiController extends Controller
{
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
        $now = Carbon::now('America/Mexico_City Time Zone');

        $grupo_cdi = new GrupoCdi();

        $grupo_cdi ->grupo_id = $request->get('grupo_id');
        $grupo_cdi->cuotainscripcion_id = $request->get('cuotainscripcion_id');
        $grupo_cdi->ec_grupo_cdi_disponible = true;
        $grupo_cdi->ec_grupo_cdi_status = true;
        $grupo_cdi->created_at = $now;
        $grupo_cdi->updated_at = $now;

        $grupo_cdi->save();

        return response()->json([
            'success' => true,
            'message' => 'La cuota de inscripción se ha asignado correctamente.'
        ], 200);

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
