<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Ciclo;
use App\Models\DetallePagoColegiatura;
use App\Models\Grupo;
use App\Models\MesPagoColegiatura;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;
use Illuminate\Support\Facades\DB;

class ReporteDeudoresPorGrupoController extends Controller
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

    private function LogoReporte($x1,$y1,$x2,$y2){
        Fpdf::Image('logo_left.png',$x1,$y1);
        Fpdf::Image('logo_right.png',$x2,$y2);

        Fpdf::SetFont('Times', 'BI', 14);
        Fpdf::SetTextColor(0,128,0);

        Fpdf::Cell(90,5,'IRLANDA Academy of English',0,0,'R');
        Fpdf::Cell(89,5,'',0,0);
        Fpdf::Cell(90,5,utf8_decode('Academia de Inglés IRLANDA'),0,1,'L');

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(209,5,utf8_decode('Calle Faisán # 147 entre Chablé y Retorno 3. Chetumal, Q.Roo. RFC: IMA-040824-R97'),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(209,5,utf8_decode('INCORPORACIÓN A LA SEQ             C.C.T. 23PBT003'),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(209,5,utf8_decode('NÚMERO DE ACUERDO DE INCORPORACIÓN: ICAT17001CT '),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::Cell(30,5,'',0,0);
        Fpdf::Cell(209,5,utf8_decode('DE 20 DE FEBRERO DEL 2017'),0,0,'C');
        Fpdf::Cell(30,5,'',0,1);

        Fpdf::SetFillColor(0,128,0);
        Fpdf::Cell(0,.5,'',0,1,0,true);

        //Espacio
        Fpdf::Cell(0,2,'',0,1,0,false);

    }

    public function Header($ciclo_id,$grupo_id){
        $ciclo = Ciclo::where('id',$ciclo_id)->first();
        $grupo = Grupo::where('id', $grupo_id)->first();

        $now = Carbon::now('America/Mexico_City Time Zone');

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::SetLineWidth(0);
        Fpdf::SetDrawColor(0);

        Fpdf::Cell(62,6,utf8_decode('Reporte de Alumnos Deudores del Grupo: '),'B',0,'L');
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(50,6,utf8_decode($grupo->ClasificacionGrupo->clasificacion_nombre.' - '.$grupo->grupo_nombre),'B',0,'L');

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(22,6,utf8_decode('Ciclo Escolar:'),'B',0,'L');
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(55,6,utf8_decode($ciclo->ciclo_anioinicial.'-'.$ciclo->ciclo_aniofinal),'B',0,'L');

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(30,6,utf8_decode('Fecha de Impresión '),'B',0,'L');
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(50,6,$now->format('Y-m-d H:m:s '),'B',1,'L');

        //Espacio
        Fpdf::Cell(0,4,'',0,1,1,false);

    }

    public function encabezadoTabla(){
        Fpdf::SetTextColor(255,255,255); //Color de Texto
        Fpdf::SetFillColor(57,107,54); //Relleno
        Fpdf::SetFont('Arial', 'B', 8); //Fuente

        Fpdf::Cell(6,5,'#',1,0,'C',true);
        Fpdf::Cell(90,5,'Alumno',1,0,'C',true);

        $meses = MesPagoColegiatura::orderBy('orden_mes', 'asc')->get();
        $width = 14.4;

        foreach ($meses as $mes){
            Fpdf::Cell($width,5,substr($mes->nombre_mes,0,3),1,0,'C',true);
        }
        Fpdf::Cell($width,5,'',0,1,'C',false);

    }

    //Ancho de la pagina en forma horizontal = 269
    public function pdf_ReporteDeudoresPorGrupo($id_ciclo,$id_grupo){

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::SetMargins(5,5,5);
        Fpdf::SetAutoPageBreak(true,1);

        Fpdf::AddPage('L');

        $this->LogoReporte(7,14,254,11);
        $this->reset();
        $this->Header($id_ciclo,$id_grupo);
        $this->reset();
        $this->encabezadoTabla();

        $alumnosDelGrupo = DB::table('grupos_alumnos')
            ->select('grupos_alumnos.grupo_id','grupos_alumnos.alumno_id')
            ->addSelect(DB::raw('CONCAT(alumnos.alumno_apellidopaterno," ", alumnos.alumno_apellidomaterno," ",alumnos.alumno_primernombre," ",alumnos.alumno_segundonombre) AS nombreAlumno'))
            ->addSelect('alumnos.alumno_genero')
            ->join('alumnos','grupos_alumnos.alumno_id','=','alumnos.id')
            ->where('grupos_alumnos.escuela_id',1)
            ->where('grupos_alumnos.ciclo_id',$id_ciclo)
            ->where('grupos_alumnos.grupo_id',$id_grupo)
            ->where('grupos_alumnos.alumno_status', true)
            ->where('grupos_alumnos.alumno_baja', false)
            ->orderBy('nombreAlumno','asc')
            ->get();

        $meses = MesPagoColegiatura::orderBy('orden_mes', 'asc')->get();

        $data = [];
        $i=0;
        $deudoresPorMes= [];

        foreach ($meses as $mes){
            $deudoresPorMes[$mes->nombre_mes] = 0;
        }

        foreach ($alumnosDelGrupo as $alumno){

            $data[$i]['valor_de_i'] = $i;
            $data[$i]['alumno'] = ucwords($alumno->nombreAlumno);
            $data[$i]['alumno_id'] = $alumno->alumno_id;

            foreach ($meses as $mes){

                $resultado = DetallePagoColegiatura::where('ciclo_id', $id_ciclo)
                    ->where('alumno_id', $alumno->alumno_id)
                    ->where('nombre_mes', $mes->nombre_mes)
                    ->where('pago_cancelado', false)
                    ->first();

                $etiqueta_mes = $mes->nombre_mes;
                $etiqueta_id  = "rowid_".$mes->nombre_mes;

                if($resultado!=null){
                    $data[$i][$etiqueta_mes] = $mes->nombre_mes;
                    $data[$i][$etiqueta_id] = $resultado->pagocolegiatura_id;
                }else{
                    $data[$i][$etiqueta_mes] = null;
                    $data[$i][$etiqueta_id] = null;
                    $deudoresPorMes[$mes->nombre_mes]++;
                }
            }
            $i++;
        }

        $this->reset();
        $i=1;

        for($y=0;$y<count($data);$y++){

            if(($y%2)==0){
                //Color de la fila: Blanco
                Fpdf::SetFillColor(254,254,254);
                Fpdf::SetTextColor(0);
                Fpdf::SetFont('Arial', '', 8);

                Fpdf::Cell(6,5,$i,1,0,'C',true);
                Fpdf::Cell(90,5,$data[$y]['alumno'],1,0,'L',true);

                foreach ($meses as $mes){
                    $etiqueta_mes = $mes->nombre_mes;
                    $etiqueta_id  = "rowid_".$mes->nombre_mes;

                    Fpdf::SetFillColor(254,254,254);
                    Fpdf::SetTextColor(0);
                    Fpdf::SetFont('Arial', 'B', 12);

                    if($data[$y][$etiqueta_mes]!=null && $data[$y][$etiqueta_id]!=null){

                        Fpdf::Cell(14.4,5,chr(149),1,0,'C',true);
                    }
                    else{

                        Fpdf::SetFont('Arial', 'B', 8); //Tamanio de Fuente
                        Fpdf::SetTextColor(255,0,0);
                        Fpdf::Cell(14.4,5,'X',1,0,'C',true);


                    }
                }
                Fpdf::Cell(1,5,'',0,1,'C',false);


            }else{
                Fpdf::SetFillColor(230,242,230);
                Fpdf::SetTextColor(0);
                Fpdf::SetFont('Arial', '', 8);

                Fpdf::Cell(6,5,$i,1,0,'C',true);
                Fpdf::Cell(90,5,$data[$y]['alumno'],1,0,'L',true);

                foreach ($meses as $mes){
                    $etiqueta_mes = $mes->nombre_mes;
                    $etiqueta_id  = "rowid_".$mes->nombre_mes;

                    Fpdf::SetFillColor(230,242,230);
                    Fpdf::SetTextColor(0);
                    Fpdf::SetFont('Arial', 'B', 12);

                    if($data[$y][$etiqueta_mes]!=null && $data[$y][$etiqueta_id]!=null){
                        Fpdf::Cell(14.4,5,chr(149),1,0,'C',true);
                    }
                    else{
                        Fpdf::SetFont('Arial', 'B', 8); //Tamanio de Fuente
                        Fpdf::SetTextColor(255,0,0);
                        Fpdf::Cell(14.4,5,'X',1,0,'C',true);
                    }
                }
                Fpdf::Cell(1,5,'',0,1,'C',false);
            }

            $i++;

        }

        Fpdf::SetTextColor(0);
        Fpdf::SetFont('Arial', 'B', 9);


        Fpdf::Cell(6,5,'',0,0,'C',false);
        Fpdf::Cell(90,5,'Alumnos deudores por mes',0,0,'C',false);

        foreach ($meses as $mes){

            if($deudoresPorMes[$mes->nombre_mes]!=0){
                Fpdf::SetTextColor(255,0,0);
                Fpdf::Cell(14.4,5,$deudoresPorMes[$mes->nombre_mes],0,0,'C',false);
            }
            else{
                Fpdf::SetTextColor(0);
                Fpdf::Cell(14.4,5,'',0,0,'C',false);
            }


        }

        Fpdf::Output();
        exit;



    }
}
