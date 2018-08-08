<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoDatosPersonales;
use App\Models\DatosInscripcionAlumno;
use App\Models\Ciclo;
use App\Models\CodigoPostal;
use App\Models\Delegacion;
use App\Models\Escuela;
use App\Models\Estado;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class AlumnoDatosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_alumno, $id_ciclo, $id_escuela)
    {
        $alumno = Alumno::where('id', $id_alumno)->first();
        $ciclo  = Ciclo::where('id', $id_ciclo)->first();
        $escuela = Escuela::where('id', $id_escuela)->first();
        $estados = Estado::select('id','estado_nombre')
                   ->orderBy('estado_nombre', 'asc')
                   ->get();

        return view('alumnos.nuevo_alumno_datos_personales', compact('alumno','ciclo', 'escuela','estados'));
    }

    public function store2(Request $request){

        $validation = Validator::make($request->all(),[

            /*Tabla: DATOS_INSCRIPCION_ALUMNO */
            'datospersonales_id' => 'required',
            'escuela_id'         => 'required',
            'ciclo_id'           => 'required',
            'alumno_id'          => 'required'

        ]);

        if($validation->passes())
        {
            try
            {
                //Iniciamos la transaccion para la insercion de los datos de inscripción
                $resultado = DB::transaction(function () use ($request)  {

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $datos_inscripcion = new DatosInscripcionAlumno();

                    $datos_inscripcion->escuela_id         = $request->get('escuela_id');
                    $datos_inscripcion->ciclo_id           = $request->get('ciclo_id');
                    $datos_inscripcion->alumno_id          = $request->get('alumno_id');
                    $datos_inscripcion->datospersonales_id = $request->get('datospersonales_id');

                    $datos_inscripcion->alumno_escuela       = mb_strtolower($request->get('alumno_escuela'),'UTF-8');
                    $datos_inscripcion->alumno_ultimogrado   = mb_strtolower($request->get('alumno_ultimogrado'),'UTF-8');
                    $datos_inscripcion->alumno_lugartrabajo  = mb_strtolower($request->get('alumno_lugartrabajo'),'UTF-8');
                    $datos_inscripcion->alumno_email         = $request->get('alumno_email');
                    $datos_inscripcion->encuesta_pregunta1   = $request->get('encuesta_pregunta1');
                    $datos_inscripcion->encuesta_pregunta2   = $request->get('encuesta_pregunta2');

                    $datos_inscripcion->created_at = $now;
                    $datos_inscripcion->updated_at = $now;

                    $datos_inscripcion->save();

                    return response()->json([
                        'success'   => true,
                        'message'   => 'Los datos del alumno se han guardado correctamente.'
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[

            /*Tabla: ALUMNOS_DATOSPERSONALES */
            'nombre_vialidad'        => 'required',
            'numero_exterior'        => 'required',
            'tipo_asentamiento'      => 'required',
            'nombre_asentamiento'    => 'required',
            'codigo_postal'          => 'required',
            'nombre_localidad'       => 'required',
            'delegacion_municipio'   => 'required',
            'entidad_federativa'     => 'required',

        ]);

        if($validation->passes())
        {
            try
            {
                //Iniciamos la transaccion para la insercion de los datos de inscripción
                $resultado = DB::transaction(function () use ($request)  {

                    $alumno = new AlumnoDatosPersonales();

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $alumno->tipo_vialidad        = $request->get('tipo_vialidad');
                    $alumno->nombre_vialidad      = mb_strtolower($request->get('nombre_vialidad'),'UTF-8');
                    $alumno->numero_exterior      = mb_strtolower($request->get('numero_exterior'),'UTF-8');
                    $alumno->numero_interior      = mb_strtolower($request->get('numero_interior'),'UTF-8');
                    $alumno->tipo_asentamiento    = mb_strtolower($request->get('tipo_asentamiento'),'UTF-8');
                    $alumno->nombre_asentamiento  = mb_strtolower($request->get('nombre_asentamiento'),'UTF-8');
                    $alumno->codigo_postal        = $request->get('codigo_postal');
                    $alumno->nombre_localidad     = mb_strtolower($request->get('nombre_localidad'),'UTF-8');
                    $alumno->delegacion_municipio = $request->get('delegacion_municipio');
                    $alumno->entidad_federativa   = $request->get('entidad_federativa');
                    $alumno->pais                 = 'México';
                    $alumno->entre_calles         = mb_strtolower($request->get('entre_calles'),'UTF-8');
                    $alumno->referencias_adicionales = mb_strtolower($request->get('referencias_adicionales'),'UTF-8');

                    $alumno->telefono_casa        = $request->get('telefono_casa');
                    $alumno->referencia1          = mb_strtolower($request->get('referencia1'),'UTF-8');
                    $alumno->telefono_tutor       = $request->get('telefono_tutor');
                    $alumno->referencia2          = mb_strtolower($request->get('referencia2'),'UTF-8');
                    $alumno->telefono_celular     = $request->get('telefono_celular');
                    $alumno->referencia3          = mb_strtolower($request->get('referencia3'),'UTF-8');
                    $alumno->telefono_otro        = $request->get('telefono_otro');
                    $alumno->referencia4          = mb_strtolower($request->get('referencia4'),'UTF-8');


                    $alumno->created_at = $now;
                    $alumno->updated_at = $now;

                    $alumno->save();

                   $datospersonales_id = $alumno->id;

                   $datos_inscripcion = new DatosInscripcionAlumno();

                    $datos_inscripcion->escuela_id = $request->get('escuela_id');
                    $datos_inscripcion->ciclo_id = $request->get('ciclo_id');
                    $datos_inscripcion->alumno_id = $request->get('alumno_id');;
                    $datos_inscripcion->datospersonales_id = $datospersonales_id;

                    $datos_inscripcion->alumno_escuela       = mb_strtolower($request->get('alumno_escuela'),'UTF-8');
                    $datos_inscripcion->alumno_ultimogrado   = mb_strtolower($request->get('alumno_ultimogrado'),'UTF-8');
                    $datos_inscripcion->alumno_lugartrabajo  = mb_strtolower($request->get('alumno_lugartrabajo'),'UTF-8');
                    $datos_inscripcion->alumno_email         = $request->get('alumno_email');
                    $datos_inscripcion->encuesta_pregunta1   = $request->get('encuesta_pregunta1');
                    $datos_inscripcion->encuesta_pregunta2   = $request->get('encuesta_pregunta2');

                    $datos_inscripcion->created_at = $now;
                    $datos_inscripcion->updated_at = $now;

                    $datos_inscripcion->save();

                    return response()->json([
                        'success'   => true,
                        'message'   => 'Los datos del alumno se han guardado correctamente.'
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

            }//catch exception
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

    public function utilizarDatosPersonales($id_datos_personales_alumno, $id_alumno, $id_ciclo, $id_escuela){
        $datosPersonales = AlumnoDatosPersonales::where('id',$id_datos_personales_alumno)->first();
        $alumno = Alumno::where('id', $id_alumno)->first();
        $ciclo  = Ciclo::where('id', $id_ciclo)->first();
        $escuela = Escuela::where('id', $id_escuela)->first();

        return view('alumnos.nuevo_alumno_utilizardatos',compact('datosPersonales','alumno', 'ciclo', 'escuela'));

        //return dd($datosPersonales);
    }

    public function delegaciones($id_estado)
    {
        $delegaciones = Delegacion::where('estado_id',$id_estado)
            ->select('delegacion_clave as value', 'delegacion_nombre as text')
            ->orderBy('delegacion_nombre', 'asc')
            ->get()
            ->toArray();
        array_unshift($delegaciones, ['value' => '', 'text' => '[Elegir Deleg/Munic.]']);
        return $delegaciones;
    }

    public function colonias($id_estado,$id_delegacion)
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

    public function detallesDeLaColonia($id_colonia)
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
