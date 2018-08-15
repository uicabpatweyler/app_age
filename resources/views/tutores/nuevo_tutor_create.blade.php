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
                <h1>Agregar Nuevo Tutor</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <form action="" role="form" method="post" id="form_datosdeltutor" name="form_datosdeltutor">
                        {{csrf_field()}}


                        <div class="box box-success">
                            <!-- box-header -->
                            <div class="box-header with-border">
                                <h3 class="box-title"> Datos del tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>

                            </div>
                            <!-- box-body -->
                            <div class="box-body">


                                <!-- Inicia fila para el nombre y apellido del tutor -->
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="tutor_nombre">Nombre del tutor:</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" placeholder="Nombre (*)" id="tutor_nombre" name="tutor_nombre" style="text-transform:capitalize" required minlength="2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label for="tutor_apellidopaterno">Apellidos:</label>
                                            <div class="row">
                                                <div class="col-xs-6 myerror">
                                                    <input type="text" class="form-control" placeholder="Apellido Paterno (*)" id="tutor_apellidopaterno" name="tutor_apellidopaterno" style="text-transform:capitalize" required minlength="2">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" placeholder="Apellido Materno" id="tutor_apellidomaterno" name="tutor_apellidomaterno" style="text-transform:capitalize">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Termina fila para el nombre y apellido del tutor -->

                                <!-- Inicia fila para el correo eléctronico del tutor -->
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="tutor_genero">Sexo (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <select name="tutor_genero" id="tutor_genero" class="form-control" style="width: 100%;" required>
                                                        <option value="" selected>[Elija una opción]</option>
                                                        <option value="H">Hombre</option>
                                                        <option value="M">Mujer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Termina fila para el correo eléctronico del tutor -->

                            </div>

                        </div>

                    </form>

                    <div class="box box-danger box-solid" id="div_lista_tutores">
                        <div class="box-header with-border">
                            <h3 class="box-title">Resultados de la busqueda</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped" id="lista_tutores">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">#</th>
                                    <th style="width: 90%;">Nombre del tutor</th>

                                </tr>
                                </thead>
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

@section('scripts')
    <script>
        $(document).ready(function(){

            $('#div_lista_tutores').hide();

            $('#tutor_genero').select2({
                allowClear: true,
                placeholder: '[Elija una opción]'
            });

            $("#form_datosdeltutor").validate({
                errorElement: "span",
                errorPlacement: function(error, element) {
                    $( element )
                            .closest( "form" )
                            .find( "label[for='" + element.attr( "id" ) + "']" )
                            .append( error );
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".myerror" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".myerror" ).addClass( "has-success" ).removeClass( "has-error" );
                },
                rules: {
                    tutor_nombre          : { required: true },
                    tutor_apellidopaterno : { required: true},
                    tutor_genero          : { required: true }
                },
                messages : {
                    tutor_nombre : {
                        required: " (Incorrecto)",
                        minlength: " (Incorrecto)"

                    },
                    tutor_apellidopaterno : {
                        required: " (Incorrecto)",
                        minlength: " (Incorrecto)"

                    },
                    tutor_genero:{
                        required: " requerido"
                    }
                },
                invalidHandler: function(event, validator) {
                    // 'this' refers to the form
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        var message = 'Los campos marcados con (*) son obligatorios.';
                        swal({
                            title:"Error:",
                            text: message,
                            type: "error",
                            allowOutsideClick: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: "Corregir"
                        });

                    }
                },
                submitHandler: function() {
                    swal({
                        title: '¿Desea guardar los datos del tutor?',
                        text: "",
                        type: 'warning',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'No',
                        confirmButtonText: 'Si'
                    }).then(function () {


                        //Enviamos los datos del tutor para verificar
                        $nombre = $("#tutor_nombre").val();
                        $ap     = $("#tutor_apellidopaterno").val();
                        if($("#tutor_apellidomaterno").val().length > 0){
                            $am     = $("#tutor_apellidomaterno").val();
                        }
                        else{
                            //Cuando el tutor no cuenta con apellido materno
                            $am     = "abcd";
                        }

                        $flag   = "1";

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "../verificar_datosTutor/"+$nombre+"/"+$ap+"/"+$am+"/"+$flag,
                            success: function(data){
                                //No se encontraron coincidencias con el nuevo tutor, procedemos a guardar los datos
                                //Llamamos a la funcion AJAX para enviar el formulario
                                ajaxSubmit();
                                //console.log('Continuar');
                            },
                            error  : function(xhr,status, response){
                                //Se encontro al menos 1 coincidencia con los datos proporcionados del nuevo tutor
                                //Obtener el valor de los errores devueltos por el controlador
                                var error = jQuery.parseJSON(xhr.responseText);

                                swal({
                                    title:"Error:",
                                    text: error.mensaje,
                                    type: "error",
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: "Verificar"
                                });


                                $flag = "2"

                                var i = 0;

                                $('#div_lista_tutores').show();

                                $('#lista_tutores').DataTable({
                                    paging: false,
                                    searching: false,
                                    ordering: false,
                                    info:true,
                                    destroy: true,
                                    ajax: "../verificar_datosTutor/"+$nombre+"/"+$ap+"/"+$am+"/"+$flag,
                                    columns: [
                                        { data: null,
                                            render: function(){
                                                i+=1;
                                                return '<b><p class="text-left">'+i+'</p></b>';
                                            }
                                        },
                                        { data: null,
                                            render: function(data, type, full, metas){
                                                var tutor = '';
                                                tutor += '<p class="text-left">';
                                                tutor += data.tutor_nombre.toUpperCase() +' '+data.tutor_apellidopaterno.toUpperCase() +' '+data.tutor_apellidomaterno.toUpperCase() ;
                                                tutor += '</p>';
                                                return tutor;
                                            }
                                        }
                                    ],
                                    language: {
                                        url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                                    }
                                })

                            }
                        });

                    })
                }
            });

            function ajaxSubmit(){
                $.ajax({
                    type:"POST",
                    url:"{{route('nuevo_tutor_store')}}",
                    data: $("#form_datosdeltutor").serialize(),
                    dataType : 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            window.location.replace("nuevo_tutor_elegirdireccion/"+data.tutor_id);
                        });
                    },
                    error: function(xhr,status, response ){
                        //Obtener el valor de los errores devueltos por el controlador
                        var error = jQuery.parseJSON(xhr.responseText);
                        //Obtener los mensajes de error
                        var info = error.message;
                        //Verificar si el mensaje proviene de una Excepcion al guardar los datos
                        var excepcion = error.exception;
                        if(excepcion===true)
                        {
                            var message_user = error.message_user;
                            var error_numeric_code = error.error_numeric_code;
                            var message_error = error.message_error;
                            swal({
                                title: (error_numeric_code != 0 )?'Codigo de Error: '+error_numeric_code : 'Error de Excepción',
                                html: (error_numeric_code != 0 )? message_error : message_user,
                                type: "error",
                                allowOutsideClick: false,
                                confirmButtonColor: '#d33',
                                confirmButtonText: "Reintentar"
                            });
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
                            });
                        }

                    }
                });
            }
        });
    </script>
@endsection