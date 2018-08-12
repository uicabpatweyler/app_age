<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\CuotaInscripcion;
use App\Models\Escuela;
use App\Models\GrupoCdi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuotaInscripcionController extends Controller
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

            return view('cuotasinscripcion.index', compact('ciclo', 'escuelas'));
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
                     ->where('cuotainscripcion_nombre', mb_convert_case(trim($request->get('cuotainscripcion_nombre')),MB_CASE_UPPER, "UTF-8"))
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
                $cuotainscripcion->cuotainscripcion_nombre = mb_convert_case(trim($request->get('cuotainscripcion_nombre')),MB_CASE_UPPER, "UTF-8");
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
        //Verificar si se encuentra en uso
        $verifica_cdi = GrupoCdi::where('cuotainscripcion_id', $id)->first();

        //Obtener la cuota de inscripción seleccionada
        $cuota = CuotaInscripcion::findOrFail($id);

        //La cuota de inscripcion seleccionada no se encuentra en uso
        if($verifica_cdi === null)
        {
            return view('cuotasinscripcion.mostrarcdi', compact('cuota'));
        }
        else
        {
            $mensaje = "La cuota de inscripción seleccionada no puede ser eliminada porque se enuentra en uso.";
            return view('cuotasinscripcion.mostrarcdi', compact('cuota', 'mensaje'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_cdi)
    {
        $cuota = CuotaInscripcion::where('id', $id_cdi)
                 ->where('cuotainscripcion_status', true)
                 ->first();

        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        //return dd($ciclo);
        return view('cuotasinscripcion.edit', compact('cuota','escuelas'));
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
            'cuotainscripcion_nombre' => 'required|max: 120',
            'cuotainscripcion_cuota'  => 'required'
        ]);

        if($validation->passes())
        {

            //Si el usuario desea poner en NO DISPONIBLE la cuota de incsripcion, verificar lo siguiente:
            //Que la CUOTA DE INSCRIPCION no se encuentre asignada a ningun grupo.
            //Esto se obtiene haciendo una consulta a la entidad compuesta EC_GRUPO_CDI.
            //Si la consulta devuelve un valor distinto de CERO significa que la CDI se esta usando en al menos
            //un GRUPO, por lo tanto se le informa al usuario que no es posible realizar esa acción

            if($request->get('cuotainscripcion_disponible')==="on")
            {
                $cuotainscripcion_disponible = true;

            }
            else
            {
                $verifica_cdi = GrupoCdi::all()
                                ->where('cuotainscripcion_id', $id)
                                ->count();

                if($verifica_cdi === 0)
                {
                    $cuotainscripcion_disponible = false;

                }
                else
                {
                    return response()->json([
                        'extra'   => true,
                        'success' => false,
                        'message' => 'No puede poner como NO DISPONIBLE la cuota actual de inscripción, ya que esta se encuentra en uso.'
                    ], 422);
                }
            }

            $update_at = Carbon::now('America/Mexico_City Time Zone');

            $cuotainscripcion = CuotaInscripcion::findOrFail($id);

            $cuotainscripcion->ciclo_id = $request->get('ciclo_id');
            $cuotainscripcion->escuela_id = $request->get('escuela_id');
            $cuotainscripcion->cuotainscripcion_nombre = mb_convert_case(trim($request->get('cuotainscripcion_nombre')),MB_CASE_UPPER, "UTF-8");
            $cuotainscripcion->cuotainscripcion_cuota = $request->get('cuotainscripcion_cuota2');
            $cuotainscripcion->cuotainscripcion_disponible = $cuotainscripcion_disponible;
            $cuotainscripcion->updated_at = $update_at;

            $cuotainscripcion->save();

            return response()->json([
                'success' => true,
                'message' => 'La cuota de inscripción se ha actualizado correctamente.'
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
            $cdi = CuotaInscripcion::find($id);
            $cdi->delete();

            return response()->json([
                'success' => true,
                'message' => 'La cuota de inscripción se ha eliminado correctamente'
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
                    'error_message_user' => 'No es posible eliminar la cuota de inscripción. Restricción de llave foránea.'
                ],422);
            }
        }
    }
}
