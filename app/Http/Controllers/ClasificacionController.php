<?php

namespace App\Http\Controllers;


use App\Models\Ciclo;
use App\Models\Clasificacion;
use App\Models\Escuela;
use Illuminate\Http\Request;


class ClasificacionController extends Controller{


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

        //Verificar las clasificaciones existentes para el ciclo actual de trabajo
        $clasificaciones = Clasificacion::all()
            ->where('ciclo_id', $ciclo->id)
            ->where('clasificacion_status', true)
            ->count();

        if($clasificaciones===0){
            //Nueva clasifiación
            return redirect()->route('nuevaclasificacion');
        }
        else if($clasificaciones>=1){
            //Mostrar la lista de clasificaciones
            return view ('clasificacion.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        $ciclo = $this->cicloEscolarPredeterminado();

        return view('clasificacion.create', compact('ciclo', 'escuelas'));
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
