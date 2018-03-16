<?php

namespace App\Http\Controllers\Alumno;

use App\Models\Alumno;
use App\Models\AlumnoTutor;
use App\Models\Ciclo;
use App\Models\CodigoPostal;
use App\Models\DatosDeInscripcion;
use App\Models\Delegacion;
use App\Models\Direccion;
use App\Models\Escuela;
use App\Models\Estado;
use App\Models\Tutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class InscripcionController extends Controller
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

    /**
     * Alumnos. Nueva Inscripcion.
     *
     * Verificar la CURP introducida para evitar datos duplicados en la entidad ALUMNOS
     * Si la CURP ya existe en la entidad ALUMNOS se le notifica al usuario
     * Si la CURP no existe se muestra el formulario para los datos de un nuevo alumno
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function index(Request $request)
    {
        if($request->get('alumno_curp')===null)
        {
            return view('alumnos.inscripcion.inscripcion_paso1');
        }
        else{

            /*Verificar la CURP introducida para evitar datos duplicados en la entidad ALUMNOS*/
            $alumnos = Alumno::where('alumno_curp', $request->get('alumno_curp'))->get();

            /*No se encontro al menos 1 coincidencia en la entidad ALUMNOS*/
            if($alumnos->count()===0){

                $estados = Estado::select('id','estado_nombre')
                    ->orderBy('estado_nombre', 'asc')
                    ->get();

                $ciclo = $this->cicloEscolarPredeterminado();

                $escuelas = Escuela::where('escuela_status', true)
                    ->get();

                $curp = $request->get('curp');
                $alumno_curp = $request->get('alumno_curp');

                /*Se muestra el formulario para agregar los datos de un nuevo alumno en la entidad ALUMNOS*/
                return view('alumnos.inscripcion.inscripcion_paso2', compact('curp','alumno_curp','estados','escuelas', 'ciclo'));
            }

            /*Se encontro al menos 1 coincidencia en la entidad ALUMNOS*/
            else{

                /*Se redirige al usuario al formulario de inicio notificandole que la CURP introducida ya existe*/
                $verificarCurp = $alumnos->count();
                return view('alumnos.inscripcion.inscripcion_paso1', compact('verificarCurp','alumnos'));
            }
        }
    }

    /**
     * Crea un nuevo registro en las siguientes entidades: ALUMNOS, DATOS_INSCRIPCION y DIRECCIONES
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
            'alumno_genero'          => 'required|min:1|max:1',

            /*Tabla: DIRECCIONES */
            'nombre_vialidad'        => 'required',
            'numero_exterior'        => 'required',
            'tipo_asentamiento'      => 'required',
            'nombre_asentamiento'    => 'required',
            'codigo_postal'          => 'required',
            'nombre_localidad'       => 'required',
            'delegacion_municipio'   => 'required',
            'entidad_federativa'     => 'required',

            /*Tabla: DATOS_INSCRIPCION */
            'alumno_edad'            => 'required'
        ]);

        if($validation->passes())
        {
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

                    //Obtenemos el ultimo id insertado para usarlo en la tabla DATOS_INSCRIPCION
                    $id_alumno = $alumno->id;

                    $direccion = new Direccion();

                    $direccion->tipo_vialidad        = ($request->get('tipo_vialidad')===null) ? '' : $request->get('tipo_vialidad');
                    $direccion->nombre_vialidad      = mb_strtolower($request->get('nombre_vialidad'),'UTF-8');
                    $direccion->numero_exterior      = mb_strtolower($request->get('numero_exterior'),'UTF-8');
                    $direccion->numero_interior      = ($request->get('numero_interior')===null) ? '' : mb_strtolower($request->get('numero_interior'),'UTF-8');
                    $direccion->tipo_asentamiento    = mb_strtolower($request->get('tipo_asentamiento'),'UTF-8');
                    $direccion->nombre_asentamiento  = mb_strtolower($request->get('nombre_asentamiento'),'UTF-8');
                    $direccion->codigo_postal        = $request->get('codigo_postal');
                    $direccion->nombre_localidad     = mb_strtolower($request->get('nombre_localidad'),'UTF-8');
                    $direccion->delegacion_municipio = $request->get('delegacion_municipio');
                    $direccion->entidad_federativa   = $request->get('entidad_federativa');
                    $direccion->pais                 = 'México';
                    $direccion->entre_calles         = ($request->get('entre_calles')===null) ? '' : mb_strtolower($request->get('entre_calles'),'UTF-8');
                    $direccion->referencias_adicionales = ($request->get('referencias_adicionales')===null) ? '' : mb_strtolower($request->get('referencias_adicionales'),'UTF-8');
                    $direccion->created_at = $now;
                    $direccion->updated_at = $now;

                    $direccion->save();

                    //Obtenemos el ultimo id insertado para usarlo en la tabla DATOS_INSCRIPCION
                    $id_direccion = $direccion->id;

                    $datosDeInscripcion = new DatosDeInscripcion();

                    $datosDeInscripcion->escuela_id       = $request->get('escuela_id');
                    $datosDeInscripcion->ciclo_id         = $request->get('ciclo_id');
                    $datosDeInscripcion->alumno_id        = $id_alumno;
                    $datosDeInscripcion->direccion_id     = $id_direccion;
                    $datosDeInscripcion->alumno_edad      = $request->get('alumno_edad');
                    $datosDeInscripcion->telefono_casa    = $request->get('telefono_casa');
                    $datosDeInscripcion->referencia1      = ($request->get('referencia1')===null) ? '' : mb_strtolower($request->get('referencia1'),'UTF-8');
                    $datosDeInscripcion->telefono_tutor   = $request->get('telefono_tutor');
                    $datosDeInscripcion->referencia2      = ($request->get('referencia2')===null) ? '' : mb_strtolower($request->get('referencia2'),'UTF-8');
                    $datosDeInscripcion->telefono_celular = $request->get('telefono_celular');
                    $datosDeInscripcion->referencia3      = ($request->get('referencia3')===null) ? '' : mb_strtolower($request->get('referencia3'),'UTF-8');
                    $datosDeInscripcion->telefono_otro    = $request->get('telefono_otro');
                    $datosDeInscripcion->referencia4      = ($request->get('referencia4')===null) ? '' : mb_strtolower($request->get('referencia4'),'UTF-8');
                    $datosDeInscripcion->alumno_escuela   = ($request->get('alumno_escuela')===null) ? '' : mb_strtolower($request->get('alumno_escuela'),'UTF-8');
                    $datosDeInscripcion->alumno_ultimogrado = ($request->get('alumno_ultimogrado')===null) ? '' : mb_strtolower($request->get('alumno_ultimogrado'),'UTF-8');
                    $datosDeInscripcion->alumno_lugartrabajo = ($request->get('alumno_lugartrabajo')===null) ? '' : mb_strtolower($request->get('alumno_lugartrabajo'),'UTF-8');
                    $datosDeInscripcion->alumno_email = $request->get('alumno_email');
                    $datosDeInscripcion->encuesta_pregunta1 = $request->get('encuesta_pregunta1');
                    $datosDeInscripcion->encuesta_pregunta2 = $request->get('encuesta_pregunta2');
                    $datosDeInscripcion->created_at = $now;
                    $datosDeInscripcion->updated_at = $now;


                    $datosDeInscripcion->save();

                    return response()->json([
                        'success'   => true,
                        'id_alumno' => $id_alumno,
                        'id_ciclo'  => $request->get('ciclo_id'),
                        'id_direccion' => $id_direccion,
                        'id_datos_inscripcion' => $datosDeInscripcion->id,
                        'message'              => 'Los datos del alumno se han guardado correctamente. ¿Desea agregar los datos del tutor? '
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
                        'message_user'       => '(1) Error al guardar los datos de inscripción.'

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
                        'message_user'       => '(2) Error al guardar los datos de inscripción.'

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
     * Mostrar el formulario para agregar los datos del tutor del alumno del cual se realiza la inscripcion
     *
     * ID del alumno recien creado de la entidad ALUMNOS
     * ID del ciclo actual de trabajo
     * ID de la direccion recien creada de la entidad DIRECCIONES
     *
     * @param int $id_alumno
     * @param int $id_ciclo
     * @param int $id_direccion
     * @return \Illuminate\Http\Response
     */
    public function show($id_alumno,$id_ciclo, $id_direccion)
    {
        //Datos del ciclo escolar
        $ciclo = Ciclo::where('id', $id_ciclo)->first();

        //El alumno al cual se asignara el tutor
        $alumno = Alumno::where('id', $id_alumno)->first();

        //Datos de la direccion recien creada del alumno que se esta registrando para usar en la direccion del tutor
        $direccion = Direccion::where('id', $id_direccion)->first();

        $estados = Estado::select('id','estado_nombre')
            ->orderBy('estado_nombre', 'asc')
            ->get();
    
        return view('alumnos.inscripcion.inscripcion_paso3',compact('ciclo','alumno','estados','direccion'));
    }   



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function storeDatosTutor(Request $request){

        $validation = Validator::make($request->all(),[
            'tutor_nombre'           => 'required|min:2|max:60',
            'tutor_apellidopaterno'  => 'required|min:2|max:60',
        ]);

        if($validation->passes()){

            try
            {
                //Iniciamos la transaccion para la insercion de los datos del tutor
                $resultado = DB::transaction(function () use ($request)  {

                    $tutor = new Tutor();

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $tutor->tutor_nombre = mb_strtolower($request->get('tutor_nombre'),'UTF-8');
                    $tutor->tutor_apellidopaterno = mb_strtolower($request->get('tutor_apellidopaterno'),'UTF-8');
                    $tutor->tutor_apellidomaterno = ($request->get('tutor_apellidomaterno')===null) ? '' : mb_strtolower($request->get('tutor_apellidomaterno'),'UTF-8');
                    $tutor->tutor_email = ($request->get('tutor_email')===null) ? '' : $request->get('tutor_email');
                    $tutor->tutor_status = true;
                    $tutor->created_at   = $now;
                    $tutor->updated_at   = $now;

                    $tutor->save();

                    return response()->json([
                        'success'   => true,
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

    public function guardarDatosTutor(Request $request)
    {
        //return dd($request->all());

        $validation = Validator::make($request->all(),[
            'tutor_primernombre'           => 'required|min:2|max:30',
            'tutor_primerapellido'         => 'required|min:2|max:30',
            'tutor_genero'                 => 'required|min:1|max:1',
            'ciclo_id'                     => 'required',
            'alumno_id'                    => 'required',
            'registro_id'                  => 'required',
            'tutor_direccion_calle'        => 'required',
            'tutor_direccion_numinterior'  => 'required',
            'tutor_direccion_referencias'  => 'required',
            'tutor_direccion_colonia'      => 'required',
            'tutor_direccion_codigopostal' => 'required|min:5|max:5',
            'tutor_direccion_localidad'    => 'required',
            'tutor_direccion_delegacion'   => 'required',
            'tutor_direccion_estado'       => 'required'
        ]);

        if($validation->passes())
        {
            try
            {
                $alumno_tutor = new AlumnoTutor();

                $now = Carbon::now('America/Mexico_City Time Zone');

                $alumno_tutor->ciclo_id                     = $request->get('ciclo_id');
                $alumno_tutor->alumno_id                    = $request->get('alumno_id');
                $alumno_tutor->registro_id                  = $request->get('registro_id');
                $alumno_tutor->tutor_primernombre           = mb_strtolower($request->get('tutor_primernombre'),'UTF-8');
                $alumno_tutor->tutor_segundonombre          = mb_strtolower($request->get('tutor_segundonombre'),'UTF-8');
                $alumno_tutor->tutor_primerapellido         = mb_strtolower($request->get('tutor_primerapellido'),'UTF-8');
                $alumno_tutor->tutor_segundoapellido        = mb_strtolower($request->get('tutor_segundoapellido'),'UTF-8');
                $alumno_tutor->tutor_genero                 = $request->get('tutor_genero');
                $alumno_tutor->tutor_email                  = $request->get('tutor_email');
                $alumno_tutor->tutor_direccion_calle        = mb_strtolower($request->get('tutor_direccion_calle'),'UTF-8');
                $alumno_tutor->tutor_direccion_numinterior  = mb_strtolower($request->get('tutor_direccion_numinterior'),'UTF-8');
                $alumno_tutor->tutor_direccion_numexterior  = mb_strtolower($request->get('tutor_direccion_numexterior'),'UTF-8');
                $alumno_tutor->tutor_direccion_referencias  = mb_strtolower($request->get('tutor_direccion_referencias'),'UTF-8');
                $alumno_tutor->tutor_direccion_colonia      = mb_strtolower($request->get('tutor_direccion_colonia'),'UTF-8');
                $alumno_tutor->tutor_direccion_codigopostal = $request->get('tutor_direccion_codigopostal');
                $alumno_tutor->tutor_direccion_localidad    = mb_strtolower($request->get('tutor_direccion_localidad'),'UTF-8');
                $alumno_tutor->tutor_direccion_delegacion   = mb_strtolower($request->get('tutor_direccion_delegacion'),'UTF-8');
                $alumno_tutor->tutor_direccion_estado       = mb_strtolower($request->get('tutor_direccion_estado'),'UTF-8');
                $alumno_tutor->tutor_telefonocasa           = $request->get('tutor_telefonocasa').'/'.mb_strtolower($request->get('referencia1'),'UTF-8');
                $alumno_tutor->tutor_telefonotrabajo        = $request->get('tutor_telefonotrabajo').'/'.mb_strtolower($request->get('referencia2'),'UTF-8');
                $alumno_tutor->tutor_telefonocelular        = $request->get('tutor_telefonocelular').'/'.mb_strtolower($request->get('referencia3'),'UTF-8');
                $alumno_tutor->tutor_telefono_otro          = $request->get('tutor_telefono_otro').'/'.mb_strtolower($request->get('referencia4'),'UTF-8');
                $alumno_tutor->tutor_ocupacion              = mb_strtolower($request->get('tutor_ocupacion'),'UTF-8');
                $alumno_tutor->tutor_lugardetrabajo	        = mb_strtolower($request->get('tutor_lugardetrabajo'),'UTF-8');
                $alumno_tutor->tutor_ldt_calle              = mb_strtolower($request->get('tutor_ldt_calle'),'UTF-8');
                $alumno_tutor->tutor_ldt_numinterior        = mb_strtolower($request->get('tutor_ldt_numinterior'),'UTF-8');
                $alumno_tutor->tutor_ldt_numexterior        = mb_strtolower($request->get('tutor_ldt_numexterior'),'UTF-8');
                $alumno_tutor->tutor_ldt_referencias        = mb_strtolower($request->get('tutor_ldt_referencias'),'UTF-8');
                $alumno_tutor->tutor_ldt_colonia            = mb_strtolower($request->get('tutor_ldt_colonia'),'UTF-8');
                $alumno_tutor->tutor_ldt_codigopostal       = $request->get('tutor_ldt_codigopostal');
                $alumno_tutor->tutor_ldt_localidad          = mb_strtolower($request->get('tutor_ldt_localidad'),'UTF-8');
                $alumno_tutor->tutor_ldt_delegacion         = mb_strtolower($request->get('tutor_ldt_delegacion'),'UTF-8');
                $alumno_tutor->tutor_ldt_estado             = mb_strtolower($request->get('tutor_ldt_estado'),'UTF-8');
                $alumno_tutor->tutor_status = true;
                $alumno_tutor->created_at   = $now;
                $alumno_tutor->updated_at   = $now;

                $alumno_tutor->save();

                return response()->json([
                    'success'   => true,
                    'message'  => 'Los datos del tutor se han guardado correctamente.'
                ], 200);


            }
            catch (Exception $e) {

                return response()->json([
                    'exception'    => true,
                    'success'      => false,
                    'error_message_user' => 'Error de consulta o del servidor de la base de datos. Contacte al administrador del sistema'
                ],422);

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

    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    public function delegacionesPorEstado($id_estado)
    {
        $delegaciones = Delegacion::where('estado_id',$id_estado)
            ->select('delegacion_clave as value', 'delegacion_nombre as text')
            ->orderBy('delegacion_nombre', 'asc')
            ->get()
            ->toArray();
        array_unshift($delegaciones, ['value' => '', 'text' => '[Elegir Deleg/Munic.]']);
        return $delegaciones;
    }

    public function coloniasPorDelegacion($id_estado,$id_delegacion)
    {
        $colonias = CodigoPostal::where('estado_id',$id_estado)
            ->where('delegacion_id',$id_delegacion)
            ->select('id as value', 'cp_asentamiento as text')
            ->orderBy('cp_asentamiento', 'asc')
            ->get()
            ->toArray();
        array_unshift($colonias, ['value' => '', 'text' => '[Elegir Colonia]']);
        return $colonias;
    }

    public function detalleColonia($id_colonia)
    {
        $colonia = CodigoPostal::where('id', $id_colonia)
            ->first();

        return response()->json([
            'cp_codigo'           => $colonia->cp_codigo,
            'cp_tipoasentamiento' => $colonia->cp_tipoasentamiento,
            'cp_asentamiento'     => $colonia->cp_asentamiento,
            'cp_ciudad'           => $colonia->cp_ciudad
        ]);
    }
}
