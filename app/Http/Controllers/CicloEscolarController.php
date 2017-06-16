<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CicloEscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclos = Ciclo::where('ciclo_activo',0)
                         ->orderBy('ciclo_anioinicial','desc')
                         ->get();
        return view('cicloescolar.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cicloescolar/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'ciclo_anioinicial' => 'required|unique:ciclos|max:4',
            'ciclo_aniofinal'   => 'required|unique:ciclos|max:4',
        ]);

        if($validation->passes()){

            $now = Carbon::now('America/Mexico_City Time Zone');
            $ciclo_escolar = new Ciclo();
            $ciclo_escolar->ciclo_anioinicial = $request->get('ciclo_anioinicial');
            $ciclo_escolar->ciclo_aniofinal = $request->get('ciclo_aniofinal');
            $ciclo_escolar->ciclo_actual = false;
            $ciclo_escolar->ciclo_activo = false;
            $ciclo_escolar->created_at = $now;
            $ciclo_escolar->updated_at = $now;

            $ciclo_escolar->save();

            return response()->json([
                'success' => true,
                'message' => 'El ciclo escolar se ha creado correctamente.'
            ], 200);
        }
        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'success' => false,
            'message' => $errors
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return view('cicloescolar.details', compact('ciclo'));

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
