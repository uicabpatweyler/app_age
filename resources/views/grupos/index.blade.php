@extends('templates.app_age')

@section('title', 'Grupos')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">

                    <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title">Grupos para el ciclo:</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="form-control select_escuela" name="escuela_id" id="escuela_id" style="width: 100%;">
                                            <option value="-1" selected="selected">[Elija una escuela]</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select class="form-control select_clasificacion" name="clasificacion_id" id="clasificacion_id" style="width: 100%">
                                            <option value="-1" selected="selected">[Elegir clasificación]</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <a class="btn btn-primary form-control" name="boton_enviar" id="boton_enviar" href="">
                                            <i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i>&nbsp;  Enviar</a>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <a class="btn btn-success form-control" href="{{route('nuevogrupo')}}">
                                            <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>&nbsp;  Agregar</a>
                                    </div>
                                </div>



                            </div>
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

@section('scripts')
    <script>
        $(document).ready(function () {

            $('.select_escuela').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elija una escuela]'
                }
            });

            $('.select_clasificacion').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elegir clasificación]'
                }
            });

        });
    </script>
@endsection