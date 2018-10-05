@extends('templates.app_age')

@section('title', 'Venta de Libors y Playeras')

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
                        <h3 class="box-title">Venta de Libros y Playeras</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">

                            <input type="hidden" id="escuela_id" name="escuela_id">
                            <input type="hidden" id="ciclo_id" name="ciclo_id">
                            <input type="hidden" id="alumno_id" name="alumno_id">
                            <input type="hidden" id="grupo_id" name="grupo_id">


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

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="nombre_alumno">Alumno: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <button class="btn  btn-primary pull-left" id="btn_elegir_alumno" data-toggle="modal" data-target="#modal_listado_alumnos">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i></button>
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

                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Productos Agregados</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="dt_productos_agregados" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">Categoria</th>
                                <th style="width: 40%">Descripción</th>
                                <th style="width: 10%">Precio</th>
                                <th style="width: 10%">Cantidad</th>
                                <th style="width: 10%">Importe</th>
                                <th style="width: 10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Libro</td>
                                <td>Beginners 1 - Family and Friends 2 Classbook</td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="590.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min="1" max="10" id="cantidad_producto" name="cantidad_producto">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="0.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>

                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Playera</td>
                                <td>Playera Blanca de Cuello Redondo Niño(a). Talla 6-8</td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="590.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min="1" max="10" id="cantidad_producto" name="cantidad_producto">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="0.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>

                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Libro</td>
                                <td>Advanced 3 -Solutions Advanced Workbook</td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="590.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min="1" max="10" id="cantidad_producto" name="cantidad_producto">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="0.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>

                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Playera</td>
                                <td>Playera Blanca de Cuello Redondo Niño(a). Talla 14-16</td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="590.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control" min="1" max="10" id="cantidad_producto" name="cantidad_producto">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="" name="" value="0.00" style="text-align:center; font-weight:bold;" readonly>
                                </td>
                                <td style="text-align: center">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>

                                    </button>
                                </td>
                            </tr>
                            </tbody>
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

    $("#cantidad_producto").bind('change keyup', function (e) {
        alert($(this).val());
    });

    var dataTableAlumnos;
    var urlRoot = "{{Request::root()}}";

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

        $('#modal_listado_alumnos').modal('hide');
    });

});

</script>
@endsection