@extends('templates.app_age')

@section('title', 'Nuevo ciclo escolar')

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
                        <form class="form-horizontal" method="post" action="" id="form_nuevociclo" name="form_nuevociclo">
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

                                <a class="btn btn-danger" href="{{route('ciclos')}}">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                                <button type="submit" class="btn btn-primary pull-right" id="boton_guardar">
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
        $(document).ready(function(){
            $("#ciclo_anioinicial").inputmask("9{4}");
            $("#ciclo_aniofinal").inputmask("9{4}");

            //http://jquery-manual.blogspot.mx/2013/06/enviar-formulario-con-ajax-jquery.html
            //http://www.anerbarrena.com/jquery-addclass-removeclass-4705/
            //https://limonte.github.io/sweetalert2/
            //https://laracasts.com/discuss/channels/general-discussion/showing-request-validation-errors-when-submitting-form-by-ajax

            $('#boton_guardar').click(function(event){

                event.preventDefault();

                var anio_inicial = $("#ciclo_anioinicial").val();
                var anio_final = $("#ciclo_aniofinal").val();

                // 1) Verificar que se cumpla la mascara de 4 digitos numericos
                if ($("#ciclo_anioinicial").inputmask("isComplete") && $("#ciclo_aniofinal").inputmask("isComplete")){
                    //2 Verificar los años del ciclo escolar
                    if(anio_inicial>=anio_final){
                        $(".ciclo_escolar").addClass("has-error");
                        swal({
                            title:"Error:",
                            text: "El ciclo escolar es incorrecto",
                            type: "error",
                            allowOutsideClick: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: "Corregir"
                        });
                    }
                    else{

                        $('#boton_guardar').attr("disabled", true);

                        $.ajax({
                            type:"POST",
                            url:"{{route('guardarciclo')}}",
                            data: $("#form_nuevociclo").serialize(),
                            dataType : 'json',
                            success: function(data){
                                swal({
                                    title:"",
                                    text: data.message,
                                    type: "success",
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Continuar'
                                }).then(function(){
                                    window.location.replace("{{route('ciclos')}}");
                                }).catch(swal.noop);
                            },
                            error: function(xhr,status, response ){

                                //Obtener el valor de los errores devueltos por el controlador
                                var error = jQuery.parseJSON(xhr.responseText);
                                //Obtener los mensajes de error
                                var info = error.message;
                                if(error.integridad===true){
                                    console.log(error.message);
                                    swal({
                                        title: 'Error de duplicación',
                                        html: error.message,
                                        type: "error",
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: "Verificar"
                                    }).catch(swal.noop);

                                    $("#boton_guardar").removeAttr('disabled');


                                }
                                else
                                {
                                    //Crear la lista de errores
                                    var errorsHtml = '<ul>';
                                    $.each(info, function (key,value) {
                                        errorsHtml += '<li>' + value[0] + '</li>';
                                    });
                                    errorsHtml += '</ul>';
                                    //Mostrar el y/o los errores devuelto(s) por el controlador
                                    swal({
                                        title:"Error:",
                                        html: errorsHtml,
                                        type: "error",
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: "Corregir"
                                    }).catch(swal.noop);

                                    $("#boton_guardar").removeAttr('disabled');
                                }

                            }
                        });
                    }
                }else{
                    $(".ciclo_escolar").addClass("has-error");
                    swal({
                        title:"Error:",
                        text: "El ciclo escolar es incorrecto",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    }).catch(swal.noop);

                    $("#boton_guardar").removeAttr('disabled');


                }

                return false;
            });
        });
    </script>
@endsection