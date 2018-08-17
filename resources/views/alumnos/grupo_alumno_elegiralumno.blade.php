@extends('templates.app_age')

@section('title', 'Asignar Tutor a Alumno - Paso 1')

@section('content')

        <!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Asignar Grupo a Alumno
                <small>Paso 1: Elegir alumno</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-success">
                <div class="box-header with-border bg-green color-palette">
                    <h3 class="box-title">Listado de Alumnos: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                </div>
                <div class="box-body">
                    <table id="dt_listado_alumnos" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 10%">Ciclo</th>
                            <th style="width: 15%; text-align: center"></th>
                            <th style="width: 15%; text-align: center">Alumno</th>
                            <th style="width: 15%; text-align: center"></th>
                            <th style="width: 20%; text-align: center">Grupo/Pago I.</th>
                            <th style="width: 20%;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($dias as $dia)
                            <tr>
                                <td style="width: 5%;"><strong>{{$i++}}</strong></td>
                                <td style="width: 10%">{{$dia->CicloDatosInscripcionAlumno->ciclo_anioinicial}}-{{$dia->CicloDatosInscripcionAlumno->ciclo_aniofinal}}</td>
                                <td style="width: 15%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_primernombre)}} {{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_segundonombre)}}</td>
                                <td style="width: 15%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidopaterno)}}</td>
                                <td style="width: 15%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidomaterno)}}</td>
                                <td style="width: 20%;" align="center">
                                    @if ($dia->grupo_nombre!=null)
                                        <small class="label label-success"><i class="fa fa-check"></i> {{$dia->grupo_nombre}}</small>
                                    @endif

                                    @if ($dia->pago_inscripcion!=null)
                                        <small class="label label-success"><i class="fa fa-dollar"></i> </small>
                                    @endif
                                </td>
                                <td style="width: 20%;" align="center">
                                    @if ($dia->grupo_nombre==null)
                                        <a class="btn btn-xs btn-social btn-dropbox" href="{{route('grupo_alumno_elegirgrupo',['escuela'=>$dia->escuela_id, 'ciclo'=>$ciclo->id, 'alumno'=>$dia->alumno_id])}}">
                                            <i class="fa fa-arrow-circle-right"></i> Elegir
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
        $(document).ready(function(){

            $('#dt_listado_alumnos').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                language: {
                    url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                }
            });

        });
    </script>
@endsection