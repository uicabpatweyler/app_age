@extends('templates.app_age')

@section('title', 'Listado de Productos')

@section('content')

<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">

        <!-- Main content -->
        <section class="content">

            <div class="box box-success">
                <div class="box-header with-border bg-green color-palette">
                    <h3 class="box-title">Listado de Productos: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                </div>
                <div class="box-body">
                    <table id="dt_listado_productos" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th style="width: 15%">Sub-Categoría</th>
                            <th style="width: 15%; text-align: center">Clasificación</th>
                            <th style="width: 30%; text-align: center">Nombre/Descripción</th>
                            <th style="width: 15%; text-align: center"></th>
                            <th style="width: 15%; text-align: center">Precio de Venta</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                        <tr>
                            <td style="width: 15%">{{$producto->SubCategoriaProducto->clasif_nombre}}</td>
                            <td style="width: 15%">{{$producto->Clasificacion1Producto->clasif_nombre}}</td>
                            <td style="width: 30%">{{ucwords($producto->nombre_producto)}}</td>
                            <td style="width: 15%;">{{ucwords($producto->info_adicional_producto)}}</td>
                            <td style="width: 15%; text-align: center">
                                @if($producto->producto_precio_venta==0)
                                    <a class="btn btn-xs btn-social btn-dropbox openAsignarPrecio" data-id="{{$producto->producto_precio_id}}" data-producto="{{ucwords($producto->nombre_producto)}}" data-toggle="modal" href="#asignar_precio">
                                        <i class="fa fa-usd" aria-hidden="true"></i> Asignar
                                    </a>
                                @else
                                    <span class="badge bg-green"><i class="fa fa-usd"></i> {{number_format($producto->producto_precio_venta,2,'.',',')}}</span>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->

        <div class="modal fade" tabindex="-1" role="dialog" id="asignar_precio"  aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-aqua-active">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Asignar Precio</h4>
                    </div>
                    <form action="{{route('producto_asignar_precio')}}" role="form" method="post" id="form_asignar_precio" name="form_asignar_precio">
                        {{csrf_field()}}
                        <input type="hidden" name="producto_precio_id" id="producto_precio_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="ciclo_escolar">Producto</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="precio_producto_venta">Precio</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" id="precio_producto_venta" name="precio_producto_venta" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times-circle fa-lg" aria-hidden="true" title="Cancelar"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="boton_guardar">
                                <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<script>
$(document).ready(function(){

    $('#dt_listado_productos').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        language: {
            url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
        }
    });

    //https://stackoverflow.com/questions/29824467/calling-ajax-request-function-in-href
    //https://stackoverflow.com/questions/10626885/passing-data-to-a-bootstrap-modal
    //https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_ref_js_modal_event_shown&stacked=h
    $(document).on("click", ".openAsignarPrecio", function () {

        $("#precio_producto_venta").val('');

        var id = $(this).data('id');
        var producto = $(this).data('producto');

        $("#producto_precio_id").val(id);
        $("#nombre_producto").val(producto);
    });

    $('#boton_guardar').click(function(event){
        var precio_producto_venta = $("#precio_producto_venta").val().trim();
        if(precio_producto_venta.length === 0 || precio_producto_venta === "0" ){
            swal({
                title:"Error:",
                text: "El precio de venta no puede estar en blanco o en ceros.",
                type: "error",
                allowOutsideClick: false,
                confirmButtonColor: '#d33',
                confirmButtonText: "Corregir"
            }).catch(swal.noop);
            event.preventDefault();
        }
        else{
            $("#asignar_precio").modal("hide");
            $( "#form_asignar_precio" ).submit();
            event.preventDefault();
        }

    });
});
</script>
@endsection