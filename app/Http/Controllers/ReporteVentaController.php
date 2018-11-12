<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteVentaController extends Controller
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

    public function reporteVentaPorDia(){
        return view('impresiones.reporte_ventas_index');
    }
}
