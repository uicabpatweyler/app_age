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
                            <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="grupo_cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="grupo_cicloescolar" name="grupo_cicloescolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_id" class="col-sm-2 control-label"><p class="text-left">Escuela:(*)</p></label>
                                    <div class="col-sm-5">
                                        <select name="escuela_id" id="escuela_id" class="form-control escuela_id" style="width: 100%;">
                                            <option value="-1" selected>[Elija una escuela]</option>
                                            @foreach($escuelas as $escuela)
                                                <option value="{{$escuela->id}}">
                                                    {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="clasificacion_id" class="col-sm-2 control-label"><p class="text-left">Clasificación:(*)</p></label>
                                    <div class="col-sm-3">
                                        <select name="clasificacion_id" id="clasificacion_id" class="form-control clasificacion_id" style="width: 100%;" disabled>
                                            <option value="-1" selected>[Elegir clasificación]</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre:(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="grupo_nombre" name="grupo_nombre">
                                    </div>
                                    <label for="grupo_alumnospermitidos" class="col-sm-2 control-label"><p class="text-left">Alumnos Permitidos:(*)</p></label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="grupo_alumnospermitidos" name="grupo_alumnospermitidos">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_disponible" class="col-sm-2 control-label"><p class="text-left"></p></label>
                                    <div class="col-sm-3">
                                        <label>
                                            Grupo disponible &nbsp; &nbsp; &nbsp;
                                            <input type="checkbox" class="minimal" checked name="grupo_disponible" id="grupo_disponible">
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

            $('.escuela_id').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elija una escuela]'
                }
            });

            $('.clasificacion_id').select2({
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

            $('.escuela_id').change(function () {

                //Activamos el select de las clasificaciones
                $(".clasificacion_id").removeAttr('disabled');
                //Si el select contenia otros elementos estos se eliminan
                $('.clasificacion_id').empty().change();
                //Obtenemos el id del valor seleccionado del select de las escuelas
                var escuela_id = $(this).val();
                //Los parametros de la consulta son el ID de la escuela seleccionada
                $.getJSON('/listaAjaxClasifPorEscuela/'+escuela_id, null, function (values) {
                    $('.clasificacion_id').populateSelect(values);
                });
            });

            $.fn.populateSelect = function (values) {
                var options = '';
                $.each(values, function (key, row) {
                    options += '<option value="' + row.value + '">' + row.text + '</option>';
                });
                $(this).html(options);
            }

            $("#boton_enviar").click(function(event){
                //event.preventDefault();

                //Obtenemos los valores de los select
                var escuela_id = $('.escuela_id').val();
                var clasificacion_id = $('.clasificacion_id').val();

                //Obtenemos los valores de los cuadros de texto
                var grupo_nombre = $('#grupo_nombre').val().length;
                var grupo_alumnospermitidos = $('#grupo_alumnospermitidos').val().length;

                //1) Verificamos que el usuario haya elegido una escuela del select
                if(escuela_id==="-1")
                {
                    swal({
                        title:"Error:",
                        text: "Es necesario elegir una escuela",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                //2) Verificamos que el usuario haya elegido una clasificacion para el grupo
                else if(clasificacion_id==="-1")
                {
                    swal({
                        title:"Error:",
                        text: "Debe elegir una clasificación para el grupo",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                else
                {
                    //Validamos el resto de los campos de texto del formulario
                    jQuery.validator.setDefaults({
                        debug: true,
                        success: "valid"
                    });

                    $("#form_grupo").validate({
                        focusCleanup: true,
                        focusInvalid: false,
                        rules:{
                            grupo_nombre            : { required: true },
                            grupo_alumnospermitidos : { required: true}
                        },
                        messages:{
                            grupo_nombre            : 'Falta el nombre del grupo',
                            grupo_alumnospermitidos : 'Incorrecto'
                        },
                        invalidHandler: function(event, validator) {
                            // 'this' refers to the form
                            var errors = validator.numberOfInvalids();
                            if (errors) {
                                var message = 'El formulario es incorrecto.';
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
                        submitHandler: function(form) {
                            ajaxSubmit();
                        }
                    });
                }

                function ajaxSubmit(){

                    $('#boton_enviar').attr("disabled", true);

                    $.ajax({
                        type:"POST",
                        url:"{{route('guardargrupo')}}",
                        data: $("#form_grupo").serialize(),
                        dataType : 'json',
                        success: function(data){
                            swal({
                                title:"",
                                text: data.message,
                                type: "success",
                                allowOutsideClick: false,
                                confirmButtonText: 'Continuar'
                            }).then(function(){
                                window.location.replace("{{ route('grupos') }}");
                            });
                        },
                        error: function(xhr,status, response ){
                            //Obtener el valor de los errores devueltos por el controlador
                            var error = jQuery.parseJSON(xhr.responseText);
                            //Obtener los mensajes de error
                            var info = error.message;
                            var extra = error.extra;
                            if(extra===true){
                                swal({
                                    title:"Error:",
                                    html: info,
                                    type: "error",
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: "Corregir"
                                });

                                $("#boton_enviar").removeAttr('disabled');
                            }
                            else {
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

                                $("#boton_enviar").removeAttr('disabled');

                            }

                        }
                    });
                }

            });

        });
    </script>
@endsection