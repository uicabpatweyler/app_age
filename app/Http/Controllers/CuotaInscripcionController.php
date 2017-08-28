<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\CuotaInscripcion;
use App\Models\Escuela;
use App\Models\Grupo;
use App\Models\GrupoCdi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuotaInscripcionController extends Controller
{
    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    public function listaCdi($id_escuela)
    {
        $ciclo = $this->cicloEscolarPredeterminado();

        $escuela = Escuela::where('escuela_status', true)
            ->where('id', $id_escuela)
            ->first();

        $cuotas = CuotaInscripcion::where('cuotainscripcion_status', true)
            ->where('ciclo_id', $ciclo->id)
            ->where('escuela_id', $id_escuela)
            ->OrderBy('id', 'asc')
            ->get();

        return view('cuotasinscripcion.cuotasdeinscripcion', compact('escuela','ciclo', 'cuotas'));
    }

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclo    = $this->cicloEscolarPredeterminado();

        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        return view('cuotasinscripcion.index', compact('ciclo', 'escuelas'));
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
        return view('cuotasinscripcion.create', compact('ciclo','escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1) Validación de datos
        $validation =Validator::make($request->all(),[
            'ciclo_id'                => 'required',
            'escuela_id'              => 'required',
            'cuotainscripcion_nombre' => 'required|max: 120',
            'cuotainscripcion_cuota'  => 'required'
        ]);

        //1.1) La validadcion de datos fue correcta
        if($validation->passes())
        {

            $cuota = CuotaInscripcion::where('cuotainscripcion_status', true)
                     ->where('ciclo_id', $request->get('ciclo_id'))
                     ->where('escuela_id', $request->get('escuela_id'))
                     ->where('cuotainscripcion_nombre', mb_strtoupper(trim($request->get('cuotainscripcion_nombre'))))
                     ->where('cuotainscripcion_cuota',$request->get('cuotainscripcion_cuota2'))
                     ->first();

            if($cuota===null)
            {
                //Establecer el valor del campo 'cuotainscripcion_disponible'
                if($request->get('cuotainscripcion_disponible')==="on")
                {
                    $cuotainscripcion_disponible = true;
                }
                else{
                    $cuotainscripcion_disponible = false;
                }

                $now = Carbon::now('America/Mexico_City Time Zone');

                $cuotainscripcion = new CuotaInscripcion();

                $cuotainscripcion->ciclo_id = $request->get('ciclo_id');
                $cuotainscripcion->escuela_id = $request->get('escuela_id');
                $cuotainscripcion->cuotainscripcion_nombre = mb_strtoupper(trim($request->get('cuotainscripcion_nombre')));
                $cuotainscripcion->cuotainscripcion_cuota = $request->get('cuotainscripcion_cuota2');
                $cuotainscripcion->cuotainscripcion_disponible = $cuotainscripcion_disponible;
                $cuotainscripcion->cuotainscripcion_status = true;
                $cuotainscripcion->created_at = $now;
                $cuotainscripcion->updated_at = $now;

                $cuotainscripcion->save();

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
                    'message' => 'La cuota de inscripción que trata de crear ya existe'
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