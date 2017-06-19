<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
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
            'empresa_rfc'           => 'required|unique:empresas|max:14',
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
            $empresa->create($request->all());

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
        return view ('empresa.edit');
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
