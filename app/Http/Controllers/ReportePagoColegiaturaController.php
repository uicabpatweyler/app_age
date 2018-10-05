<?php

namespace App\Http\Controllers;

use App\Models\PagoColegiatura;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportePagoColegiaturaController extends Controller
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
        return view('impresiones.reporte_colegiaturas_index');

    }

    public function pagosColegiaturaPorDia($fecha_reporte){

        $registros = PagoColegiatura::select('pagos_colegiatura.serie_recibo','pagos_colegiatura.folio_recibo','pagos_colegiatura.fecha_pago')
                     ->addSelect('pagos_colegiatura.pago_cancelado','pagos_colegiatura.alumno_id','pagos_colegiatura.grupo_id')
                     ->addSelect('pagos_colegiatura.cantidad_recibida_mxn','alumnos.alumno_primernombre','alumnos.alumno_segundonombre')
                     ->addSelect('alumnos.alumno_apellidopaterno','alumnos.alumno_apellidomaterno','grupos.grupo_nombre')
                     ->join('alumnos','pagos_colegiatura.alumno_id','=','alumnos.id')
                     ->join('grupos','pagos_colegiatura.grupo_id','=','grupos.id')
                     ->where('fecha_pago', $fecha_reporte)
                     ->orderBy('folio_recibo','asc')
                     ->get();
        $data_1 = [];

        $i=1;
        foreach ($registros as $registro){
            $data_1[] = [
                'numero'         => $i++,
                'serie_recibo'   => $registro->serie_recibo,
                'folio_recibo'   => $registro->folio_recibo,
                'fecha_pago'     => ucwords($registro->fecha_pago->format('D d, M Y')),
                'pago_cancelado' => $registro->pago_cancelado,
                'alumno'         => ucwords($registro->alumno_primernombre.' '.$registro->alumno_segundonombre.' '.$registro->alumno_apellidopaterno.' '.$registro->alumno_apellidomaterno),
                'grupo'          => $registro->grupo_nombre,
                'importe'        => '$ '.number_format($registro->cantidad_recibida_mxn,2,".",",")
            ];
        }

        //return dd($data_1);

        return response()->json([
            'data' => $data_1
        ]);

    }
}
