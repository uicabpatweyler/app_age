<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Ciclo;
use App\Models\ItemSalidaProducto;
use App\Models\SalidaProducto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;

class ReporteDiarioVentasController extends Controller
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
        Fpdf::Cell(44,6,utf8_decode('Reporte de Ventas del día: '),'B',0,'L');
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(55,6,utf8_decode($this->dateSpanish($fecha)),'B',0,'L');
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

    public function dateSpanish($date){
        $info = explode('-',$date);
        $fecha = Carbon::createFromDate($info[0],$info[1],$info[2]);

        $nameMonths     = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre',' Diciembre'];
        $shortDayOfWeek = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
        $diaSemana      = $shortDayOfWeek[$fecha->dayOfWeek];

        return $diaSemana.' '.$info[2].', '.$nameMonths[$info[1]-1].' del '.$info[0];

    }

    public function resumen($libros, $playeras, $importelibros, $importeplayeras, $total,$recibos,$cancelados){

        Fpdf::SetFillColor(230,242,230);

        Fpdf::Cell(0,2,'',0,1,false);

        Fpdf::SetFont('Arial', '', 8); //130
        Fpdf::Cell(30,5,'Total de Libros:',0,0,false);
        Fpdf::Cell(20,5,'( '.$libros.' ) ',0,0,'C',false);
        Fpdf::Cell(30,5,'$ '.number_format($importelibros,2,'.',','),0,0,'R',false);
        Fpdf::Cell(50,5,'',0,0,false);

        Fpdf::Cell(38,5,'Total del Reporte','TB',0,'L',false);
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(38,5,'$ '.number_format($importelibros + $importeplayeras,2,'.',','),'TB',1,'C',true);

        Fpdf::SetFont('Arial', '', 8); //130
        Fpdf::Cell(30,5,'Total de Playeras:',0,0,false);
        Fpdf::Cell(20,5,'( '.$playeras.' ) ',0,0,'C',false);
        Fpdf::Cell(30,5,'$ '.number_format($importeplayeras,2,'.',','),0,0,'R',false);
        Fpdf::Cell(50,5,'',0,0,false);

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

    public function encabezadoTabla(){
        Fpdf::SetFont('Arial', 'B', 7);
        Fpdf::SetTextColor(255,255,255);
        Fpdf::SetFillColor(57,107,54);

        Fpdf::Cell(8,5,'#',0,0,'C',true);
        Fpdf::Cell(14,5,'Recibo',0,0,'C',true);
        Fpdf::Cell(12,5,'Cancel.',0,0,'C',true);
        Fpdf::Cell(35,5,'Alumo',0,0,'C',true);
        Fpdf::Cell(75,5,utf8_decode('Descripción'),0,0,'C',true);
        Fpdf::Cell(20,5,'F. Cancel.',0,0,'C',true);
        Fpdf::Cell(10,5,'Cant.',0,0,'C',true);
        Fpdf::Cell(16,5,'Precio',0,0,'C',true);
        Fpdf::Cell(16,5,'Importe.',0,1,'C',true);
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

    public function pdf_ReporteDiarioVentas($fecha){

        $cancelados      = 0;
        $libros          = 0;
        $importeLibros   = 0;
        $playeras        = 0;
        $importePlayeras = 0;

        $data = SalidaProducto::whereDate('fecha_venta',$fecha)
                ->orderBy('folio_recibo','asc')
                ->get();

        $array_detalle   = [];
        $totalReporte    = 0;
        $totalRecibo     = 0;
        $numeroDeRecibos = 0;
        $i = 1;

        foreach ($data as $fila){

            $numeroDeRecibos++;

            $detalle = ItemSalidaProducto::select('items_salida_producto.categoria_id','items_salida_producto.cantidad','items_salida_producto.precio_unitario')
                       ->addSelect('alumnos.alumno_curp','productos.descripcion_venta')
                       ->join('alumnos', 'items_salida_producto.alumno_id','=','alumnos.id')
                       ->join('productos','items_salida_producto.producto_id', '=', 'productos.id')
                       ->where('items_salida_producto.salidaprod_id', $fila->id)
                       ->orderBy('items_salida_producto.numero_linea', 'asc')
                       ->get();

            if($fila->venta_cancelada==true){$cancelados++;}

            foreach ($detalle as $filaDetalle){

                if($fila->venta_cancelada==true){

                    if(($fila->fecha_venta == $fila->fecha_cancelacion) ){

                        $array_detalle[] = [
                            'col_numero'      => $i,
                            'col_recibo'      => $fila->serie_recibo.'-'.$fila->folio_recibo,
                            'col_cancel'      => $fila->venta_cancelada==true ? 'Si':'',
                            'col_alumno'      => $filaDetalle->alumno_curp,
                            'col_descripcion' => $filaDetalle->descripcion_venta,
                            'col_fechacancel' => $fila->venta_cancelada==true ? $fila->fecha_cancelacion->format('Y-m-d') :'',
                            'col_cantidad'    => $filaDetalle->cantidad,
                            'col_precunit'    => '$ '.number_format($filaDetalle->precio_unitario,2,'.',','),
                            'col_importe'     => ''
                        ];

                    }

                    if($fila->fecha_cancelacion > $fila->fecha_venta){

                        $totalReporte = $totalReporte + $fila->cantidad_recibida_mxn;


                        if($filaDetalle->categoria_id==1) {
                            $importeLibros = $importeLibros + ($filaDetalle->cantidad * $filaDetalle->precio_unitario);
                            $libros++;
                        }
                        if($filaDetalle->categoria_id==2) {
                            $importePlayeras = $importePlayeras + ($filaDetalle->cantidad * $filaDetalle->precio_unitario);
                            $playeras++;
                        }

                        $array_detalle[] = [
                            'col_numero'      => $i,
                            'col_recibo'      => $fila->serie_recibo.'-'.$fila->folio_recibo,
                            'col_cancel'      => $fila->venta_cancelada==true ? 'Si':'',
                            'col_alumno'      => $filaDetalle->alumno_curp,
                            'col_descripcion' => $filaDetalle->descripcion_venta,
                            'col_fechacancel' => $fila->venta_cancelada==true ? $fila->fecha_cancelacion->format('Y-m-d') :'',
                            'col_cantidad'    => $filaDetalle->cantidad,
                            'col_precunit'    => '$ '.number_format($filaDetalle->precio_unitario,2,'.',','),
                            'col_importe'     => '$ '.number_format($filaDetalle->cantidad * $filaDetalle->precio_unitario,2,'.',',')
                        ];
                    }

                }
                else{

                    $totalReporte = $totalReporte + $fila->cantidad_recibida_mxn;

                    $array_detalle[] = [
                        'col_numero'      => $i,
                        'col_recibo'      => $fila->serie_recibo.'-'.$fila->folio_recibo,
                        'col_cancel'      => $fila->venta_cancelada==true ? 'Si':'',
                        'col_alumno'      => $filaDetalle->alumno_curp,
                        'col_descripcion' => $filaDetalle->descripcion_venta,
                        'col_fechacancel' => $fila->venta_cancelada==true ? $fila->fecha_cancelacion->format('Y-m-d') :'',
                        'col_cantidad'    => $filaDetalle->cantidad,
                        'col_precunit'    => '$ '.number_format($filaDetalle->precio_unitario,2,'.',','),
                        'col_importe'     => '$ '.number_format($filaDetalle->cantidad * $filaDetalle->precio_unitario,2,'.',',')
                    ];

                    if($filaDetalle->categoria_id==1) {
                        $importeLibros = $importeLibros + ($filaDetalle->cantidad * $filaDetalle->precio_unitario);
                        $libros++;
                    }
                    if($filaDetalle->categoria_id==2) {
                        $importePlayeras = $importePlayeras + ($filaDetalle->cantidad * $filaDetalle->precio_unitario);
                        $playeras++;
                    }

                }

            }

            $i++;
        }

        $data = SalidaProducto::whereDate('fecha_cancelacion',$fecha)
                ->orderBy('folio_recibo','asc')
                ->get();

        foreach ($data as $fila){

            if($fila->fecha_venta < $fila->fecha_cancelacion){
                $array_detalle[] = [
                    'col_numero'      => '',
                    'col_recibo'      => $fila->serie_recibo.'-'.$fila->folio_recibo,
                    'col_cancel'      => $fila->venta_cancelada==true ? 'Si':'',
                    'col_alumno'      => '',
                    'col_descripcion' => 'Fecha de Ingreso: '. $fila->fecha_venta->format('Y-m-d') ,
                    'col_fechacancel' => $fila->venta_cancelada==true ? $fila->fecha_cancelacion->format('Y-m-d') :'',
                    'col_cantidad'    => '',
                    'col_precunit'    => '',
                    'col_importe'     => ''
                ];
            }

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

        for($i=0;$i<count($data_1);$i++){

            Fpdf::SetFont('Arial', '', 8);
            Fpdf::SetMargins(5,5,5);
            Fpdf::SetAutoPageBreak(true,1);

            Fpdf::AddPage();

            $this->Header($fecha);

            if($i==0){
                $this->resumen($libros,$playeras,$importeLibros, $importePlayeras, $totalReporte,$numeroDeRecibos,$cancelados);
                $this->reset();
            }
            $this->encabezadoTabla();
            $this->reset();

            for($y=$fila_inicial-1; $y<=$fila_final-1; $y++){

                if(($y%2)==0){
                    //Color de la fila: Blanco
                    Fpdf::SetFillColor(254,254,254);
                    Fpdf::SetFont('Arial', '', 7);

                    Fpdf::Cell(8,5, $array_detalle[$y]['col_numero'],0,0,'C',true);
                    Fpdf::Cell(14,5,$array_detalle[$y]['col_recibo'],0,0,'C',true);
                    Fpdf::Cell(12,5,$array_detalle[$y]['col_cancel'],0,0,'C',true);
                    Fpdf::Cell(35,5,$array_detalle[$y]['col_alumno'],0,0,'L',true);
                    Fpdf::Cell(75,5,utf8_decode($array_detalle[$y]['col_descripcion']),0,0,'L',true);
                    Fpdf::Cell(20,5,$array_detalle[$y]['col_fechacancel'],0,0,'C',true);
                    Fpdf::Cell(10,5,$array_detalle[$y]['col_cantidad'],0,0,'C',true);
                    Fpdf::Cell(16,5,$array_detalle[$y]['col_precunit'],0,0,'C',true);
                    Fpdf::Cell(16,5,$array_detalle[$y]['col_importe'],0,1,'C',true);
                }
                else{
                    //Color de la fila: Verde
                    Fpdf::SetFillColor(230,242,230);
                    Fpdf::SetFont('Arial', '', 7);

                    Fpdf::Cell(8,5, $array_detalle[$y]['col_numero'],0,0,'C',true);
                    Fpdf::Cell(14,5,$array_detalle[$y]['col_recibo'],0,0,'C',true);
                    Fpdf::Cell(12,5,$array_detalle[$y]['col_cancel'],0,0,'C',true);
                    Fpdf::Cell(35,5,$array_detalle[$y]['col_alumno'],0,0,'L',true);
                    Fpdf::Cell(75,5,utf8_decode($array_detalle[$y]['col_descripcion']),0,0,'L',true);
                    Fpdf::Cell(20,5,$array_detalle[$y]['col_fechacancel'],0,0,'C',true);
                    Fpdf::Cell(10,5,$array_detalle[$y]['col_cantidad'],0,0,'C',true);
                    Fpdf::Cell(16,5,$array_detalle[$y]['col_precunit'],0,0,'C',true);
                    Fpdf::Cell(16,5,$array_detalle[$y]['col_importe'],0,1,'C',true);

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
