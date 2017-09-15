@extends('templates.app_age')

@section('title', 'Nueva inscripción')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripción de un nuevo alumno
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Para iniciar ingrese la <strong>C.U.R.P.</strong> del alumno</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="" id="form_verificarcurp" name="form_verificarcurp">

                            <!-- box-body start -->
                            <div class="box-body">

                                <div class="form-group curp_alumno">
                                    <label for="alumno_curp" class="col-sm-2 control-label">C.U.R.P del alumno: (*)</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="alumno_curp" name="alumno_curp" placeholder="UIPW810622HYNCTY02" required>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <a class="btn btn-social btn-danger" href="#">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                                </a>

                                <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_siguiente">
                                    <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>
                                    Siguiente
                                </button>
                            </div>
                            <!-- /.box-footer -->

                        </form>
                        <!-- form end -->

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
    $(document).ready(function(){
        //$("#escuela_clavect").inputmask("9{2}A{3}9{4}A{1}");
        $("#alumno_curp").inputmask("A{4}9{6}A{1}A{2}A{3}9{2}",{
            onKeyValidation: function(key, result){
                if (!result){
                    swal({
                        title:"Error:",
                        text: "La informacion ingresada de la CURP es incorrecta",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Reintentar"
                    });
                }
            },
            onincomplete : function(){
                $(".curp_alumno").addClass("has-error");
            },
            oncomplete : function(){
                $(".curp_alumno").removeClass("has-error");
            }
        });

        $("#boton_siguiente").click(function(){
            if ($("#alumno_curp").inputmask("isComplete")){
                $(".curp_alumno").removeClass("has-error");
                return false;
            }
            else{
                $(".curp_alumno").addClass("has-error");
                $( "#alumno_curp").focus();
                swal({
                    title:"Error:",
                    text: "La CURP es incorrecta",
                    type: "error",
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Corregir"
                });
                return false;
            }
        });

    });
</script>
@endsection