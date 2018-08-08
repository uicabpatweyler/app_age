<?php

namespace App\Http\Controllers;

use App\Models\AlumnoDatosPersonales;
use App\Models\Ciclo;
use App\Models\Estado;
use App\Models\Tutor;
use App\Models\TutorDatosPersonales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class TutorDatosPersonalesController extends Controller
{
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
    public function create($tutor_id, $ciclo_id, $dp)
    {
        $tutor = Tutor::where('id',$tutor_id)->first();

        $ciclo = Ciclo::where('id', $ciclo_id)->first();

        if($dp!=0){

            $dp = AlumnoDatosPersonales::where('id', $dp)->first();
            return view('tutores.nuevo_tutor_utilizar_dp', compact('tutor', 'ciclo', 'dp'));
        }
        else{

            $estados = Estado::select('id','estado_nombre')
                       ->orderBy('estado_nombre', 'asc')
                       ->get();

            return view('tutores.nuevo_tutor_datospersonales',compact('tutor', 'ciclo', 'estados'));
        }
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

            /*Tabla: TUTORES_DATOSPERSONALES */
            'nombre_vialidad'        => 'required',
            'numero_exterior'        => 'required',
            'tipo_asentamiento'      => 'required',
            'nombre_asentamiento'    => 'required',
            'codigo_postal'          => 'required',
            'nombre_localidad'       => 'required',
            'delegacion_municipio'   => 'required',
            'entidad_federativa'     => 'required',

        ]);

        if($validation->passes()){
            try
            {
                $resultado = DB::transaction(function () use ($request) {

                    $tutor = new TutorDatosPersonales();

                    $now = Carbon::now('America/Mexico_City Time Zone');

                    $tutor->ciclo_id             = $request->get('ciclo_id');
                    $tutor->tutor_id             = $request->get('tutor_id');
                    $tutor->tutor_email          = $request->get('tutor_email');
                    $tutor->tipo_vialidad        = $request->get('tipo_vialidad');
                    $tutor->nombre_vialidad      = mb_strtolower($request->get('nombre_vialidad'),'UTF-8');
                    $tutor->numero_exterior      = mb_strtolower($request->get('numero_exterior'),'UTF-8');
                    $tutor->numero_interior      = mb_strtolower($request->get('numero_interior'),'UTF-8');
                    $tutor->tipo_asentamiento    = mb_strtolower($request->get('tipo_asentamiento'),'UTF-8');
                    $tutor->nombre_asentamiento  = mb_strtolower($request->get('nombre_asentamiento'),'UTF-8');
                    $tutor->codigo_postal        = $request->get('codigo_postal');
                    $tutor->nombre_localidad     = mb_strtolower($request->get('nombre_localidad'),'UTF-8');
                    $tutor->delegacion_municipio = $request->get('delegacion_municipio');
                    $tutor->entidad_federativa   = $request->get('entidad_federativa');
                    $tutor->pais                 = 'México';
                    $tutor->entre_calles         = mb_strtolower($request->get('entre_calles'),'UTF-8');
                    $tutor->referencias_adicionales = mb_strtolower($request->get('referencias_adicionales'),'UTF-8');

                    $tutor->telefono_casa        = $request->get('telefono_casa');
                    $tutor->referencia1          = mb_strtolower($request->get('referencia1'),'UTF-8');
                    $tutor->telefono_trabajo       = $request->get('telefono_trabajo');
                    $tutor->referencia2          = mb_strtolower($request->get('referencia2'),'UTF-8');
                    $tutor->telefono_celular     = $request->get('telefono_celular');
                    $tutor->referencia3          = mb_strtolower($request->get('referencia3'),'UTF-8');
                    $tutor->telefono_otro        = $request->get('telefono_otro');
                    $tutor->referencia4          = mb_strtolower($request->get('referencia4'),'UTF-8');

                    $tutor->tutor_lugartrabajo                = $request->get('tutor_lugartrabajo');
                    $tutor->tutor_direccion_lugartrabajo      = $request->get('tutor_direccion_lugartrabajo');
                    $tutor->colonia_direccion_lugartrabajo    = $request->get('colonia_direccion_lugartrabajo');
                    $tutor->cp_direccion_lugartrabajo         = $request->get('cp_direccion_lugartrabajo');
                    $tutor->estado_direccion_lugartrabajo     = $request->get('estado_direccion_lugartrabajo');
                    $tutor->delegacion_direccion_lugartrabajo = $request->get('delegacion_direccion_lugartrabajo');
                    $tutor->localidad_direccion_lugartrabajo  = $request->get('localidad_direccion_lugartrabajo');


                    $tutor->created_at = $now;
                    $tutor->updated_at = $now;

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
                        'message_user'       => '(1) Error al guardar los datos personales del tutor.'

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
                        'message_user'       => '(2) Error al guardar los datos personales del tutor.'

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
