@extends('templates.app_age')

@section('title', 'Generar Lista de Asistencia')

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
                        <h3 class="box-title">Generar Lista de Asistencia <small>Los campos marcados con (*) son obligatorios</small></h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="grupo">Grupo: (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <select class="form-control" name="grupo" id="grupo" style="width: 100%;" required>
                                                <option value="" selected="selected">[Elija un grupo]</option>
                                                @foreach($grupos as $grupo)
                                                    <option value="{{$grupo->id}}-{{$grupo->clasificacion_nombre}}-{{$grupo->grupo_nombre}}">{{$grupo->grupo_nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="teacher">Teacher: (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <select class="form-control" name="teacher" id="teacher" style="width: 100%;" required>
                                                <option value="" selected="selected">[Elija un nombre]</option>
                                                <option value="Ana Laura Manzanero Alamilla">Ana Laura Manzanero Alamilla</option>
                                                <option value="Fatima Concepción Manzanero Juarez">Fatima Concepción Manzanero Juarez</option>
                                                <option value="Estefanía Martínez Suárez">Estefanía Martínez Suárez</option>
                                                <option value="Laura Margarita Gutierrez">Laura Margarita Gutierrez</option>
                                                <option value="Monica Vanessa Martinez Cabrera">Monica Vanessa Martinez Cabrera</option>
                                                <option value="Noel Christopher Gough Whitworth">Noel Christopher Gough Whitworth</option>
                                                <option value="Rosa Elizabeth Bautista Gutierrez ">Rosa Elizabeth Bautista Gutierrez </option>
                                                <option value="Wendy Aridel Chulim Lopez">Wendy Aridel Chulim Lopez</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="nombre_mes">Del mes de: (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="nombre_mes" name="nombre_mes" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="fecha_entrega">Fecha de Entrega: (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="fecha_entrega" name="fecha_entrega" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <button class="btn  btn-social btn-facebook pull-right" id="btn_imprimir" name="btn_imprimir">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Imprimir Lista</button>
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
$(document).ready(function(){

    var urlRoot = "{{Request::root()}}";
    var grupo    = '';
    var maestro  = '';
    var mes_anio = '';
    var fecha;

    moment.locale('es');

    $('#grupo').select2({
        allowClear: true,
        placeholder: '[Elija un grupo]'
    });

    $('#teacher').select2({
        allowClear: true,
        placeholder: '[Elija un nombre]'
    });

    moment.locale('es');

    //Date picker
    $('#nombre_mes').datepicker({
        language    : "es",
        autoclose   : true,
        minViewMode : 'months',
        format      : 'MM-yyyy'
    });

    $('#fecha_entrega').datepicker({
        todayBtn: "linked",
        language: "es",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true,
        format: "dd-MM-yyyy"
    });

    $('#fecha_entrega').datepicker('update', moment().format('DD-MM-YYYY'));
    fecha = moment($("#fecha_entrega").val(), "DD-MMMM-YYYY").format('DD-MMMM-YYYY');

    $('#nombre_mes').on('changeDate', function() {
        mes_anio = moment($("#nombre_mes").val(), "MMMM-YYYY").format('MM-YYYY');
    });

    $('#fecha_entrega').on('changeDate', function() {
        fecha = moment($("#fecha_entrega").val(), "DD-MMMM-YYYY").format('DD-MMMM-YYYY');
    });

    $('#grupo').change(function () {
        grupo = $(this).val();

        //El usuario no selecciono algun elemento
        if(grupo===null) { grupo='';}

        //El usuario elimina la seleccion del select
        else if(grupo===""){ grupo='';}

    });

    $('#teacher').change(function () {
        maestro = $(this).val();

        //El usuario no selecciono algun elemento
        if(maestro===null) { maestro='';}

        //El usuario elimina la seleccion del select
        else if(maestro===""){ maestro='';}

    });

    $("#btn_imprimir").click(function(){
        if(grupo.length===0){
            swal({
                title: 'Atención',
                html: 'Elija un grupo de la lista desplegable',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if(maestro.length===0){
            swal({
                title: 'Atención',
                html: 'Elija un nombre de la lista de maestros.',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if(mes_anio.length===0){
            swal({
                title: 'Atención',
                html: 'Elija el mes al que corresponde la lista de asistencia',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else if(fecha.length===0){
            swal({
                title: 'Atención',
                html: 'Elija la fecha en la que se esta generando la lista de asistencia.',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else{
            window.open(urlRoot+'/pdf_ListaDeAsistencia/'+grupo+'/'+mes_anio+'/'+maestro+'/'+fecha, '_blank');
            return false;
        }
    });



});
</script>
@endsection