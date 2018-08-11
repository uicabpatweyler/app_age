<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\DatosInscripcionAlumno;
use App\Models\Escuela;
use App\Models\Grupo;
use App\Models\GrupoAlumno;

use App\Models\TutorAlumno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class GrupoAlumnoController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclo = $this->cicloEscolarPredeterminado();

        //dia = datos_inscripcion_alumno (plural)
        $dias= DatosInscripcionAlumno::where('ciclo_id',$ciclo->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('alumnos.grupo_alumno_elegiralumno', compact('ciclo','dias'));
    }

    public function verificaGrupoAlumno($escuela,$ciclo,$alumno, $grupo){
        $test = GrupoAlumno::where('escuela_id', $escuela)
                ->where('ciclo_id', $ciclo)
                ->where('alumno_id', $alumno)
                ->where('grupo_id', $grupo)
                ->first();
        if($test!=null){
            return true;
        }
        else{
            return false;
        }
    }

    public function verificaEscuelaCicloAlumno($escuela,$ciclo,$alumno){
        $test = GrupoAlumno::where('escuela_id', $escuela)
            ->where('ciclo_id', $ciclo)
            ->where('alumno_id', $alumno)
            ->first();
        if($test!=null){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($escuela,$ciclo,$alumno)
    {

        $e = Escuela::where('id',$escuela)->first();
        $a = Alumno::where('id',$alumno)->first();
        $c = Ciclo::where('id',$ciclo)->first();

        $tutorAlumno = TutorAlumno::where('escuela_id',$escuela)
                       ->where('ciclo_id',$ciclo)
                       ->where('alumno_id',$alumno)
                       ->first();
        if($tutorAlumno!=null){
            $ta = true;
        }
        else{
            $ta=false;
        }

        $grupos = Grupo::where('ciclo_id', $ciclo)
            ->where('escuela_id', $escuela)
            ->where('grupo_status', true)
            ->orderBy('clasificacion_id', 'asc')
            ->orderBy('grupo_nombre', 'asc')
            ->get();

        return view('alumnos.grupo_alumno_elegirgrupo', compact('grupos','e','a','c'))->with(['escuela_id'=>$escuela, 'ciclo_id'=>$ciclo, 'alumno_id'=>$alumno,'ta'=>$ta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[

            /*Tabla: TUTORES_ALUMNOS */
            'escuela_id'  => 'required',
            'ciclo_id'    => 'required',
            'alumno_id'   => 'required',
            'grupo_id'    => 'required',
            'clasifgrupo_id' => 'required',
            'user_id'     => 'required'
        ]);

        if($validation->passes()){

            $test_1= $this->verificaGrupoAlumno($request->get('escuela_id'),$request->get('ciclo_id'), $request->get('alumno_id'), $request->get('grupo_id'));
            $test_2= $this->verificaEscuelaCicloAlumno($request->get('escuela_id'),$request->get('ciclo_id'), $request->get('alumno_id'));

            if($test_1){
                return response()->json([
                    'success'   => false,
                    'integridad' => true,
                    'message'   => "La asignacion de Grupo-Alumno que desea realizar ya existe."
                ], 422);
            }

            if($test_2){
                return response()->json([
                    'success'   => false,
                    'integridad' => true,
                    'message'   => "El alumno elegido ya cuenta con un grupo asignado."
                ], 422);
            }

            try
            {
                $resultado = DB::transaction(function () use ($request) {

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $grupo_alumno = new GrupoAlumno();

                    $grupo_alumno->escuela_id       = $request->get('escuela_id');
                    $grupo_alumno->ciclo_id         = $request->get('ciclo_id');
                    $grupo_alumno->alumno_id        = $request->get('alumno_id');
                    $grupo_alumno->grupo_id         = $request->get('grupo_id');
                    $grupo_alumno->clasifgrupo_id   = $request->get('clasifgrupo_id');
                    $grupo_alumno->user_id          = $request->get('user_id');
                    $grupo_alumno->pago_inscripcion = false;
                    $grupo_alumno->alumno_status    = true;
                    $grupo_alumno->alumno_baja      = false;
                    $grupo_alumno->alumno_becario   = false;
                    $grupo_alumno->created_at       = $now;
                    $grupo_alumno->updated_at       = $now;

                    $grupo_alumno->save();



                    return response()->json([
                        'grupo_alumno_id' => $grupo_alumno->id,
                        'success'         => true,
                        'message'         => 'Los datos se han guardado correctamente.'
                    ], 200);
                });
                return $resultado->getContent();
            }
            catch (Exception $e){
                /*
                 * //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
                 *
                 * For error checking, use error codes, not error messages. Error messages do not change often,
                 * but it is possible. Also if the database administrator changes the language setting,
                 * that affects the language of error messages.
                 *
                 * $e->getCode() or  $e->errorInfo[0]
                 */

                if($e->getCode()!=0)
                {
                    return response()->json([
                        'exception'          => true,
                        'success'            => false,
                        'error_numeric_code' => $e->errorInfo[0],
                        'sqlstate_value'     => $e->errorInfo[1],
                        'message_error'      => $e->errorInfo[2],
                        'message_details'    => $e->getMessage(),
                        'message_user'       => '(1) Error al guardar los datos del tutor y el alumno.'

                    ],422);
                }
                else{
                    return response()->json([
                        'exception'          => true,
                        'success'            => false,
                        'error_numeric_code' => 0,
                        'sqlstate_value'     => 0,
                        'message_error'      => '',
                        'message_details'    => $e->getMessage(),
                        'message_user'       => '(2) Error al guardar los datos del tutor y el alumno.'

                    ],422);
                }
            }
        }

        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'exception' => false,
            'success'   => false,
            'message'   => $errors
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
