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
        $ciclo  =   $this->cicloEscolarPredeterminado();
        $filtro = Clasificacion::where('ciclo_id',$ciclo->id)
                  ->where('escuela_id', $id)
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
        /*
        * 1) Verificar que al menos exista una escuela activa
        */
        $numeroDeEscuelas = Escuela::all()
            ->where('escuela_status', true)
            ->count();

        if($numeroDeEscuelas===0)
        {
            //Nueva Escuela
            return redirect()->route('nuevaescuela');
        }
        /*
         * 2) Verificar que al menos exista un ciclo escolar creado y que este activo
         * 3) Si existe al menos un ciclo escolar, debe existir el ciclo de trabajo predeterminado
         */
        else if($this->cicloEscolarPredeterminado()===null)
        {
            //1) No existe al menos un ciclo escolar creado
            //2) Existe al menos un ciclo escolar, pero no se ha marcado como predeterminado
            //3) Existe mas de un ciclo escolar, pero ninguno se ha marcado como predeterminado
            //En cualquiera de los tres casos es necesario redirigir hacia la seccion de los CICLOS ESCOLARES
            return redirect()->route('ciclos');
        }
        else
        {
            //Obtener el ciclo escolar predeterminado de trabajo
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
            else
            {
                $escuelas = Escuela::where('escuela_status', true)
                            ->get();
                return view ('clasificacion.index', compact('escuelas', 'ciclo'));
            }
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
    public function show($id_clasificacion,$id_escuela)
    {
        //Obtener el ciclo escolar predeterminado de trabajo
        $ciclo    = $this->cicloEscolarPredeterminado();

        $escuela = Escuela::where('escuela_status', true)
                   ->where('id', $id_escuela)
                   ->first();

        $clasificacion = Clasificacion::where('clasificacion_status', true)
            ->where('id', $id_clasificacion)
            ->first();

        return view('clasificacion.delete',compact('id_clasificacion','ciclo','escuela','clasificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_clasificacion,$id_escuela)
    {
        //Obtener el ciclo escolar predeterminado de trabajo
        $ciclo    = $this->cicloEscolarPredeterminado();

        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        $clasificacion = Clasificacion::where('clasificacion_status', true)
            ->where('id', $id_clasificacion)
            ->first();

        return view('clasificacion.edit', compact('ciclo','escuelas','id_escuela','clasificacion'));
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
        $validation =Validator::make($request->all(),[
            'ciclo_id'             => 'required',
            'escuela_id'           => 'required',
            'clasificacion_nombre' => 'required'
        ]);

        if($validation->passes()){

            $updated_at = Carbon::now('America/Mexico_City Time Zone');

            $clasificacion = Clasificacion::findOrFail($id);

            $clasificacion->escuela_id = $request->get('escuela_id');
            $clasificacion->clasificacion_nombre = $request->get('clasificacion_nombre');
            $clasificacion->updated_at = $updated_at;

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $updated_at = Carbon::now('America/Mexico_City Time Zone');

        $clasificacion = Clasificacion::findOrFail($id);

        $clasificacion->clasificacion_status = false;
        $clasificacion->updated_at = $updated_at;

        $clasificacion->save();

        return response()->json([
            'success' => true,
            'message' => 'El registro se ha eliminado correctamente.'
        ], 200);
    }
}
