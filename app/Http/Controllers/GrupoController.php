<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Clasificacion;
use App\Models\CuotaColegiatura;
use App\Models\CuotaInscripcion;
use App\Models\Escuela;
use App\Models\Grupo;
use App\Models\GrupoCdc;
use App\Models\GrupoCdi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    public function listaAjaxClasifPorEscuela($id)
    {

        $ciclo  =   $this->cicloEscolarPredeterminado();

        $clasificaciones = Clasificacion::where('ciclo_id',$ciclo->id)
                           ->where('escuela_id', $id)
                           ->select('id as value', 'clasificacion_nombre as text')
                           ->orderBy('id', 'ASC')
                           ->get()
                           ->toArray();
        array_unshift($clasificaciones, ['value' => '-1', 'text' => '[Elegir clasificación]']);

        return $clasificaciones;
    }

    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    public function listaDeGrupos($id_escuela)
    {
        $ciclo = $this->cicloEscolarPredeterminado();

        $escuela = Escuela::where('escuela_status', true)
                  ->where('id', $id_escuela)
                  ->first();

        $grupos = Grupo::where('grupo_status', true)
                  ->where('ciclo_id', $ciclo->id)
                  ->where('escuela_id', $id_escuela)
                  ->OrderBy('id', 'asc')
                  ->get();

        return view('grupos.listagrupos', compact('escuela','ciclo', 'grupos'));
    }

    /**
     * Muestra el grupo elegido para poder seleccionar una Cuota de Inscripcion (CDI)
     *
     * @return \Illuminate\Http\Response
     */
    public function seleccionarCDI($id_grupo){

        $grupo = Grupo::where('id', $id_grupo)->first();

        $cuotas = CuotaInscripcion::where('cuotainscripcion_status', true)
            ->where('cuotainscripcion_disponible', true)
            ->where('ciclo_id', $grupo->ciclo_id)
            ->where('escuela_id', $grupo->escuela_id)
            ->get();

        $grupo_cdi = GrupoCdi::where('grupo_id', $id_grupo)
            ->where('ec_grupo_cdi_disponible', true)
            ->where('ec_grupo_cdi_status', true)
            ->first();

        return view('grupos.seleccionar_cdi', compact('grupo', 'cuotas', 'grupo_cdi'));
    }

    /**
     * Muestra el grupo elegido para poder seleccionar una Cuota de Colegitura (CDC)
     *
     * @return \Illuminate\Http\Response
     */
    public function seleccionarCDC($id_grupo)
    {
        $grupo = Grupo::where('id', $id_grupo)->first();

        $cuotas = CuotaColegiatura::where('cuotacolegiatura_status', true)
            ->where('cuotacolegiatura_disponible', true)
            ->where('ciclo_id', $grupo->ciclo_id)
            ->where('escuela_id', $grupo->escuela_id)
            ->get();

        $grupo_cdc = GrupoCdc::where('grupo_id', $id_grupo)
            ->where('ec_grupo_cdc_disponible', true)
            ->where('ec_grupo_cdc_status', true)
            ->first();

        return view('grupos.seleccionar_cdc', compact('grupo','cuotas','grupo_cdc'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclo = $this->cicloEscolarPredeterminado();

        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        return view('grupos.index', compact('ciclo', 'escuelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciclo = $this->cicloEscolarPredeterminado();

        $escuelas = Escuela::where('escuela_status', true)
            ->get();

        //return dd($ciclo);
        return view('grupos.create', compact('ciclo','escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1) Validacion de datos

        $validation =Validator::make($request->all(),[
            'ciclo_id'                => 'required',
            'escuela_id'              => 'required',
            'clasificacion_id'        => 'required',
            'grupo_nombre'            => 'required',
            'grupo_alumnospermitidos' => 'required'
        ]);

        //1.1) La validadcion de datos fue correcta
        if($validation->passes()){

            //1.2) Verificar duplicados en base a: Escuela, Ciclo, Clasificacion y Nombre de grupo

            $grupo = Grupo::where('grupo_status', true)
                ->where('ciclo_id', $request->get('ciclo_id'))
                ->where('escuela_id', $request->get('escuela_id'))
                ->where('clasificacion_id', $request->get('clasificacion_id'))
                ->where('grupo_nombre', strtoupper(trim($request->get('grupo_nombre'))))
                ->first();

            //Establecer el valor del campo 'grupo_disponible'
            if($request->get('grupo_disponible')==="on")
            {
                $grupo_disponible = true;
            }
            else{
                $grupo_disponible = false;
            }

            if($grupo===null)
            {
                //1.3) Sí pasa la validacion, y el grupo no existe, procedemos a guardar el registro

                $now = Carbon::now('America/Mexico_City Time Zone');


                $grupo = new Grupo();
                $grupo->ciclo_id                = $request->get('ciclo_id');
                $grupo->escuela_id              = $request->get('escuela_id');
                $grupo->clasificacion_id        = $request->get('clasificacion_id');
                $grupo->grupo_nombre            = strtoupper(trim($request->get('grupo_nombre')));
                $grupo->grupo_alumnospermitidos = $request->get('grupo_alumnospermitidos');
                $grupo->grupo_disponible        = $grupo_disponible;
                $grupo->grupo_status            = true;
                $grupo->created_at              = $now;
                $grupo->updated_at              = $now;

                $grupo->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Los datos se han guardado correctamente.'
                ], 200);


            }
            else
            {
                return response()->json([
                    'extra'   => true,
                    'success' => false,
                    'message' => 'El grupo que trata de crear ya existe'
                ], 422);

            }


        }

        //No se cumplieron las reglas de validacion de los datos
        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'extra'   => false,
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
        $grupo = Grupo::where('id', $id)
            ->first();

        return view('grupos.delete', compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciclo = $this->cicloEscolarPredeterminado();

        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        $grupo = Grupo::where('id', $id)
                 ->first();

        $clasificaciones = Clasificacion::where('ciclo_id',$ciclo->id)
            ->where('escuela_id', $grupo->escuela_id)
            ->where('clasificacion_status', true)
            ->orderBy('id', 'ASC')
            ->get();


        //return dd($ciclo);
        return view('grupos.edit', compact('ciclo','escuelas', 'grupo', 'clasificaciones'));

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
        //1) Validacion de datos

        $validation =Validator::make($request->all(),[
            'ciclo_id'                => 'required',
            'escuela_id'              => 'required',
            'clasificacion_id'        => 'required',
            'grupo_nombre'            => 'required',
            'grupo_alumnospermitidos' => 'required'
        ]);

        //1.1) La validadcion de datos fue correcta
        if($validation->passes()){

            //Establecer el valor del campo 'grupo_disponible'
            if($request->get('grupo_disponible')==="on")
            {
                $grupo_disponible = true;
            }
            else{
                $grupo_disponible = false;
            }

            $updated_at = Carbon::now('America/Mexico_City Time Zone');


            $grupo = Grupo::findOrFail($id);

            $grupo->ciclo_id                = $request->get('ciclo_id');
            $grupo->escuela_id              = $request->get('escuela_id');
            $grupo->clasificacion_id        = $request->get('clasificacion_id');
            $grupo->grupo_nombre            = strtoupper(trim($request->get('grupo_nombre')));
            $grupo->grupo_alumnospermitidos = $request->get('grupo_alumnospermitidos');
            $grupo->grupo_disponible        = $grupo_disponible;
            $grupo->updated_at              = $updated_at;

            $grupo->save();

            return response()->json([
                'success' => true,
                'message' => 'Los datos del grupo se han correctamente.'
            ], 200);

        }

        //No se cumplieron las reglas de validacion de los datos
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
    public function destroy($id)
    {
        $updated_at = Carbon::now('America/Mexico_City Time Zone');

        $grupo = Grupo::findOrFail($id);

        $grupo->grupo_status = false;
        $grupo->updated_at = $updated_at;

        $grupo->save();

        return response()->json([
            'success' => true,
            'message' => 'El registro se ha eliminado correctamente.'
        ], 200);
    }
}
