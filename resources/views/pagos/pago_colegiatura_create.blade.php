@extends('templates.app_age')

@section('title', 'Pago de Colegiatura')

@section('content')

    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="box box-success">
                    <div class="box-header with-border bg-green color-palette">
                        <h3 class="box-title">Pago Colegiatura</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Ciclo Escolar:</td>
                                        <td style="width: 70%" class=""> <strong></strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Escuela:</td>
                                        <td style="width: 70%" class=""> <strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Alumno:</td>
                                        <td style="width: 70%" class=""> <strong></strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Matricula:</td>
                                        <td style="width: 70%" class="">

                                        </td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-sm-1"></div>

                            <div class="col-sm-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Recibo No.:</td>
                                        <td style="width: 70%" class="text-center text-red">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Fecha :</td>
                                        <td style="width: 70%" class="text-center">
                                            <!-- Date -->
                                            <div class="input-group date">
                                               <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                               </div>
                                               <input type="text" class="form-control pull-right" id="datepicker" name="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Nivel :</td>
                                        <td style="width: 70%" class="text-center"> <strong></strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Grupo :</td>
                                        <td style="width: 70%" class="text-center"> <strong></strong> </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <form action="" class="form-horizontal" method="post" id="">

                                <div class="form-group">

                                    <div class="col-sm-1">

                                    </div>

                                    <div class="col-sm-3">
                                        Concepto
                                    </div>

                                    <div class="col-sm-2">
                                        Colegiatura
                                    </div>

                                    <div class="col-sm-2">
                                        Recargo
                                    </div>

                                    <div class="col-sm-2">
                                        Descuento
                                    </div>

                                    <div class="col-sm-2">
                                        Importe
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_agosto" id="chk_agosto">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Agosto">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_agosto" name="cuota_colegiatura_agosto" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_agosto" name="recargo_agosto" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_agosto" name="descuento_agosto" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_agosto" name="importe_agosto" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_septiembre" id="chk_septiembre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Septiembre">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Octubre">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Noviembre">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Diciembre">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Enero">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Febrero">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Marzo">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Abril">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Mayo">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Junio">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_octubre" id="chk_octubre">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="" name="" value="Colegiatura de Julio">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="cuota_colegiatura_septiembre" name="cuota_colegiatura_septiembre" value="1000" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="recargo_septiembre" name="recargo_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="descuento_septiembre" name="descuento_septiembre" value="5" >
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_septiembre" name="importe_septiembre" value="1000" >
                                    </div>
                                </div>



                            </form>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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

    //$('#mytable').DataTable();

    moment.locale('es');

    //Date picker
    $('#datepicker').datepicker({
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        format: "dd-MM-yyyy"
    });

    $('#datepicker').datepicker('update', moment().format('DD-MM-YYYY'));

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    $("input[name^='cuota_colegiatura']").inputmask({
        alias: 'numeric',
        groupSeparator : ',',
        autoGroup : true,
        digits : 2,
        digitsOptional: false,
        placeholder: '0',
        prefix: '$ '
    });

    $("input[name^='importe']").inputmask({
        alias: 'numeric',
        groupSeparator : ',',
        autoGroup : true,
        digits : 2,
        digitsOptional: false,
        placeholder: '0',
        prefix: '$ '
    });





});
</script>
@endsection