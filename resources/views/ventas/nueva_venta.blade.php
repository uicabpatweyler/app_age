@extends('templates.app_age')

@section('title', 'Venta de Libros y Playeras')

@section('content')

<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header"></section>

        <!-- Main content -->
        <section class="content">
            
            <div class="col-md-12">
                
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Venta de Libros y Playeras.  <strong><span class="text-red"> Recibo de venta: {{ ($folio->folio <100) ? '000' : '00'  }}{{$folio->folio}}</span></strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">

                            <input type="hidden" id="escuela_id" name="escuela_id">
                            <input type="hidden" id="ciclo_id" name="ciclo_id">
                            <input type="hidden" id="alumno_id" name="alumno_id">
                            <input type="hidden" id="grupo_id" name="grupo_id">
                            <input type="hidden" id="foliovta" name="foliovta" value="{{$folio->folio}}">


                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="nombre_escuela">Escuela: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="nombre_escuela" name="nombre_escuela" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ciclo_escolar">Ciclo: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="dt_fecha_venta">Fecha de venta: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="dt_fecha_venta" name="dt_fecha_venta" readonly>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nombre_alumno">Alumno: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn  btn-success pull-left" id="btn_elegir_alumno" data-toggle="modal" data-target="#modal_listado_alumnos">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="grupo_alumno">Grupo: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="grupo_alumno" name="grupo_alumno" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn  btn-dropbox pull-left" id="btn_pagar">
                                                    <i class="fa fa-usd" aria-hidden="true"></i>&nbsp;Pagar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn  btn-facebook pull-left" id="btn_imprimir" disabled>
                                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;Recibo</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Productos Agregados</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                <i class="fa fa-minus fa-lg"></i></button>

                            <button type="submit" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#modal_elegir_producto" title="Agregar Producto" style="margin-right: 5px;">
                                <i class="fa fa-plus-circle fa-lg"></i></button>

                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dt_items_compra" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 10%">Categoria</th>
                                <th style="width: 50%">Descripción</th>
                                <th style="width: 10%">Precio</th>
                                <th style="width: 10%">Cantidad</th>
                                <th style="width: 10%">Importe</th>
                                <th style="width: 10%"></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>

            <!-- Begin Modal Listado de Alumnos -->
            <div class="modal fade" id="modal_listado_alumnos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Elegir Alumno</h4>
                        </div>
                        <div class="modal-body">

                            <table id="dt_listado_alumnos" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th style="">escuela_id</th>
                                    <th style="">ciclo_id</th>
                                    <th style="">alumno_id</th>
                                    <th style="">grupo_id</th>
                                    <th>Ciclo</th>
                                    <th>Alumno</th>
                                    <th>Grupo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Listado de Alumnos -->

            <!-- Begin Modal Elegir Productos -->
            <div class="modal fade" id="modal_elegir_producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-green-active">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Elegir Producto</h4>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="categoria_id">Categoria (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="categoria_id" id="categoria_id" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elija una categoria]</option>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{$categoria->id}}">
                                                            {{$categoria->categprod_nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>

                            <table id="dt_productos" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID_C</th>
                                    <th style="width: 20%">Categoria</th>
                                    <th style="width: 60%">Descripcion</th>
                                    <th style="width: 10%">Precio</th>
                                    <th style="width: 10%"></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Elegir Productos -->

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

    moment.locale('es');

    //Date picker
    $('#dt_fecha_venta').datepicker({
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        format: "dd-MM-yyyy"
    });

    $('#categoria_id').select2({
        allowClear: true,
        placeholder: '[Elija una categoria]'
    });

    $("#cantidad_producto").bind('change keyup', function (e) {
        alert($(this).val());
    });

    var dataTableAlumnos;
    var dataTableProductos;
    var dataTableItemsCompra;
    var totalImporte   = 0;
    var totalArticulos = 0;
    var idSalidaProducto = 0;
    var urlRoot = "{{Request::root()}}";


    $("#btn_pagar").click(function(){
        if($('#nombre_alumno').val().length===0){
            swal({
                title: 'Atención',
                html: 'Los campos marcados con (*) son obligatorios',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if($('#dt_fecha_venta').val().length===0){
            swal({
                title: 'Atención',
                html: 'El campo Fecha de venta es obligatorio',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if ( ! $('#dt_items_compra').dataTable().api().data().any() ) {
            swal({
                title: 'Atención',
                html: 'Es necesario agregar al menos un producto a la venta actual.',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if ( ! $('#dt_items_compra').dataTable().api().data().any() ) {
            swal({
                title: 'Atencion',
                html: 'Es necesario agregar al menos un producto a la venta actual.',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if(verificaImporte()==false){
            swal({
                title: 'Atención',
                html: 'El total de la venta es de cero pesos',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if(verificaCantidades()==true){
            swal({
                title: 'Atención',
                html: 'Las cantidades y/o importes no pueden estar en ceros.',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else{
            swal({
                title: '¿Los datos de la venta son correctos?',
                html: '<strong>Productos: </strong>' + totalArticulos + ' ' + '<strong>Total a Pagar: </strong>' + '$ ' +  totalImporte.format(2),
                type: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Verificar',
                confirmButtonText:'Si, es correcto'
            }).then(function () {
                procesarVenta();
            }).catch(swal.noop);
        }
    });


    $("#btn_imprimir" ).click(function() {
        window.open(urlRoot+'/pdf_ReciboSalidaVenta/'+idSalidaProducto);
        return false;
    });

    function procesarVenta(){
        var ENCABEZADOVENTA  = [];
        var ITEMSVENTA       = [];
        var item = {};

        item['escuela_id']            = $('#escuela_id').val();
        item['ciclo_id']              = $('#ciclo_id').val();
        item['alumno_id']             = $('#alumno_id').val();
        item['grupo_id']              = $('#grupo_id').val();
        item['serie_recibo']          = 'SPV';
        item['folio_recibo']          = $('#foliovta').val();
        item['fecha_venta']           = moment($("#dt_fecha_venta").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD');
        item['cantidad_recibida_mxn'] = totalImporte;

        ENCABEZADOVENTA.push(item);

        $("input[name^='productoid_']").each(function(index,data) {
            var fila= $(this).val();

            item = {};

            item ['producto_id']     = $('#productoid_'+fila).val();
            item ['categoria_id']    = $('#categoriaid_'+fila).val();
            item ['precio_unitario'] = $('#preciovta_'+fila).val();
            item ['cantidad']        = $('#cantidad_'+fila).val();
            item ['fecha_venta']     = moment($("#dt_fecha_venta").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD');

            ITEMSVENTA.push(item);
        });

        INFO 	= new FormData();
        aInfo 	= JSON.stringify(ENCABEZADOVENTA);
        bInfo   = JSON.stringify(ITEMSVENTA);
        console.log(aInfo);
        console.log(bInfo);

        INFO.append('encabezado', aInfo);
        INFO.append('itemsventa', bInfo);

        $("#btn_pagar").attr("disabled", true);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: INFO,
            type: 'POST',
            url : ' {{route('salida_producto_store')}}',
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(data){
                swal({
                    title:"",
                    text: data.message,
                    type: "success",
                    allowOutsideClick: false,
                    confirmButtonText: 'Continuar'
                }).then(function(){
                    idSalidaProducto = data.salida_id;
                    $("#btn_imprimir").removeAttr('disabled');
                }).catch(swal.noop);
            },
            error: function(xhr,status, response ){

                $("#btn_pagar").removeAttr('disabled');

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
                    }).catch(swal.noop);
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
                }

            }
        });
    }

    function verificaImporte(){
        totalImporte = 0;
        $("input[name^='importe_']").each(function(index,data) {
            var auxImporte= $(this).val() * 1;
            totalImporte   = totalImporte + auxImporte;
        });
        if(totalImporte==0){
            return false;
        }
        return true;
    }

    function verificaCantidades(){
        var auxFlag = false;
        totalArticulos = 0;
        $("input[name^='cantidad_']").each(function(index,data) {
            var cant = $(this).val() * 1;
            totalArticulos = totalArticulos + cant;
            if(cant==0){
                auxFlag = true;
            }

        });
        return auxFlag;
    }

    dataTableItemsCompra = $('#dt_items_compra').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "language": {
            "url": "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
        },
        "columnDefs": [
            { "width": "10%", "targets": 0 },
            { "width": "50%", "targets": 1 },
            { "width": "10%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "10%", "targets": 4 },
            { "width": "10%", "targets": 5 }
        ]
    });



    //Select de las categorias
    $('#categoria_id').change(function (){
        var categoria_id = $(this).val();

        //El usuario no selecciono algun elemento
        if(categoria_id===null) {}

        //El usuario elimina la seleccion del select
        else if(categoria_id===""){}

        else{

            dataTableProductos = $('#dt_productos').DataTable({
                "ajax": urlRoot+'/lista_productos_categorias/'+categoria_id,
                "destroy": true,
                "scrollY":        "200px",
                "scrollCollapse": true,
                "paging":         false,
                "ordering": false,
                "language": {
                    "url": "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                },
                "columns" : [
                    { "data" : "id" },

                    { "data" : 'categoria_id'},

                    { "data" : null,
                        render : function ( data, type, full, meta ) {
                            return '<strong>'+data.nombre+'</strong>';
                        }
                    },

                    { "data" : null,
                        render : function ( data, type, full, meta ) {
                            if(data.info_adicional.length!=0){
                                return data.descripcion_venta.capitalize() + ' ('+data.info_adicional+')';
                            }else{
                                return data.descripcion_venta.capitalize();
                            }

                        }
                    },

                    { "data" : 'precio_venta',
                        render : $.fn.dataTable.render.number( ',', '.', 2)
                    },

                    { "data" : null,
                        "render": function ( data, type, full, meta ) {
                            var button='';
                            button += '<button name="'+"boton_elegir"+'" id="'+"boton_elegir"+'" type="'+"button"+'" class="'+"btn btn-xs btn-warning boton_elegir"+'">';
                            button += '<i class="'+"fa fa-hand-o-right fa-lg"+'" aria-hidden="'+"true"+'"></i>';
                            button += ' Elegir';
                            button += '</button>';
                            return button;
                        }
                    }
                ]
            });

        }
    });

    $('#dt_productos tbody').on( 'click', 'button', function () {

        var data = dataTableProductos.row( $(this).parents('tr') ).data();

        var inputIdProducto  = '';
        var inputIdCategoria = '';
        var inputPrecioVenta = '';
        var inputCantidad    = '';
        var inputImporte     = '';
        var botonEliminarProducto = '';


        inputIdProducto  += '<input name="'+"productoid_"+data['id']+'"  id="'+"productoid_"+data['id']+'"  type="'+"hidden"+'" class="'+"form-control"+'" value="'+data['id']+'">';
        inputIdCategoria += '<input name="'+"categoriaid_"+data['id']+'" id="'+"categoriaid_"+data['id']+'" type="'+"hidden"+'" class="'+"form-control"+'" value="'+data['categoria_id']+'">';
        inputPrecioVenta += '<input name="'+"preciovta_"+data['id']+'"   id="'+"preciovta_"+data['id']+'"   type="'+"text"+'"   class="'+"form-control"+'" value="'+data['precio_venta']+'" readonly>';
        inputPrecioVenta += inputIdProducto;
        inputPrecioVenta += inputIdCategoria;
        inputCantidad    += '<input name="'+"cantidad_"+data['id']+'"   id="'+"cantidad_"+data['id']+'" type="'+"number"+'" min="0"   class="'+"form-control"+'" value="0">';
        inputImporte     += '<input name="'+"importe_"+data['id']+'"   id="'+"importe_"+data['id']+'"   type="'+"text"+'"   class="'+"form-control"+'" value="0.00" readonly>';

        botonEliminarProducto += '<button name="'+"btn_delete"+'" id="'+"btn_delete"+'" type="'+"button"+'" class="'+"btn btn-xs btn-danger btn_delete"+'">';
        botonEliminarProducto += '<i class="'+"fa fa-trash-o fa-lg"+'" aria-hidden="'+"true"+'"></i>';
        botonEliminarProducto += ' Eliminar';
        botonEliminarProducto += '</button>';

        dataTableItemsCompra.row.add([
            data['nombre'],
            data['descripcion_venta'],
            inputPrecioVenta,
            inputCantidad,
            inputImporte,
            botonEliminarProducto
        ] ).draw();

        // $("#cantidad_"+data['id']).bind('change keyup', function (e) {
        $("#cantidad_"+data['id']).bind('change keyup',function () {
            //alert($(this).val());
            var fila     = $(this).attr("name").slice(9);
            var precio   = $('#preciovta_'+fila).val();
            var cantidad = $(this).val();
            var importe = precio * cantidad;
            $('#importe_'+fila).val(importe);
        });
    });

    //Remover el producto de la tabla
    $('#dt_items_compra tbody').on( 'click', 'button', function () {
        dataTableItemsCompra.row( $(this).parents('tr') ).remove().draw();
    });

    $('#modal_elegir_producto').on('hidden.bs.modal', function (event) {
        if ( $.fn.dataTable.isDataTable( '#dt_productos' ) ) {
            dataTableProductos.clear();
            dataTableProductos.destroy();
            $("#categoria_id").val('').trigger('change');

        }
        else {

        }
    });


    $('#modal_listado_alumnos').on('show.bs.modal', function (event) {
        if ( $.fn.dataTable.isDataTable( '#dt_listado_alumnos' ) ) {

        }
        else {
            dataTableAlumnos = $('#dt_listado_alumnos').DataTable({

                "ajax": urlRoot+'/dataTableAlumnos/',
                "paging": true,
                "destroy": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "language": {
                    "url": "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                },
                "columnDefs": [
                    { "visible": false, "targets": 0 },
                    { "visible": false, "targets": 1 },
                    { "visible": false, "targets": 2 },
                    { "visible": false, "targets": 3 }
                ],
                "columns": [
                    { "data": "escuela_id" },
                    { "data": "ciclo_id" },
                    { "data": "alumno_id" },
                    { "data": "grupo_id" },
                    { "data": "ciclo" },
                    { "data": "alumno" },
                    { "data": "grupo" },
                    { "data" : null,
                        "render": function ( data, type, full, meta ) {
                            var button='';
                            button += '<button name="'+"boton_elegir_alumno"+'" id="'+"boton_elegir_alumno"+'" type="'+"button"+'" class="'+"btn btn-xs btn-warning boton_elegir_alumno"+'">';
                            button += '<i class="'+"fa fa-hand-o-right fa-lg"+'" aria-hidden="'+"true"+'"></i>';
                            button += ' Elegir Alumno';
                            button += '</button>';
                            return button;
                        }
                    }
                ]
            });
        }
    });

    $('#dt_listado_alumnos tbody').on( 'click', 'button', function () {
        var data = dataTableAlumnos.row( $(this).parents('tr') ).data();

        $('#escuela_id').val(data['escuela_id']);
        $('#ciclo_id').val(data['ciclo_id']);
        $('#alumno_id').val(data['alumno_id']);
        $('#grupo_id').val(data['grupo_id']);

        $('#nombre_escuela').val(data['escuela']);
        $('#ciclo_escolar').val(data['ciclo']);
        $('#nombre_alumno').val(data['alumno']);
        $('#grupo_alumno').val(data['grupo']);

        $('#modal_listado_alumnos').modal('hide');
    });

    //https://stackoverflow.com/questions/2332811/capitalize-words-in-string/7592235
    String.prototype.capitalize = function() {
        return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
    };

    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };

});

</script>
@endsection