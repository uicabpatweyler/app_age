@extends('templates.app_age')

@section('title', 'Editar clasificacion')

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
                    Editar clasificación
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
                        <form class="form-horizontal" method="post" action="" name="form_clasificacion" id="form_clasificacion">
                            {{csrf_field()}}
                            <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">

                            <div class="box-body">

                                <div class="form-group">
                                    <label for="clasificacion_cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="clasificacion_cicloescolar" name="clasificacion_cicloescolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_id" class="col-sm-2 control-label"><p class="text-left">Escuela:</p></label>
                                    <div class="col-sm-5">
                                        <select name="escuela_id" id="escuela_id" class="form-control select_escuela_id" style="width: 100%;">
                                            @foreach($escuelas as $escuela)
                                                @if($escuela->id == $id_escuela)
                                                    <option value="{{$id_escuela}}" selected>
                                                        {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}
                                                    </option>
                                                @else
                                                    <option value="{{$escuela->id}}">
                                                        {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="clasificacion_nombre" class="col-sm-2 control-label"><p class="text-left">Clasificación:(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="clasificacion_nombre" name="clasificacion_nombre" placeholder="Clasificación" value="{{$clasificacion->clasificacion_nombre}}">
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-danger" href="{{route('clasificaciones')}}">
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
            $('.select_escuela_id').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elija una escuela]'
                }
            });

            $("#boton_enviar").click(function(){
                var escuela_id = $('.select_escuela_id').val();

                //Es necesario elegir la escuela
                if(escuela_id===null) {
                    swal({
                        title: "Error:",
                        text: "Es necesario elegir una escuela",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                //Se procede a validar el resto de los campos del formulario
                else{

                    jQuery.validator.setDefaults({
                        debug: true,
                        success: "valid"
                    });

                    $("#form_clasificacion").validate({
                        focusCleanup: true,
                        focusInvalid: false,
                        rules:{
                            clasificacion_nombre : { required: true }
                        },
                        messages:{
                            clasificacion_nombre : 'El campo clasificacion es obligatorio'
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
                    $.ajax({
                        type:"POST",
                        url:"{{route('updateclasificacion', $clasificacion->id)}}",
                        data: $("#form_clasificacion").serialize(),
                        dataType : 'json',
                        success: function(data){
                            swal({
                                title:"",
                                text: data.message,
                                type: "success",
                                allowOutsideClick: false,
                                confirmButtonText: 'Continuar'
                            }).then(function(){
                                window.location = "{{ route('clasificaciones') }}";
                            });
                        },
                        error: function(xhr,status, response ){
                            //Obtener el valor de los errores devueltos por el controlador
                            var error = jQuery.parseJSON(xhr.responseText);
                            //Obtener los mensajes de error
                            var info = error.message;
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
                    });
                }

            });

        });
    </script>
@endsection