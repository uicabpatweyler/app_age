<?php

namespace App\Http\Controllers;

use App\Models\MesPagoColegiatura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MesPagoColegiaturaController extends Controller
{
    private function formatearFecha($tipo,$cadena)
    {
        $arreglo =explode(' / ', $cadena);

        if($tipo === 1)
        {
            //Fecha inicial
            $carbon = new Carbon($arreglo[0],'America/Mexico_City Time Zone');
            return $carbon->toDateString();
        }
        if($tipo === 2)
        {
            //Fecha final
            $carbon = new Carbon($arreglo[1],'America/Mexico_City Time Zone');
            return $carbon->toDateString();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1) Validación de datos
        $validation =Validator::make($request->all(),[
            'colegiatura_id'          => 'required',
            'orden_mes'               => 'required',
            'nombre_mes'              => 'required|max: 10',
            'periodo_sin_recargo'     => 'required',
            'periodo_con_recargo'     => 'required',
            'porcentaje_recargo'      => 'required'
        ]);

        if($validation->passes())
        {

            $duplicado = MesPagoColegiatura::where('colegiatura_id', $request->get('colegiatura_id'))
                         ->where('nombre_mes',$request->get('nombre_mes'))
                         ->first();

            if($duplicado===null)
            {
                $now = Carbon::now('America/Mexico_City Time Zone');

                $registro = new MesPagoColegiatura();
                $registro->colegiatura_id     = $request->get('colegiatura_id');
                $registro->orden_mes          = $request->get('orden_mes');
                $registro->nombre_mes         = $request->get('nombre_mes');
                $registro->fecha1_sin_recargo = $this->formatearFecha(1,$request->get('periodo_sin_recargo'));
                $registro->fecha2_sin_recargo = $this->formatearFecha(2,$request->get('periodo_sin_recargo'));
                $registro->fecha3_con_recargo = $this->formatearFecha(1,$request->get('periodo_con_recargo'));
                $registro->fecha4_con_recargo = $this->formatearFecha(2,$request->get('periodo_con_recargo'));
                $registro->porcentaje_recargo = $request->get('porcentaje_recargo');
                $registro->created_at         = $now;
                $registro->updated_at         = $now;

                $registro->save();

                return response()->json([
                    'success' => true,
                    'message' => 'El mes se ha guardado correctamente.'
                ], 200);
            }
            else{
                return response()->json([
                    'extra'   => true,
                    'success' => false,
                    'message' => 'El mes que trata de crear ya existe'
                ], 422);
            }


        }

        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'extra'   => true,
            'success' => false,
            'message' => $errors
        ], 422);
        //return dd($this->formatearFecha(2,$request->get('periodo_sin_recargo')));
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
