<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use App\Models\TipoDeServicio;
use App\Models\Nivel;
use App\Models\Servicio;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EscuelaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuela = Escuela::all()
                   ->where('escuela_status', true)
                   ->count();
        if($escuela===0){
            $tiposdeservicio = TipoDeServicio::select('id', 'tiposervicio_nombre')
                ->where('tiposervicio_estado', 1)
                ->OrderBy('id','ASC')
                ->get();

            return view('escuelas.create',compact('tiposdeservicio'));
        }
        else{
            $escuelas = Escuela::where('escuela_status', true)
                        ->OrderBy('id', 'ASC')
                        ->get();
            return view('escuelas.index', compact('escuelas'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * views\escuelas\create.blade.php
        */
        $tiposdeservicio = TipoDeServicio::select('id', 'tiposervicio_nombre')
            ->where('tiposervicio_estado', 1)
            ->OrderBy('id','ASC')
            ->get();

        return view('escuelas.create',compact('tiposdeservicio'));
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
            'escuela_tiposervicio'     => 'required',
            'escuela_nivel'            => 'required',
            'escuela_servicio'         => 'required',
            'escuela_nombre'           => 'required',
            'escuela_clavect'          => 'required|max:20',
            'escuela_direccion'        => 'required',
            'escuela_numexterior'      => 'required|max:60',
            'escuela_referencia'       => 'required',
            'escuela_colonia'          => 'required',
            'escuela_codpost'          => 'required|max:5',
            'escuela_delegacion'       => 'required',
            'escuela_localidad'        => 'required',
            'escuela_estado'           => 'required',
            'escuela_pais'             => 'required'
        ]);

        if($validation->passes()){

            $now = Carbon::now('America/Mexico_City Time Zone');

            $escuela = new Escuela();

            $escuela->escuela_tiposervicio     = $request->get('escuela_tiposervicio');
            $escuela->escuela_nivel            = $request->get('escuela_nivel');
            $escuela->escuela_servicio         = $request->get('escuela_servicio');
            $escuela->escuela_ciclo            = 0;
            $escuela->escuela_nombre           = $request->get('escuela_nombre');
            $escuela->escuela_clavect          = $request->get('escuela_clavect');
            $escuela->escuela_numincorporacion = $request->get('escuela_numincorporacion');
            $escuela->escuela_direccion        = $request->get('escuela_direccion');
            $escuela->escuela_numexterior      = $request->get('escuela_numexterior');
            $escuela->escuela_numinterior      = $request->get('escuela_numinterior');
            $escuela->escuela_referencia       = $request->get('escuela_referencia');
            $escuela->escuela_colonia          = $request->get('escuela_colonia');
            $escuela->escuela_codpost          = $request->get('escuela_codpost');
            $escuela->escuela_telefono         = $request->get('escuela_telefono');
            $escuela->escuela_email            = $request->get('escuela_email');
            $escuela->escuela_delegacion       = $request->get('escuela_delegacion');
            $escuela->escuela_localidad        = $request->get('escuela_localidad');
            $escuela->escuela_estado           = $request->get('escuela_estado');
            $escuela->escuela_pais             = $request->get('escuela_pais');
            $escuela->escuela_status           = true;
            $escuela->created_at               = $now;
            $escuela->updated_at               = $now;

            $escuela->save();

            return response()->json([
                'success' => true,
                'message' => 'Los datos de la escuela se han guardado correctamente.'
            ], 200);

        }

        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
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
        $escuela = Escuela::findOrFail($id);
        
        $tiposdeservicio = TipoDeServicio::select('id', 'tiposervicio_nombre')
            ->where('tiposervicio_estado', true)
            ->OrderBy('id','ASC')
            ->get();

        $niveles = Nivel::select('id', 'nivel_nombre')
                   ->where('nivel_estado', true)
                   ->where('tiposervicio_id', $escuela->escuela_tiposervicio)
                   ->OrderBy('id', 'ASC')
                   ->get();

        $servicios = Servicio::select('id', 'servicio_nombre')
                     ->where('servicio_estado', true)
                     ->where('nivel_id', $escuela->escuela_nivel)
                     ->OrderBy('id', 'ASC')
                     ->get();

        return view('escuelas.edit', compact('escuela','tiposdeservicio', 'niveles', 'servicios'));
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
        $validation = Validator::make($request->all(),[
            'escuela_tiposervicio'     => 'required',
            'escuela_nivel'            => 'required',
            'escuela_servicio'         => 'required',
            'escuela_nombre'           => 'required',
            'escuela_clavect'          => 'required|max:20',
            'escuela_direccion'        => 'required',
            'escuela_numexterior'      => 'required|max:60',
            'escuela_referencia'       => 'required',
            'escuela_colonia'          => 'required',
            'escuela_codpost'          => 'required|max:5',
            'escuela_delegacion'       => 'required',
            'escuela_localidad'        => 'required',
            'escuela_estado'           => 'required',
            'escuela_pais'             => 'required'
        ]);

        if($validation->passes()){

            $updated_at = Carbon::now('America/Mexico_City Time Zone');

            $escuela = Escuela::findOrFail($id);

            $escuela->escuela_tiposervicio     = $request->get('escuela_tiposervicio');
            $escuela->escuela_nivel            = $request->get('escuela_nivel');
            $escuela->escuela_servicio         = $request->get('escuela_servicio');
            $escuela->escuela_ciclo            = 0;
            $escuela->escuela_nombre           = $request->get('escuela_nombre');
            $escuela->escuela_clavect          = $request->get('escuela_clavect');
            $escuela->escuela_numincorporacion = $request->get('escuela_numincorporacion');
            $escuela->escuela_direccion        = $request->get('escuela_direccion');
            $escuela->escuela_numexterior      = $request->get('escuela_numexterior');
            $escuela->escuela_numinterior      = $request->get('escuela_numinterior');
            $escuela->escuela_referencia       = $request->get('escuela_referencia');
            $escuela->escuela_colonia          = $request->get('escuela_colonia');
            $escuela->escuela_codpost          = $request->get('escuela_codpost');
            $escuela->escuela_telefono         = $request->get('escuela_telefono');
            $escuela->escuela_email            = $request->get('escuela_email');
            $escuela->escuela_delegacion       = $request->get('escuela_delegacion');
            $escuela->escuela_localidad        = $request->get('escuela_localidad');
            $escuela->escuela_estado           = $request->get('escuela_estado');
            $escuela->escuela_pais             = $request->get('escuela_pais');
            $escuela->escuela_status           = true;
            $escuela->updated_at               = $updated_at ;

            $escuela->save();

            return response()->json([
                'success' => true,
                'message' => 'Los datos de la escuela se han actualizado correctamente.'
            ], 200);

        }

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
            $escuela = Escuela::find($id);
            $escuela->delete();

            return response()->json([
                'success' => true,
                'message' => 'La eliminación de la escuela se ha realizado correctamente'
            ], 200);

        }catch(Exception $e){
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
                    'error_message_user' => 'No es posible eliminar la escuela elegida. Restricción de llave foránea.'
                ],422);
            }
        }


    }

    public function listaAjaxNiveles($id){
        $niveles = Nivel::where('tiposervicio_id', $id)
            ->select('id as value', 'nivel_nombre as text')
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        array_unshift($niveles, ['value' => '-1', 'text' => '[Seleccione un nivel]']);
        return $niveles;
    }

    public function listaAjaxServicios($id){
        $servicios = Servicio::where('nivel_id', $id)
            ->select('id as value', 'servicio_nombre as text')
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
        array_unshift( $servicios, ['value' => '-1', 'text' => '[Tipo de Servicio]']);
        return  $servicios;
    }
}
