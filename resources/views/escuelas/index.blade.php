@extends('templates.app_age')

@section('title', 'Escuelas')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Escuelas</h3>
                    </div>

                    <div class="box-body">

                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Nivel</th>
                                <th>Nombre de la escuela</th>
                                <th>Acciones</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach($escuelas as $escuela)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$escuela->escuela_nivel}}</td>
                                <td>{{$escuela->escuela_nombre}}</td>
                                <td>
                                    <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                    |
                                    <a class="btn btn-xs btn-info" href="" title="Editar">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <!-- /.box-body -->

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