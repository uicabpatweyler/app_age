@extends('templates.app_age')

@section('title', 'Hoja de Inscripción')

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

                    <form action="" role="form" method="post" id="form_nuevotutor_datospersonales" name="form_nuevotutor_datospersonales">
                        {{csrf_field()}}
                        <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                        <input type="hidden" name="tutor_id" id="tutor_id" value="{{$tutor->id}}">


                        <!-- Inicia: Datos Personales del tutor -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Datos personales del tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>

                            </div>


                            <div class="box-body">

                                <!-- Fila para el nombre y apellidos del tutor -->
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tutor_nombre">Nombre</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="{{$tutor->tutor_nombre}}" id="tutor_nombre" name="tutor_nombre" style="text-transform:capitalize"  disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tutor_apellidos">Apellidos</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="{{$tutor->tutor_apellidopaterno}} {{$tutor->tutor_apellidomaterno}}" placeholder="" id="tutor_apellidos" name="tutor_apellidos" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Fila para el ciclo escolar y el correo electronico del tutor-->
                                <div class="row">

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

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tutor_email">Correo Electronico</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control" id="tutor_email" name="tutor_email" placeholder="Correo Electrónico del Tutor">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <!-- Fila para la CURP, Fecha Nac., Edad y Sexo -->
                                <div class="row">

                                </div>
                                <br />
                                <!-- Fila para el TabPanel de Dirección, Telefonos y Otros Datos -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- Begin Custom Tabs -->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-address-card fa-lg" aria-hidden="true"></i>&nbsp; Dirección</a></li>
                                                <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;Telefonos</a></li>
                                                <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>&nbsp;Lugar de Trabajo</a></li>

                                            </ul>

                                            <div class="tab-content">

                                                <div class="tab-pane active" id="tab_1">

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="">Tipo de Vialidad</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="" id="tipo_vialidad" name="tipo_vialidad" value="{{$dp->tipo_vialidad}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label for="nombre_vialidad">Nombre de vialidad (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Nombre de Vialidad" id="nombre_vialidad" name="nombre_vialidad" value="{{$dp->nombre_vialidad}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="numero_exterior">Num. Ext. (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Num. Ext." id="numero_exterior" name="numero_exterior" value="{{$dp->numero_exterior}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="">Num. Int.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Num. Int." id="numero_interior" value="{{$dp->numero_interior}}" style="text-transform:capitalize" name="numero_interior" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para la direccion -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="entre_calles">Entre Calles</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Entre Calles" id="entre_calles" name="entre_calles" value="{{$dp->entre_calles}}" style="text-transform:capitalize" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="referencias_adicionales">Referencias Adicionales</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Referencias Adicionales" id="referencias_adicionales" name="referencias_adicionales" value="{{$dp->referencias_adicionales}}" style="text-transform:capitalize" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para los select de Estado, Delegacion/Municipio y Colonia -->
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="entidad_federativa">Estado (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="" id="entidad_federativa" name="entidad_federativa" value="{{$dp->entidad_federativa}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_delegacion">Deleg/Munic. (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="" id="delegacion_municipio" name="delegacion_municipio" value="{{$dp->delegacion_municipio}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">

                                                        </div>
                                                    </div>

                                                    <!-- Fila para los input text del nombre de la localidad, colonia y codigo postal -->
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="nombre_localidad">Localidad (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="nombre_localidad" id="nombre_localidad" value="{{$dp->nombre_localidad}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="tipo_asentamiento">Tipo Asentamiento(*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="tipo_asentamiento" id="tipo_asentamiento" value="{{$dp->tipo_asentamiento}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="nombre_asentamiento">Nombre Asentamiento(*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="nombre_asentamiento" id="nombre_asentamiento" value="{{$dp->nombre_asentamiento}}" style="text-transform:capitalize" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="codigo_postal">C.P.(*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="00000" name="codigo_postal" id="codigo_postal" value="{{$dp->codigo_postal}}" required disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.tab-pane Dirección -->

                                                <div class="tab-pane" id="tab_2">
                                                    <!-- Fila los telefonos de contacto del alumno -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Teléfono de casa</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_casa" id="telefono_casa" value="">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia1" id="referencia1" style="text-transform:capitalize" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Telefono del trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_trabajo" id="telefono_trabajo" value="">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia2" id="referencia2" style="text-transform:capitalize" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Celular</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_celular" id="telefono_celular" value="">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia3" id="referencia3" style="text-transform:capitalize" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Otro</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_otro" id="telefono_otro" value="">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia4" id="referencia4" style="text-transform:capitalize" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane Telefonos -->

                                                <!-- tab-pane Lugar de Trabajo -->
                                                <div class="tab-pane" id="tab_3">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label for="tutor_lugartrabajo">Nombre del lugar de trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Nombre del lugar de trabajo" id="tutor_lugartrabajo" name="tutor_lugartrabajo" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_lugartrabajo">Dirección del lugar de trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Dirección del lugar de trabajo" id="tutor_direccion_lugartrabajo" name="tutor_direccion_lugartrabajo" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="colonia_direccion_lugartrabajo">Colonia del lugar de trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Colonia del lugar de trabajo" id="colonia_direccion_lugartrabajo" name="colonia_direccion_lugartrabajo" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="cp_direccion_lugartrabajo">Código Postal</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Código Postal" id="cp_direccion_lugartrabajo" name="cp_direccion_lugartrabajo" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="estado_direccion_lugartrabajo">Estado</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="" id="estado_direccion_lugartrabajo" name="estado_direccion_lugartrabajo" style="text-transform:capitalize" value="Quintana Roo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="delegacion_direccion_lugartrabajo">Delegación/Municipio</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="" id="delegacion_direccion_lugartrabajo" name="delegacion_direccion_lugartrabajo" style="text-transform:capitalize" value="Othón P. Blanco">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="localidad_direccion_lugartrabajo">Ciudad/Localidad</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="" id="localidad_direccion_lugartrabajo" name="localidad_direccion_lugartrabajo" style="text-transform:capitalize" value="Chetumal">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.tab-pane Lugar de Trabajo -->



                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- End Custom Tabs -->
                                    </div>
                                    <!-- /. col-sm-12 -->
                                </div>
                                <!-- Termina Fila para el TabPanel de Dirección, Telefonos y Otros Datos -->
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


            $("#telefono_casa").inputmask("(999)-999-9999");
            $("#telefono_trabajo").inputmask("(999)-999-9999");
            $("#telefono_celular").inputmask("(999)-999-9999");
            $("#telefono_otro").inputmask("(999)-999-9999");
            //email mask
            $("#tutor_email").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: false,
                onBeforePaste: function (pastedValue, opts) {
                    pastedValue = pastedValue.toLowerCase();
                    return pastedValue.replace("mailto:", "");
                },
                definitions: {
                    '*': {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            });

            $("#form_nuevotutor_datospersonales").validate({
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
                rules:{
                    nombre_vialidad          : { required: true },
                    numero_exterior          : { required: true },
                    tipo_asentamiento        : { required: true },
                    nombre_asentamiento      : { required: true },
                    codigo_postal            : { required: true },
                    nombre_localidad         : { required: true },
                    entidad_federativa      : { required: true },
                    delegacion_municipio     : { required: true },
                    direccion_colonia        : { required: true }
                },
                messages :{
                    nombre_vialidad:{
                        required: " requerido"
                    },
                    numero_exterior : {
                        required: " requerido"
                    },
                    tipo_asentamiento : {
                        required: " requerido"
                    },
                    nombre_asentamiento : {
                        required: " requerido"
                    },
                    codigo_postal : {
                        required: " requerido"
                    },
                    nombre_localidad    : {
                        required: " requerido"
                    },
                    entidad_federativa  : {
                        required: " requerido"
                    },
                    delegacion_municipio : {
                        required: " requerido"
                    },
                    direccion_colonia : {
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
                        activarDireccion('disabled')
                        ajaxSubmit();
                    })
                }
            });

            function ajaxSubmit(){
                $.ajax({
                    type:"POST",
                    url:"{{route('nuevo_tutor_datospersonales_store')}}",
                    data: $("#form_nuevotutor_datospersonales").serialize(),
                    dataType : 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            window.location.replace("{{route('nuevo_tutor_create')}}");
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

            function activarDireccion($valor){
                $("#tipo_vialidad").removeAttr($valor);
                $("#nombre_vialidad").removeAttr($valor);
                $("#numero_exterior").removeAttr($valor);
                $("#numero_interior").removeAttr($valor);
                $("#entre_calles").removeAttr($valor);
                $("#referencias_adicionales").removeAttr($valor);
                $("#entidad_federativa").removeAttr($valor);
                $("#delegacion_municipio").removeAttr($valor);
                $("#nombre_localidad").removeAttr($valor);
                $("#tipo_asentamiento").removeAttr($valor);
                $("#nombre_asentamiento").removeAttr($valor);
                $("#codigo_postal").removeAttr($valor);

            }


        });
    </script>
@endsection