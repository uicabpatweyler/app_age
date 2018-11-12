@extends('templates.app_age')

@section('title', 'Reporte de Venta de Libros y Playeras')

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
                        <h3 class="box-title">Reporte de Venta de Libros y Playeras <small>Los campos marcados con (*) son obligatorios</small></h3>
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
                                            <button class="btn  btn-social btn-dropbox pull-left" id="btn_reporte_pdf" disabled>
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Reporte Detallado PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>



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
$(document).ready(function() {

    var dt_resumen_reporte;
    var urlRoot = "{{Request::root()}}";
    var fecha_reporte;
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
        if ($("#btn_reporte_pdf").prop('disabled')) {
            $('#btn_reporte_pdf').prop('disabled',false);
        } else {
            // do sth if enabled
        }
    });

    $('#btn_reporte_pdf').click( function() {

        fecha_reporte = (moment($("#dt_fecha_reporte").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD'));

        if($("#dt_fecha_reporte").val().length===0){
            swal({
                title: 'Información',
                html: 'Elija una fecha para generar el reporte.',
                type: "warning",
                allowOutsideClick: false,
                showConfirmButton : true,
                confirmButtonText : 'Verificar'
            }).catch(swal.noop);
        }
        else{
            window.open(urlRoot+'/pdf_ReporteDiarioVentas/'+fecha_reporte, '_blank');
            return false;
        }




    });
});
</script>
@endsection