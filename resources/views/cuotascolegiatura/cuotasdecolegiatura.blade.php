@extends('templates.app_age')

@section('title', 'Lista de Cuotas de Colegiatura')

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
                        <small>&nbsp;&nbsp;(Cuotas de colegiatura de la escuela elegida)</small>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <table class="table table-striped" id="clasificaciones">
                            <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th>Ciclo</th>
                                <th>Nombre</th>
                                <th>Cuota</th>
                                <th>Disponible</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <?php $i=1 ?>
                            @foreach($cuotas as $cuota)
                                <tr>
                                    <td><p class="text-center"><strong>{{$i++}}</strong></p></td>
                                    <td>{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</td>
                                    <td>{{$cuota->cuotacolegiatura_nombre}}</td>
                                    <td>$ {{number_format($cuota->cuotacolegiatura_cuota, 2, '.', ',')}}</td>
                                    <td>
                                        @if($cuota->cuotacolegiatura_disponible===0)
                                            <span data-toggle="tooltip" title="No Disponible" class="badge bg-red">No</span>
                                        @else
                                            <span data-toggle="tooltip" title="Disponible" class="badge bg-light-blue">Si</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar" href="">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar" href="">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                        |
                                        <a class="btn btn-xs btn-warning" data-toggle="tooltip" title="Configurar Meses de Pago" href="{{route('asignarmesesdepago')}}">
                                            <i class="fa fa-cogs" aria-hidden="true"></i></a>
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