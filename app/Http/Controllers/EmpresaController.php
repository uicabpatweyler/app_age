<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::all()->count();
        if($empresa===0){ return redirect()->route('nuevaempresa');}
        else{
            $empresa= Empresa::all();
            return view('empresa.index', compact('empresa'));
            //return $empresa;
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
        * views\empresa\create.blade.php
       */
        return view('empresa.create');
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
            'empresa_rfc'           => 'required|unique:empresas|max:15',
            'empresa_razonsocial'   => 'required',
            'empresa_regimenfiscal' => 'required',
            'empresa_direccion'     => 'required',
            'empresa_numexterior'   => 'required',
            'empresa_referencia'    => 'required',
            'empresa_colonia'       => 'required',
            'empresa_codigopostal'  => 'required|max:5',
            'empresa_delegacion'    => 'required',
            'empresa_localidad'     => 'required',
            'empresa_estado'        => 'required',
            'empresa_pais'          => 'required'
        ]);

        if($validation->passes()){

            $now = Carbon::now('America/Mexico_City Time Zone');

            $empresa = new Empresa();

            $empresa->empresa_rfc           = $request->get('empresa_rfc');
            $empresa->empresa_razonsocial   = $request->get('empresa_razonsocial');
            $empresa->empresa_regimenfiscal = $request->get('empresa_regimenfiscal');
            $empresa->empresa_direccion     = $request->get('empresa_direccion');
            $empresa->empresa_numexterior   = $request->get('empresa_numexterior');
            $empresa->empresa_numinterior   = $request->get('empresa_numinterior');
            $empresa->empresa_referencia    = $request->get('empresa_referencia');
            $empresa->empresa_colonia       = $request->get('empresa_colonia');
            $empresa->empresa_codigopostal  = $request->get('empresa_codigopostal');
            $empresa->empresa_telefono      = $request->get('empresa_telefono');
            $empresa->empresa_email         = $request->get('empresa_email');
            $empresa->empresa_delegacion    = $request->get('empresa_delegacion');
            $empresa->empresa_localidad     = $request->get('empresa_localidad');
            $empresa->empresa_estado        = $request->get('empresa_estado');
            $empresa->empresa_pais          = $request->get('empresa_pais');
            $empresa->empresa_status        = true;
            $empresa->created_at            = $now;
            $empresa->updated_at            = $now;

            $empresa->save();

            return response()->json([
                'success' => true,
                'message' => 'Los datos de la empresa se han guardado correctamente.'
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
        $empresa = Empresa::findOrFail($id);
        return view ('empresa.edit',compact('empresa'));
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
            'empresa_rfc'           => 'required|max:15',
            'empresa_razonsocial'   => 'required',
            'empresa_regimenfiscal' => 'required',
            'empresa_direccion'     => 'required',
            'empresa_numexterior'   => 'required',
            'empresa_referencia'    => 'required',
            'empresa_colonia'       => 'required',
            'empresa_codigopostal'  => 'required|max:5',
            'empresa_delegacion'    => 'required',
            'empresa_localidad'     => 'required',
            'empresa_estado'        => 'required',
            'empresa_pais'          => 'required'
        ]);

        if($validation->passes()){
            $now = Carbon::now('America/Mexico_City Time Zone');
            $empresa = Empresa::findOrFail($id);
            $empresa->empresa_rfc           = $request->get('empresa_rfc');
            $empresa->empresa_razonsocial   = $request->get('empresa_razonsocial');
            $empresa->empresa_regimenfiscal = $request->get('empresa_regimenfiscal');
            $empresa->empresa_direccion     = $request->get('empresa_direccion');
            $empresa->empresa_numexterior   = $request->get('empresa_numexterior');
            $empresa->empresa_numinterior   = $request->get('empresa_numinterior');
            $empresa->empresa_referencia    = $request->get('empresa_referencia');
            $empresa->empresa_colonia       = $request->get('empresa_colonia');
            $empresa->empresa_codigopostal  = $request->get('empresa_codigopostal');
            $empresa->empresa_telefono      = $request->get('empresa_telefono');
            $empresa->empresa_email         = $request->get('empresa_email');
            $empresa->empresa_delegacion    = $request->get('empresa_delegacion');
            $empresa->empresa_localidad     = $request->get('empresa_localidad');
            $empresa->empresa_estado        = $request->get('empresa_estado');
            $empresa->empresa_pais          = $request->get('empresa_pais');
            $empresa->updated_at            = $now;

            $empresa->save($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Los datos de la empresa se han actualizado correctamente.'
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
        //
    }
}
