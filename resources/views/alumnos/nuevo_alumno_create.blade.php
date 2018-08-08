@extends('templates.app_age')

@section('title', 'Agregar Nuevo Alumno')

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
                <h1>Agregar Nuevo Alumno</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">

                    <form action="" role="form" method="post" id="form_nuevoalumno_create" name="form_nuevoalumno_create">
                        {{csrf_field()}}
                        <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                        <input type="hidden" name="fecha_nacimiento" id="fecha_nacimiento">

                        <!-- Inicia: Datos Personales del alumno -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Datos del alumno</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="{{route('nuevo_alumno_index')}}" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>

                            </div>


                            <div class="box-body">

                                <!-- Fila para la escuela y el ciclo escolar -->
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="escuela_id">Escuela (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <select class="form-control" name="escuela_id" id="escuela_id" style="width: 100%;" required>
                                                        <option value="" selected="selected">[Elija una escuela]</option>
                                                        @foreach($escuelas as $escuela)
                                                            <option value="{{$escuela->id}}">
                                                                {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ciclo_escolar">Ciclo Escolar</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila para el nombre y apellidos del alumno -->
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alumno_primernombre">Nombre</label>
                                            <div class="row">
                                                <div class="col-xs-6 myerror">
                                                    <input type="text" class="form-control" placeholder="Primer Nombre (*)" id="alumno_primernombre" name="alumno_primernombre" style="text-transform:capitalize" required minlength="2">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" placeholder="Segundo Nombre" id="alumno_segundonombre" name="alumno_segundonombre" style="text-transform:capitalize">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alumno_apellidopaterno">Apellidos</label>
                                            <div class="row">
                                                <div class="col-xs-6 myerror">
                                                    <input type="text" class="form-control" placeholder="Apellido Paterno (*)" id="alumno_apellidopaterno" name="alumno_apellidopaterno" required minlength="2" style="text-transform:capitalize">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" placeholder="Apellido Materno" id="alumno_apellidomaterno" name="alumno_apellidomaterno" style="text-transform:capitalize">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Fila para la CURP, Fecha Nac., Edad y Sexo -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">C.U.R.P.</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control" id="alumno_curp" name="alumno_curp" value="{{$curp}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Fecha Nac.:</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="alumno_fechanacimiento" name="alumno_fechanacimiento" readonly>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Edad</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="alumno_edad" name="alumno_edad" readonly>
                                                        <span class="input-group-addon">años</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="alumno_genero">Sexo (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <select name="alumno_genero" id="alumno_genero" class="form-control" style="width: 100%;" required>
                                                        <option value="" selected>[Elija una opción]</option>
                                                        <option value="H">Hombre</option>
                                                        <option value="M">Mujer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /. box-body -->
                        </div>
                        <!-- /. box-success -->

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
<script>
    $(document).ready(function(){

        //Configuracion e inicializacion de las listas desplegables

        $('#escuela_id').select2({
            allowClear: true,
            placeholder: '[Elija una escuela]'
        });

        $('#alumno_genero').select2({
            allowClear: true,
            placeholder: '[Elegir]'
        });

        var curp = "{{$curp}}";
        var curp_split = curp.split(" ");
        var fecha_nac = curp_split[1];
        moment.locale('es');

        $("#alumno_fechanacimiento").val(moment(fecha_nac, "YYMMDD").format('DD-MMMM-YYYY'));

        //La fecha de nacimiento
        var a = moment(fecha_nac, "YYMMDD");
        a = moment(a,'MM/DD/YYYY');
        //La fecha actual
        var b = moment();

        //Diferencia de años entre la fecha actual y la fecha de nacimiento
        //para obtener la edad del alumno al dia en que se realiza la inscripción
        $("#alumno_edad").val(b.diff(a, 'years'));

        //https://jqueryvalidation.org/
        //https://jqueryvalidation.org/files/demo/
        //https://jqueryvalidation.org/files/demo/bootstrap/index.html

        $("#form_nuevoalumno_create").validate({
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
            rules : {
                escuela_id               : { required: true },
                alumno_primernombre      : { required: true },
                alumno_apellidopaterno   : { required: true },
                alumno_genero            : { required: true },
            },
            messages : {
                escuela_id : {
                    required: " requerido"

                },
                alumno_primernombre : {
                    required: " (Incorrecto)",
                    minlength: " (Incorrecto)"

                },
                alumno_apellidopaterno : {
                    required: " (Incorrecto)",
                    minlength: " (Incorrecto)"

                },
                alumno_genero :{
                    required: "(Incorrecto)"
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
                    title: '¿Desea guardar los datos del alumno?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si'
                }).then(function () {
                    //Obtenemos la fecha de nacimiento en el formato correcto yyyy-mm-dd
                    $("#fecha_nacimiento").val(moment(fecha_nac, "YYMMDD").format('YYYY-MM-DD'));
                    ajaxSubmitFormNuevoAlumno();
                })
            }
        });

        function ajaxSubmitFormNuevoAlumno(){
            $.ajax({
                type:"POST",
                url:"{{route('nuevo_alumno_store')}}",
                data: $("#form_nuevoalumno_create").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        if(data.coincidencia===true){
                            window.location.replace("../alumno_parentesco/"+data.id_alumno+"/"+data.ap+"/"+data.am+"/"+data.id_ciclo+"/"+data.id_escuela+"/");
                        }
                        else{
                            window.location.replace("../nuevo_alumno_datospersonales/"+data.id_alumno+"/"+data.id_ciclo+"/"+data.id_escuela+"/");
                        }
                        //window.location.replace("datos_tutor/"+data.id_alumno+"/"+data.id_ciclo+"/"+data.id_direccion);
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