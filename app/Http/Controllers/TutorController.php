<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Tutor;
use App\Models\DatosInscripcionAlumno;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class TutorController extends Controller
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

    public function datosInscripcionAlumno($tutor_id){

        $ciclo = $this->cicloEscolarPredeterminado();

        //dia = datos_inscripcion_alumno (plural)
        $dias= DatosInscripcionAlumno::where('ciclo_id',$ciclo->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tutores.nuevo_tutor_elegirdireccion', compact('dias', 'ciclo'))->with(['tutor_id' => $tutor_id]);
    }


    public function verificaNombreApellidosTutor($nombre,$ap,$am, $flag){

        if($flag==="1"){
            if ($am==="abcd"){
                //Verificar solamente usando los campos del nombre y apellido paterno
                $tutores = DB::table('tutores')
                    ->where('tutor_nombre', 'like', '%' . mb_strtolower($nombre,'UTF-8') . '%')
                    ->where('tutor_apellidopaterno', 'like', '%' . mb_strtolower($ap,'UTF-8') . '%')
                    ->get();
            }
            else{
                //Verificar solamente usando el nomnre con los apellidos
                $tutores = DB::table('tutores')
                    ->where('tutor_nombre', 'like', '%' . mb_strtolower($nombre,'UTF-8') . '%')
                    ->where('tutor_apellidopaterno', 'like', '%' . mb_strtolower($ap,'UTF-8') . '%')
                    ->where('tutor_apellidomaterno', 'like', '%' . mb_strtolower($am,'UTF-8') . '%')
                    ->get();
            }


            if($tutores->count()!=0){
                return response()->json([
                    'success'   => false,
                    'mensaje'   => 'Se encontraron coincidencias con el nuevo tutor'
                ],422);
            }
            else{
                return response()->json([
                    'success'   => true,
                    'mensaje'   => 'No Se encontraron coincidencias con el nuevo tutor'
                ],200);
            }

        }
        if ($flag==="2"){
            if($am==="abcd"){
                //Obtener los datos de los tutores que cumplen con los datos proporcionados
                $tutores = DB::table('tutores')
                    ->where('tutor_nombre', 'like', '%' . mb_strtolower($nombre,'UTF-8') . '%')
                    ->where('tutor_apellidopaterno', 'like', '%' . mb_strtolower($ap,'UTF-8') . '%')
                    ->get()
                    ->toArray();
            }
            else{

            }


            return response()->json([
                'data' => $tutores
            ]);
        }        

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutores.nuevo_tutor_create');
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
            'tutor_nombre'           => 'required|min:2|max:60',
            'tutor_apellidopaterno'  => 'required|min:2|max:60',
            'tutor_genero'           => 'required'
        ]);

        if($validation->passes()){

            try
            {
                //Iniciamos la transaccion para la insercion de los datos del tutor
                $resultado = DB::transaction(function () use ($request)  {

                    $tutor = new Tutor();

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $tutor->tutor_nombre          = mb_strtolower($request->get('tutor_nombre'),'UTF-8');
                    $tutor->tutor_apellidopaterno = mb_strtolower($request->get('tutor_apellidopaterno'),'UTF-8');
                    $tutor->tutor_apellidomaterno = ($request->get('tutor_apellidomaterno')===null) ? '' : mb_strtolower($request->get('tutor_apellidomaterno'),'UTF-8');
                    $tutor->tutor_genero          = $request->get('tutor_genero');
                    $tutor->tutor_status          = true;
                    $tutor->created_at            = $now;
                    $tutor->updated_at            = $now;

                    $tutor->save();

                    return response()->json([
                        'success'   => true,
                        'tutor_id'  => $tutor->id,
                        'message'   => 'Los datos del tutor se han guardado correctamente.'
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
                        'message_user'       => '(1) Error al guardar los datos del tutor.'

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
                        'message_user'       => '(2) Error al guardar los datos del tutor.'

                    ],422);
                }


            } //catch exception


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
