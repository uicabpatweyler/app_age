@extends('templates.app_age')

@section('title', 'Datos del tutor')

@section('css')
    <style>
        span.error { color: #a94442; }
    </style>
    @endsection

    @section('content')
            <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Agregar Nuevo Tutor</h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">
                        <!-- box-success -->
                        <div class="box box-success ">

                            <!-- box-header -->
                            <div class="box-header with-border">
                                <h3 class="box-title"> Alumnos del ciclo: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3><small>
                                    &nbsp;&nbsp;
                                    (Si desea reutilizar la dirección de algun alumno presione el boton con el icono <i class="fa fa-recycle" aria-hidden="true"></i> )</small>

                                <div class="box-tools pull-right">

                                    <a class="btn btn-danger btn-sm pull-right" href="{{route('nuevo_tutor_datospersonales',['tutor_id'=>$tutor_id, 'ciclo_id'=>$ciclo->id, 'dp'=>0])}}" data-toggle="tooltip" title="" style="margin-right: 5px;">
                                        <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Omitir y Continuar</a>

                                </div>
                                <!-- /box-header -->

                            </div>

                            <!-- box-body -->
                            <div class="box-body">
                                <table id="datos_inscripcion_alumno" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">No.</th>
                                            <th style="width: 15%;">Ciclo</th>
                                            <th style="width: 20%;">Nombre(s)</th>
                                            <th style="width: 20%;">Apellido Materno</th>
                                            <th style="width: 20%;">Apeliido Paterno</th>
                                            <th style="width: 15%;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1 ?>
                                    @foreach($dias as $dia)
                                    <tr>
                                        <td style="width: 10%;"><strong>{{$i++}}</strong></td>
                                        <td style="width: 15%;">{{$dia->CicloDatosInscripcionAlumno->ciclo_anioinicial}}-{{$dia->CicloDatosInscripcionAlumno->ciclo_aniofinal}}</td>
                                        <td style="width: 20%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_primernombre)}} {{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_segundonombre)}} </td>
                                        <td style="width: 20%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidopaterno)}}</td>
                                        <td style="width: 20%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidomaterno)}}</td>
                                        <td style="width: 15%;">
                                            <a class="btn btn-xs btn-info" data-toggle="tooltip" title="Utilizar Datos" href="{{route('nuevo_tutor_datospersonales',['tutor_id'=>$tutor_id, 'ciclo_id'=>$ciclo->id, 'dp'=>$dia->datospersonales_id])}}">
                                                <i class="fa fa-recycle" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /box-body -->

                        </div>
                        <!-- /box-success -->



                </div>


            </section>
            <!-- /.content -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $('#datos_inscripcion_alumno').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            language: {
                url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
            }
        });

    });
</script>
@endsection