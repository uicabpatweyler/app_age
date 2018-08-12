@extends('templates.app_age')

@section('title', 'Nueva Cuota de Inscripción')

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
                    Crear nueva cuota de inscripción
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
                        <form class="form-horizontal" method="post" action="" name="form_cuotainscripcion" id="form_cuotainscripcion">
                            {{csrf_field()}}
                            <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                            <input type="hidden" name="cuotainscripcion_cuota2" id="cuotainscripcion_cuota2">

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
                                        <label for="cuotainscripcion_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre:(*)</p></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="cuotainscripcion_nombre" name="cuotainscripcion_nombre" placeholder="Nombre para identificar a la cuota de inscripción">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cuotainscripcion_cuota" class="col-sm-2 control-label"><p class="text-left">Cuota:(*)</p></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="cuotainscripcion_cuota" name="cuotainscripcion_cuota">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="cuotainscripcion_disponible" class="col-sm-2 control-label"><p class="text-left"></p></label>
                                        <div class="col-sm-3">
                                            <label>
                                                Cuota disponible &nbsp; &nbsp; &nbsp;
                                                <input type="checkbox" class="minimal" checked name="cuotainscripcion_disponible" id="cuotainscripcion_disponible">
                                            </label>
                                        </div>
                                    </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <a class="btn btn-danger" href="javascript:history.back(1)">
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

            $("#cuotainscripcion_cuota").inputmask({
                alias: 'numeric',
                groupSeparator : ',',
                autoGroup : true,
                digits : 2,
                digitsOptional: false,
                placeholder: '0',
                prefix: '$ '
            });

            $('.escuela_id').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elija una escuela]'
                }
            });

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });

            $("#boton_enviar").click(function(){
                //https://github.com/RobinHerbots/Inputmask#unmaskedvalue
                //Get the unmaskedvalue
                //Obtenemos el valor de la cuota sin el signo de pesos, ya que el campo de la tabla no admite el simbolo de '$'
                var cuota = $('#cuotainscripcion_cuota').inputmask('unmaskedvalue');
                //Eliminamos los espacios en blanco de la cuota de inscripcion (en caso que existan)
                cuota = $.trim(cuota);

                //Obtenemos los valores de los select
                var escuela_id = $('.escuela_id').val();

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
                else if(cuota.length === 0)
                {
                    swal({
                        title:"Error:",
                        text: "Falta la cuota de inscripción.",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                else if(cuota==='0.00')
                {
                    swal({
                        title:"Error:",
                        text: "Falta la cuota de inscripción.",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                else{

                    $('#cuotainscripcion_cuota2').val(cuota);

                    //Validamos el resto de los campos de texto del formulario
                    jQuery.validator.setDefaults({
                        debug: true,
                        success: "valid"
                    });

                    $("#form_cuotainscripcion").validate({
                        focusCleanup: true,
                        focusInvalid: false,
                        rules:{
                            cuotainscripcion_nombre: { required: true },
                            cuotainscripcion_cuota : { required: true}
                        },
                        messages:{
                            cuotainscripcion_nombre : 'Falta el nombre de la cuota a crear',
                            cuotainscripcion_cuota  : 'Incorrecto'
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
            });

            function ajaxSubmit(){

                $('#boton_enviar').attr("disabled", true);

                $.ajax({
                    type:"POST",
                    url:"{{route('guardarcuota_cdi')}}",
                    data: $("#form_cuotainscripcion").serialize(),
                    dataType : 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            window.location.replace("{{ route('cuotasdeinscripcion') }}");
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
    </script>
@endsection