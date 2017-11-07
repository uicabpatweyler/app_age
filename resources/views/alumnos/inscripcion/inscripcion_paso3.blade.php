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
                <h1>Hoja de Incripción - Tutor del alumno</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <form action="" role="form" method="post">
                    {{csrf_field()}}
                    
                    <div class="box box-success">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title"> Datos del tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- box-body -->
                        <div class="box-body">
                            <!-- Inicia fila para el nombre del alumno y el ciclo escolar-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="alumno">Alumno:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" value="" class="form-control" id="alumno_nombre" name="alumno_nombre" style="text-transform:capitalize" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="alumno">Ciclo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" value="" class="form-control" id="ciclo_escolar" name="ciclo_escolar" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina fila del nombre del alumno y el ciclo escolar-->

                            <br />
                            <!-- Inicia fila para el TabPanel de los datos del tutor -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-tabs-custom">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-address-card fa-lg" aria-hidden="true"></i>&nbsp; Dirección</a></li>
                                            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;Telefonos</a></li>
                                            <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>&nbsp;Lugar de Trabajo</a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="tab1">...</div>
                                            <div role="tabpanel" class="tab-pane" id="tab2">...</div>
                                            <div role="tabpanel" class="tab-pane" id="tab3">...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina fila para el TabPanel de los datos del tutor -->

                        </div>

                    </div>
                    
                </form>
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