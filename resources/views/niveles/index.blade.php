@extends('templates.app_age')

@section('title', 'Niveles')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Niveles
                    <small>Para el sistema educativo </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Layout</a></li>
                    <li class="active">Top Navigation</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lista de niveles</h3><small>&nbsp;&nbsp;creados y disponibles en el sistema</small>
                        </div>
                        <!-- /.box-header -->
                         <div class="box-body">

                            <a class="btn btn-success" href="{{route('nuevonivel')}}">
                                <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>&nbsp;  Agregar nuevo nivel</a>
                             <br /><br />
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nivel Educativo</th>
                                    <th>Categoria</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Educación Inicial</td>
                                    <td>Nombre de la categoria 1</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>Educación Básica</td>
                                    <td>Nombre de la categoría</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>03</td>
                                    <td>Educación Preescolar</td>
                                    <td>Nombre de la categoría</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>04</td>
                                    <td>Educación Primaria</td>
                                    <td>Nombre de la categoria</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>05</td>
                                    <td>Educación Secundaria</td>
                                    <td>Nombre de la categoria</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>06</td>
                                    <td>Educación Media Superior</td>
                                    <td>Nombre de la categoria</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>07</td>
                                    <td>Educación Superior</td>
                                    <td>Nombre de la categoria</td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" href="#" title="Editar">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    </td>
                                </tr>
                                </tbody>
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