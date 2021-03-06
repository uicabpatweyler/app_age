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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
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
        /*
         * SELECT
            clasificaciones.clasificacion_nombre,
            grupos.id,
            grupos.grupo_nombre,
            grupos.grupo_alumnospermitidos,
            grupos.grupo_disponible,
            grupos.grupo_status,
            grupos.created_at,
            grupos.updated_at
            FROM
            clasificaciones
            INNER JOIN grupos ON grupos.clasificacion_id = clasificaciones.id
            WHERE
            grupos.ciclo_id = '%s' AND
            grupos.escuela_id = '%s' AND
            grupos.grupo_status = true
            ORDER BY
            clasificaciones.id ASC,
            grupos.grupo_nombre ASC
         */
        $grupos = DB::table('clasificaciones')
                 ->join('grupos', 'grupos.clasificacion_id', '=', 'clasificaciones.id')
                 ->select('clasificaciones.clasificacion_nombre',
                          'grupos.id',
                          'grupos.grupo_nombre',
                          'grupos.grupo_alumnospermitidos',
                          'grupos.grupo_disponible')
                 ->where('grupos.ciclo_id', $ciclo->id)
                 ->where('grupos.escuela_id', $id_escuela)
                 ->where('grupos.grupo_status', true)
                 ->orderBy('clasificaciones.id', 'asc')
                 ->orderBy('grupos.grupo_nombre', 'asc')
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
            $ciclo = $this->cicloEscolarPredeterminado();

            $escuelas = Escuela::where('escuela_status', true)
                ->get();

            return view('grupos.index', compact('ciclo', 'escuelas'));
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
                ->where('grupo_nombre', mb_convert_case(trim($request->get('grupo_nombre')),MB_CASE_UPPER, "UTF-8"))
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
                $grupo->grupo_nombre            = mb_convert_case(trim($request->get('grupo_nombre')),MB_CASE_UPPER, "UTF-8");
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
            $grupo->grupo_nombre            = mb_convert_case(trim($request->get('grupo_nombre')),MB_CASE_UPPER, "UTF-8");
            $grupo->grupo_alumnospermitidos = $request->get('grupo_alumnospermitidos');
            $grupo->grupo_disponible        = $grupo_disponible;
            $grupo->updated_at              = $updated_at;

            $grupo->save();

            return response()->json([
                'success' => true,
                'message' => 'Los datos del grupo se han actualizado correctamente.'
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
        //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2
        try{
            $grupo = Grupo::find($id);
            $grupo->delete();

            return response()->json([
                'success' => true,
                'message' => 'El grupo se ha eliminado correctamente'
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
                    'error_message_user' => 'El grupo que desea eliminar se encuentra en uso. Restricción de llave foránea.'
                ],422);
            }
        }
    }
}
