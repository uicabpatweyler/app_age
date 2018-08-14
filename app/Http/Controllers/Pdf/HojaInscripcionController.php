<?php

namespace App\Http\Controllers\Pdf;

use App\Models\DatosInscripcionAlumno;
use App\Models\GrupoAlumno;
use App\Models\PagoInscripcion;
use App\Models\Tutor;
use App\Models\TutorAlumno;
use App\Models\TutorDatosPersonales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Codedge\Fpdf\Facades\Fpdf;

class HojaInscripcionController extends Controller
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

    public function pdf_HojaInscrpcionPorAlumno($id_grupo_alumno){
        //grupo_alumno
        $ga = GrupoAlumno::where('id', $id_grupo_alumno)->first();

        //pagos_inscripcion
        $pi = PagoInscripcion::where('inscripcion_id', $ga->id)->first();

        //datos_inscripcion_alumno
        $dia = DatosInscripcionAlumno::where('escuela_id',$pi->escuela_id)
               ->where('ciclo_id',$pi->ciclo_id)
               ->where('alumno_id',$pi->alumno_id)
               ->first();
        //Ancho de toda la pagina: 196
        Fpdf::AddPage();

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 9);

        //Logo del encabezado
        $this->logo();

        //Cuadro sin bordes, en el area del logo
        Fpdf::Cell(0,28,'',0,1,'C');

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(49, 5, 'Matricula:',1,0,1,true);
        if ($pi->alumno_id<10){
            Fpdf::Cell(49, 5, '00'.$pi->alumno_id.'-'.$pi->AlumnoPagoDeInscripcion->created_at->format('dmy'),1,1,'C',false);
        }
        elseif ($pi->alumno_id<100){
            Fpdf::Cell(49, 5, '0'.$pi->alumno_id.'-'.$pi->AlumnoPagoDeInscripcion->created_at->format('dmy'),1,1,'C',false);
        }
        else{
            Fpdf::Cell(49, 5, $pi->alumno_id.'-'.$pi->AlumnoPagoDeInscripcion->created_at->format('dmy'),1,1,'C',false);
        }

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(49, 5, utf8_decode('Fecha de Inscripción:'),1,0,1,true);
        Fpdf::Cell(49, 5, ucwords(utf8_decode($pi->created_at->format('D d, M Y')) ),1,1,'C',false);

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(49, 5, utf8_decode('Nivel:'),1,0,1,true);
        Fpdf::Cell(49, 5, utf8_decode($ga->ClasifGrupoAlumno->clasificacion_nombre),1,1,'C',false);

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(49, 5, utf8_decode('Grupo:'),1,0,1,true);
        Fpdf::Cell(49, 5, utf8_decode($ga->GrupoDeGrupoAlumno->grupo_nombre),1,1,'C', false);

        Fpdf::Cell(98,5,'',0,0);
        Fpdf::Cell(49, 5, utf8_decode('Ciclo Escolar:'),1,0,1,true);
        Fpdf::Cell(49, 5, $ga->CicloGrupoAlumno->ciclo_anioinicial.'-'.$ga->CicloGrupoAlumno->ciclo_aniofinal,1,1,'C',false);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', 'B', 10);

        Fpdf::Cell(0,3,'',0,1);//Espacio
        Fpdf::Cell(0,6,'FICHA DE INCRIPCION','TB',1,'C');
        Fpdf::Cell(0,3,'',0,1);//Espacio

        //Verde
        Fpdf::SetFillColor(197,224,180);
        Fpdf::Cell(0,6,'DATOS PERSONALES DEL ALUMNO',1,1,'C', true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(98,5,'Nombre(s)',1,0,'C',true);
        Fpdf::Cell(49,5,'Apellido Paterno',1,0,'C',true);
        Fpdf::Cell(49,5,'Apellido Materno',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        $nombre   = $pi->AlumnoPagoDeInscripcion->alumno_primernombre.' '.$pi->AlumnoPagoDeInscripcion->alumno_segundonombre;

        Fpdf::Cell(98,5,ucwords(utf8_decode($nombre)),1,0,'C',true);
        Fpdf::Cell(49,5,ucwords(utf8_decode($pi->AlumnoPagoDeInscripcion->alumno_apellidopaterno)),1,0,'C',true);
        Fpdf::Cell(49,5,ucwords(utf8_decode($pi->AlumnoPagoDeInscripcion->alumno_apellidomaterno)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(48,5,'C.U.R.P',1,0,'C',true);
        Fpdf::Cell(50,5,'Fecha de Nacimiento',1,0,'C',true);
        Fpdf::Cell(49,5,'Edad',1,0,'C',true);
        Fpdf::Cell(49,5,'Sexo',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        //Dia Mes y Anio de la fecha de nacimiento del alumno, tomado del campo alumno_fechanacimiento de la entidad ALUMNOS
        $dia_a  = $pi->AlumnoPagoDeInscripcion->alumno_fechanacimiento->format('d');
        $mes_a  = $pi->AlumnoPagoDeInscripcion->alumno_fechanacimiento->format('m');
        $anio_a = $pi->AlumnoPagoDeInscripcion->alumno_fechanacimiento->format('y');

        //Dia Mes y Anio de la fecha del pago de inscripción
        $dia_pi  = $pi->created_at->format('d');
        $mes_pi  = $pi->created_at->format('m');
        $anio_pi = $pi->created_at->format('y');

        Fpdf::Cell(48,5,$pi->AlumnoPagoDeInscripcion->alumno_curp,1,0,'C',true);
        Fpdf::Cell(50,5,utf8_decode(ucwords($pi->AlumnoPagoDeInscripcion->alumno_fechanacimiento->format('D d, M Y'))),1,0,'C',true);
        Carbon::setLocale('es');
        Fpdf::Cell(49,5,utf8_decode(Carbon::createFromDate($anio_pi,$mes_pi,$dia_pi)->diffForHumans(Carbon::createFromDate($anio_a,$mes_a,$dia_a),true,false,2)),1,0,'C',true);

        $genero_alumno = $pi->AlumnoPagoDeInscripcion->alumno_genero;

        if($genero_alumno=='H'){
            //Gris Claro
            Fpdf::SetFillColor(234,234,234);

            Fpdf::Cell(12,5,'X',1,0,'C',true);

            //Blanco
            Fpdf::SetFillColor(255,255,255);

            Fpdf::Cell(13,5,'M',1,0,'C',true);
            //Gris Claro
            Fpdf::SetFillColor(234,234,234);
            Fpdf::Cell(12,5,'',1,0,'C',true);
            Fpdf::Cell(12,5,'F',1,1,'C',false);
        }

        if ($genero_alumno=='M'){
            //Gris Claro
            Fpdf::SetFillColor(234,234,234);

            Fpdf::Cell(12,5,'',1,0,'C',true);

            //Blanco
            Fpdf::SetFillColor(255,255,255);

            Fpdf::Cell(13,5,'M',1,0,'C',true);
            //Gris Claro
            Fpdf::SetFillColor(234,234,234);
            Fpdf::Cell(12,5,'X',1,0,'C',true);
            Fpdf::Cell(12,5,'F',1,1,'C',false);
        }

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(105,5,utf8_decode('Dirección'),1,0,1,true);
        Fpdf::Cell(65,5,'Colonia',1,0,'C',true);
        Fpdf::Cell(26,5,utf8_decode('Código Postal'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        $d_1 = utf8_decode(ucwords(utf8_decode($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->nombre_vialidad)));
        $d_2 = utf8_decode(strtoupper($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->numero_exterior));
        $d_3 = utf8_decode(ucwords($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->numero_interior));
        $d_4 = utf8_decode(ucwords($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->entre_calles));

        Fpdf::Cell(105,5,$d_1.' '.$d_2.' '.$d_3.' '.$d_4,1,0,1,true);
        Fpdf::Cell(65,5,utf8_decode(ucwords($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->nombre_asentamiento)),1,0,'C',true);
        Fpdf::Cell(26,5,$dia->AlumnoDatosPersonalesDatosInscripcionAlumno->codigo_postal,1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(65,5,'Estado',1,0,'C',true);
        Fpdf::Cell(65,5,utf8_decode('Delegación/Municipio'),1,0,'C',true);
        Fpdf::Cell(66,5,'Ciudad/Localidad',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(65,5,utf8_decode($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->entidad_federativa),1,0,'C',true);
        Fpdf::Cell(65,5,utf8_decode($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->delegacion_municipio),1,0,'C',true);
        Fpdf::Cell(66,5,utf8_decode(ucwords($dia->AlumnoDatosPersonalesDatosInscripcionAlumno->nombre_localidad)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(49,5,utf8_decode('Teléfono de Casa'),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode('Teléfono del Tutor'),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode('Celular'),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode('Otro'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(49,5,$dia->telefono_casa.' '.utf8_decode(ucwords($dia->referencia1)),1,0,'C',true);
        Fpdf::Cell(49,5,$dia->telefono_tutor.' '.utf8_decode(ucwords($dia->referencia2)),1,0,'C',true);
        Fpdf::Cell(49,5,$dia->telefono_celular.' '.utf8_decode(ucwords($dia->referencia3)),1,0,'C',true);
        Fpdf::Cell(49,5,$dia->telefono_otro.' '.utf8_decode(ucwords($dia->referencia4)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(98,5,utf8_decode('Escuela'),1,0,1,true);
        Fpdf::Cell(98,5,utf8_decode('Lugar de Trabajo'),1,1,1,true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(98,5,utf8_decode(utf8_decode(ucwords($dia->alumno_escuela))),1,0,1,true);
        Fpdf::Cell(98,5,utf8_decode(ucwords($dia->alumno_lugardetrabajo)),1,1,1,true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(98,5,utf8_decode('Último Grado Escolar a Cursar'),1,0,1,true);
        Fpdf::Cell(98,5,utf8_decode('Correo eléctronico del alumno'),1,1,1,true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(98,5,utf8_decode(ucwords($dia->alumno_ultimogrado)),1,0,1,true);
        Fpdf::Cell(98,5,$dia->alumno_email,1,1,1,true);

        //Verde
        Fpdf::SetFillColor(197,224,180);
        Fpdf::SetFont('Arial', 'B', 10);


        Fpdf::Cell(0,6,'OTROS DATOS',1,1,'C', true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(98,5,utf8_decode('¿Cómo te enteraste de la escuela?'),1,0,'C',true);
        Fpdf::Cell(98,5,utf8_decode('¿Por qué quieres estudiar inglés?'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(98,5,utf8_decode($dia->encuesta_pregunta1),1,0,'C',true);
        Fpdf::Cell(98,5,utf8_decode($dia->encuesta_pregunta2),1,1,'C',true);

        //Tabla tutores_alumnos
        $tutor_alumno = TutorAlumno::where('escuela_id', $pi->escuela_id)
            ->where('ciclo_id', $pi->ciclo_id)
            ->where('alumno_id', $pi->alumno_id)
            ->first();

        //Tabla tutores_datospersonales
        $tutor = TutorDatosPersonales::where('ciclo_id',$pi->ciclo_id)
                 ->where('tutor_id',$tutor_alumno->tutor_id)
                 ->first();

        //Verde
        Fpdf::SetFillColor(197,224,180);
        Fpdf::SetFont('Arial', 'B', 10);


        Fpdf::Cell(0,6,'DATOS DEL TUTOR',1,1,'C', true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(98,5,'Nombre(s)',1,0,'C',true);
        Fpdf::Cell(49,5,'Apellido Paterno',1,0,'C',true);
        Fpdf::Cell(49,5,'Apellido Materno',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(98,5,utf8_decode(ucwords($tutor->TutorTutoresDatosPersonales->tutor_nombre)),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode(ucwords($tutor->TutorTutoresDatosPersonales->tutor_apellidopaterno)),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode(ucwords($tutor->TutorTutoresDatosPersonales->tutor_apellidomaterno)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(105,5,utf8_decode('Dirección'),1,0,1,true);
        Fpdf::Cell(65,5,'Colonia',1,0,'C',true);
        Fpdf::Cell(26,5,utf8_decode('Código Postal'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        $dt_1 = utf8_decode(ucwords(utf8_decode($tutor->nombre_vialidad)));
        $dt_2 = utf8_decode(strtoupper($tutor->numero_exterior));
        $dt_3 = utf8_decode(ucwords($tutor->numero_interior));
        $dt_4 = utf8_decode(ucwords($tutor->entre_calles));

        Fpdf::Cell(105,5,utf8_decode($dt_1.' '.$dt_2.' '.$dt_3.' '.$dt_4),1,0,1,true);
        Fpdf::Cell(65,5,utf8_decode(ucwords($tutor->nombre_asentamiento)),1,0,'C',true);
        Fpdf::Cell(26,5,$tutor->codigo_postal,1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(65,5,'Estado',1,0,'C',true);
        Fpdf::Cell(65,5,utf8_decode('Delegación/Municipio'),1,0,'C',true);
        Fpdf::Cell(66,5,'Ciudad/Localidad',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(65,5,utf8_decode($tutor->entidad_federativa),1,0,'C',true);
        Fpdf::Cell(65,5,utf8_decode($tutor->delegacion_municipio),1,0,'C',true);
        Fpdf::Cell(66,5,utf8_decode(ucwords($tutor->nombre_localidad)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(49,5,utf8_decode('Teléfono de Casa'),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode('Teléfono del Trabajo'),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode('Celular'),1,0,'C',true);
        Fpdf::Cell(49,5,utf8_decode('Otro'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(49,5,$tutor->telefono_casa.' '.utf8_decode(ucwords($tutor->referencia1)),1,0,'C',true);
        Fpdf::Cell(49,5,$tutor->telefono_trabajo.' '.utf8_decode(ucwords($tutor->referencia2)),1,0,'C',true);
        Fpdf::Cell(49,5,$tutor->telefono_celular.' '.utf8_decode(ucwords($tutor->referencia3)),1,0,'C',true);
        Fpdf::Cell(49,5,$tutor->telefono_otro.' '.utf8_decode(ucwords($tutor->referencia4)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(196,5,utf8_decode('Nombre del lugar de trabajo'),1,1,1,true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(196,5,utf8_decode(ucwords($tutor->tutor_lugartrabajo)),1,1,1,true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(105,5,utf8_decode('Dirección del lugar de trabajo'),1,0,1,true);
        Fpdf::Cell(65,5,'Colonia',1,0,'C',true);
        Fpdf::Cell(26,5,utf8_decode('Código Postal'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(105,5,utf8_decode(ucwords($tutor->tutor_direccion_lugar_trabajo)),1,0,1,true);
        Fpdf::Cell(65,5,utf8_decode(ucwords($tutor->colonia_direccion_lugartrabajo)),1,0,'C',true);
        Fpdf::Cell(26,5,$tutor->cp_direccion_lugartrabajo,1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(65,5,'Estado',1,0,'C',true);
        Fpdf::Cell(65,5,utf8_decode('Delegación/Municipio'),1,0,'C',true);
        Fpdf::Cell(66,5,'Ciudad/Localidad',1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(65,5,utf8_decode(ucwords($tutor->estado_direccion_lugartrabajo)),1,0,'C',true);
        Fpdf::Cell(65,5,utf8_decode($tutor->delegacion_direccion_lugartrabajo),1,0,'C',true);
        Fpdf::Cell(66,5,utf8_decode(ucwords($tutor->localidad_direccion_lugartrabajo)),1,1,'C',true);

        //Gris Claro
        Fpdf::SetFillColor(234,234,234);
        Fpdf::SetFont('Arial', 'B', 8);

        Fpdf::Cell(196,5,utf8_decode('Correo eléctronico del tutor'),1,1,'C',true);

        //Blanco
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Arial', '', 8);

        Fpdf::Cell(196,5,$tutor->tutor_email,1,1,'C',true);

        //Se entrego Tarjetas de Pago, Reglamento, Fechas de entrega de Boletas y Dias de Suspensión
        //Cuadro sin bordes, en el area del logo
        Fpdf::SetFont('Arial', 'B', 8);
        Fpdf::Cell(0,6,utf8_decode('Se entrego Tarjetas de Pago, Reglamento, Fechas de entrega de Boletas y Dias de Suspensión'),0,1,'C');

        Fpdf::Output();
        exit;

    }
}
