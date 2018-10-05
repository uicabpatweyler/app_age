<?php

namespace App\Http\Controllers;

use App\Models\PagoInscripcion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportePagoInscripcionController extends Controller
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

    public function index(){
        return view('impresiones.reporte_inscripcion_index');
    }

    //https://laraveles.com/consultas-fechas-usando-eloquent/
    public function  pagosInscripcionPorDia($fecha){

        //$fecha = '2018-08-14';

        $registros = PagoInscripcion::whereDate('created_at',(new Carbon($fecha))->format('Y-m-d'))
                     ->orderBy('folio_recibo','asc')
                     ->get();

        $data_1 = [];

        $i=1;
        foreach ($registros as $registro){

            $nombre_alumno   = ucwords($registro->AlumnoPagoDeInscripcion->alumno_primernombre.' '.$registro->AlumnoPagoDeInscripcion->alumno_segundonombre);
            $apellido_alumno = ucwords($registro->AlumnoPagoDeInscripcion->alumno_apellidopaterno.' '.$registro->AlumnoPagoDeInscripcion->alumno_apellidopaterno);

            $data_1[] = [
                'numero'         => $i++,
                'serie_recibo'   => $registro->serie_recibo,
                'folio_recibo'   => $registro->folio_recibo,
                'fecha_pago'     => ucwords($registro->created_at->format('D d, M Y')),
                'pago_cancelado' => $registro->pago_cancelado,
                'alumno'         => $nombre_alumno.' '.$apellido_alumno,
                'grupo'          => $registro->GrupoPagoDeInscripcion->grupo_nombre,
                'importe'        => '$ '.number_format($registro->cantidad_recibida_mxn,2,".",",")
            ];
        }

        return response()->json([
            'data' => $data_1
        ]);

    }
}
