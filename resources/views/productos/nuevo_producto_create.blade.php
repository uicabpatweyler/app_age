@extends('templates.app_age')

@section('title', 'Agregar nuevo producto')

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
            <h1>
                Agregar nuevo producto
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <!-- form start -->
                <form action="" method="post" role="form" id="form_nuevo_producto" name="form_nuevo_producto">

                    {{csrf_field()}}
                    <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                    <input type="hidden" name="precio_venta_producto" id="precio_venta_producto">

                    <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ingrese los datos del nuevo producto</h3>
                        <small>Los campos marcados con <strong>(*)</strong> son obligatorios</small>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

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

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="categoria_id">Categoria (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="categoria_id" id="categoria_id" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elija una categoria]</option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="subcategoria_id">SubCategoria (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="subcategoria_id" id="subcategoria_id" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elegir SubCategoria]</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="clasificacion_id">Clasificación (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="clasificacion_id" id="clasificacion_id" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elegir clasificacion]</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nombre_producto">Nombre/Descripción del Producto(*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" style="text-transform:capitalize" placeholder="Nombre/Descripción del Producto" name="nombre_producto" id="nombre_producto" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="info_adicional_producto">Información Adicional</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" style="text-transform:capitalize" placeholder="Información Adicional" name="info_adicional_producto" id="info_adicional_producto">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-3">
                                    <div class="form-group precio_venta">
                                        <label for="precio_venta">Precio de Venta(*)</label>
                                        <div class="row">
                                            <div class="col-xs-6 myerror">
                                                <input type="text" class="form-control" placeholder="" name="precio_venta" id="precio_venta" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>


                    </div>

                    <div class="box-footer">
                        <a class="btn btn-social btn-danger" href="">
                            <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                        </a>

                        <button type="submit" class="btn  btn-social btn-dropbox pull-right" id="" name="" >
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar Datos</button>

                    </div>
                    <!-- /.box-footer -->



                </div>
                    <!-- /.box -->

                </form>
                <!-- form end -->

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

        $('#categoria_id').select2({
            allowClear: true,
            placeholder: '[Elija una categoria]'
        });

        $('#subcategoria_id').select2({
            allowClear: true,
            placeholder: '[Elegir SubCategoria]'
        });

        $('#clasificacion_id').select2({
            allowClear: true,
            placeholder: '[Elegir clasificacion]'
        });

        $("#precio_venta").inputmask({
            alias: 'numeric',
            groupSeparator : ',',
            autoGroup : true,
            digits : 2,
            digitsOptional: false,
            placeholder: '0',
            prefix: '$ '
        });

        //Desactivamos los selects de Categoria, SubCategoria y Clasificacion
        //El Select de Categorias se activa cuando el usuario elige una escuela
        $("#categoria_id").attr('disabled','-1');
        $("#subcategoria_id").attr('disabled','-1');
        $("#clasificacion_id").attr('disabled','-1');

        var urlRoot = "{{Request::root()}}";

        //Select de las escuelas
        $('#escuela_id').change(function () {
            var escuela_id = $(this).val();

            //El usuario no selecciono algun elemento
            if(escuela_id===null) {}

            //El usuario elimina la seleccion del select
            else if(escuela_id==="")
            {
                //Eliminamos el contenido de los select correspondientes
                $('#categoria_id').empty().change();
                $("#categoria_id").attr('disabled','-1');

                $("#subcategoria_id").attr('disabled','-1');
                $('#subcategoria_id').empty().change();

                $('#clasificacion_id').empty().change();
                $("#clasificacion_id").attr('disabled','-1');


            }

            else
            {
                //El usuario selecciono un elemento valido
                $("#categoria_id").removeAttr('disabled');

                //Consulta AJAX
                $.getJSON(urlRoot+'/lista_categorias/'+$('#ciclo_id').val()+'/'+escuela_id, null, function (values) {
                    $('#categoria_id').populateSelect(values);
                });
            }
        });

        //Select de las categorias
        $('#categoria_id').change(function (){
            var categoria_id = $(this).val();

            //El usuario no selecciono algun elemento
            if(categoria_id===null) {}

            //El usuario elimina la seleccion del select
            else if(categoria_id==="")
            {

                $("#subcategoria_id").attr('disabled','-1');
                $('#subcategoria_id').empty().change();

                $('#clasificacion_id').empty().change();
                $("#clasificacion_id").attr('disabled','-1');

            }

            else
            {
                //El usuario selecciono un elemento valido
                $("#subcategoria_id").removeAttr('disabled');

                //Consulta AJAX
                $.getJSON(urlRoot+'/lista_subcategorias/'+categoria_id, null, function (values) {
                    $('#subcategoria_id').populateSelect(values);
                });
            }

        });

        //Select de las SubCategorias
        $('#subcategoria_id').change(function (){
            var subcategoria_id = $(this).val();

            //El usuario no selecciono algun elemento
            if(subcategoria_id===null) {}

            //El usuario elimina la seleccion del select
            else if(subcategoria_id==="")
            {

                $('#clasificacion_id').empty().change();
                $("#clasificacion_id").attr('disabled','-1');

            }

            else
            {
                //El usuario selecciono un elemento valido
                $("#clasificacion_id").removeAttr('disabled');

                //Consulta AJAX
                $.getJSON(urlRoot+'/lista_clasificaciones/'+subcategoria_id, null, function (values) {
                    $('#clasificacion_id').populateSelect(values);
                });
            }

        });

        //Funcion para llenar los select con los datos devueltos mediante AJAX
        $.fn.populateSelect = function (values) {

            var options='';

            $.each(values, function (key, row) {
                options += '<option value="' + row.value + '">' + row.text + '</option>';
            });

            $(this).html(options);
        };

        $("#form_nuevo_producto").validate({
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
                escuela_id       : { required: true },
                categoria_id     : { required: true },
                subcategoria_id  : { required: true },
                clasificacion_id : { required: true },
                nombre_producto  : { required: true },
                precio_venta     : { required: true }

            },
            messages :{
                escuela_id       : { required: "requerido" },
                categoria_id     : { required: "requerido" },
                subcategoria_id  : { required: "requerido" },
                clasificacion_id : { required: "requerido" },
                nombre_producto  : { required: "requerido" },
                precio_venta     : { required: "requerido" }
            },
            invalidHandler: function(event, validator) {

                console.log($("#precio_venta").val());
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
                    }).catch(swal.noop);

                }
            },
            submitHandler: function() {
                swal({
                    title: '¿Desea guardar los datos del producto?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si'
                }).then(function () {

                    if($("#precio_venta").inputmask("hasMaskedValue")){
                        $("#precio_venta_producto").val($("#precio_venta").inputmask('unmaskedvalue'));
                    }

                    ajaxSubmitFormNuevoProducto();
                }).catch(swal.noop);

            }
        });

        function ajaxSubmitFormNuevoProducto(){
            $.ajax({
                type:"POST",
                url:"{{route('nuevo_producto_store')}}",
                data: $("#form_nuevo_producto").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title: (data.coincidencia===true) ? "Producto Duplicado" : "",
                        text: data.message,
                        type: (data.coincidencia===true) ? "error" :"success",
                        showCancelButton: (data.coincidencia===true) ? true : false,
                        showConfirmButton : (data.coincidencia===true) ? false : true,
                        cancelButtonText: (data.coincidencia===true) ? 'Verificar' : '',
                        cancelButtonColor: (data.coincidencia===true) ? '#d33' : '',
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location.replace("{{route('productos_index')}}");
                    }).catch(swal.noop);
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