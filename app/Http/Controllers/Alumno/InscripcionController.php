<?php

namespace App\Http\Controllers\Alumno;

use App\Models\Alumno;
use App\Models\AlumnoDatosPersonales;
use App\Models\AlumnoTutor;
use App\Models\Ciclo;
use App\Models\CodigoPostal;
use App\Models\Delegacion;
use App\Models\Escuela;
use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    public function inscripcion_paso1()
    {
        return view('alumnos.inscripcion.inscripcion_paso1');
    }

    public function verificaCurpAlumno($curp)
    {
        $verificarCurp = Alumno::where('alumno_curp', $curp)->count();

        return $verificarCurp;
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

    public function inscripcion_paso2(Request $request)
    {
        $verificarCurp = $this->verificaCurpAlumno($request->get('alumno_curp'));

        if($verificarCurp!=0)
        {
            $alumnos = Alumno::where('alumno_curp', $request->get('alumno_curp'))->get();
            return view('alumnos.inscripcion.inscripcion_paso1', compact('verificarCurp','alumnos'));
        }
        else
        {
            $estados = Estado::select('id','estado_nombre')
                       ->orderBy('estado_nombre', 'asc')
                       ->get();

            $ciclo = $this->cicloEscolarPredeterminado();

            $escuelas = Escuela::where('escuela_status', true)
                        ->get();


            $curp = $request->get('curp');
            $alumno_curp = $request->get('alumno_curp');
            
            return view('alumnos.inscripcion.inscripcion_paso2', compact('curp','alumno_curp','estados','escuelas', 'ciclo'));
        }
    }


    /**
     * Paso 3 de una nueva inscripcion. Agregar los datos del tutor del alumno en cuestion.
     * ID del ciclo actual de trabajo
     * ID del alumno recien creado de la entidad ALUMNOS
     * ID del registro recien creado de los datos personales del alumno de la entidad ALUMNOS_DATOSPERSONALES
     *
     * @param int $id_alumno
     * @param int $id_registro
     * @param int $id_ciclo
     */
    public function inscripcion_paso3($id_ciclo,$id_alumno, $id_registro)
    {
        //Datos del ciclo escolar
        $ciclo = Ciclo::where('id', $id_ciclo)->first();

        //El alumno al cual se asignara el tutor
        $alumno = Alumno::where('id', $id_alumno)->first();

        //Datos del registro recien creado de la tabla ALUMNOS_DATOSPERSONALES
        $alumno_datospersonales = AlumnoDatosPersonales::where('id', $id_registro)->first();

        $estados = Estado::select('id','estado_nombre')
                   ->orderBy('estado_nombre', 'asc')
                   ->get();

        //return view('alumnos.inscripcion');
        //return dd($ciclo, $alumno, $alumno_datospersonales);
        return view('alumnos.inscripcion.inscripcion_paso3', compact('ciclo', 'alumno','alumno_datospersonales', 'estados'));
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
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return dd($request->all());

        $validation = Validator::make($request->all(),[
            'alumno_primernombre'    => 'required|min:2|max:30',
            'alumno_apellidopaterno' => 'required|min:2|max:30',
            'alumno_curp'            => 'required|min:2|max:30',
            'alumno_fechanacimiento' => 'required',
            'alumno_genero'          => 'required|min:1|max:1',
            'escuela_id'             => 'required',
            'ciclo_id'               => 'required',
            'alumno_edad'            => 'required',
            'direccion_calle'        => 'required',
            'direccion_numerointerior' => 'required',
            'direccion_referencias'  => 'required',
            'direccion_colonia'      => 'required',
            'direccion_codigopostal' => 'required|min:5|max:5',
            'direccion_localidad'    => 'required',
            'direccion_delegacion'   => 'required',
            'direccion_estado'       => 'required'
        ]);

        if($validation->passes())
        {

            try{

                $alumno = new Alumno();

                $now = Carbon::now('America/Mexico_City Time Zone');

                $alumno->alumno_primernombre    = mb_strtolower($request->get('alumno_primernombre'),'UTF-8');
                $alumno->alumno_segundonombre   = mb_strtolower($request->get('alumno_segundonombre'),'UTF-8');
                $alumno->alumno_apellidopaterno = mb_strtolower($request->get('alumno_apellidopaterno'),'UTF-8');
                $alumno->alumno_apellidomaterno = mb_strtolower($request->get('alumno_apellidomaterno'),'UTF-8');
                $alumno->alumno_curp            = $request->get('alumno_curp');
                $alumno->alumno_fechanacimiento = $request->get('fecha_nacimiento');
                $alumno->alumno_genero          = $request->get('alumno_genero');
                $alumno->alumno_status          = true;
                $alumno->created_at             = $now;
                $alumno->updated_at             = $now;

                $alumno->save();

                //Obtenemos el ultimo id insertado para usarlo en la tabla ALUMNOS_DATOSPERSONALES
                $id_alumno = $alumno->id;

                $alumnoDatosPersonales = new AlumnoDatosPersonales();

                $now = Carbon::now('America/Mexico_City Time Zone');

                $alumnoDatosPersonales->escuela_id               = $request->get('escuela_id');
                $alumnoDatosPersonales->ciclo_id                 = $request->get('ciclo_id');
                $alumnoDatosPersonales->alumno_id                = $id_alumno;
                $alumnoDatosPersonales->alumno_edad              = $request->get('alumno_edad');
                $alumnoDatosPersonales->direccion_calle          = mb_strtolower($request->get('direccion_calle'),'UTF-8');
                $alumnoDatosPersonales->direccion_numerointerior = mb_strtolower($request->get('direccion_numerointerior'),'UTF-8');
                $alumnoDatosPersonales->direccion_numeroexterior = mb_strtolower($request->get('direccion_numeroexterior'),'UTF-8');
                $alumnoDatosPersonales->direccion_referencias    = mb_strtolower($request->get('direccion_referencias'),'UTF-8');
                $alumnoDatosPersonales->direccion_colonia        = mb_strtolower($request->get('direccion_colonia_2'),'UTF-8');
                $alumnoDatosPersonales->direccion_codigopostal   = $request->get('direccion_codigopostal');
                $alumnoDatosPersonales->direccion_localidad      = mb_strtolower($request->get('direccion_localidad'),'UTF-8');
                $alumnoDatosPersonales->direccion_delegacion     = $request->get('nombre_delegacion');
                $alumnoDatosPersonales->direccion_estado         = $request->get('nombre_estado');
                $alumnoDatosPersonales->contacto_telefonocasa       = $request->get('contacto_telefonocasa').'/'.mb_strtolower($request->get('referencia1'),'UTF-8');
                $alumnoDatosPersonales->contacto_telefonotutor      = $request->get('contacto_telefonotutor').'/'.mb_strtolower($request->get('referencia2'),'UTF-8');
                $alumnoDatosPersonales->contacto_telefonocelular    = $request->get('contacto_telefonocelular').'/'.mb_strtolower($request->get('referencia3'),'UTF-8');
                $alumnoDatosPersonales->contacto_telefono_otro      = $request->get('contacto_telefono_otro').'/'.mb_strtolower($request->get('referencia4'),'UTF-8');
                $alumnoDatosPersonales->contacto_nombre_escuela  = mb_strtolower($request->get('contacto_nombre_escuela'),'UTF-8');
                $alumnoDatosPersonales->contacto_lugartrabajo    = mb_strtolower($request->get('contacto_lugartrabajo'),'UTF-8');
                $alumnoDatosPersonales->alumno_ultimogrado       = mb_strtolower($request->get('alumno_ultimogrado'),'UTF-8');
                $alumnoDatosPersonales->alumno_email             = $request->get('alumno_email');
                $alumnoDatosPersonales->encuesta_pregunta1       = $request->get('encuesta_pregunta1');
                $alumnoDatosPersonales->encuesta_pregunta2       = $request->get('encuesta_pregunta2');
                $alumnoDatosPersonales->alumno_status            = true;
                $alumnoDatosPersonales->created_at               = $now;
                $alumnoDatosPersonales->updated_at               = $now;

                $alumnoDatosPersonales->save();
                $id_registro = $alumnoDatosPersonales->id;

                return response()->json([
                    'success'   => true,
                    'id_alumno' => $id_alumno,
                    'id_registro' => $id_registro,
                    'message'  => 'Los datos de inscripción se han guardado correctamente.'
                ], 200);

            }
            catch (Exception $e){

                return response()->json([
                    'exception'    => true,
                    'success'      => false,
                    'error_message_user' => 'Error de consulta o del servidor de la base de datos. Contacte al administrador del sistema'
                ],422);

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
