@extends('templates.app_age')

@section('title', 'Editar Cuota de Colegiatura')

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
                    Editar cuota de colegiatura
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <a class="btn btn-xs btn-success" href="javascript:history.back(1)">
                                <i class="fa fa-reply fa-lg" aria-hidden="true"></i> Regresar</a>

                            <h3 class="box-title"> Ingrese los siguientes datos</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- /.box-header -->
                        <form class="form-horizontal" method="post" action="" name="form_cuotacolegiatura" id="form_cuotacolegiatura">
                            {{csrf_field()}}
                            <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$cuota->ciclo_id}}">
                            <input type="hidden" name="cuotacolegiatura_cuota2" id="cuotacolegiatura_cuota2">

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cicloescolar" name="cicloescolar" value="{{$cuota->CicloCDC->ciclo_anioinicial}}-{{$cuota->CicloCDC->ciclo_aniofinal}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_id" class="col-sm-2 control-label"><p class="text-left">Escuela:(*)</p></label>
                                    <div class="col-sm-5">
                                        <select name="escuela_id" id="escuela_id" class="form-control escuela_id" style="width: 100%;">
                                            <option value="-1" selected>[Elija una escuela]</option>
                                            @foreach($escuelas as $escuela)
                                                @if($escuela->id === $cuota->escuela_id)
                                                    <option value="{{$escuela->id}}" selected>
                                                        {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}</option>
                                                @else
                                                    <option value="{{$escuela->id}}">
                                                        {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}</option>
                                                @endif

                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cuotacolegiatura_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre:(*)</p></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="cuotacolegiatura_nombre" name="cuotacolegiatura_nombre" placeholder="Nombre para identificar a la cuota de colegiatura" value="{{$cuota->cuotacolegiatura_nombre}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cuotacolegiatura_cuota" class="col-sm-2 control-label"><p class="text-left">Cuota:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuotacolegiatura_cuota" name="cuotacolegiatura_cuota" value="{{$cuota->cuotacolegiatura_cuota}}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="cuotacolegiatura_disponible" class="col-sm-2 control-label"><p class="text-left"></p></label>
                                    <div class="col-sm-3">
                                        <label>
                                            @if($cuota->cuotacolegiatura_disponible === 0)
                                                <input type="checkbox" class="minimal" name="cuotacolegiatura_disponible" id="cuotacolegiatura_disponible">
                                            @else
                                                <input type="checkbox" class="minimal" checked name="cuotacolegiatura_disponible" id="cuotacolegiatura_disponible">
                                            @endif
                                            Cuota disponible &nbsp; &nbsp; &nbsp;
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

            $("#cuotacolegiatura_cuota").inputmask({
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
                var cuota = $('#cuotacolegiatura_cuota').inputmask('unmaskedvalue');
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
                        text: "Falta la cuota de la colegiatura.",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                else if(cuota==='0.00'){
                    swal({
                        title:"Error:",
                        text: "Falta la cuota de la colegiatura.",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                else
                {
                    //Asignamos al campo oculto la cuota de la colegiatura sin el signo de pesos o la coma
                    $('#cuotacolegiatura_cuota2').val(cuota);

                    //Validamos el resto de los campos de texto del formulario
                    jQuery.validator.setDefaults({
                        debug: true,
                        success: "valid"
                    });

                    $("#form_cuotacolegiatura").validate({
                        focusCleanup: true,
                        focusInvalid: false,
                        rules:{
                            cuotacolegiatura_nombre: { required: true },
                            cuotacolegiatura_cuota : { required: true}
                        },
                        messages:{
                            cuotacolegiatura_nombre : 'Falta el nombre de la cuota de colegiatura.',
                            cuotacolegiatura_cuota  : 'Incorrecto'
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
                    url:"{{route('update_cdc',$cuota->id)}}",
                    data: $("#form_cuotacolegiatura").serialize(),
                    dataType : 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            window.location.replace({{ route('cuotasdecolegiatura') }});
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