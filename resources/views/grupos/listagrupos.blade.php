@extends('templates.app_age')

@section('title', 'Lista de Grupos')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{$escuela->NivelEscuela->nivel_nombre}} - {{$escuela->escuela_nombre}}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <table class="table table-striped" id="clasificaciones">
                            <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th>Ciclo</th>
                                <th>Clasificacion</th>
                                <th>Nombre</th>
                                <th>Disponible</th>
                                <th>Alumnos</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            @foreach($grupos as $grupo)
                                <tr>
                                    <td></td>
                                    <td>{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</td>
                                    <td>{{$grupo-> ClasificacionGrupo->clasificacion_nombre}}</td>
                                    <td>{{$grupo->grupo_nombre}}</td>
                                    <td>
                                        @if($grupo->grupo_disponible===0)
                                            <span data-toggle="tooltip" title="No Disponible" class="badge bg-red">No</span>
                                        @else
                                            <span data-toggle="tooltip" title="Disponible" class="badge bg-light-blue">Si</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                        10 de 32 (50%)
                                    </td>
                                    <td>Editar|Eliminar</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->

                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->

        </section>
        <!-- /.content -->

    </div>
    <!-- /.container -->

</div>
<!-- /.content-wrapper -->
@endsection