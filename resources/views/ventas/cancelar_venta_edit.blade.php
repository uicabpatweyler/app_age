@extends('templates.app_age')

@section('title', 'Cancelar Recibo de Venta')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Cancelar Recibo de Venta</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">Seleccione la fecha de cancelación del recibo</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <form action="">

                            <div class="row">

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="grupo">Recibo #:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control text-bold text-center" style="color: red; font-size: large" id="" name="" value="{{$salida->folio_recibo < 100 ? '000'.$salida->folio_recibo : $salida->folio_recibo}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="grupo">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <a class="btn btn-social btn-dropbox" href="{{route('pdf_ReciboSalidaVenta',['id_salida'=>$salida->id])}}" target="_blank">
                                                    <i class="fa fa-list" aria-hidden="true"></i> Detalles del Recibo
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2"></div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="dt_fecha_reporte">Fecha de Cancelación: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="dt_fecha_cancelacion" name="dt_fecha_cancelacion" readonly>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>

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
$(document).ready(function(){
    moment.locale('es');

    //Date picker
    $('#dt_fecha_cancelacion').datepicker({
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        format: "dd-MM-yyyy"
    });
});
</script>
@endsection