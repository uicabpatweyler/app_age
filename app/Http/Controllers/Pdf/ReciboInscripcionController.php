<?php

namespace App\Http\Controllers\Pdf;

use App\Helpers\Convertidor;
use App\Models\AlumnoDatosPersonales;
use App\Models\PagoInscripcion;
use App\Models\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;



class ReciboInscripcionController extends Controller
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

    public function logo(){
        Fpdf::Image('logo_encabezado.png',10,10);
    }
    
    public function pdf_ReciboInscripcion($pago_id){

        $datos = PagoInscripcion::where('id', $pago_id)->first();

        //Ancho de toda la pagina: 196
        Fpdf::AddPage();

        //Logo del encabezado
        $this->logo();

        //Cuadro sin bordes, en el area del logo
        Fpdf::Cell(0,28,'',0,1,'C');

        //Color de fondo y fuente
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 10);

        Fpdf::Cell(98,5,utf8_decode('RFC: IMA-040824-R97'),0,0,1,true);
        Fpdf::Cell(98,5,utf8_decode('ESTE COMPROBANTE NO ES DEDUCIBLE DE I.S.R'),0,1,'R',true);

        Fpdf::Cell(0,3,'',0,1);//Espacio

        //Verde
        Fpdf::SetFillColor(196,224,180);
        Fpdf::SetFont('Arial', 'B', 9);

        //Recibo No.
        Fpdf::Cell(98,7,'',0,0);
        Fpdf::Cell(30, 7, 'Recibo:',1,0,1,true);

        Fpdf::SetFont('Arial', '', 9);
        if($datos->folio_recibo<10){ Fpdf::Cell(68, 7, '000'.$datos->folio_recibo,1,1,'C',false); }
        else if($datos->folio_recibo<100){ Fpdf::Cell(68, 7, '00'.$datos->folio_recibo,1,1,'C',false); }
        else{ Fpdf::Cell(68, 7,$datos->folio_recibo,1,1,'C',false); }

        //Fecha
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(98,7,'',0,0);
        Fpdf::Cell(30, 7, 'Fecha',1,0,1,true);

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(68, 7,ucwords(utf8_decode($datos->created_at->format('D d, M Y')) ) ,1,1,'C',false);

        //Nivel del grupo
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(98,7,'',0,0);
        Fpdf::Cell(30, 7, 'Nivel',1,0,1,true);

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(68, 7, $datos->ClasificacionPagoDeInscripcion->clasificacion_nombre,1,1,'C',false);

        //Nombre del grupo
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(98,7,'',0,0);
        Fpdf::Cell(30, 7, 'Grupo',1,0,1,true);

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(68, 7, $datos->GrupoPagoDeInscripcion->grupo_nombre,1,1,'C',false);

        //Matricula del alumno
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(98,7,'',0,0);
        Fpdf::Cell(30, 7, 'Matr. Alumno',1,0,1,true);

        Fpdf::SetFont('Arial', '', 9);
        if ($datos->alumno_id<10){
            Fpdf::Cell(68, 7, '00'.$datos->alumno_id.'-'.$datos->AlumnoPagoDeInscripcion->created_at->format('dmy'),1,1,'C',false);
        }
        elseif ($datos->alumno_id<100){
            Fpdf::Cell(68, 7, '0'.$datos->alumno_id.'-'.$datos->AlumnoPagoDeInscripcion->created_at->format('dmy'),1,1,'C',false);
        }
        else{
            Fpdf::Cell(68, 7, $datos->alumno_id.'-'.$datos->AlumnoPagoDeInscripcion->created_at->format('dmy'),1,1,'C',false);
        }

        //RECIBIMOS DE
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(0,3,'',0,1);//Espacio
        Fpdf::Cell(196,5,utf8_decode('RECIBIMOS DE:'),0,1,'C',false);
        Fpdf::Cell(0,3,'',0,1);//Espacio

        //Nombre del alumno
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(25,7,'Alumno',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 9);

        $nombre   = $datos->AlumnoPagoDeInscripcion->alumno_primernombre.' '.$datos->AlumnoPagoDeInscripcion->alumno_segundonombre;
        $apellido = $datos->AlumnoPagoDeInscripcion->alumno_apellidopaterno.' '.$datos->AlumnoPagoDeInscripcion->alumno_apellidomaterno;

        Fpdf::Cell(73,7,ucwords(utf8_decode($nombre.' '.$apellido)) ,1,0,'L',false);

        $tutor = Tutor::select('tutores.tutor_nombre','tutores.tutor_apellidopaterno','tutores.tutor_apellidomaterno')
                 ->join('tutores_alumnos','tutores_alumnos.tutor_id','=','tutores.id')
                 ->where('tutores_alumnos.escuela_id', $datos->escuela_id)
                 ->where('tutores_alumnos.ciclo_id', $datos->ciclo_id)
                 ->where('tutores_alumnos.alumno_id', $datos->alumno_id)
                 ->first();
        //Tutor
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(25,7,'Tutor',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 9);

        Fpdf::Cell(73,7,ucwords(utf8_decode($tutor->tutor_nombre.' '.$tutor->tutor_apellidopaterno.' '.$tutor->tutor_apellidomaterno)),1,1,'L',false);
        //Fpdf::Cell(73,7,'',1,1,'L',false);

        $dp= AlumnoDatosPersonales::select('alumnos_datospersonales.*')
             ->join('datos_inscripcion_alumno','datos_inscripcion_alumno.datospersonales_id','=','alumnos_datospersonales.id')
             ->where('datos_inscripcion_alumno.escuela_id', $datos->escuela_id)
             ->where('datos_inscripcion_alumno.ciclo_id', $datos->ciclo_id)
             ->where('datos_inscripcion_alumno.alumno_id', $datos->alumno_id)
             ->first();

        $direccion_1 = ucwords($dp->nombre_vialidad.' '.$dp->numero_exterior.' '.$dp->numero_interior.' '.$dp->entre_calles.' '.$dp->nombre_asentamiento.' '.$dp->codigo_postal);
        $direccion_2 = $dp->entidad_federativa.', '.$dp->delegacion_municipio.', '.ucwords($dp->nombre_localidad);
        //Direccion
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(25,7,'Direccion',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 9);
        Fpdf::Cell(171,7,utf8_decode($direccion_1),1,1,'L',false);

        Fpdf::Cell(25,7,'',0,0,'C',false);
        Fpdf::Cell(171,7,utf8_decode($direccion_2),1,1,'L',false);

        Fpdf::Cell(0,5,'',0,1);//Espacio

        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(26,5,'Cantidad',1,0,'C',true);
        Fpdf::Cell(90,5,'Concepto',1,0,'C',true);
        Fpdf::Cell(45,5,'Ciclo',1,0,'C',true);
        Fpdf::Cell(35,5,'Importe',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 10);

        Fpdf::Cell(26,8,$datos->cantidad_concepto,'LR',0,'C',false);
        Fpdf::Cell(90,8,'Cuota de inscripcion','R',0,'C',false);
        Fpdf::Cell(45,8,$datos->CicloPagoDeInscripcion->ciclo_anioinicial.'-'.$datos->CicloPagoDeInscripcion->ciclo_aniofinal,'R',0,'C',false);
        Fpdf::Cell(35,8,'$ '.number_format($datos->importe_cuota,2,'.',','),'R',1,'R',false);

        for($i=1;$i<=13;$i++){
            Fpdf::Cell(26,8,'','LR',0,'C',false);
            Fpdf::Cell(90,8,'','R',0,'C',false);
            Fpdf::Cell(45,8,'','R',0,'C',false);
            Fpdf::Cell(35,8,'','R',1,'R',false);
        }

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', 'B', 9);

        Fpdf::Cell(116,7,'Importe con letras:','T',0,'C',true);

        //Verde
        Fpdf::SetFillColor(196,224,180);
        Fpdf::SetFont('Arial', 'B', 9);
        Fpdf::Cell(45, 7, 'Total:',1,0,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 10);

        Fpdf::Cell(35, 7, '$ '.number_format($datos->importe_cuota,2,'.',','),1,1,'R',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(116,7,Convertidor::numtoletras($datos->importe_cuota),0,0,'C',true);


        Fpdf::Output();
        exit;
    }
}
