<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaAsistenciaController extends Controller
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

    public function index(){

        $ciclo = $this->cicloEscolarPredeterminado();

        $grupos = DB::table('clasificaciones')
            ->join('grupos', 'grupos.clasificacion_id', '=', 'clasificaciones.id')
            ->select('clasificaciones.clasificacion_nombre',
                'grupos.id',
                'grupos.grupo_nombre',
                'grupos.grupo_alumnospermitidos',
                'grupos.grupo_disponible')
            ->where('grupos.ciclo_id', $ciclo->id)
            ->where('grupos.escuela_id', 1)
            ->where('grupos.grupo_status', true)
            ->orderBy('clasificaciones.id', 'asc')
            ->orderBy('grupos.grupo_nombre', 'asc')
            ->get();

        return view('impresiones.lista_asistencia_index',compact('grupos'));
    }
}
