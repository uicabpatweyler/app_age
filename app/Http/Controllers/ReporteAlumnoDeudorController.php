<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\DetallePagoColegiatura;
use App\Models\GrupoAlumno;
use App\Models\MesPagoColegiatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteAlumnoDeudorController extends Controller
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

        $meses = MesPagoColegiatura::orderBy('orden_mes', 'asc')->get();

        $array_detalle = [];

        foreach ($grupos as $grupo){

            foreach ($meses as $mes){

                $alumnosDelGrupo = GrupoAlumno::select('alumno_id')
                    ->where('ciclo_id', $ciclo->id)
                    ->where('grupo_id', $grupo->id)
                    ->where('alumno_status', true)
                    ->where('alumno_baja', false)
                    ->get();

                $pagado = 0;

                foreach ($alumnosDelGrupo as $alumno){
                    $resultado = DetallePagoColegiatura::where('ciclo_id', $ciclo->id)
                        ->where('alumno_id', $alumno->alumno_id)
                        ->where('nombre_mes', $mes->nombre_mes)
                        ->where('pago_cancelado', false)
                        ->first();

                    if($resultado!=null){
                        $pagado++;
                    }
                }

                $array_detalle[] = [
                    'ciclo_id'          => $ciclo->id,
                    'grupo_id'          => $grupo->id,
                    'nivel_grupo'       => $grupo->clasificacion_nombre.'-'.$grupo->grupo_nombre,
                    'nombre_mes'        => $mes->nombre_mes,
                    'alumnos_inscritos' => $alumnosDelGrupo->count(),
                    'alumnos_con_pago'  => $pagado,
                    'alumnos_deudores'  => $alumnosDelGrupo->count() - $pagado,
                    'porcentaje'        => bcdiv(($pagado * 100),$alumnosDelGrupo->count(),2)
                ];

            }

        }

        return view('deudores.alumnos_deudores_index',compact('array_detalle'));
        //return dd($array_detalle);
    }
}
