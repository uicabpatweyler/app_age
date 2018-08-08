@extends('templates.app_age')

@section('title', 'Agregar Nuevo Alumno')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Agregar Nuevo Alumno
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Utilice este formulario si el alumno <strong>no ha sido registrado</strong> previamente en ciclos escolares anteriores.</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="" id="form_verificarcurp" name="form_verificarcurp">
                        {{csrf_field()}}
                        <input type="hidden" name="alumno_curp" id="alumno_curp">

                        <!-- box-body start -->
                        <div class="box-body">

                            <div class="form-group curp">
                                <label for="curp" class="col-sm-2 control-label">C.U.R.P del alumno: (*)</label>

                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="curp" name="curp" placeholder="UIPW810622HYNCTY02" required >
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                                <a class="btn btn-social btn-danger" href="">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                                </a>

                            <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_verificarcurp">
                                <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>
                                Verificar C.U.R.P
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

        $("#curp").inputmask("A{4} 9{6} A{1} A{2} A{3} 9|A{2}",{
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
                $(".curp").addClass("has-error");
            },
            oncomplete : function(){
                $(".curp").removeClass("has-error");
            }
        });

        $("#boton_verificarcurp").click(function(){
            if ($("#curp").inputmask("isComplete")){
                //Eliminamos la clase de error del cuadro de texto
                $(".curp").removeClass("has-error");
                //Obtenemos la CURP sin los espacios en blano
                var curp_alumno = $('#curp').inputmask('unmaskedvalue');
                //Se lo asignamos al campo oculto 'alumnocurp'
                $("#alumno_curp").val(curp_alumno);
                //Enviamos el formulario
                ajaxSubmitFormVerificaCurp();
                return false;
            }
            else{
                $(".curp").addClass("has-error");
                $( "#curp").focus();
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

        function ajaxSubmitFormVerificaCurp(){
            $.ajax({
                type:"POST",
                url:"{{route('verificar_curp_alumno')}}",
                data: $("#form_verificarcurp").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location.replace("nuevo_alumno_create/"+$('#curp').val());
                    });
                },
                error: function(xhr,status, response ){
                    //Obtener el valor del error devuelto por el controlador
                    var error = jQuery.parseJSON(xhr.responseText);
                    //Obtener el mensaje de error
                    var info = error.message;
                    //Mostrar el y/o los errores devuelto(s) por el controlador
                    swal({
                        title:"Error:",
                        html: info,
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Entendido"
                    });
                }
            });
        }

    });
</script>

@endsection