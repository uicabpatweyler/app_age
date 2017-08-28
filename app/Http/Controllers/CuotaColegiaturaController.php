<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\CuotaColegiatura;
use App\Models\Escuela;
use App\Models\MesPagoColegiatura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuotaColegiaturaController extends Controller
{
    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    public function listaCdc($id_escuela){
        $ciclo = $this->cicloEscolarPredeterminado();

        $escuela = Escuela::where('escuela_status', true)
            ->where('id', $id_escuela)
            ->first();

        $cuotas = CuotaColegiatura::where('cuotacolegiatura_status', true)
            ->where('ciclo_id', $ciclo->id)
            ->where('escuela_id', $id_escuela)
            ->OrderBy('id', 'asc')
            ->get();

        return view('cuotascolegiatura.cuotasdecolegiatura', compact('escuela','ciclo', 'cuotas'));
    }

    public function asignarMesesDePago($id_cuota){

        $cuota = CuotaColegiatura::findOrFail($id_cuota);

        $mesescolegiatura = MesPagoColegiatura::where('colegiatura_id', $id_cuota)
                            ->orderBy('orden_mes', 'asc')
                            ->get();

        //return dd($mesescolegiatura->fecha1_sin_recargo);


        if(count($mesescolegiatura)===0)
        {
            return view('cuotascolegiatura.configurarmeses', compact('cuota'));
        }
        else
        {
            return view('cuotascolegiatura.configurarmeses', compact('cuota', 'mesescolegiatura'));

        }
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

        return view('cuotascolegiatura.index', compact('ciclo', 'escuelas'));
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
        return view('cuotascolegiatura.create', compact('ciclo','escuelas'));
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
            'cuotacolegiatura_nombre' => 'required|max: 120',
            'cuotacolegiatura_cuota'  => 'required'
        ]);

        //1.1) La validacion de datos fue correcta
        if($validation->passes())
        {
            //Verificar que no existan duplicados en base al CICLO, ESCUELA, NOMBRE DE LA CUOTA y CUOTA
            $cuota = CuotaColegiatura::where('cuotacolegiatura_status', true)
                ->where('ciclo_id', $request->get('ciclo_id'))
                ->where('escuela_id', $request->get('escuela_id'))
                ->where('cuotacolegiatura_nombre', mb_strtoupper(trim($request->get('cuotacolegiatura_nombre'))))
                ->where('cuotacolegiatura_cuota',$request->get('cuotacolegiatura_cuota2'))
                ->first();

            if($cuota===null)
            {
                //Establecer el valor del campo 'cuotacolegiatura_disponible'
                if($request->get('cuotacolegiatura_disponible')==="on")
                {
                    $cuotacolegiatura_disponible = true;
                }
                else{
                    $cuotacolegiatura_disponible = false;
                }

                //Establecemos las propiedades del objeto CuotaColegiatura
                $cuotacolegiatura = new CuotaColegiatura();

                $now = Carbon::now('America/Mexico_City Time Zone');

                $cuotacolegiatura->ciclo_id = $request->get('ciclo_id');
                $cuotacolegiatura->escuela_id = $request->get('escuela_id');
                $cuotacolegiatura->cuotacolegiatura_nombre = mb_strtoupper(trim($request->get('cuotacolegiatura_nombre')));
                $cuotacolegiatura->cuotacolegiatura_cuota = $request->get('cuotacolegiatura_cuota2');
                $cuotacolegiatura->cuotacolegiatura_disponible = $cuotacolegiatura_disponible;
                $cuotacolegiatura->cuotacolegiatura_status = true;
                $cuotacolegiatura->created_at = $now;
                $cuotacolegiatura->updated_at = $now;

                $cuotacolegiatura->save();

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
                    'message' => 'La cuota de colegiatura que trata de crear ya existe'
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
