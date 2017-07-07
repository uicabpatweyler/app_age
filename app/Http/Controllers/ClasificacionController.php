<?php

namespace App\Http\Controllers;


use App\Models\Ciclo;
use App\Models\Clasificacion;
use App\Models\Escuela;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClasificacionController extends Controller{

    public function filtrarClasificaciones($id)
    {
        $filtro = Clasificacion::where('escuela_id',$id)
                  ->where('clasificacion_status', true)
                  ->get()
                  ->toArray();

        return response()->json([
            'data' => $filtro
        ]);
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
            $escuelas = Escuela::where('escuela_status', true)
                        ->get();
            return view ('clasificacion.index', compact('escuelas', 'ciclo'));
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
        $validation =Validator::make($request->all(),[
            'ciclo_id'             => 'required',
            'escuela_id'           => 'required',
            'clasificacion_nombre' => 'required'
        ]);

        if($validation->passes()){

            $now = Carbon::now('America/Mexico_City Time Zone');

            $clasificacion = new Clasificacion();
            $clasificacion->ciclo_id = $request->get('ciclo_id');
            $clasificacion->escuela_id = $request->get('escuela_id');
            $clasificacion->clasificacion_nombre = $request->get('clasificacion_nombre');
            $clasificacion->clasificacion_status = true;
            $clasificacion->created_at = $now;
            $clasificacion->updated_at = $now;

            $clasificacion->save();

            return response()->json([
                'success' => true,
                'message' => 'Los datos se han guardado correctamente.'
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

    public function eliminar($id)
    {

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
