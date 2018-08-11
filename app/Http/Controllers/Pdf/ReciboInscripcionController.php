<?php

namespace App\Http\Controllers\Pdf;

use App\Models\PagoInscripcion;

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
        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(30, 5, 'Recibo:',1,0,1,true);
        if($datos->folio_recibo<10){ Fpdf::Cell(68, 5, '000'.$datos->folio_recibo,1,1,'C',false); }
        else if($datos->folio_recibo<100){ Fpdf::Cell(68, 5, '00'.$datos->folio_recibo,1,1,'C',false); }
        else{ Fpdf::Cell(68, 5,$datos->folio_recibo,1,1,'C',false); }

        //Fecha
        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(30, 5, 'Fecha',1,0,1,true);
        Fpdf::Cell(68, 5,ucwords($datos->created_at->format('D d, M Y')) ,1,1,'C',false);

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(30, 5, 'Nivel',1,0,1,true);
        Fpdf::Cell(68, 5, '',1,1);

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(30, 5, 'Grupo',1,0,1,true);
        Fpdf::Cell(68, 5, '',1,1);

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(30, 5, 'Matr. Alumno',1,0,1,true);
        Fpdf::Cell(68, 5, '',1,1);





        Fpdf::Output();
        exit;
    }
}
