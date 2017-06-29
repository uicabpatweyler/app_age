@extends('templates.app_age')

@section('title', 'Editar Escuela')

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
            <h1>Editar Escuela</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ingrese los siguientes datos</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                    </div>

                    <form action="" class="form-horizontal" method="post" id="form_escuela">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="escuela_tiposervicio" class="col-sm-2 control-label"><p class="text-left">Tipo de Servicio:(*)</p></label>
                                <div class="col-sm-3">
                                    <select id="escuela_tiposervicio" name="escuela_tiposervicio" class="form-control escuela_tiposervicio" style="width: 100%;">

                                        @foreach($tiposdeservicio as $tipodeservicio)
                                            @if($escuela->escuela_tiposervicio === $tipodeservicio->id)
                                                <option value="{{$tipodeservicio->id}}" selected>{{$tipodeservicio->tiposervicio_nombre}}</option>
                                            @else
                                                <option value="{{$tipodeservicio->id}}">{{$tipodeservicio->tiposervicio_nombre}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <select id="escuela_nivel" name="escuela_nivel" class="form-control escuela_nivel" style="width: 100%;">

                                        @foreach($niveles as $nivel)
                                            @if($escuela->escuela_nivel === $nivel->id)
                                                <option value="{{$nivel->id}}" selected>{{$nivel->nivel_nombre}}</option>
                                            @else
                                                <option value="{{$nivel->id}}">{{$nivel->nivel_nombre}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-sm-3">
                                    <select id="escuela_servicio" name="escuela_servicio" class="form-control escuela_servicio" style="width: 100%;">
                                        @foreach($servicios as $servicio)
                                            @if($escuela->escuela_servicio === $servicio->id)
                                                <option value="{{$servicio->id}}" selected>{{$servicio->servicio_nombre}}</option>
                                            @else
                                                <option value="{{$servicio->id}}">{{$servicio->servicio_nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="escuela_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre:(*)</p></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="escuela_nombre" name="escuela_nombre" placeholder="Nombre de la escuela" value="{{$escuela->escuela_nombre}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escuela_clavect" class="col-sm-2 control-label"><p class="text-left">Clave:(*)</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_clavect" name="escuela_clavect" placeholder="Clave CT" value="{{$escuela->escuela_clavect}}">
                                </div>

                                <label for="escuela_numincorporacion" class="col-sm-2 control-label">Incorporación:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="escuela_numincorporacion" name="escuela_numincorporacion" placeholder="Num. Acuerdo Incorporación" value="{{$escuela->escuela_numincorporacion}}">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="escuela_direccion" class="col-sm-2 control-label"><p class="text-left">Dirección(*)</p></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="escuela_direccion" name="escuela_direccion" placeholder="Direccion" value="{{$escuela->escuela_direccion}}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="escuela_numexterior" name="escuela_numexterior" placeholder="Num. Ext." value="{{$escuela->escuela_numexterior}}">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="escuela_numinterior" name="escuela_numinterior" placeholder="Num. Int." value="{{$escuela->escuela_numinterior}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escuela_referencia" class="col-sm-2 control-label"><p class="text-left">Referencias(*)</p></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="escuela_referencia" name="escuela_referencia" placeholder="Cruzamientos/Esquina/Entre Calles" value="{{$escuela->escuela_referencia}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escuela_estado" class="col-sm-2 control-label"><p class="text-left">Estado(*)</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_estado" name="escuela_estado" value="{{$escuela->escuela_estado}}">
                                </div>
                                <label for="escuela_delegacion" class="col-sm-2 control-label">Delegación/Municipio(*)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_delegacion" name="escuela_delegacion" value="{{$escuela->escuela_delegacion}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escuela_localidad" class="col-sm-2 control-label"><p class="text-left">Localidad(*)</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_localidad" name="escuela_localidad" value="{{$escuela->escuela_localidad}}">
                                </div>
                                <label for="escuela_colonia" class="col-sm-2 control-label">Colonia(*)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_colonia" name="escuela_colonia" value="{{$escuela->escuela_colonia}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escuela_codpost" class="col-sm-2 control-label"><p class="text-left">Código Postal(*)</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_codpost" name="escuela_codpost" value="{{$escuela->escuela_codpost}}">
                                </div>
                                <label for="escuela_pais" class="col-sm-2 control-label">País(*)</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_pais" name="escuela_pais" value="{{$escuela->escuela_pais}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="escuela_telefono" class="col-sm-2 control-label"><p class="text-left">Teléfono</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_telefono" name="escuela_telefono" placeholder="(983)-000-0000" value="{{$escuela->escuela_telefono}}">
                                </div>
                                <label for="escuela_email" class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="escuela_email" name="escuela_email" placeholder="usuario@dominio.com" value="{{$escuela->escuela_email}}">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">

                            <a class="btn btn-danger" href="{{route('escuelas')}}">
                                <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                            <button type="submit" class="btn btn-primary pull-right" id="boton_enviar" name="boton_enviar">
                                <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar Datos</button>
                        </div>

                    </form>

                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->

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

            $("#escuela_clavect").inputmask("9{2}A{3}9{4}A{1}");
            $("#escuela_numincorporacion").inputmask("A{4}9{5}A{2}");
            $("#escuela_telefono").inputmask("(999)-999-9999");

            $('.escuela_tiposervicio').select2({
                allowClear: false,
                placeholder: {
                    id: "-1",
                    text: '[Elija una opción]'
                }
            });

            $('.escuela_nivel').select2({
                allowClear: false,
                placeholder: {
                    id: "-1",
                    text: '[Seleccione un nivel]'
                }
            });

            $('.escuela_servicio').select2({
                allowClear: false,
                placeholder: {
                    id: "-1",
                    text: '[Tipo de Servicio]'
                }
            });

            $.fn.populateSelect = function (values) {
                var options = '';
                $.each(values, function (key, row) {
                    options += '<option value="' + row.value + '">' + row.text + '</option>';
                });
                $(this).html(options);
            }

            $('.escuela_tiposervicio').change(function () {

                $('.escuela_nivel').empty().change();
                $('.escuela_servicio').empty().change();

                var tiposervicio_id = $(this).val();

                $.getJSON('/listaAjaxNiveles/'+tiposervicio_id, null, function (values) {
                    $('.escuela_nivel').populateSelect(values);
                });

            });

            $('.escuela_nivel').change(function () {
                var nivel_id = $(this).val();
                if(nivel_id===null){}
                else{
                    $(".escuela_servicio").empty().change();
                    $.getJSON('/listaAjaxServicios/'+nivel_id, null, function (values) {
                        $('.escuela_servicio').populateSelect(values);
                    });
                }
            });

            $("#boton_enviar").click(function(){
                //1) El usuario debe elegir un valor del select Tipo de Servicio
                var tiposervicio_id = $('.escuela_tiposervicio').val();
                if(tiposervicio_id==="-1"){
                    swal({
                        title:"Error:",
                        text: "Falta el tipo de servicio de la escuela",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                //2) El usuario debe elegir un valor del select Nivel
                else if($(".escuela_nivel").prop('disabled')===false && $('.escuela_nivel').val()==="-1"){
                    swal({
                        title:"Error:",
                        text: "Falta el nivel de la escuela",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false;
                }
                //3) EL usuario debe elegir un valor del select Servicio
                else if($(".escuela_servicio").prop('disabled')===false && $('.escuela_servicio').val()==="-1"){
                    swal({
                        title:"Error:",
                        text: "Falta el servicio que ofrecera la escuela",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                    return false
                }
                //Se procede a validar el resto de los campos del formulario
                else{
                    jQuery.validator.setDefaults({
                        debug: true,
                        success: "valid"
                    });

                    $("#form_escuela").validate({
                        focusCleanup: true,
                        focusInvalid: false,
                        rules:{
                            escuela_nombre      : { required: true },
                            escuela_clavect     : { required: true },
                            escuela_direccion   : { required: true },
                            escuela_numexterior : { required: true },
                            escuela_referencia  : { required: true },
                            escuela_colonia     : { required: true },
                            escuela_codpost     : { required: true },
                            escuela_delegacion  : { required: true },
                            escuela_localidad   : { required: true },
                            escuela_estado      : { required: true },
                            escuela_pais        : { required: true }

                        },
                        messages:{
                            escuela_nombre      : 'El nombre de la escuela es obligatorio',
                            escuela_clavect     : 'Campo obligatorio',
                            escuela_direccion   : 'Falta la dirección',
                            escuela_numexterior : 'Falta el num. ext.',
                            escuela_referencia  : 'Este campo es obligatorio',
                            escuela_colonia     : 'Este campo es obligatorio',
                            escuela_codpost     : 'Este campo es obligatorio',
                            escuela_delegacion  : 'Este campo es obligatorio',
                            escuela_localidad   : 'Este campo es obligatorio',
                            escuela_estado      : 'Este campo es obligatorio',
                            escuela_pais        : 'Este campo es obligatorio'

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
                //Validar las entradas de los inputmask
                if( $("#escuela_clavect").inputmask("isComplete")){
                    //alert('Enviar formulario por ajax.');
                    $.ajax({
                        type:"POST",
                        url:"{{route('updateescuela', $escuela->id)}}",
                        data: $("#form_escuela").serialize(),
                        dataType : 'json',
                        success: function(data){
                            swal({
                                title:"",
                                text: data.message,
                                type: "success",
                                allowOutsideClick: false,
                                confirmButtonText: 'Continuar'
                            }).then(function(){
                                window.location = "{{ route('escuelas') }}";
                            });;
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
                else{
                    swal({
                        title:"Error:",
                        text: "La clave del centro de trabajo es incorrecta.",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                }
            }

        });
    </script>
@endsection