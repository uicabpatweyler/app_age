@extends('templates.app_age')

@section('title', 'Ciclos Escolares')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">

                    <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title"> Ciclos Escolares</h3>
                        </div>
                        <!-- /.box-header -->

                            <div class="box-body">

                                <a class="btn btn-success" href="{{route('nuevociclo')}}">
                                    <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>&nbsp;  Agregar ciclo escolar</a>
                                <br /><br />

                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th>Ciclo Escolar</th>
                                        <th>Predeterminado</th>
                                        <th>Acciones</th>
                                    </tr>
                                    <?php $i=1 ?>

                                    @foreach($ciclos as $ciclo)

                                        <tr>
                                            <td>{{$i++}}.</td>
                                            <td>{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</td>
                                            <td>
                                                @if($ciclo->ciclo_actual===1)
                                                    <span class="badge bg-green">Ciclo Actual de Trabajo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                                    <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                                |
                                                <a class="btn btn-xs btn-info" href="{{route('editarciclo',$ciclo->id)}}" title="Editar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
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