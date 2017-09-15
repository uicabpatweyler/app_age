<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\CuotaColegiatura;
use App\Models\Escuela;
use App\Models\GrupoCdc;
use App\Models\MesPagoColegiatura;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuotaColegiaturaController extends Controller
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
            $ciclo    = $this->cicloEscolarPredeterminado();

            $escuelas = Escuela::where('escuela_status', true)
                        ->get();

            return view('cuotascolegiatura.index', compact('ciclo', 'escuelas'));
        }

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
        $escuelas = Escuela::where('escuela_status', true)
                    ->orderBy('escuela_nombre', 'asc')
                    ->get();

        $cuota = CuotaColegiatura::where('id', $id)->first();

        return view('cuotascolegiatura.edit', compact('escuelas', 'cuota'));
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
        //1) Validación de datos
        $validation =Validator::make($request->all(),[
            'ciclo_id'                => 'required',
            'escuela_id'              => 'required',
            'cuotacolegiatura_nombre' => 'required|max: 120',
            'cuotacolegiatura_cuota'  => 'required'
        ]);

        if($validation->passes())
        {
            if($request->get('cuotacolegiatura_disponible')==="on")
            {
                $cuotacolegiatura_disponible = true;

            }
            else
            {
                $verifica_cdc = GrupoCdc::all()
                    ->where('cuotacolegiatura_id', $id)
                    ->count();

                if($verifica_cdc === 0)
                {
                    $cuotacolegiatura_disponible = false;

                }
                else
                {
                    return response()->json([
                        'extra'   => true,
                        'success' => false,
                        'message' => 'No puede poner como NO DISPONIBLE la cuota actual de colegiatura, ya que esta se encuentra en uso.'
                    ], 422);
                }
            }

            $update_at = Carbon::now('America/Mexico_City Time Zone');

            $cuotacolegiatura = CuotaColegiatura::findOrFail($id);

            $cuotacolegiatura->ciclo_id = $request->get('ciclo_id');
            $cuotacolegiatura->escuela_id = $request->get('escuela_id');
            $cuotacolegiatura->cuotacolegiatura_nombre = mb_strtoupper(trim($request->get('cuotacolegiatura_nombre')));
            $cuotacolegiatura->cuotacolegiatura_cuota = $request->get('cuotacolegiatura_cuota2');
            $cuotacolegiatura->cuotacolegiatura_disponible = $cuotacolegiatura_disponible;
            $cuotacolegiatura->cuotacolegiatura_status = true;
            $cuotacolegiatura->updated_at = $update_at;

            $cuotacolegiatura->save();

            return response()->json([
                'success' => true,
                'message' => 'La cuota de colegiatura se ha actualizado correctamente.'
            ], 200);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2
        try{
            $cdc = CuotaColegiatura::find($id);
            $cdc->delete();

            return response()->json([
                'success' => true,
                'message' => 'La cuota de colegiatura se ha eliminado correctamente'
            ], 200);

        }catch (Exception $e){
            //Error: 1451. SQLSTATE: 2300
            //Cannot delete or update a parent row: a foreign key constraint fails
            $error_server  = $e->errorInfo[0];
            $error_code    = $e->errorInfo[1];
            $error_message = $e->errorInfo[2];

            //return dd($e);

            if($error_server == 23000 and $error_code == 1451)
            {
                return response()->json([
                    'success'      => false,
                    'error_server' => $error_server,
                    'error_code'   => $error_code,
                    'error_message_admin' => $error_message,
                    'error_message_user' => 'No es posible eliminar la cuota de colegiatura. Restricción de llave foránea.'
                ],422);
            }
        }
    }
}
