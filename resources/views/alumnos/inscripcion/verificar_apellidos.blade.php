@extends('templates.app_age')

@section('title', 'Verificar Apellidos')

@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">

        <section class="content-header">
            <h1>Nueva Inscripción</h1>
        </section>

        <!-- Begin main content -->
        <div class="content">
            <div class="col-md-12">

                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title"> Ingrese los siguientes datos del alumno </h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                    </div>
                    <!-- /.box-header -->

                    <form class="form-horizontal" action="{{route('verificar_apellidos')}}">

                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-sm-3 myerror">
                                    <input type="text" class="form-control" id=ap"" name="ap" placeholder="Apellido Paterno (*)" required minlength="2">
                                </div>

                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="am" name="am" placeholder="Apellido Materno">
                                </div>

                                <div class="col-sm-3 myerror">
                                    <input type="text" class="form-control" id="pn" name="pn" placeholder="Primer Nombre (*)" required minlength="2">
                                </div>

                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="sn" name="sn" placeholder="Segundo Nombre">
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a class="btn btn-social btn-danger" href="">
                                <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_buscar" data-toggle="tooltip" title="Verificar datos">
                                <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                                Verificar
                            </button>
                        </div>
                        <!-- /.box-footer -->

                    </form>
                    <!-- End form -->

                </div>
                <!-- ./ box box-succes -->

                @if(isset($resultados))
                <!-- Tabla para mostrar los resultados de busqueda -->
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title">Resultados de la busqueda</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <table class="table table-bordered table-striped">
                            <tr>
                                <th style="text-align: center; width: 20%">Ciclo Escolar</th>
                                <th style="text-align: center; width: 25%">Apellido(s)</th>
                                <th style="text-align: center; width: 25%">Nombre(s)</th>
                                <th style="text-align: center; width: 30%">Acciones</th>
                            </tr>
                            <tr>
                                <td style="text-align: center; width: 20%">2016-2017</td>
                                <td style="width: 25%">Uicab Pat</td>
                                <td style="width: 25%">Weyler Antonio</td>
                                <td style="text-align: center; width: 30%">
                                    <a class="btn btn-xs bg-light-blue" data-toggle="tooltip" title="Reutilizar" href="#">
                                        <i class="fa fa-recycle fa-lg" aria-hidden="true"></i> Reutilizar</a>

                                    <a class="btn btn-xs bg-yellow" data-toggle="tooltip" title="Visualizar" href="#">
                                        <i class="fa fa-eye fa-lg" aria-hidden="true"></i> Visualizar</a>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <!-- /.box-body -->

                </div>
                @endif


            </div>
        </div>
        <!-- End main content -->
    </div>
</div>
@endsection