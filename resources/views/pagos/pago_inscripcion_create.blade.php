@extends('templates.app_age')

@section('title', 'Pago de la cuota de inscripción')

@section('content')

    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="box box-success">
                    <div class="box-header with-border bg-green color-palette">
                        <h3 class="box-title">Pago de la cuota de inscripción</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Ciclo Escolar:</td>
                                        <td style="width: 70%" class=""> <strong>{{$inscripcion->CicloGrupoAlumno->ciclo_anioinicial}}-{{$inscripcion->CicloGrupoAlumno->ciclo_aniofinal}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Escuela:</td>
                                        <td style="width: 70%" class=""> <strong>{{$inscripcion->EscuelaGrupoAlumno->escuela_nombre}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Alumno:</td>
                                        <td style="width: 70%" class=""> <strong>{{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_primernombre)}} {{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_segundonombre)}} {{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_apellidopaterno)}} {{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_apellidomaterno)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Matricula:</td>
                                        <td style="width: 70%" class="">
                                            @if($inscripcion->alumno_id<10)
                                                <strong>00{{$inscripcion->alumno_id}}-{{$inscripcion->AlumnoGrupoAlumno->created_at->format('dmy')}}</strong>
                                            @elseif($inscripcion->alumno_id<100)
                                                <strong>0{{$inscripcion->alumno_id}}-{{$inscripcion->AlumnoGrupoAlumno->created_at->format('dmy')}}</strong>
                                            @else
                                                <strong>0{{$inscripcion->alumno_id}}-{{$inscripcion->AlumnoGrupoAlumno->created_at->format('dmy')}}</strong>
                                            @endif
                                        </td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-sm-1"></div>

                            <div class="col-sm-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Recibo No.:</td>
                                        <td style="width: 70%" class="text-center text-red"> <strong>001</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Fecha :</td>
                                        <td style="width: 70%" class="text-center"> <strong>{{ucwords(Date::now()->format('D d, M Y'))}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Nivel :</td>
                                        <td style="width: 70%" class="text-center"> <strong>{{$inscripcion->ClasifGrupoAlumno->clasificacion_nombre}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Grupo :</td>
                                        <td style="width: 70%" class="text-center"> <strong>{{$inscripcion->GrupoDeGrupoAlumno->grupo_nombre}}</strong> </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 15%" class="bg-gray color-palette text-center">Cantidad</th>
                                        <th style="width: 50%" class="bg-gray color-palette text-center">Concepto</th>
                                        <th style="width: 20%" class="bg-gray color-palette text-center">Ciclo</th>
                                        <th style="width: 15%" class="bg-gray color-palette text-center">Importe</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width: 15%" class="text-center">1</td>
                                        <td style="width: 50%" class="text-center">Cuota de Inscripción</td>
                                        <td style="width: 20%" class="text-center">{{$inscripcion->CicloGrupoAlumno->ciclo_anioinicial}}-{{$inscripcion->CicloGrupoAlumno->ciclo_aniofinal}}</td>
                                        <td style="width: 15%" class="text-center">$ {{number_format($cuota->cuotainscripcion_cuota,2,'.',',')}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 15%" class=""></th>
                                        <th style="width: 50%" class=""></th>
                                        <th style="width: 20%" class="bg-gray color-palette text-center">Total</th>
                                        <th style="width: 15%" class="text-center">$ {{number_format($cuota->cuotainscripcion_cuota,2,'.',',')}}</th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('scripts')
<script>
$(document).ready(function() {

});
</script>
@endsection