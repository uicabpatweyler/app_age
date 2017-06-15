@extends('templates.app_age')

@section('title', 'Nuevo ciclo escolar')

@section('css')
<!-- Sweet Alert CSS -->
    <link rel="stylesheet" href="{{asset('sweetalert/sweetalert2.css')}}">
@endsection

@section('js')
<!-- Sweet Alert JS -->
    <script src="{{asset('sweetalert/sweetalert2.min.js')}}"></script>
@endsection

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Agregar nuevo ciclo escolar
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
                        <form class="form-horizontal" method="post" action="">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group ciclo_escolar">
                                    <label for="ciclo_anioinicial" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar: (*)</p></label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="ciclo_anioinicial" name="ciclo_anioinicial" placeholder="">
                                    </div>

                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="ciclo_aniofinal" name="ciclo_aniofinal" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar</button>
                                <button type="submit" class="btn btn-primary pull-right" id="boton_guardar"><i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar Datos</button>
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
<!-- InputMask https://github.com/RobinHerbots/Inputmask -->
<script src="{{asset('adminlte/plugins/input-mask/dist/jquery.inputmask.bundle.js')}}"></script>

    <script>
        $(document).ready(function(){
            $("#ciclo_anioinicial").inputmask("9{4}");
            $("#ciclo_aniofinal").inputmask("9{4}");

            //http://jquery-manual.blogspot.mx/2013/06/enviar-formulario-con-ajax-jquery.html
            //http://www.anerbarrena.com/jquery-addclass-removeclass-4705/
            //https://limonte.github.io/sweetalert2/

            $('#boton_guardar').click(function(){

                var anio_inicial = $("#ciclo_anioinicial").val();
                var anio_final = $("#ciclo_aniofinal").val();

                // 1) Verificar que se cumpla la mascara de 4 digitos numericos
                if ($("#ciclo_anioinicial").inputmask("isComplete") && $("#ciclo_aniofinal").inputmask("isComplete")){
                    //2 Verificar los años del ciclo escolar
                    if(anio_inicial>=anio_final){
                        $(".ciclo_escolar").addClass("has-error");
                        swal({title:"", text: "El ciclo escolar es incorrecto", type: "error", allowOutsideClick: false });
                    }
                }else{
                    $(".ciclo_escolar").addClass("has-error");
                    swal({title:"", text: "El ciclo escolar es incorrecto", type: "error", allowOutsideClick: false });
                }

                return false;
            });
        });
    </script>
@endsection