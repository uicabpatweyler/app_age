<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Ciclo;
use App\Models\DetallePagoColegiatura;
use App\Models\GrupoAlumno;
use App\Models\MesPagoColegiatura;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReporteDeudorGrupoMesController extends Controller
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

    private function reset(){
        Fpdf::SetLineWidth(0);
        Fpdf::SetDrawColor(0);
        Fpdf::SetFillColor(0);
        Fpdf::SetTextColor(0);
        Fpdf::SetFont('Arial', '', 8);
    }

    public function Header($mes,$ciclo){

        // $this->LogoRecibo(7,14,187,11);
        Fpdf::AliasNbPages();

        Fpdf::Image('logo_left.png',7,14);
        Fpdf::Image('logo_right.png',187,11);

        Fpdf::SetFont('Times', 'BI', 14);
        Fpdf::SetTextColor(0,128,0);

        Fpdf::Cell(90,5,'IRLANDA Academy of English',0,0,'L');
        Fpdf::Cell(26,5,'',0,0);
        Fpdf::Cell(90,5,utf8_decode('Academia de Inglés IRLANDA'),0,1,'R');

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(146,5,utf8_decode('Calle Faisán # 147 entre Chablé y Retorno 3. Chetumal, Q.Roo. RFC: IMA-040824-R97'),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(146,5,utf8_decode('INCORPORACIÓN A LA SEQ             C.C.T. 23PBT003'),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(146,5,utf8_decode('NÚMERO DE ACUERDO DE INCORPORACIÓN: ICAT17001CT '),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(146,5,utf8_decode('DE 20 DE FEBRERO DEL 2017'),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::SetFillColor(0,128,0);
        Fpdf::Cell(0,.5,'',0,1,0,true);

        //Espacio
        Fpdf::Cell(0,1,'',0,1,0,false);

        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::SetTextColor(0);
        Fpdf::SetLineWidth(0);
        Fpdf::SetDrawColor(0);

        Fpdf::Cell(50,6,'Alumnos deudores del mes de: ','B',0,'L',false);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(20,6,$mes,'B',0,'C',false);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(25,6,'Ciclo Escolar: ','B',0,'L',false);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(20,6,$ciclo,'B',0,'C',false);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(15,6,'Fecha: ','B',0,'L',false);
        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(25,6,$this->fechaEspaniol(null),'B',0,'C',false);
        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(51,6,utf8_decode('Página: ').Fpdf::PageNo().' '.'de {nb}','B',1,'R');

        //Espacio
        Fpdf::Cell(0,2,'',0,1,0,false);

    }

    public function cicloEscolarPredeterminado()
    {
        //Obtener el ID del ciclo actual de trabajo
        $ciclo = Ciclo::where('ciclo_activo', false)
            ->where('ciclo_actual', true)
            ->first();

        return $ciclo;
    }

    public function pdf_DeudoresGrupoMes($mes_del_reporte){

        $nameMonths = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $array_detalle =[];

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

        $mes = MesPagoColegiatura::where('nombre_mes',$nameMonths[$mes_del_reporte-1])->first();
        $i=1;

        foreach ($grupos as $grupo){

            $alumnos = GrupoAlumno::select('grupos_alumnos.grupo_id','grupos_alumnos.alumno_id','grupos_alumnos.created_at')
                ->addSelect(DB::raw('CONCAT(alumnos.alumno_apellidopaterno," ", 
                                        alumnos.alumno_apellidomaterno," ",
                                        alumnos.alumno_primernombre," ",
                                        alumnos.alumno_segundonombre) AS nombreAlumno'))
                ->join('alumnos','grupos_alumnos.alumno_id','=','alumnos.id')
                ->where('grupos_alumnos.escuela_id',1)
                ->where('grupos_alumnos.ciclo_id',$ciclo->id)
                ->where('grupos_alumnos.grupo_id',$grupo->id)
                ->where('grupos_alumnos.alumno_status',true)
                ->where('grupos_alumnos.alumno_baja',false)
                ->orderBy('nombreAlumno','asc')
                ->get();

            foreach ($alumnos as $alumno){

                $resultado = DetallePagoColegiatura::where('ciclo_id', $ciclo->id)
                    ->where('alumno_id', $alumno->alumno_id)
                    ->where('nombre_mes', $nameMonths[$mes_del_reporte-1])
                    ->where('pago_cancelado', false)
                    ->first();

                //El alumno aun no ha cubierto el pago de colegiatura de este mes
                if($resultado==null){

                    //Verificamos si su fecha de inscripcion es posterior al mes del reporte
                    if($alumno->created_at >= $mes->fecha4_con_recargo ){
                        $array_detalle[] = [
                            'numero'                 => $i++,
                            'alumno_id'              => $alumno->alumno_id,
                            'nombre_alumno'          => $alumno->nombreAlumno,
                            'fecha_pago_inscripcion' => $alumno->created_at->format('Y-m-d'),
                            'mes_inscripcion'        => $nameMonths[$alumno->created_at->month - 1],
                            'nivel_grupo'            => $grupo->clasificacion_nombre,
                            'nombre_grupo'           => $grupo->grupo_nombre,
                            'exento'                 => true
                        ];
                    }
                    else{
                        $array_detalle[] = [
                            'numero'                 => $i++,
                            'alumno_id'              => $alumno->alumno_id,
                            'nombre_alumno'          => $alumno->nombreAlumno,
                            'fecha_pago_inscripcion' => $alumno->created_at->format('Y-m-d'),
                            'mes_inscripcion'        => $nameMonths[$alumno->created_at->month - 1],
                            'nivel_grupo'            => $grupo->clasificacion_nombre,
                            'nombre_grupo'           => $grupo->grupo_nombre,
                            'exento'                 => false
                        ];
                    }
                }


            } //ALUMNOS

        } //GRUPOS

        $filas        = count($array_detalle);
        $fila_inicial = 1;
        $fila_final   = 42;

        $data_1 = [];

        $indice=0;

        if($filas<=42){
            $data_1[$indice]=$filas;
            $fila_final =$filas;
        }
        else{

            $data_1[$indice]=42;
            $indice++;
            $filas_por_pagina = 42;
            $x=1;
            while($x>0){

                $x = $filas - $filas_por_pagina;

                if($x>=46){ $data_1[$indice]=46; }
                elseif ($x>0){ $data_1[$indice]=$x; }

                $filas = $x;
                $filas_por_pagina=46;
                $indice++;
            }
        }

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::SetMargins(5,5,5);
        Fpdf::SetAutoPageBreak(true,1);

        for($i=0;$i<count($data_1);$i++){

            Fpdf::AddPage();
            $this->Header($nameMonths[$mes_del_reporte-1], $ciclo->ciclo_anioinicial.'-'.$ciclo->ciclo_aniofinal);
            $this->reset();

            Fpdf::SetFont('Arial', 'B', 7);
            Fpdf::SetTextColor(255,255,255);
            Fpdf::SetFillColor(57,107,54);

            //Encabezado de la tabla
            Fpdf::Cell(10,5,'#',0,0,'C',true);
            Fpdf::Cell(60,5,'Alumo',0,0,'C',true);
            Fpdf::Cell(76,5,'Fecha de  Inscripcion',0,0,'C',true);
            Fpdf::Cell(30,5,'Nivel',0,0,'C',true);
            Fpdf::Cell(30,5,'Grupo',0,1,'C',true);
            $this->reset();

            for($y=$fila_inicial-1; $y<=$fila_final-1; $y++){

                if(($y%2)==0){
                    //Color de la fila: Blanco
                    Fpdf::SetFillColor(254,254,254);
                    Fpdf::SetFont('Arial', '', 7);

                    Fpdf::Cell(10,5,$array_detalle[$y]['numero'],0,0,'C',true);
                    Fpdf::Cell(60,5,utf8_decode(ucwords($array_detalle[$y]['nombre_alumno'])),0,0,'L',true);
                    Fpdf::Cell(76,5,$this->fechaEspaniol($array_detalle[$y]['fecha_pago_inscripcion']),0,0,'C',true);
                    Fpdf::Cell(30,5,$array_detalle[$y]['nivel_grupo'],0,0,'C',true);
                    Fpdf::Cell(30,5,$array_detalle[$y]['nombre_grupo'],0,1,'C',true);
                }
                else{
                    //Color de la fila alterno
                    Fpdf::SetFillColor(230,242,230);
                    Fpdf::SetFont('Arial', '', 7);

                    Fpdf::Cell(10,5,$array_detalle[$y]['numero'],0,0,'C',true);
                    Fpdf::Cell(60,5,utf8_decode(ucwords($array_detalle[$y]['nombre_alumno'])),0,0,'L',true);
                    Fpdf::Cell(76,5,$this->fechaEspaniol($array_detalle[$y]['fecha_pago_inscripcion']),0,0,'C',true);
                    Fpdf::Cell(30,5,$array_detalle[$y]['nivel_grupo'],0,0,'C',true);
                    Fpdf::Cell(30,5,$array_detalle[$y]['nombre_grupo'],0,1,'C',true);
                }

            }

            $fila_inicial = $fila_final + 1;
            if($i+1<count($data_1)){
                $fila_final   = $fila_final + $data_1[$i+1];
            }
            else{
                $fila_final   = $fila_final + $data_1[$i];
            }
        }

        Fpdf::Output();
        exit;
        //return dd($data_1);

    }

    public function fechaEspaniol($fecha){
        $nameMonths = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $shortName = ['Ene','Febr','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        $mifecha = '';

        //Obtener la fecha actual
        if($fecha==null){
            $mifecha = Carbon::now()->format('d') .'-'.$nameMonths[Carbon::now()->month - 1].'-'.Carbon::now()->format('Y');
        }
        else{
            $aux = Carbon::parse($fecha);
            $mifecha = $aux->format('d').'-'. $shortName[$aux->month - 1].'-'.$aux->format('Y');
        }

        return $mifecha;
    }
}
