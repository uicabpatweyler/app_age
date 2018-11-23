<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Ciclo;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListaDeAsistencia extends Controller
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

    private function LogoRecibo($x1,$y1,$x2,$y2){
        Fpdf::Image('logo_left.png',$x1,$y1);
        Fpdf::Image('logo_right.png',$x2,$y2);

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
        Fpdf::Cell(0,2,'',0,1,0,false);

    }

    private function cuadricula($diasLista,$fill){

        $width = number_format((110/(count($diasLista))),2);

        for($i=0;$i<count($diasLista);$i++){
            if($i==count($diasLista)-1){
                Fpdf::Cell($width,5,'',1,1,'C',$fill);
            }
            else{
                Fpdf::Cell($width,5,'',1,0,'C',$fill);
            }
        }
    }

    private function encabezado($nivel,$grupo,$mes,$anio){

        $ciclo = Ciclo::where('ciclo_actual',true)->first();

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(68,5,utf8_decode('LISTA DE ASISTENCIA DEL GRUPO'),1,0,'C',true);
        Fpdf::Cell(68,5,utf8_decode('DEL MES DE'),1,0,'C',true);
        Fpdf::Cell(70,5,'CICLO ESCOLAR',1,1,'C',true);

        Fpdf::SetFont('Arial', 'I', 8);

        Fpdf::Cell(68,5,utf8_decode($nivel.' - '.$grupo),1,0,'C',false);
        Fpdf::Cell(68,5,utf8_decode($mes.' - '.$anio),1,0,'C',false);
        Fpdf::Cell(70,5,$ciclo->ciclo_anioinicial.'-'.$ciclo->ciclo_aniofinal,1,1,'C',false);

        //Espacio
        Fpdf::Cell(0,2,'',0,1,0,false);
    }

    private function EncabezadoTabla($diasLista){

        Fpdf::Cell(6,5,'',0,0,'C',false);
        Fpdf::Cell(90,5,'',0,0,'C',false);

        $width = number_format((110/(count($diasLista))),2);

        Fpdf::SetFont('Arial', '', 7);
        Fpdf::SetFillColor(234,234,234); //Gris Claro

        for ($i=0;$i<count($diasLista);$i++){

            $dia = explode('-',$diasLista[$i]);

            if($i==count($diasLista)-1){
                Fpdf::Cell($width,5,$dia[0],1,1,'C',true);
            }
            else{
                Fpdf::Cell($width,5,$dia[0],1,0,'C',true);
            }

        }

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::SetFillColor(196,224,180); //Verde

        Fpdf::Cell(6,5,'#',1,0,'C',true);
        Fpdf::Cell(90,5,'Alumno',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 7);
        Fpdf::SetFillColor(234,234,234); //Gris Claro

        for ($i=0;$i<count($diasLista);$i++){

            $dia = explode('-',$diasLista[$i]);

            if($i==count($diasLista)-1){
                Fpdf::Cell($width,5,$dia[1],1,1,'C',true);
            }
            else{
                Fpdf::Cell($width,5,$dia[1],1,0,'C',true);
            }
        }
    }


    public function pdf_ListaDeAsistencia($grupo,$mes_anio,$maestro,$fecha){

        $diasHabiles = $this->diasHabiles($mes_anio);

        $info = explode('-',$grupo);
        $id_grupo    = $info[0];
        $nivel       = $info[1];
        $grupo       = $info[2];

        $info = explode('-',$mes_anio);
        $numero_mes = $info[0];
        $anio       = $info[1];

        $hombres = 0;
        $mujeres  = 0;

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::SetMargins(5,5,5);
        Fpdf::SetAutoPageBreak(true,1);

        Fpdf::AddPage();

        $this->LogoRecibo(7,14,187,11);
        $this->reset();
        $this->encabezado($nivel,$grupo,$this->nameMonth($numero_mes),$anio);
        $this->reset();

        $alumnos = DB::table('grupos_alumnos')
            ->select('grupos_alumnos.grupo_id','grupos_alumnos.alumno_id')
            ->addSelect(DB::raw('CONCAT(alumnos.alumno_apellidopaterno," ", alumnos.alumno_apellidomaterno," ",alumnos.alumno_primernombre," ",alumnos.alumno_segundonombre) AS nombreAlumno'))
            ->addSelect('alumnos.alumno_genero')
            ->join('alumnos','grupos_alumnos.alumno_id','=','alumnos.id')
            ->where('grupos_alumnos.escuela_id',1)
            ->where('grupos_alumnos.ciclo_id',1)
            ->where('grupos_alumnos.grupo_id',$id_grupo)
            ->orderBy('nombreAlumno','asc')
            ->get();

        if($alumnos->count()!=0){
            $this->EncabezadoTabla($diasHabiles);
            $this->reset();
            $numero = 1;

            foreach ($alumnos as $alumno){

                $alumno->alumno_genero === 'H' ? $hombres++ : $mujeres++;

                if(($numero%2)==0){

                    Fpdf::SetFillColor(234,234,234); //Gris Claro

                    Fpdf::Cell(6,5,$numero,1,0,'C',true);
                    Fpdf::Cell(90,5,utf8_decode(ucwords($alumno->nombreAlumno)),1,0,'L',true);
                    $this->cuadricula($diasHabiles,true);
                }
                else{

                    Fpdf::SetFillColor(255,255,255); //Blanco

                    Fpdf::Cell(6,5,$numero,1,0,'C',true);
                    Fpdf::Cell(90,5,utf8_decode(ucwords($alumno->nombreAlumno)),1,0,'L',true);
                    $this->cuadricula($diasHabiles,true);
                }

                $numero++;
            }

            Fpdf::SetFont('Arial', 'B', 8);

            //Espacio
            Fpdf::Cell(0,5,'',0,1,'C',false);

            Fpdf::Cell(6,5,'',0,0,'C',false);
            Fpdf::Cell(45,5,'Total de alumnos: '.$alumnos->count(),0,0,'L',false);
            Fpdf::Cell(45,5,'Hombres: '.$hombres,0,0,'C',false);
            Fpdf::Cell(45,5,'Mujeres: '.$mujeres,0,1,'C',false);


            Fpdf::SetFont('Arial', 'B', 8);
            Fpdf::SetFillColor(196,224,180); //Verde

            //Espacio
            Fpdf::Cell(0,10,'',0,1,'C',false);

            Fpdf::Cell(80,5,'Teacher',1,0,'C',true);
            Fpdf::Cell(60,5,'Fecha de Entrega',1,0,'C',true);
            Fpdf::Cell(66,5,utf8_decode('Fecha de devolución'),1,1,'C',true);

            Fpdf::Cell(80,5,utf8_decode($maestro),1,0,'C',false);
            Fpdf::Cell(60,5,ucwords($fecha),1,0,'C',false);
            Fpdf::Cell(66,5,'',1,0,'C',false);


        }
        else{
            Fpdf::SetFont('Arial', 'B', 20);
            Fpdf::SetTextColor(255,0,0);

            Fpdf::Cell(0,30,'',0,1,'C',false);
            Fpdf::Cell(0,10,'*** El grupo seleccionado no contiene alumnos ***',0,0,'C',false);
        }


        Fpdf::Output();
        exit;

    }

    public function nameMonth($number){
        $nameMonths = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return $nameMonths[$number-1];
    }

    /**
     * @param $mes_anio
     * @return array
     */
    private function diasHabiles($mes_anio){
        $info           = explode('-',$mes_anio);
        $diasDelMes     = Carbon::createFromDate($info[1],$info[0],1)->daysInMonth;
        $shortDayOfWeek = array('D','L','M','M','J','V','S');
        $diasHabiles    = [];
        $index          = 0;

        for($i=1; $i<=$diasDelMes; $i++){
            $fecha     = Carbon::createFromDate($info[1],$info[0],$i);
            $diaSemana =  $shortDayOfWeek[$fecha->dayOfWeek];

            if($fecha->dayOfWeek==0 || $fecha->dayOfWeek==6){}
            else{
                $diasHabiles[$index] = $diaSemana.'-'.$fecha->format('d');
                $index++;
            }
        }

        return $diasHabiles;
    }
}
