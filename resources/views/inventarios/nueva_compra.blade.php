@extends('templates.app_age')

@section('title', 'Nueva Compra')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Entrada Por Compra
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">


                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Personalizar Entrada</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-warning btn-sm pull-right" data-toggle="modal" data-target="#modal_detalles_compra">
                                <i class="fa fa fa-gears"></i></button>

                            <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#modal_elegir_producto" style="margin-right: 5px;">
                                <i class="fa fa-plus"></i></button>

                            <button type="button" class="btn btn-primary btn-sm pull-right" title="Guardar" style="margin-right: 5px;" id="boton_guardar" name="boton_guardar">
                                <i class="fa fa-floppy-o fa-lg"></i></button>

                            <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                        </div>

                    </div>

                    <div class="box-body">

                        <table id="dt_items_compra" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 40%">Producto</th>
                                <th style="width: 15%">Costo</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 15%">Importe</th>
                                <th style="width: 15%"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
        </section>
        <!-- /.content -->

        <!-- Begin Modal Detalles de la Compra -->
        <div class="modal fade" id="modal_detalles_compra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-orange">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detalles de la compra</h4>
                    </div>
                    <form action="" role="form" id="form_detalles_compra" name="form_detalles_compra">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="select_escuela">Escuela (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="select_escuela" id="select_escuela" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elija una escuela]</option>
                                                    @foreach($escuelas as $escuela)
                                                        <option value="{{$escuela->id}}">
                                                            {{$escuela->escuela_nombre}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="ciclo_escolar">Ciclo Escolar(*)</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="serie_folio">Serie-Folio (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                @if($seriefolio->folio<=9)
                                                    <input type="text" class="form-control" id="serie_folio" name="serie_folio" value="{{$seriefolio->serie}}-00000{{$seriefolio->folio}}" readonly>
                                                @elseif($seriefolio->folio>=10 && $seriefolio->folio<=99)
                                                    <input type="text" class="form-control" id="serie_folio" name="serie_folio" value="{{$seriefolio->serie}}-0000{{$seriefolio->folio}}" readonly>
                                                @elseif($seriefolio->folio>=100 && $seriefolio->folio<=999)
                                                    <input type="text" class="form-control" id="serie_folio" name="serie_folio" value="{{$seriefolio->serie}}-000{{$seriefolio->folio}}" readonly>
                                                @else
                                                    <input type="text" class="form-control" id="serie_folio" name="serie_folio" value="{{$seriefolio->serie}}-{{$seriefolio->folio}}" readonly>
                                                @endif

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="nombre_proveedor">Proveedor(*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="Nombre del proveedor" id="nombre_proveedor" name="nombre_proveedor" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="select_tipo_documento">Tipo de documento</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="select_tipo_documento" id="select_tipo_documento" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elegir] (Opcional)</option>
                                                    <option value="Factura">Factura</option>
                                                    <option value="Remisión">Remisión</option>
                                                    <option value="Recibo">Recibo</option>
                                                    <option value="Nota de Compra">Nota de Compra</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="folio_documento">Folio del documento</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="(Opcional)" id="folio_documento" name="folio_documento">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="fecha_documento">Fecha del documento(*)</label>
                                        <div class="row">

                                            <div class="col-xs-12 myerror">
                                                <!-- Date -->
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="dd-mm-aaaa" id="fecha_documento" name="fecha_documento" readonly>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="referencia_documento">Referencia</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="(Opcional)" id="referencia_documento" name="referencia_documento">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal Detalles de la Compra -->

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

                        <table id="dt_productos_categoria" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 20%"></th>
                                <th style="width: 50%">Producto</th>
                                <th style="width: 20%">Acciones</th>
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
            $('#fecha_documento').datepicker({
                todayBtn: "linked",
                language: "es",
                daysOfWeekDisabled: "0,6",
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                format: "dd-MM-yyyy"
            });

            $('#fecha_documento').datepicker('update', moment().format('DD-MM-YYYY'));

            $('#select_escuela').select2({
                allowClear: true,
                placeholder: '[Elija una escuela]'
            });

            $('#select_tipo_documento').select2({
                allowClear: true,
                placeholder: '[Elegir] (Opcional)'
            });

            $("#boton_guardar").click(function () {

                var escuela         = $("#select_escuela").val();
                var serie_folio     = $("#serie_folio").val().trim();
                var proveedor       = $("#nombre_proveedor").val().trim();
                var fecha_documento = moment($("#fecha_documento").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD');


                if(escuela===null || escuela===""){
                    console.log("Falta la escuela en los detalles de la compra");
                }
                else if(serie_folio.length===0 || serie_folio===""){
                    console.log("El valor Serie-Folio no puede estar vacio.");
                }
                else if(proveedor.length===0 || proveedor===""){
                    console.log("El nombre del proveedor no puede estar vacio.");
                }else{}

                console.log(fecha_documento);

            });

            var table_listado_productos;
            var table_items_compra;

            var urlRoot = "{{Request::root()}}";

            $('#categoria_id').select2({
                allowClear: true,
                placeholder: '[Elija una categoria]'
            });

            //Select de las categorias
            $('#categoria_id').change(function (){
                var categoria_id = $(this).val();

                //El usuario no selecciono algun elemento
                if(categoria_id===null) {}

                //El usuario elimina la seleccion del select
                else if(categoria_id===""){}

                else{
                        table_listado_productos = $('#dt_productos_categoria').DataTable({
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
                                { "data" : null,
                                    render : function ( data, type, full, meta ) {
                                        return '<strong>'+data.clasif_nombre+'</strong>';
                                    }
                                },
                                { "data" : null,
                                    render : function ( data, type, full, meta ) {
                                        return data.nombre_producto.capitalize();
                                    }
                                },
                                { "data" : null,
                                    "render": function ( data, type, full, meta ) {
                                        var button='';
                                        button += '<button name="'+"boton_elegir"+'" id="'+"boton_elegir"+'" type="'+"button"+'" class="'+"btn btn-xs btn-warning boton_elegir"+'">';
                                        button += '<i class="'+"fa fa-hand-o-right fa-lg"+'" aria-hidden="'+"true"+'"></i>';
                                        button += ' Elegir Producto';
                                        button += '</button>';
                                        return button;
                                    }
                                }
                            ]

                        });

                }
            });

            $('#modal_elegir_producto').on('hidden.bs.modal', function (event) {
                if ( $.fn.dataTable.isDataTable( '#dt_productos_categoria' ) ) {
                    table_listado_productos.clear();
                    table_listado_productos.destroy();
                    $("#categoria_id").val('').trigger('change');

                }
                else {
                    //alert('Ninguna tabla para limpiar y destruir');
                }
            });



            //Generated content for a column
            //https://datatables.net/examples/ajax/null_data_source.html
            //Scroll - vertical
            //https://datatables.net/examples/basic_init/scroll_y.html
            //Add rows
            //https://datatables.net/examples/api/add_row.html


            $('#dt_productos_categoria tbody').on( 'click', 'button', function () {
                var data = table_listado_productos.row( $(this).parents('tr') ).data();

                var inputCostoUnitario = '';

                inputCostoUnitario += '<input name="producto_id" id="producto_id" type="'+"hidden"+'" class="'+"form-control"+'" value="'+data['id']+'">';
                inputCostoUnitario += '<input name="'+"fila_costo_unitario_"+data['id']+'" id="'+"fila_costo_unitario_"+data['id']+'" type="'+"text"+'" class="'+"form-control"+'" value="0">';

                var inputCantidad = '<input name="'+"fila_cantidad_"+data['id']+'" id="'+"fila_cantidad_"+data['id']+'" type="'+"text"+'" class="'+"form-control"+'" value="0">';

                var inputImporte = '<input name="'+"fila_importe_"+data['id']+'" id="'+"fila_importe_"+data['id']+'" type="'+"text"+'" class="'+"form-control"+'" value="0">';



                var botonEliminarProducto = '';
                botonEliminarProducto += '<button name="'+"btn_delete"+'" id="'+"btn_delete"+'" type="'+"button"+'" class="'+"btn btn-xs btn-danger btn_delete"+'">';
                botonEliminarProducto += '<i class="'+"fa fa-trash-o fa-lg"+'" aria-hidden="'+"true"+'"></i>';
                botonEliminarProducto += ' Eliminar';
                botonEliminarProducto += '</button>';


                if ( $.fn.dataTable.isDataTable( '#dt_items_compra' ) ) {
                    table_items_compra.row.add([
                        data['nombre_producto'].capitalize(),
                        inputCostoUnitario,
                        inputCantidad,
                        inputImporte,
                        botonEliminarProducto
                    ] ).draw( false );
                }
                else {

                    table_items_compra = $('#dt_items_compra').DataTable({
                        paging: false,
                        lengthChange: false,
                        searching: false,
                        ordering: false,
                        info: true,
                        autoWidth: true,
                        language: {
                            "url": "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                        },
                        "columnDefs": [
                            { "width": "40%", "targets": 0 },
                            { "width": "15%", "targets": 1 },
                            { "width": "15%", "targets": 2 },
                            { "width": "15%", "targets": 3 },
                            { "width": "15%", "targets": 4 }
                        ]
                    });

                    table_items_compra.row.add([
                        data['nombre_producto'].capitalize(),
                        inputCostoUnitario,
                        inputCantidad,
                        inputImporte,
                        botonEliminarProducto
                    ] ).draw( false );
                }

                $("#fila_costo_unitario_"+data['id']).inputmask({
                    alias: 'numeric',
                    groupSeparator : ',',
                    autoGroup : true,
                    digits : 2,
                    digitsOptional: false,
                    placeholder: '0',
                    prefix: '$ '
                });

                $("#fila_importe_"+data['id']).inputmask({
                    alias: 'numeric',
                    groupSeparator : ',',
                    autoGroup : true,
                    digits : 2,
                    digitsOptional: false,
                    placeholder: '0',
                    prefix: '$ '
                });

                $("#fila_costo_unitario_"+data['id']).keyup(function(){
                    var fila = $(this).attr("name").slice(20);
                    var aux_CostoUnitario = $("#fila_costo_unitario_"+fila).inputmask('unmaskedvalue') * 1;
                    var aux_Cantidad      = $("#fila_cantidad_"+fila).val();

                    //http://www.linuxhispano.net/2012/03/07/por-que-usar-el-triple-igual-en-javascript-para-comparar/
                    //https://stackoverflow.com/questions/29189633/mask-text-is-missing-when-setting-valnull-or-val
                    if(aux_CostoUnitario=="0" || (aux_Cantidad === "0" || aux_Cantidad.length===0 || aux_Cantidad==="")){
                        var aux_Importe = aux_CostoUnitario * aux_Cantidad;
                        $("#fila_importe_"+fila).val(aux_Importe);
                    }
                    else{
                        //Si isNaN(aux_Cantidad) = true, ponemos el campo importe a cero
                        //Si isNaN(aux_Cantidad) = false multiplicamos por cero
                        if(isNaN(aux_Cantidad)){
                        }
                        else{
                            var aux_Importe = aux_CostoUnitario * aux_Cantidad;
                            $("#fila_importe_"+fila).val(aux_Importe);
                        }
                    }
                    //alert('Costo Unitario: '+aux_CostoUnitario+' Cantidad: '+aux_Cantidad+' Longitud Cantidad: '+aux_Cantidad.length+' '+isNaN(aux_Cantidad));

                });

                $("#fila_cantidad_"+data['id']).keyup(function(){
                    var fila = $(this).attr("name").slice(14);
                    var aux_CostoUnitario = $("#fila_costo_unitario_"+fila).inputmask('unmaskedvalue') * 1;
                    var aux_Cantidad      = $(this).val();

                    if(aux_CostoUnitario=="0" || (aux_Cantidad === "0" || aux_Cantidad.length===0 || aux_Cantidad==="")){
                        var aux_Importe = aux_CostoUnitario * 0;
                        $("#fila_importe_"+fila).val(aux_Importe);
                    }
                    else{
                        if(isNaN(aux_Cantidad)){
                        }
                        else{
                            var aux_Importe = aux_CostoUnitario * aux_Cantidad;
                            $("#fila_importe_"+fila).val(aux_Importe);
                        }
                    }

                });

            } );

            //Remover el producto de la tabla
            $('#dt_items_compra tbody').on( 'click', 'button', function () {
                table_items_compra.row( $(this).parents('tr') ).remove().draw();
            });

            //https://stackoverflow.com/questions/2332811/capitalize-words-in-string/7592235
            String.prototype.capitalize = function() {
                return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
            };

        });
    </script>
@endsection