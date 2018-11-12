<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ImprReciboVentaController extends Controller
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
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
                 ->where('ciclo_actual', true)
                 ->first();

        $recibos = DB::table('salidas_producto')
                   ->select('salidas_producto.id','salidas_producto.folio_recibo')
                   ->addSelect('salidas_producto.fecha_venta','salidas_producto.venta_cancelada','salidas_producto.alumno_id','salidas_producto.cantidad_recibida_mxn')
                   ->addSelect(DB::raw('CONCAT(alumnos.alumno_apellidopaterno," ", alumnos.alumno_apellidomaterno," ",alumnos.alumno_primernombre," ",alumnos.alumno_segundonombre) AS nombreAlumno'))
                   ->join('alumnos','salidas_producto.alumno_id','=','alumnos.id')
                   ->where('salidas_producto.ciclo_id',$ciclo->id)
                   ->orderBy('salidas_producto.folio_recibo', 'asc')
                   ->get();

        return view('impresiones.impr_rec_venta_index', compact('ciclo', 'recibos'));
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
        //
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
