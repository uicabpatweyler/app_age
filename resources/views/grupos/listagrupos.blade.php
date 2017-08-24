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
                        <a class="btn btn-xs btn-success" href="javascript:history.back(1)">
                            <i class="fa fa-reply fa-lg" aria-hidden="true"></i> Regresar</a>

                        <h3 class="box-title">{{$escuela->NivelEscuela->nivel_nombre}} - {{$escuela->escuela_nombre}}</h3>
                        <small>&nbsp;&nbsp;(Lista de grupos de la escuela elegida)</small>
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
                            <?php $i=1 ?>
                            @foreach($grupos as $grupo)
                                <tr>
                                    <td><p class="text-center"><strong>{{$i++}}</strong></p></td>
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
                                    <td>
                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar" href="{{route('mostrargrupo',$grupo->id)}}">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar" href="{{route('editargrupo', $grupo->id)}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                        |
                                        <div class="btn-group">

                                            <a class="btn btn-xs bg-yellow" data-toggle="tooltip" title="Detalle de Pagos" href="#">
                                            <i class="fa fa-usd" aria-hidden="true"></i> Pagos</a>

                                            <button type="button" class="btn bg-yellow btn-xs dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>

                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('seleccionar_cdi', $grupo->id)}}">Cuota de Inscripción</a></li>
                                                <li><a href="#">Cuota de Colegiatura</a></li>
                                                <li><a href="#">Otros Pagos</a></li>
                                            </ul>

                                        </div>

                                    </td>
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