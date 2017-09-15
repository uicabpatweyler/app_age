<?php

namespace App\Http\Controllers;

use App\Models\GrupoCdc;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GrupoCdcController extends Controller
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

        $grupo_cdc = new GrupoCdc();

        $grupo_cdc->grupo_id = $request->get('grupo_id');
        $grupo_cdc->cuotacolegiatura_id = $request->get('cuotacolegiatura_id');
        $grupo_cdc->ec_grupo_cdc_disponible = true;
        $grupo_cdc->ec_grupo_cdc_status = true;
        $grupo_cdc->created_at = $now;
        $grupo_cdc->updated_at = $now;

        $grupo_cdc->save();

        return response()->json([
            'success' => true,
            'message' => 'La cuota de colegiatura se ha asignado correctamente.'
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
