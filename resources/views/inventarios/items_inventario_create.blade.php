@extends('templates.app_age')

@section('title', 'Inventario Inicial')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Crear Inventario Inicial. Folio:
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categoria: {{$categoria->categprod_nombre}}</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                <i class="fa fa-minus"></i></button>

                            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;" id="boton_guardar" name="boton_guardars">
                                <i class="fa fa-floppy-o fa-lg"></i></button>

                            <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                        </div>

                    </div>

                    <div class="box-body">



                        <table id="dt_listado_productos_categoria" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 15%">Clasificación</th>
                                <th style="width: 40%">Producto</th>
                                <th style="width: 15%">Costo Unitario</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 15%">Importe</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td style="width: 15%"><strong>{{$producto->Clasificacion1Producto->clasif_nombre}}</strong></td>
                                <td style="width: 40%">{{ucwords($producto->nombre_producto)}}</td>
                                <input type="hidden" id="producto_id" name="producto_id" value="{{$producto->id}}">
                                <td style="width: 15%"><input type="text" class="form-control"  id="fila_costo_unitario_{{$producto->id}}" name="fila_costo_unitario_{{$producto->id}}" value="0"></td>
                                <input name="fila_costo_unitario_1" id="fila_costo_unitario_1" type="text" class="form-control">
                                <td style="width: 15%"><input type="text" class="form-control" id="fila_cantidad_{{$producto->id}}" name="fila_cantidad_{{$producto->id}}" value="0"></td></td>
                                <td style="width: 15%"><input type="text" class="form-control" id="fila_importe_{{$producto->id}}" name="fila_importe_{{$producto->id}}" value="0"></td></td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                


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

            //https://datatables.net/examples/advanced_init/row_grouping.html

            var groupColumn = 0;

            var table = $('#dt_listado_productos_categoria').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                language: {
                    url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                },
                "columnDefs": [
                    { "visible": false, "targets": groupColumn }
                ],
                "order": [[ groupColumn, 'asc' ]],
                //"displayLength": 10,
                "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();

                    var last=null;

                    api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                        if ( last !== group ) {
                            $(rows).eq( i ).before(
                                    '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                            );

                            last = group;
                        }
                    } );
                }

            });



            $("input[name^='fila_costo_unitario']").keyup(function(){
                var fila = $(this).attr("name").slice(20);
                var aux_CostoUnitario = $("#fila_costo_unitario_"+fila).inputmask('unmaskedvalue') * 1;
                var aux_Cantidad      = $("#fila_cantidad_"+fila).val();

                if(aux_Cantidad === "0" || aux_Cantidad.length===0 || isNaN(aux_Cantidad)){
                    var aux_Importe = aux_CostoUnitario * 0;
                    $("#fila_importe_"+fila).val(aux_Importe);
                    //alert("(fila_costo_unitario) Importe: "+aux_Importe);
                }

                else{
                    var aux_Importe = aux_CostoUnitario * aux_Cantidad;
                    $("#fila_importe_"+fila).val(aux_Importe);
                }

            }).keyup();

            $("input[name^='fila_cantidad']").keyup(function(){
                var fila = $(this).attr("name").slice(14);
                var aux_CostoUnitario = $("#fila_costo_unitario_"+fila).inputmask('unmaskedvalue') * 1;
                var aux_Cantidad      = $(this).val();

                if(aux_Cantidad === "0" || aux_Cantidad.length===0 || isNaN(aux_Cantidad)){
                    var aux_Importe = aux_CostoUnitario * 0;
                    $("#fila_importe_"+fila).val(aux_Importe);
                    //alert("(fila_cantidad) Importe: "+aux_Importe);
                }
                else{
                    var aux_Importe       = aux_CostoUnitario * aux_Cantidad;
                    $("#fila_importe_"+fila).val(aux_Importe);
                }

                //alert('b) Valor: '+aux_Cantidad+" "+"Longitud: "+aux_Cantidad.length);


            }).keyup();

            //Todos los input text que contengan 'importe'
            $("input[name^='fila_costo_unitario']").inputmask({
                alias: 'numeric',
                groupSeparator : ',',
                autoGroup : true,
                digits : 2,
                digitsOptional: false,
                placeholder: '0',
                prefix: '$ '
            });

            //Todos los input text que contengan 'importe'
            $("input[name^='fila_importe']").inputmask({
                alias: 'numeric',
                groupSeparator : ',',
                autoGroup : true,
                digits : 2,
                digitsOptional: false,
                placeholder: '',
                prefix: '$ '
            });

            //https://www.w3schools.com/jquery/ajax_serializearray.asp

            $('#boton_guardar').click( function() {

                var x = 0;

                $("input[name^='producto_id']").each(function(i, field) {

                    var y = $("#fila_importe_"+field.value).inputmask('unmaskedvalue') * 1;
                    x = x + y;
                });

                console.log(x);


                var DATOS = [];


                $("input[name^='producto_id']").each(function(i, field) {

                    item = {};

                    item["producto_id"]    = field.value;

                    if($("#fila_costo_unitario_"+field.value).inputmask("hasMaskedValue")){
                        item ["costo_unitario"]  = $("#fila_costo_unitario_"+field.value).inputmask('unmaskedvalue');
                    }

                    item["cantidad"]       = $("#fila_cantidad_"+field.value).val();

                    if($("#fila_importe_"+field.value).inputmask("hasMaskedValue")){
                        item ["importe"]  = $("#fila_importe_"+field.value).inputmask('unmaskedvalue');
                    }

                    DATOS.push(item);
                });

                INFO 	= new FormData();
                aInfo 	= JSON.stringify(DATOS);

                console.log(aInfo);

                return false;
            } );
        });
    </script>
@endsection