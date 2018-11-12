<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProducto;
use App\Models\Producto;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;

class KardexProducto extends Controller
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

    private function LogoReporte($x1,$y1,$x2,$y2){
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

    private function TituloReporte(){
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(150,5,'REPORTE DE: EXISTENCIA INICIAL / ENTRADAS / SALIDAS Y EXISTENCIA ACTUAL DE PRODUCTOS','TB',0,'L');
        Fpdf::SetFont('Arial', '', 8);
        Fpdf::Cell(56,5,Carbon::now('America/Mexico_City Time Zone'),'TB',1,'R');

        Fpdf::Cell(0,2,'',0,1);//Espacio
    }

    private function EncabezadoTabla(){
        Fpdf::SetFillColor(196,224,180);

        Fpdf::Cell(10,5,'#',1,0,'C',true);
        Fpdf::Cell(20,5,'Categoria',1,0,'C',true);
        Fpdf::Cell(96,5,utf8_decode('Descripción del producto'),1,0,'C',true);
        Fpdf::Cell(20,5,'Prec. Vta.',1,0,'C',true);
        Fpdf::Cell(15,5,'Inicial',1,0,'C',true);
        Fpdf::Cell(15,5,'Entradas',1,0,'C',true);
        Fpdf::Cell(15,5,'Salidas',1,0,'C',true);
        Fpdf::Cell(15,5,'Existencia',1,1,'C',true);
    }

    private function LineasReporte($id){
        $query = Producto::select('productos.id','productos.nombre','productos.descripcion_venta','productos.info_adicional')
                 ->addSelect('kardex_productos.inicial','kardex_productos.entradas','kardex_productos.salidas','kardex_productos.existencia')
                 ->addSelect('productos_precios.precio_venta')
                 ->join('kardex_productos','kardex_productos.producto_id','=','productos.id')
                 ->join('productos_precios','productos_precios.producto_id','=','productos.id')
                 ->where('productos.categoria_id',$id)
                 ->orderBy('productos.id','asc')
                 ->get();
        $linea = 1;
        foreach ($query as $fila){
            if(($linea%2)==0){
                //Gris Claro
                Fpdf::SetFillColor(234,234,234);

                Fpdf::Cell(10,5,$linea,1,0,'C',true);
                Fpdf::Cell(20,5,utf8_decode($fila->nombre),1,0,'C',true);
                Fpdf::Cell(96,5,utf8_decode($fila->descripcion_venta),1,0,'L',true);
                Fpdf::Cell(20,5,'$ '.number_format($fila->precio_venta,2,'.',','),1,0,'C',true);
                Fpdf::Cell(15,5,$fila->inicial,1,0,'C',true);
                Fpdf::Cell(15,5,$fila->entradas,1,0,'C',true);
                Fpdf::Cell(15,5,$fila->salidas,1,0,'C',true);
                Fpdf::Cell(15,5,$fila->existencia,1,1,'C',true);
            }
            else{
                //Blanco
                Fpdf::SetFillColor(255,255,255);

                Fpdf::Cell(10,5,$linea,1,0,'C',true);
                Fpdf::Cell(20,5,utf8_decode($fila->nombre),1,0,'C',true);
                Fpdf::Cell(96,5,utf8_decode($fila->descripcion_venta),1,0,'L',true);
                Fpdf::Cell(20,5,'$ '.number_format($fila->precio_venta,2,'.',','),1,0,'C',true);
                Fpdf::Cell(15,5,$fila->inicial,1,0,'C',true);
                Fpdf::Cell(15,5,$fila->entradas,1,0,'C',true);
                Fpdf::Cell(15,5,$fila->salidas,1,0,'C',true);
                Fpdf::Cell(15,5,$fila->existencia,1,1,'C',true);
            }

            $linea++;
        }


    }

    public function index(){

        $categorias = CategoriaProducto::all();

        return view('impresiones.kardex_productos_index',compact('categorias'));

    }

    public function pdf_KardexProducto($categoria_id){

        Fpdf::SetFont('Arial', '', 8);
        Fpdf::SetMargins(5,5,5);
        Fpdf::SetAutoPageBreak(true,1);

        Fpdf::AddPage();

        $this->LogoReporte(7,14,187,11);
        $this->reset();
        $this->TituloReporte();
        $this->reset();
        $this->EncabezadoTabla();
        $this->reset();
        $this->LineasReporte($categoria_id);

        Fpdf::Output();
        exit;

    }


}
