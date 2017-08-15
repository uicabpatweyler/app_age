@extends('templates.app_age')

@section('title', 'Agregar Grupo')

@section('css')

    <style>
        label.error, label.error {
            /* remove the next line when you have trouble in IE6 with labels in list */
            color: red;
            font-style: italic
        }
    </style>
@endsection


@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Nuevo Grupo
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Ingrese los siguientes datos</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="" name="form_grupo" id="form_grupo">
                            {{csrf_field()}}

                            <div class="box-body">

                                <div class="form-group">
                                    <label for="grupo_cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="grupo_cicloescolar" name="grupo_cicloescolar" value="" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_escuela" class="col-sm-2 control-label"><p class="text-left">Escuela:(*)</p></label>
                                    <div class="col-sm-5">
                                        <select name="grupo_escuela" id="grupo_escuela" class="form-control select_grupo_escuela" style="width: 100%;">
                                            <option value="-1" selected>[Elija una escuela]</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_clasificacion" class="col-sm-2 control-label"><p class="text-left">Clasificación:(*)</p></label>
                                    <div class="col-sm-3">
                                        <select name="grupo_clasificacion" id="grupo_clasificacion" class="form-control select_grupo_clasificacion" style="width: 100%;" disabled>
                                            <option value="-1" selected>[Elegir clasificación]</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre:(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="grupo_nombre" name="grupo_nombre">
                                    </div>
                                    <label for="grupo_numalumnos" class="col-sm-2 control-label"><p class="text-left">Alumnos Permitidos:(*)</p></label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="grupo_numalumnos" name="grupo_numalumnos">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_disponible" class="col-sm-2 control-label"><p class="text-left"></p></label>
                                    <div class="col-sm-3">
                                        <label>
                                            Grupo disponible &nbsp; &nbsp; &nbsp;
                                            <input type="checkbox" class="minimal" checked>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-danger" href="{{route('grupos')}}">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                                <button type="submit" class="btn btn-primary pull-right" name="boton_enviar" id="boton_enviar">
                                    <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar Datos</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            $('.select_grupo_escuela').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elija una escuela]'
                }
            });

            $('.select_grupo_clasificacion').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elegir clasificación]'
                }
            });

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

        });
    </script>
@endsection