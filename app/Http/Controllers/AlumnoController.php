<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Escuela;
use App\Models\Ciclo;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class AlumnoController extends Controller
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

    public function verificarCurpDelAlumno(Request $request){

        /*Verificar la CURP introducida para evitar datos duplicados en la entidad ALUMNOS*/
        $alumno = Alumno::where('alumno_curp', $request->get('curp'))->get();

        if($alumno->count()===0){
            return response()->json([
                'success'   => true,
                'message'   => 'La C.UR.P. introducida no existe. Presione Continuar',

            ]);
        }
        else{
            $alumno = Alumno::where('alumno_curp', $request->get('curp'))->first();
            $nombre = $alumno->alumno_apellidopaterno. ' '.$alumno->alumno_apellidomaterno.' '.$alumno->alumno_primernombre.' '.$alumno->alumno_segundonombre;
            return response()->json([
                'success'   => false,
                'message'   => 'La C.UR.P. '.$request->get('alumno_curp').' '.'se encuentra registrada para el alumno '.strtoupper($nombre)
            ], 422);
        }


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alumnos.nuevo_alumno_inicio');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curp)
    {
        $escuelas = Escuela::where('escuela_status', true)
                    ->get();

        //Obtener el ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
                 ->where('ciclo_actual', true)
                 ->first();

        return view('alumnos.nuevo_alumno_create', compact('escuelas', 'ciclo','curp'));
    }

    public function auxiliar1($id_alumno, $apellidopaterno,$apellidomaterno,$id_ciclo,$id_escuela){

        $alumnos = DB::table('alumnos')
            ->join('datos_inscripcion_alumno', 'alumnos.id', '=', 'datos_inscripcion_alumno.alumno_id')
            ->join('ciclos', 'datos_inscripcion_alumno.ciclo_id', '=', 'ciclos.id' )
            ->select('alumnos.*','datos_inscripcion_alumno.*','ciclos.*')
            ->where('alumnos.id', '<>', $id_alumno)
            ->where('alumnos.alumno_apellidopaterno', 'like', mb_strtolower($apellidopaterno,'UTF-8'))
            ->where('alumnos.alumno_apellidomaterno', 'like', mb_strtolower($apellidomaterno,'UTF-8'))
            ->orderBy('ciclos.ciclo_anioinicial', 'desc')
            ->get();

        $nuevo_alumno = Alumno::where('id', $id_alumno)->first();


        return view('alumnos.lista_alumnos_parentesco', compact('alumnos', 'nuevo_alumno'))->with(['id_ciclo' => $id_ciclo, 'id_alumno' => $id_alumno, 'id_escuela' => $id_escuela]);
    }

    /*
     * El alumno es nuevo y no ha sido registrado y no aparece en la entidad ALUMNOS
     * Se procede a verificar la entidad ALUMNOS realizando una busqueda en base a los
     * apellidos proporcionados.
     * Si la busqueda arroja algun resultado, se procede a realizar otra busqueda del o de los alumnos
     * en el ciclo actual o anteriores, en la entidad DATOS_INSCRIPCION_ALUMNOS para mostrarselos al
     * usuario y que el decida si los reutiliza
     */
    public function test($id_alumno, $apellidopaterno,$apellidomaterno){
        //echo $apellidopaterno;

        $alumno = DB::table('alumnos')
                 ->join('datos_inscripcion_alumno', 'alumnos.id', '=', 'datos_inscripcion_alumno.alumno_id')
                 ->join('ciclos', 'datos_inscripcion_alumno.ciclo_id', '=', 'ciclos.id' )
                 ->select('alumnos.*','datos_inscripcion_alumno.*','ciclos.*')
                 ->where('alumnos.id', '<>', $id_alumno)
                 ->where('alumnos.alumno_apellidopaterno', 'like', mb_strtolower($apellidopaterno,'UTF-8'))
                 ->where('alumnos.alumno_apellidomaterno', 'like', mb_strtolower($apellidomaterno,'UTF-8'))
                 ->orderBy('ciclos.ciclo_anioinicial', 'desc')
                 ->get();

        return $alumno->count();
        //return dd($alumno);
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

            /*Tabla: ALUMNOS*/
            'alumno_primernombre'    => 'required|min:2|max:30',
            'alumno_apellidopaterno' => 'required|min:2|max:30',
            'alumno_curp'            => 'required|min:2|max:30',
            'alumno_fechanacimiento' => 'required',
            'alumno_genero'          => 'required|min:1|max:1'
        ]);

        if($validation->passes()){
            try{
                //Iniciamos la transaccion para la insercion de los datos de inscripción
                $resultado = DB::transaction(function () use ($request)  {

                    $alumno = new Alumno();

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $alumno->alumno_primernombre    = mb_strtolower($request->get('alumno_primernombre'),'UTF-8');
                    $alumno->alumno_segundonombre   = mb_strtolower($request->get('alumno_segundonombre'),'UTF-8');
                    $alumno->alumno_apellidopaterno = mb_strtolower($request->get('alumno_apellidopaterno'),'UTF-8');
                    $alumno->alumno_apellidomaterno = mb_strtolower($request->get('alumno_apellidomaterno'),'UTF-8');
                    $alumno->alumno_curp            = $request->get('alumno_curp');
                    $alumno->alumno_fechanacimiento = $request->get('fecha_nacimiento');//yyyy-mm-dd
                    $alumno->alumno_genero          = $request->get('alumno_genero');
                    $alumno->alumno_status          = true;
                    $alumno->created_at             = $now;
                    $alumno->updated_at             = $now;

                    $alumno->save();

                    $id_alumno = $alumno->id;

                    $test = $this->test($id_alumno,$request->get('alumno_apellidopaterno'),$request->get('alumno_apellidomaterno'));
                    if($test!=0){
                        return response()->json([
                            'coincidencia' => true,
                            'success'   => true,
                            'id_alumno' => $id_alumno,
                            'id_ciclo'  => $request->get('ciclo_id'),
                            'id_escuela' => $request->get('escuela_id'),
                            'ap'        => mb_strtolower($request->get('alumno_apellidopaterno'),'UTF-8'),
                            'am'        => mb_strtolower($request->get('alumno_apellidomaterno'),'UTF-8'),
                            'message'   => 'Se encontraron coincidencias con el apellido del nuevo alumno'
                        ], 422);
                    }
                    else{
                        return response()->json([
                            'coincidencia' => false,
                            'success'   => true,
                            'id_alumno' => $id_alumno,
                            'id_ciclo'  => $request->get('ciclo_id'),
                            'id_escuela' => $request->get('escuela_id'),
                            'message'   => 'Los datos se han guardado correctamente.'
                        ], 200);
                    }



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
                        'message_user'       => '(1) Error al guardar los datos del alumno.'

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
                        'message_user'       => '(2) Error al guardar los datos del alumno.'

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
