@extends('templates.app_age')

@section('title', 'Inventario Inicial')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Crear Inventario Inicial: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">

                    <!-- form start -->
                    <form method="post" action="" id="" name="">
                        {{csrf_field()}}
                        <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                        <input type="hidden" name="fecha_aplicacion" id="fecha_aplicacion">
                        <input type="hidden" name="fecha_factura" id="fecha_factura">

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ingrese los siguientes datos.</h3> <small>Los campos marcados con (*) son obligatorios</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>

                            </div>
                            <!-- /.box-header -->

                        <!-- box-body start -->
                        <div class="box-body">

                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="escuela_id">Escuela (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select class="form-control" name="escuela_id" id="escuela_id" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elija una escuela]</option>
                                                    @foreach($escuelas as $escuela)
                                                        <option value="{{$escuela->id}}">
                                                            {{$escuela->escuela_nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ciclo_escolar">Ciclo Escolar</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="dp_fecha_aplicacion">Fecha de Aplicación(*)</label>
                                        <div class="row">
                                            <div class="col-xs-12  myerror">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="dp_fecha_aplicacion" name="dp_fecha_aplicacion" readonly required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="dp_fecha_factura">Fecha de Factura(*)</label>
                                        <div class="row">
                                            <div class="col-xs-12  myerror">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="dp_fecha_factura" name="dp_fecha_factura" readonly required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="folio_factura">Folio Factura</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" id="folio_factura" name="folio_factura" value="" placeholder="Opcional">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="proveedor_factura">Proveedor(*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" id="proveedor_factura" name="proveedor_factura" value="" placeholder="Requerido">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="referencia_factura">Referencia(*)</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" id="referencia_factura" name="referencia_factura" value="Entrada para el inventario inicial {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" placeholder="Requerido" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.box-body -->



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

    $('#escuela_id').select2({
        allowClear: true,
        placeholder: '[Elija una escuela]'
    });

    moment.locale('es');

    //Date picker
    $('#dp_fecha_aplicacion').datepicker({
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        format: "dd-MM-yyyy"
    });

    //Date picker
    $('#dp_fecha_factura').datepicker({
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        format: "dd-MM-yyyy"
    });

    $('#dp_fecha_aplicacion').datepicker('update', moment().format('DD-MM-YYYY'));

    $('#dp_fecha_factura').datepicker('update', moment().format('DD-MM-YYYY'));

});
</script>
@endsection