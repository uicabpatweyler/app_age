<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Ciclo;
use App\Models\DetallePagoColegiatura;
use App\Models\PagoColegiatura;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;

class ReporteDiarioColegiaturaController extends Controller
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

    public function Header($fecha){

        $ciclo = Ciclo::where('ciclo_actual',true)->first();

        Fpdf::SetLineWidth(.4);
        Fpdf::SetDrawColor(55,86,35);
        Fpdf::AliasNbPages();
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(0,6,utf8_decode('ACADEMIA DE INGLÉS: IRLANDA'),'TB',1,'C');

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::SetLineWidth(0);
        Fpdf::SetDrawColor(0);
        Fpdf::Cell(44,6,utf8_decode('Reporte de Colegiaturas del día: '),'B',0,'L');
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(55,6,utf8_decode(ucwords($fecha)),'B',0,'L');
        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(10,6,'','B',0,'L');
        Fpdf::Cell(20,6,utf8_decode('Ciclo Escolar:'),'B',0,'L');
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(30,6,utf8_decode($ciclo->ciclo_anioinicial.'-'.$ciclo->ciclo_aniofinal),'B',0,'L');
        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(47,6,utf8_decode('Página: ').Fpdf::PageNo().' '.'de {nb}','B',1,'R');

    }

    public function reset(){

        Fpdf::SetLineWidth(0);
        Fpdf::SetDrawColor(0);
        Fpdf::SetFillColor(0);
        Fpdf::SetTextColor(0);
        Fpdf::SetFont('Arial', '', 8);
    }

    public function resumen($total,$recibos,$cancelados){
        Fpdf::SetFillColor(230,242,230);

        Fpdf::Cell(0,2,'',0,1,false);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(130,5,'',0,0,false);
        Fpdf::Cell(38,5,'Total del Reporte','TB',0,'L',false);
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(38,5,'$ '.number_format($total,2,'.',','),'TB',1,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(130,5,'',0,0,false);
        Fpdf::Cell(38,5,utf8_decode('Número de Recibos'),'B',0,'L',false);
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(38,5,$recibos,'B',1,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(130,5,'',0,0,false);
        Fpdf::Cell(38,5,utf8_decode('Recibos Cancelados'),'B',0,'L',false);
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(38,5,$cancelados,'B',1,'C',true);
        //Espacio para la siguiente linea
        Fpdf::Cell(0,2,'',0,1);
    }

    public function firmas(){

        Fpdf::SetX(0);
        Fpdf::SetY(262);

        Fpdf::Cell(0,0,'',0,1);

        Fpdf::Cell(62,1,'','B',0);
        Fpdf::Cell(10,1,'',0,0);
        Fpdf::Cell(62,1,'','B',0);
        Fpdf::Cell(10,1,'',0,0);
        Fpdf::Cell(62,1,'','B',1);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(62,4,utf8_decode('María del Carmén Kantun Cupul'),0,0,'C');
        Fpdf::Cell(10,4,'',0,0);
        Fpdf::Cell(62,4,utf8_decode('Gaspar Felipe Sandoval Gómez'),0,0,'C');
        Fpdf::Cell(10,4,'',0,0);
        Fpdf::Cell(62,4,utf8_decode('Mtra. Flor Patrón'),0,1,'C');

        Fpdf::Cell(62,3,'Encargada de Caja',0,0,'C');
        Fpdf::Cell(10,3,'',0,0);
        Fpdf::Cell(62,3,'Control Escolar',0,0,'C');
        Fpdf::Cell(10,3,'',0,0);
        Fpdf::Cell(62,3,'Directora',0,1,'C');
    }

    public function encabezadoTabla(){
        Fpdf::SetFont('Arial', 'B', 7);
        Fpdf::SetTextColor(255,255,255);
        Fpdf::SetFillColor(57,107,54);

        Fpdf::Cell(8,5,'#',0,0,'C',true);
        Fpdf::Cell(14,5,'Recibo',0,0,'C',true);
        Fpdf::Cell(12,5,'Cancel.',0,0,'C',true);
        Fpdf::Cell(14,5,'Mes',0,0,'C',true);
        Fpdf::Cell(50,5,'Alumo',0,0,'C',true);
        Fpdf::Cell(20,5,'Grupo',0,0,'C',true);
        Fpdf::Cell(20,5,'F. Cancel.',0,0,'C',true);
        Fpdf::Cell(16,5,'Coleg.',0,0,'C',true);
        Fpdf::Cell(16,5,'Descuento',0,0,'C',true);
        Fpdf::Cell(16,5,'Rec.',0,0,'C',true);
        Fpdf::Cell(20,5,'Total',0,1,'C',true);
    }

    public function prueba(){
        $pagosDeColegiatura = PagoColegiatura::where('fecha_pago','2018-08-13')
                              ->orderBy('folio_recibo','asc')
                              ->get();
        $array_detalle=[];
        $total = 0;
        $total_detalle=0;
        $i=1;
        foreach ($pagosDeColegiatura as $fila){

            $detalle = DetallePagoColegiatura::where('pagocolegiatura_id',$fila->id)
                       ->orderBy('orden_mes','asc')
                       ->get();

            $total = $total + $fila->cantidad_recibida_mxn;


            foreach ($detalle as $filaDetalle){
                $total_detalle = $total_detalle + (($filaDetalle->importe_colegiatura + ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_recargo/100)) - ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_descuento/100));
                $array_detalle[] = [
                    'col_numero'   => $i,
                    'col_fecha'    => $fila->fecha_pago->format('l d, F Y'),
                    'col_recibo'   => $fila->serie_recibo.'-'.$fila->folio_recibo,
                    'col_cancel'   => $fila->pago_cancelado===true ? 'Si':'',
                    'col_mes'      => substr($filaDetalle->nombre_mes,0,3),
                    'col_alumno'   => $fila->alumno_id,
                    'col_grupo'    => $fila->GrupoPagoColegiatura->grupo_nombre,
                    'col_f-cancel' => $fila->pago_cancelado===true ? $fila->fecha_cancelacion->format('Y-m-d') : '',
                    'col_coleg'    => $filaDetalle->importe_colegiatura,
                    'col_desc'     => ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_descuento/100),
                    'col_rec'      => ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_recargo/100),
                    'col_total'    => ($filaDetalle->importe_colegiatura + ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_recargo/100)) - ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_descuento/100)
                ];
            }

            $i++;

        }

        printf($array_detalle[0]['col_grupo']);
        exit;

    }

    public function pdf_ReporteDiarioColegiatura($fecha){

        $cancelados = 0;

        $pagosDeColegiatura = PagoColegiatura::where('fecha_pago',$fecha)
            ->orderBy('folio_recibo','asc')
            ->get();

        $array_detalle=[];
        $total = 0;
        $total_detalle=0;
        $i=1;

        foreach ($pagosDeColegiatura as $fila){

            $detalle = DetallePagoColegiatura::where('pagocolegiatura_id',$fila->id)
                ->orderBy('orden_mes','asc')
                ->get();

            if($fila->pago_cancelado===true){$cancelados++;}

            $total = $total + $fila->cantidad_recibida_mxn;

            foreach ($detalle as $filaDetalle){
                $total_detalle = $total_detalle + (($filaDetalle->importe_colegiatura + ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_recargo/100)) - ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_descuento/100));
                $array_detalle[] = [
                    'col_numero'   => $i,
                    'col_fecha'    => $fila->fecha_pago->format('l d, F Y'),
                    'col_recibo'   => $fila->serie_recibo.'-'.$fila->folio_recibo,
                    'col_cancel'   => $fila->pago_cancelado===true ? 'Si':'',
                    'col_mes'      => substr($filaDetalle->nombre_mes,0,3),
                    'col_alumno'   => ucwords($fila->AlumnoPagosDeColegiatura->alumno_primernombre.' '.$fila->AlumnoPagosDeColegiatura->alumno_segundonombre.' '.$fila->AlumnoPagosDeColegiatura->alumno_apellidopaterno.' '.$fila->AlumnoPagosDeColegiatura->alumno_apellidomaterno),
                    'col_grupo'    => $fila->GrupoPagoColegiatura->grupo_nombre,
                    'col_f-cancel' => $fila->pago_cancelado===true ? $fila->fecha_cancelacion->format('Y-m-d') : '',
                    'col_coleg'    => $filaDetalle->importe_colegiatura,
                    'col_desc'     => ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_descuento/100),
                    'col_rec'      => ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_recargo/100),
                    'col_total'    => ($filaDetalle->importe_colegiatura + ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_recargo/100)) - ($filaDetalle->importe_colegiatura) * ($filaDetalle->porcentaje_descuento/100)
                ];
            }

            $i++;

        }

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
            $this->Header($array_detalle[0]['col_fecha']);
            if($i==0){
                $this->resumen($total,count($pagosDeColegiatura),$cancelados);
                $this->reset();
            }
            $this->encabezadoTabla();
            $this->reset();

            for($y=$fila_inicial-1; $y<=$fila_final-1; $y++){

                if(($y%2)==0){
                    //Color de la fila: Blanco
                    Fpdf::SetFillColor(254,254,254);
                    Fpdf::SetFont('Arial', '', 7);

                    Fpdf::Cell(8,5,$array_detalle[$y]['col_numero'],'B',0,'C',true);
                    Fpdf::Cell(14,5,$array_detalle[$y]['col_recibo'],'B',0,'C',true);
                    Fpdf::Cell(12,5,$array_detalle[$y]['col_cancel'],'B',0,'C',true);
                    Fpdf::Cell(14,5,$array_detalle[$y]['col_mes'],'B',0,'C',true);
                    Fpdf::Cell(50,5,utf8_decode($array_detalle[$y]['col_alumno']),'B',0,'L',true);
                    Fpdf::Cell(20,5,$array_detalle[$y]['col_grupo'],'B',0,'C',true);
                    Fpdf::Cell(20,5,$array_detalle[$y]['col_f-cancel'],'B',0,'C',true);
                    Fpdf::Cell(16,5,'$ '.number_format($array_detalle[$y]['col_coleg'],2,'.',','),'B',0,'R',true);
                    Fpdf::Cell(16,5,'-$ '.number_format($array_detalle[$y]['col_desc'],2,'.',','),'B',0,'R',true);
                    Fpdf::Cell(16,5,'+$ '.number_format($array_detalle[$y]['col_rec'],2,'.',','),'B',0,'R',true);
                    Fpdf::Cell(20,5,'$ '.number_format($array_detalle[$y]['col_total'],2,'.',','),'B',1,'R',true);
                }
                else{
                    Fpdf::SetFillColor(230,242,230);
                    Fpdf::SetFont('Arial', '', 7);

                    Fpdf::Cell(8,5,$array_detalle[$y]['col_numero'],'B',0,'C',true);
                    Fpdf::Cell(14,5,$array_detalle[$y]['col_recibo'],'B',0,'C',true);
                    Fpdf::Cell(12,5,$array_detalle[$y]['col_cancel'],'B',0,'C',true);
                    Fpdf::Cell(14,5,$array_detalle[$y]['col_mes'],'B',0,'C',true);
                    Fpdf::Cell(50,5,utf8_decode($array_detalle[$y]['col_alumno']),'B',0,'L',true);
                    Fpdf::Cell(20,5,$array_detalle[$y]['col_grupo'],'B',0,'C',true);
                    Fpdf::Cell(20,5,$array_detalle[$y]['col_f-cancel'],'B',0,'C',true);
                    Fpdf::Cell(16,5,'$ '.number_format($array_detalle[$y]['col_coleg'],2,'.',','),'B',0,'R',true);
                    Fpdf::Cell(16,5,'-$ '.number_format($array_detalle[$y]['col_desc'],2,'.',','),'B',0,'R',true);
                    Fpdf::Cell(16,5,'+$ '.number_format($array_detalle[$y]['col_rec'],2,'.',','),'B',0,'R',true);
                    Fpdf::Cell(20,5,'$ '.number_format($array_detalle[$y]['col_total'],2,'.',','),'B',1,'R',true);
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
        $this->reset();
        $this->firmas();
        Fpdf::Output();
        exit;


    }


}
