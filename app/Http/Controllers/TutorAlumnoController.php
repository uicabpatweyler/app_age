<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\DatosInscripcionAlumno;
use App\Models\Escuela;
use App\Models\Tutor;
use App\Models\TutorAlumno;
use App\Models\TutorDatosPersonales;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class TutorAlumnoController extends Controller
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

        $tutores = TutorDatosPersonales::where('ciclo_id', $ciclo->id)
                   ->orderBy('created_at', 'desc')
                   ->get();;

        return view('alumnos.asignar_tutor_elegirtutor', compact('tutores','ciclo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tutor_id,$ciclo_id)
    {
        $escuelas = Escuela::where('escuela_status', true)
                    ->get();
        $tutor = Tutor::where('id', $tutor_id)->first();
        $ciclo = Ciclo::where('id', $ciclo_id)->first();

        //dia = datos_inscripcion_alumno (plural)
        $dias= DatosInscripcionAlumno::where('ciclo_id',$ciclo->id)
               ->orderBy('created_at', 'desc')
               ->get();

        $nombre_tutor = $tutor->tutor_nombre.' '.$tutor->tutor_apellidopaterno.' '.$tutor->tutor_apellidomaterno;
        return view('alumnos.asignar_tutor_elegiralumno', compact('escuelas', 'ciclo','dias'))->with(['tutor_id'=>$tutor_id,'nombre_tutor'=>$nombre_tutor]);
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
            'tutor_id'    => 'required',
            'alumno_id'   => 'required',
            'user_id'     => 'required'
        ]);

        if($validation->passes()){
            try
            {
                $resultado = DB::transaction(function () use ($request) {

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $tutor_alumno = new TutorAlumno();

                    $tutor_alumno->escuela_id = $request->get('escuela_id');
                    $tutor_alumno->ciclo_id = $request->get('ciclo_id');
                    $tutor_alumno->tutor_id = $request->get('tutor_id');
                    $tutor_alumno->alumno_id = $request->get('alumno_id');
                    $tutor_alumno->user_id = $request->get('user_id');
                    $tutor_alumno->created_at = $now;
                    $tutor_alumno->updated_at = $now;

                    $tutor_alumno->save();

                    return response()->json([
                        'success'   => true,
                        'message'   => 'Los datos se han guardado correctamente.'
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
