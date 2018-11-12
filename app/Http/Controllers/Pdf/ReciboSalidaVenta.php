<?php

namespace App\Http\Controllers\Pdf;

use App\Models\Alumno;
use App\Models\Ciclo;
use App\Models\DatosInscripcionAlumno;
use App\Models\Grupo;
use App\Models\SalidaProducto;
use App\Models\TutorAlumno;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Codedge\Fpdf\Facades\Fpdf;
use App\Helpers\Convertidor;
use Illuminate\Support\Facades\DB;


class ReciboSalidaVenta extends Controller
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

    public function reset(){
        Fpdf::SetLineWidth(0);
        Fpdf::SetDrawColor(0);
        Fpdf::SetFillColor(0);
        Fpdf::SetTextColor(0);
        Fpdf::SetFont('Arial', '', 8);
    }

    public function LogoRecibo($x1,$y1,$x2,$y2){
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

    }
    //array $datos
    public function EncabezadoRecibo($num_recibo){
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::SetTextColor(0);
        Fpdf::Cell(73,5,utf8_decode('RECIBO DE COMPRA'),0,0,'C');
        Fpdf::Cell(60,5,utf8_decode(''),0,0,'C');
        Fpdf::Cell(43,5,utf8_decode('RECIBO'),0,0,'R');

        Fpdf::SetTextColor(255,0,0);
        Fpdf::SetFont('Arial', 'B', 15);
        Fpdf::Cell(30,5,($num_recibo <100) ? '000'.$num_recibo : '00'.$num_recibo,0,1,'C');
    }

    private function traducirFecha($fecha){
        $fechaCarbon = Carbon::parse($fecha);

        $shortDayOfWeek = array('Dom','Lun','Mar','Mié','Jue','Vie','Sáb');
        $shorNameMonth  = array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept','Oct','Nov','Dic');
        return $shortDayOfWeek[$fechaCarbon->dayOfWeek].' '.$fechaCarbon->format('d').', '.$shorNameMonth[$fechaCarbon->month - 1].' '.$fechaCarbon->format('Y');
    }

    public function InformacionRecibo(array $datos){

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Fecha',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(28,5,utf8_decode($this->traducirFecha($datos[0]->format('Y-m-d'))),1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Nivel',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(22,5,utf8_decode($datos[1]),1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(18,5,'Grupo',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(20,5,utf8_decode($datos[2]),1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(14,5,'Ciclo',1,0,'C',true);

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(18,5,$datos[3],1,0,'C',false);

        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(20,5,'Matricula',1,0,'C',true);

        Fpdf::Cell(30,5,$datos[4],1,1,'C',false);

        Fpdf::Cell(0,2,'',0,1);//Espacio
    }

    public function InfoAlumno(array $datos){
        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(28,4,'Alumno',1,0,'C',true);
        Fpdf::Cell(75,4,ucwords($datos[0]),1,0,'L',false);
        Fpdf::Cell(28,4,'Tutor',1,0,'C',true);
        Fpdf::Cell(75,4,ucwords($datos[1]),1,1,'L',false);
        Fpdf::Cell(28,4,'Direccion',1,0,'C',true);
        Fpdf::Cell(178,4,utf8_decode($datos[2]),1,1,'L',false);

        Fpdf::Cell(0,2,'',0,1);//Espacio
    }

    public function EncabezadoTabla(){
        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(10,5,'#',1,0,'C',true);
        Fpdf::Cell(20,5,'Categoria',1,0,'C',true);
        Fpdf::Cell(111,5,utf8_decode('Descripción del producto'),1,0,'C',true);
        Fpdf::Cell(20,5,'Cantidad',1,0,'C',true);
        Fpdf::Cell(20,5,'Prec. Unit.',1,0,'C',true);
        Fpdf::Cell(25,5,'Importe',1,1,'C',true);
    }

    public function pdf_ReciboSalidaVenta($id_salida){

        $arrayInfoRecibo = [];
        $arrayInfoAlumno = [];

        $informacion = SalidaProducto::where('id',$id_salida)->first();

        $arrayInfoRecibo[0]  = $informacion->fecha_venta;
        $arrayInfoRecibo[1]  = $this->nivelGrupo($informacion->grupo_id);
        $arrayInfoRecibo[2]  = $this->nombreGrupo($informacion->grupo_id);
        $arrayInfoRecibo[3]  = $this->cicloEscolar($informacion->ciclo_id);
        $arrayInfoRecibo[4]  = $this->matriculaAlumno($informacion->alumno_id);

        $arrayInfoAlumno[0] = $this->nombreAlumno($informacion->alumno_id);
        $arrayInfoAlumno[1] = $this->nombreTutor($informacion->escuela_id, $informacion->ciclo_id, $informacion->alumno_id);
        $arrayInfoAlumno[2] = $this->direccionAlumno($informacion->escuela_id, $informacion->ciclo_id, $informacion->alumno_id);



        Fpdf::SetFont('Arial', '', 8);
        Fpdf::SetMargins(5,5,5);
        Fpdf::SetAutoPageBreak(true,1);

        Fpdf::AddPage();

        $this->LogoRecibo(7,14,187,11);
        $this->reset();
        $this->EncabezadoRecibo($informacion->folio_recibo);
        $this->reset();
        $this->InformacionRecibo($arrayInfoRecibo);
        $this->reset();
        $this->InfoAlumno($arrayInfoAlumno);
        $this->reset();
        $this->EncabezadoTabla();
        $this->reset();
        $this->ItemsTabla($id_salida);
        $this->reset();

        $this->LogoRecibo(7,140,187,138);
        $this->reset();
        $this->EncabezadoRecibo($informacion->folio_recibo);
        $this->reset();
        $this->InformacionRecibo($arrayInfoRecibo);
        $this->reset();
        $this->InfoAlumno($arrayInfoAlumno);
        $this->reset();
        $this->EncabezadoTabla();
        $this->reset();
        $this->ItemsTabla($id_salida);
        $this->reset();


        Fpdf::Output();
        exit;

    }

    private function ItemsTabla($salidaprod_id){

        $query2 = DB::table('items_salida_producto')
            ->select('items_salida_producto.numero_linea','items_salida_producto.categoria_id')
            ->addSelect('items_salida_producto.producto_id','items_salida_producto.cantidad','items_salida_producto.precio_unitario')
            ->addSelect('productos.nombre','productos.descripcion_venta')
            ->addSelect(DB::raw('items_salida_producto.precio_unitario * items_salida_producto.cantidad as importe'))
            ->join('productos','items_salida_producto.producto_id','=','productos.id')
            ->where('items_salida_producto.salidaprod_id', $salidaprod_id)
            ->orderBy('items_salida_producto.numero_linea','asc')
            ->get();

        $total = collect($query2)->sum('importe');

        $linea = 0;

        foreach ($query2 as $fila){

            $linea = $fila->numero_linea;

            if(($fila->numero_linea%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(10,5,$fila->numero_linea,1,0,'C',true);
                Fpdf::Cell(20,5,utf8_decode($fila->nombre),1,0,'C',true);
                Fpdf::Cell(111,5,utf8_decode($fila->descripcion_venta),1,0,'L',true);
                Fpdf::Cell(20,5,$fila->cantidad,1,0,'C',true);
                Fpdf::Cell(20,5,'$ '.number_format($fila->precio_unitario,2,'.',','),1,0,'C',true);
                Fpdf::Cell(25,5,'$ '.number_format($fila->importe,2,'.',','),1,1,'C',true);
            }
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(10,5,$fila->numero_linea,1,0,'C',true);
                Fpdf::Cell(20,5,utf8_decode($fila->nombre),1,0,'C',true);
                Fpdf::Cell(111,5,utf8_decode($fila->descripcion_venta),1,0,'L',true);
                Fpdf::Cell(20,5,$fila->cantidad,1,0,'C',true);
                Fpdf::Cell(20,5,'$ '.number_format($fila->precio_unitario,2,'.',','),1,0,'C',true);
                Fpdf::Cell(25,5,'$ '.number_format($fila->importe,2,'.',','),1,1,'C',true);
            }
        }

        for($i=$linea; $i<12;$i++){
            if(($i%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(10,5,'',1,0,'C',true);
                Fpdf::Cell(20,5,'',1,0,'C',true);
                Fpdf::Cell(111,5,'',1,0,'L',true);
                Fpdf::Cell(20,5,'',1,0,'C',true);
                Fpdf::Cell(20,5,'',1,0,'C',true);
                Fpdf::Cell(25,5,'',1,1,'C',true);
            }
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(10,5,'',1,0,'C',true);
                Fpdf::Cell(20,5,'',1,0,'C',true);
                Fpdf::Cell(111,5,'',1,0,'L',true);
                Fpdf::Cell(20,5,'',1,0,'C',true);
                Fpdf::Cell(20,5,'',1,0,'C',true);
                Fpdf::Cell(25,5,'',1,1,'C',true);
            }
        }

        Fpdf::SetFont('Arial', 'B', 8);

        //Verde
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(141,5,'Importe con letras:',0,0,'C',false);
        Fpdf::Cell(40,5,'Total',1,0,'C',true);
        Fpdf::Cell(25,5,'$ '.number_format($total,2,'.',','),1,1,'C',false);

        Fpdf::Cell(136,5,Convertidor::numtoletras($total),0,0,'C',false);
        Fpdf::Cell(28,5,'',0,0,'C',false);
        Fpdf::Cell(32,5,'',0,1,'R',false);

        Fpdf::Cell(0,5,'',0,1,'C',false); //Espacio

    }

    private function nivelGrupo($id_grupo){
        $query = Grupo::select('grupos.grupo_nombre','clasificaciones.clasificacion_nombre')
            ->join('clasificaciones', 'grupos.clasificacion_id','=', 'clasificaciones.id')
            ->where('grupos.id', $id_grupo)
            ->first();

        return $query->clasificacion_nombre;
    }

    private function nombreGrupo($id_grupo){
        $query = Grupo::where('id', $id_grupo)->first();

        return $query->grupo_nombre;
    }

    private function cicloEscolar($id_ciclo){
        $query = Ciclo::where('id',$id_ciclo)->first();

        return $query->ciclo_anioinicial.'-'.$query->ciclo_aniofinal;
    }

    private function matriculaAlumno($id_alumno){
        $query = Alumno::where('id', $id_alumno)->first();
        if($id_alumno<10){
            return '00'.$id_alumno.'-'.$query->created_at->format('dmy');
        }
        else if($id_alumno<100){
            return '0'.$id_alumno.'-'.$query->created_at->format('dmy');
        }
        else{
            return $id_alumno.'-'.$query->created_at->format('dmy');
        }
    }

    private function nombreAlumno($id_alumno){
        $query = Alumno::where('id', $id_alumno)->first();

        return ucwords($query->alumno_primernombre).' '.ucwords($query->alumno_segundonombre).' '.ucwords($query->alumno_apellidopaterno).' '.ucwords($query->alumno_apellidomaterno);

    }

    private function nombreTutor($id_escuela,$id_ciclo,$id_alumno){
        $query = TutorAlumno::select('tutores_alumnos.tutor_id','tutores.tutor_nombre','tutores.tutor_apellidopaterno','tutores.tutor_apellidomaterno')
            ->join('tutores','tutores_alumnos.tutor_id','=','tutores.id')
            ->where('tutores_alumnos.escuela_id',$id_escuela)
            ->where('tutores_alumnos.ciclo_id', $id_ciclo)
            ->where('tutores_alumnos.alumno_id', $id_alumno)
            ->first();

        return ucwords($query->tutor_nombre).' '.ucwords($query->tutor_apellidopaterno).' '.ucwords($query->tutor_apellidomaterno);

    }

    private function direccionAlumno($id_escuela,$id_ciclo,$id_alumno){
        $query = DatosInscripcionAlumno::select('datos_inscripcion_alumno.datospersonales_id')
            ->addSelect('alumnos_datospersonales.nombre_vialidad','alumnos_datospersonales.numero_exterior')
            ->addSelect('alumnos_datospersonales.numero_interior','alumnos_datospersonales.tipo_asentamiento')
            ->addSelect('alumnos_datospersonales.nombre_asentamiento','alumnos_datospersonales.codigo_postal')
            ->join('alumnos_datospersonales','datos_inscripcion_alumno.datospersonales_id','=','alumnos_datospersonales.id')
            ->where('datos_inscripcion_alumno.escuela_id',$id_escuela)
            ->where('datos_inscripcion_alumno.ciclo_id', $id_ciclo)
            ->where('datos_inscripcion_alumno.alumno_id', $id_alumno)
            ->first();

        $direccion = ucwords($query->nombre_vialidad).' '.ucwords($query->numero_exterior).' '.ucwords($query->numero_interior);
        $colonia   = ucwords($query->tipo_asentamiento).' '.ucwords($query->nombre_asentamiento);
        $cp        = 'C.P.: '.$query->codigo_postal;

        return $direccion.' '.$colonia.' '.$cp;
    }

}
