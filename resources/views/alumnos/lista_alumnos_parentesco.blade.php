@extends('templates.app_age')

@section('title', 'Coincidencia de Alumnos')

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
                <h1></h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Coincidencias para: <strong>{{ucwords($nuevo_alumno->alumno_apellidopaterno)}} {{ucwords($nuevo_alumno->alumno_apellidomaterno)}} {{ucwords($nuevo_alumno->alumno_primernombre)}} {{ucwords($nuevo_alumno->alumno_segundonombre)}} </strong></h3>
                            <div class="box-tools pull-right">

                                <a class="btn btn-danger btn-sm pull-right" href="{{route('nuevo_alumno_datospersonales',['id_alumno' => $id_alumno, 'id_ciclo' => $id_ciclo, 'id_escuela' => $id_escuela])}}" data-toggle="tooltip" title="" style="margin-right: 5px;">
                                    <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Omitir y Continuar</a>

                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped">
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th>Apellido(s)</th>
                                    <th>Nombre(s)</th>
                                    <th>Ciclo Escolar</th>
                                    <th></th>
                                </tr>
                                <?php $i=1 ?>
                                <tr>
                                    @foreach($alumnos as $alumno)
                                        <td>{{$i++}}</td>
                                        <td>{{ucwords($alumno->alumno_apellidopaterno)}} {{ucwords($alumno->alumno_apellidomaterno)}}</td>
                                        <td>{{ucwords($alumno->alumno_primernombre)}} {{ucwords($alumno->alumno_segundonombre)}} </td>
                                        <td>{{$alumno->ciclo_anioinicial}}-{{$alumno->ciclo_aniofinal}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-success" href="{{route('utilizar_datos_personales_alumno', ['id_datospersonales' => $alumno->datospersonales_id, 'id_alumno'=>$id_alumno, 'id_ciclo'=>$id_ciclo,'id_escuela'=>$id_escuela])}}" title="">
                                                <i class="fa fa-recycle" aria-hidden="true"></i> Utilizar información de este alumno</a>
                                        </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>


                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')

@endsection