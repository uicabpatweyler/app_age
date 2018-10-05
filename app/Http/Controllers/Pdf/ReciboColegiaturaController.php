<?php

namespace App\Http\Controllers\Pdf;

use App\Models\AlumnoDatosPersonales;
use App\Models\DetallePagoColegiatura;
use App\Models\PagoColegiatura;
use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;
use App\Helpers\Convertidor;

class ReciboColegiaturaController extends Controller
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

    public function pdf_ReciboColegiatura($pagoColegiatura_id){

        $pago_colegiatura = PagoColegiatura::where('id',$pagoColegiatura_id)->first();

        Fpdf::AddPage();

        Fpdf::Image('logo_left.png',10,20);
        Fpdf::Image('logo_right.png',185,16);

        Fpdf::SetFont('Times', 'BI', 14);
        Fpdf::SetTextColor(0,128,0);

        Fpdf::Cell(90,5,'IRLANDA Academy of English',0,0,'L');
        Fpdf::Cell(16,5,'',0,0);
        Fpdf::Cell(90,5,utf8_decode('Academia de Inglés IRLANDA'),0,1,'R');

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('Calle Faisán # 147 entre Chablé y Retorno 3. Chetumal, Q.Roo. RFC: IMA-040824-R97'),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('INCORPORACIÓN A LA SEQ             C.C.T. 23PBT003'),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('NÚMERO DE ACUERDO DE INCORPORACIÓN: ICAT17001CT '),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('DE 20 DE FEBRERO DEL 2017'),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::SetTextColor(0);
        Fpdf::Cell(55,5,utf8_decode('RECIBO DE PAGO DE COLEGIATURA'),0,0,'L');
        Fpdf::Cell(5,5,utf8_decode(''),0,0,'C');
        Fpdf::Cell(76,5,utf8_decode('ESTE COMPROBANTE NO ES DEDUCIBLE DE I.S.R'),0,0,'C');

        Fpdf::SetFont('Arial', 'B', 14);
        Fpdf::Cell(30,5,utf8_decode('RECIBO'),0,0,'R');

        Fpdf::SetTextColor(255,0,0);
        Fpdf::SetFont('Arial', 'B', 15);

        if($pago_colegiatura->folio_recibo<10){Fpdf::Cell(30,5,utf8_decode('000'.$pago_colegiatura->folio_recibo),0,1,'R');}
        else if($pago_colegiatura->folio_recibo<100){Fpdf::Cell(30,5,utf8_decode('00'.$pago_colegiatura->folio_recibo),0,1,'R');}
        else {Fpdf::Cell(30,5,utf8_decode($pago_colegiatura->folio_recibo),0,1,'R');}

        Fpdf::SetTextColor(0);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Fecha',1,0,'C',true);


        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(28,5,utf8_decode($pago_colegiatura->fecha_pago->format('D d, M Y')),1,0,'C',false);


        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Nivel',1,0,'C',true);


        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(22,5,utf8_decode($pago_colegiatura->ClasificacionPagosDeColegiatura->clasificacion_nombre),1,0,'C',false);


        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Grupo',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(20,5,utf8_decode($pago_colegiatura->GrupoPagoColegiatura->grupo_nombre),1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(14,5,'Ciclo',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(18,5,$pago_colegiatura->CicloPagoColegiatura->ciclo_anioinicial.'-'.$pago_colegiatura->CicloPagoColegiatura->ciclo_aniofinal,1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(17,5,'Matricula',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        if($pago_colegiatura->alumno_id<10){
            Fpdf::Cell(22,5,'00'.$pago_colegiatura->alumno_id.'-'.$pago_colegiatura->AlumnoPagosDeColegiatura->created_at->format('dmy'),1,1,'C',false);
        }
        else if($pago_colegiatura->alumno_id<100){
            Fpdf::Cell(22,5,'0'.$pago_colegiatura->alumno_id.'-'.$pago_colegiatura->AlumnoPagosDeColegiatura->created_at->format('dmy'),1,1,'C',false);
        }
        else{
            Fpdf::Cell(22,5,$pago_colegiatura->alumno_id.'-'.$pago_colegiatura->AlumnoPagosDeColegiatura->created_at->format('dmy'),1,1,'C',false);
        }

        Fpdf::Cell(0,2,'',0,1);//Espacio

        Fpdf::SetTextColor(0);
        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::SetFont('Arial', '', 8);

        $nombre   = $pago_colegiatura->AlumnoPagosDeColegiatura->alumno_primernombre.' '.$pago_colegiatura->AlumnoPagosDeColegiatura->alumno_segundonombre;
        $apellido = $pago_colegiatura->AlumnoPagosDeColegiatura->alumno_apellidopaterno.' '.$pago_colegiatura->AlumnoPagosDeColegiatura->alumno_apellidomaterno;

        Fpdf::Cell(25,4,'Alumno',1,0,'C',true);
        Fpdf::Cell(73,4,ucwords(utf8_decode($nombre.' '.$apellido)),1,0,'L',false);

        $tutor = Tutor::select('tutores.tutor_nombre','tutores.tutor_apellidopaterno','tutores.tutor_apellidomaterno')
            ->join('tutores_alumnos','tutores_alumnos.tutor_id','=','tutores.id')
            ->where('tutores_alumnos.escuela_id', $pago_colegiatura->escuela_id)
            ->where('tutores_alumnos.ciclo_id', $pago_colegiatura->ciclo_id)
            ->where('tutores_alumnos.alumno_id', $pago_colegiatura->alumno_id)
            ->first();

        Fpdf::Cell(25,4,'Tutor',1,0,'C',true);
        Fpdf::Cell(73,4,ucwords(utf8_decode($tutor->tutor_nombre.' '.$tutor->tutor_apellidopaterno.' '.$tutor->tutor_apellidomaterno)),1,1,'L',false);

        $dp = AlumnoDatosPersonales::select('alumnos_datospersonales.*')
            ->join('datos_inscripcion_alumno','datos_inscripcion_alumno.datospersonales_id','=','alumnos_datospersonales.id')
            ->where('datos_inscripcion_alumno.escuela_id', $pago_colegiatura->escuela_id)
            ->where('datos_inscripcion_alumno.ciclo_id', $pago_colegiatura->ciclo_id)
            ->where('datos_inscripcion_alumno.alumno_id', $pago_colegiatura->alumno_id)
            ->first();

        $direccion_1 = ucwords($dp->nombre_vialidad.' '.$dp->numero_exterior.' '.$dp->numero_interior.' '.$dp->entre_calles.' '.$dp->nombre_asentamiento.' '.$dp->codigo_postal);
        $direccion_2 = $dp->entidad_federativa.', '.$dp->delegacion_municipio.', '.ucwords($dp->nombre_localidad);

        Fpdf::Cell(25,4,'Direccion',1,0,'C',true);
        Fpdf::Cell(171,4,utf8_decode($direccion_1),1,1,'L',false);

        Fpdf::Cell(0,2,'',0,1);//Espacio

        Fpdf::Cell(20,5,'Cantidad',1,0,'C',true);
        Fpdf::Cell(60,5,'Concepto',1,0,'C',true);
        Fpdf::Cell(28,5,'Colegiatura',1,0,'C',true);
        Fpdf::Cell(28,5,'Recargo',1,0,'C',true);
        Fpdf::Cell(28,5,'Descuento',1,0,'C',true);
        Fpdf::Cell(32,5,'Importe',1,1,'C',true);

        //Fuente y Tamanio de fuente
        Fpdf::SetFont('Arial', '', 8);

        $detalle_pago = DetallePagoColegiatura::where('pagocolegiatura_id',$pagoColegiatura_id)->orderBy('orden_mes','asc')->get();

        $items = count($detalle_pago);
        $filas = 12-$items;
        $i=1;
        $aux_importe         = 0;
        $aux_recargo_pesos   = 0;
        $aux_descuento_pesos = 0;
        $aux_subtotal        = 0;

        foreach ($detalle_pago as $detalle){

            $aux_recargo_pesos   = ($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100));
            $aux_descuento_pesos = ($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100));
            $aux_importe = ($detalle->importe_colegiatura + $aux_recargo_pesos) - $aux_descuento_pesos;
            $aux_subtotal = $aux_subtotal + $aux_importe;

            //La variable $i es par
            if(($i%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(20,5,$detalle->cantidad_concepto,'LR',0,'C',true);
                Fpdf::Cell(60,5,'Colegiatura del Mes de '.$detalle->nombre_mes,'LR',0,'L',true);
                Fpdf::Cell(28,5,'$ '.number_format($detalle->importe_colegiatura,2,'.',','),'LR',0,'C',true);
                if($detalle->porcentaje_recargo!=0){
                    Fpdf::Cell(28,5,'+ $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }

                if($detalle->porcentaje_descuento){
                    Fpdf::Cell(28,5,'- $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }

                Fpdf::Cell(32,5,'$ '.number_format($aux_importe,2,'.',','),'LR',1,'R',true);

            } //
            //La variable $i es impar
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(20,5,$detalle->cantidad_concepto,'LR',0,'C',true);
                Fpdf::Cell(60,5,'Colegiatura del Mes de '.$detalle->nombre_mes,'LR',0,'L',true);
                Fpdf::Cell(28,5,'$ '.number_format($detalle->importe_colegiatura,2,'.',','),'LR',0,'C',true);
                if($detalle->porcentaje_recargo!=0){
                    Fpdf::Cell(28,5,'+ $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }

                if($detalle->porcentaje_descuento){
                    Fpdf::Cell(28,5,'- $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }
                Fpdf::Cell(32,5,'$ '.number_format($aux_importe,2,'.',','),'LR',1,'R',true);

            }
            $i++;
        }

        for($y=$i; $y<=12; $y++){

            if(($y%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(20,5,'','LR',0,'C',true);
                Fpdf::Cell(60,5,'','LR',0,'L',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(32,5,'','LR',1,'R',true);

            }
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(20,5,'','LR',0,'C',true);
                Fpdf::Cell(60,5,'','LR',0,'L',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(32,5,'','LR',1,'R',true);
            }

        }

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', 'B', 8);

        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(136,5,'Importe con letras:','T',0,'C',false);
        Fpdf::Cell(28,5,'Total',1,0,'C',true);
        Fpdf::Cell(32,5,'$ '.number_format($aux_subtotal,2,'.',','),1,1,'R',false);

        Fpdf::Cell(136,5,Convertidor::numtoletras($aux_subtotal),0,0,'C',false);
        Fpdf::Cell(28,5,'','T',0,'C',false);
        Fpdf::Cell(32,5,'','T',1,'R',false);

        Fpdf::Cell(0,5,'',0,1,'C',false); //Espacio

        /* ---------------------------------------------------------------------------------------------------------- */

        Fpdf::Image('logo_left.png',10,145);
        Fpdf::Image('logo_right.png',185,142);

        Fpdf::SetFont('Times', 'BI', 14);
        Fpdf::SetTextColor(0,128,0);

        Fpdf::Cell(90,5,'IRLANDA Academy of English',0,0,'L');
        Fpdf::Cell(16,5,'',0,0);
        Fpdf::Cell(90,5,utf8_decode('Academia de Inglés IRLANDA'),0,1,'R');

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('Calle Faisán # 147 entre Chablé y Retorno 3. Chetumal, Q.Roo. RFC: IMA-040824-R97'),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('INCORPORACIÓN A LA SEQ             C.C.T. 23PBT003'),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('NÚMERO DE ACUERDO DE INCORPORACIÓN: ICAT17001CT '),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(38,5,'',0,0);
        Fpdf::Cell(120,5,utf8_decode('DE 20 DE FEBRERO DEL 2017'),0,0,'C');
        Fpdf::Cell(38,5,'',0,1);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::SetTextColor(0);
        Fpdf::Cell(55,5,utf8_decode('RECIBO DE PAGO DE COLEGIATURA'),0,0,'L');
        Fpdf::Cell(5,5,utf8_decode(''),0,0,'C');
        Fpdf::Cell(76,5,utf8_decode('ESTE COMPROBANTE NO ES DEDUCIBLE DE I.S.R'),0,0,'C');

        Fpdf::SetFont('Arial', 'B', 14);
        Fpdf::Cell(30,5,utf8_decode('RECIBO'),0,0,'R');

        Fpdf::SetTextColor(255,0,0);
        Fpdf::SetFont('Arial', 'B', 15);

        if($pago_colegiatura->folio_recibo<10){Fpdf::Cell(30,5,utf8_decode('000'.$pago_colegiatura->folio_recibo),0,1,'R');}
        else if($pago_colegiatura->folio_recibo<100){Fpdf::Cell(30,5,utf8_decode('00'.$pago_colegiatura->folio_recibo),0,1,'R');}
        else {Fpdf::Cell(30,5,utf8_decode($pago_colegiatura->folio_recibo),0,1,'R');}


        Fpdf::SetTextColor(0);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Fecha',1,0,'C',true);


        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(28,5,utf8_decode($pago_colegiatura->fecha_pago->format('D d, M Y')),1,0,'C',false);


        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Nivel',1,0,'C',true);


        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(22,5,utf8_decode($pago_colegiatura->ClasificacionPagosDeColegiatura->clasificacion_nombre),1,0,'C',false);


        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Grupo',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(20,5,utf8_decode($pago_colegiatura->GrupoPagoColegiatura->grupo_nombre),1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(14,5,'Ciclo',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(18,5,$pago_colegiatura->CicloPagoColegiatura->ciclo_anioinicial.'-'.$pago_colegiatura->CicloPagoColegiatura->ciclo_aniofinal,1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(17,5,'Matricula',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        if($pago_colegiatura->alumno_id<10){
            Fpdf::Cell(22,5,'00'.$pago_colegiatura->alumno_id.'-'.$pago_colegiatura->AlumnoPagosDeColegiatura->created_at->format('dmy'),1,1,'C',false);
        }
        else if($pago_colegiatura->alumno_id<100){
            Fpdf::Cell(22,5,'0'.$pago_colegiatura->alumno_id.'-'.$pago_colegiatura->AlumnoPagosDeColegiatura->created_at->format('dmy'),1,1,'C',false);
        }
        else{
            Fpdf::Cell(22,5,$pago_colegiatura->alumno_id.'-'.$pago_colegiatura->AlumnoPagosDeColegiatura->created_at->format('dmy'),1,1,'C',false);
        }

        Fpdf::Cell(0,2,'',0,1);//Espacio

        Fpdf::SetTextColor(0);
        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(25,4,'Alumno',1,0,'C',true);
        Fpdf::Cell(73,4,ucwords(utf8_decode($nombre.' '.$apellido)),1,0,'L',false);

        Fpdf::Cell(25,4,'Tutor',1,0,'C',true);
        Fpdf::Cell(73,4,ucwords(utf8_decode($tutor->tutor_nombre.' '.$tutor->tutor_apellidopaterno.' '.$tutor->tutor_apellidomaterno)),1,1,'L',false);

        Fpdf::Cell(25,4,'Direccion',1,0,'C',true);
        Fpdf::Cell(171,4,utf8_decode($direccion_1),1,1,'L',false);

        Fpdf::Cell(0,2,'',0,1);//Espacio

        Fpdf::Cell(20,5,'Cantidad',1,0,'C',true);
        Fpdf::Cell(60,5,'Concepto',1,0,'C',true);
        Fpdf::Cell(28,5,'Colegiatura',1,0,'C',true);
        Fpdf::Cell(28,5,'Recargo',1,0,'C',true);
        Fpdf::Cell(28,5,'Descuento',1,0,'C',true);
        Fpdf::Cell(32,5,'Importe',1,1,'C',true);

        //Fuente y Tamanio de fuente
        Fpdf::SetFont('Arial', '', 8);

        $items = count($detalle_pago);
        $filas = 12-$items;
        $i=1;
        $aux_importe         = 0;
        $aux_recargo_pesos   = 0;
        $aux_descuento_pesos = 0;
        $aux_subtotal        = 0;

        foreach ($detalle_pago as $detalle){

            $aux_recargo_pesos   = ($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100));
            $aux_descuento_pesos = ($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100));
            $aux_importe = ($detalle->importe_colegiatura + $aux_recargo_pesos) - $aux_descuento_pesos;
            $aux_subtotal = $aux_subtotal + $aux_importe;

            //La variable $i es par
            if(($i%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(20,5,$detalle->cantidad_concepto,'LR',0,'C',true);
                Fpdf::Cell(60,5,'Colegiatura del Mes de '.$detalle->nombre_mes,'LR',0,'L',true);
                Fpdf::Cell(28,5,'$ '.number_format($detalle->importe_colegiatura,2,'.',','),'LR',0,'C',true);
                if($detalle->porcentaje_recargo!=0){
                    Fpdf::Cell(28,5,'+ $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }

                if($detalle->porcentaje_descuento){
                    Fpdf::Cell(28,5,'- $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }

                Fpdf::Cell(32,5,'$ '.number_format($aux_importe,2,'.',','),'LR',1,'R',true);

            } //
            //La variable $i es impar
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(20,5,$detalle->cantidad_concepto,'LR',0,'C',true);
                Fpdf::Cell(60,5,'Colegiatura del Mes de '.$detalle->nombre_mes,'LR',0,'L',true);
                Fpdf::Cell(28,5,'$ '.number_format($detalle->importe_colegiatura,2,'.',','),'LR',0,'C',true);
                if($detalle->porcentaje_recargo!=0){
                    Fpdf::Cell(28,5,'+ $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_recargo / 100)),2,'.',',').' ('.$detalle->porcentaje_recargo.'%)','LR',0,'C',true);
                }

                if($detalle->porcentaje_descuento){
                    Fpdf::Cell(28,5,'- $ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }
                else{
                    Fpdf::Cell(28,5,'$ '.number_format(($detalle->importe_colegiatura * ($detalle->porcentaje_descuento / 100)),2,'.',',').' ('.$detalle->porcentaje_descuento.'%)','LR',0,'C',true);
                }
                Fpdf::Cell(32,5,'$ '.number_format($aux_importe,2,'.',','),'LR',1,'R',true);

            }
            $i++;
        }

        for($y=$i; $y<=12; $y++){

            if(($y%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(20,5,'','LR',0,'C',true);
                Fpdf::Cell(60,5,'','LR',0,'L',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(32,5,'','LR',1,'R',true);

            }
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(20,5,'','LR',0,'C',true);
                Fpdf::Cell(60,5,'','LR',0,'L',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(28,5,'','LR',0,'C',true);
                Fpdf::Cell(32,5,'','LR',1,'R',true);
            }

        }

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', 'B', 8);

        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(136,5,'Importe con letras:','T',0,'C',false);
        Fpdf::Cell(28,5,'Total',1,0,'C',true);
        Fpdf::Cell(32,5,'$ '.number_format($aux_subtotal,2,'.',','),1,1,'R',false);

        Fpdf::Cell(136,5,Convertidor::numtoletras($aux_subtotal),0,0,'C',false);
        Fpdf::Cell(28,5,'','T',0,'C',false);
        Fpdf::Cell(32,5,'','T',1,'R',false);

        Fpdf::Output();
        exit;

    }
}
