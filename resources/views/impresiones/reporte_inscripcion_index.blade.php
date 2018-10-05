@extends('templates.app_age')

@section('title', 'Reporte de Pagos de Inscripcion')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">Reporte de Pagos de Inscripción <small>Los campos marcados con (*) son obligatorios</small></h3>
                    </div>
                    <!-- /.box-header -->



                    <div class="box-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="dt_fecha_reporte">Fecha del Reporte: (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="dt_fecha_reporte" name="dt_fecha_reporte" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="btn  btn-social btn-dropbox pull-left" id="btn_buscar" disabled>
                                                <i class="fa fa-search" aria-hidden="true"></i> Realizar Búsqueda</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="btn  btn-social btn-facebook pull-right" id="btn_generar_reporte" enabled>
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Reporte Detallado PDF</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>



                </div>
                <!-- /.box -->

                <div class="box box-success">
                    <div class="box-header with-border bg-green color-palette">
                        <h3 class="box-title">Resumen del Reporte</h3>
                    </div>
                    <div class="box-body">
                        <table id="dt_resumen_reporte" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="text-align: center; width: 5%">#</th>
                                <th style="text-align: center; width: 10%">Recibo</th>
                                <th style="text-align: center; width: 15%">Fecha</th>
                                <th style="text-align: center; width: 15%">Estado</th>
                                <th style="text-align: center; width: 35%">Alumno</th>
                                <th style="text-align: center; width: 10%">Grupo</th>
                                <th style="text-align: center; width: 10%">Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
        $(document).ready(function(){

            moment.locale('es');

            //Date picker
            $('#dt_fecha_reporte').datepicker({
                todayBtn: "linked",
                language: "es",
                daysOfWeekDisabled: "0,6",
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                format: "dd-MM-yyyy"
            });

            $('#dt_fecha_reporte').on('changeDate', function() {
                if ($("#btn_buscar").prop('disabled')) {
                    $('#btn_buscar').prop('disabled',false);
                } else {
                    // do sth if enabled
                }
            });

            var dt_resumen_reporte;
            var urlRoot = "{{Request::root()}}";

            dt_resumen_reporte = $('#dt_resumen_reporte').DataTable({
                "paging": false,
                "destroy": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "language": {
                    "url": "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                }
            });


            var fecha_reporte
            //https://datatables.net/examples/advanced_init/footer_callback.html
            $('#btn_buscar').click( function() {

                fecha_reporte = (moment($("#dt_fecha_reporte").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD'));

                if ( $.fn.dataTable.isDataTable( '#dt_resumen_reporte' ) ) {
                    dt_resumen_reporte.clear();
                    dt_resumen_reporte.destroy();

                    dt_resumen_reporte = $('#dt_resumen_reporte').DataTable({
                        "ajax": urlRoot+'/pagos_inscripcion_por_dia/'+fecha_reporte,
                        "paging": false,
                        "destroy": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": false,
                        "info": true,
                        "autoWidth": true,
                        "scrollY": "250px",
                        "scrollCollapse": true,
                        "language": {
                            "url": "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                        },
                        "columns": [
                            { "data": 'numero' },
                            { "data" : null,
                                render : function ( data, type, full, meta ) {
                                    return '<strong>'+data.serie_recibo+'-'+data.folio_recibo+'</strong>';
                                }
                            },
                            { "data": "fecha_pago"},
                            { "data" : null,
                                render : function ( data, type, full, meta ) {
                                    var etiqueta = '';

                                    if(data.pago_cancelado=='0'){
                                        etiqueta += '<small class="'+"label label-primary"+'">';
                                        etiqueta += '<i class="'+"fa fa-check"+'" aria-hidden="'+"true"+'"></i>';
                                    }
                                    else{
                                        etiqueta += '<small class="'+"label label-danger"+'">';
                                        etiqueta += '<i class="'+"fa fa-check"+'" aria-hidden="'+"true"+'">&nbsp;Cancelado</i>';
                                    }
                                    etiqueta += '</small>';

                                    return etiqueta;
                                }
                            },
                            { "data": "alumno" },
                            { "data": "grupo" },
                            { "data": "importe" }
                        ],
                        "columnDefs": [
                            { "className": "text-center", "width": "5%", "targets": 0 },
                            { "className": "text-center", "width": "10%", "targets": 1 },
                            { "className": "text-center", "width": "15%", "targets": 2 },
                            { "className": "text-center", "width": "15%", "targets": 3 },
                            { "className": "text-left",   "width": "35%", "targets": 4 },
                            { "className": "text-center", "width": "10%", "targets": 5 },
                            { "className": "text-right",  "width": "10%", "targets": 6 }
                        ]
                    });

                }
                else {

                }


            });

            $('#btn_generar_reporte').click( function() {
                if ( ! $('#dt_resumen_reporte').dataTable().api().data().any() ) {
                    swal({
                        title: 'Información',
                        html: 'No existen registros para generar el reporte.',
                        type: "warning",
                        allowOutsideClick: false,
                        showConfirmButton : true,
                        confirmButtonText : 'Verificar'
                    }).catch(swal.noop);
                }
                else{
                    window.open(urlRoot+'/pdf_ReporteDiarioInscripcion/'+fecha_reporte, '_blank');
                    return false;
                }
            });


        });
    </script>
@endsection