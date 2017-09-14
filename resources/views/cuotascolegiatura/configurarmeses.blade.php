@extends('templates.app_age')

@section('title', 'Configurar Meses de Pago')

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
                    <!-- Horizontal Form -->
                    <div class="box box-success">

                        <div class="box-header with-border">
                            <a class="btn btn-xs btn-success" href="javascript:history.back(1)">
                                <i class="fa fa-reply fa-lg" aria-hidden="true"></i> Regresar</a>
                            <h3 class="box-title">Cuota de Colegiatura Elegida</h3>
                        </div>
                        <!-- /.box-header -->

                            <div class="box-body">

                                <div class="alert bg-aqua-active">
                                    <h4> {{$cuota->cuotacolegiatura_nombre}} - $ {{number_format($cuota->cuotacolegiatura_cuota, 2, '.', ',')}}</h4>
                                    Seleccione un mes de la lista, agregue el periodo sin recargo, las fechas con recargo, el porcentaje de
                                    recargo y el descuento a aplicar. (El descuento es opcional).
                                </div>

                                <form method="post" action="" class="form-horizontal" name="form_mesesdepago" id="form_mesesdepago">
                                    {{csrf_field()}}
                                    <input type="hidden" name="colegiatura_id" id="colegiatura_id" value="{{$cuota->id}}">
                                    <div class="form-group">

                                        <div class="col-sm-1">
                                                <input type="number" class="form-control" id="orden_mes" name="orden_mes" placeholder="#">
                                        </div>

                                        <div class="col-sm-3">
                                            <select id="nombre_mes" name="nombre_mes" class="form-control nombre_mes" style="width: 100%;">                                                <option value="-1" selected>[Elija una opción]</option>
                                                <option value="-1" selected>[Elegir mes de pago]</option>
                                                <option value="Enero">Enero</option>
                                                <option value="Febrero">Febrero</option>
                                                <option value="Marzo">Marzo</option>
                                                <option value="Abril">Abril</option>
                                                <option value="Mayo">Mayo</option>
                                                <option value="Junio">Junio</option>
                                                <option value="Julio">Julio</option>
                                                <option value="Agosto">Agosto</option>
                                                <option value="Septiembre">Septiembre</option>
                                                <option value="Octubre">Octubre</option>
                                                <option value="Noviembre">Noviembre</option>
                                                <option value="Diciembre">Diciembre</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="periodo_sin_recargo" name="periodo_sin_recargo" readonly placeholder="Sin recargo">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="periodo_con_recargo" name="periodo_con_recargo" readonly placeholder="Con recargo">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porcentaje_recargo" name="porcentaje_recargo" placeholder="0 %">
                                        </div>

                                        <div class="col-sm-1">
                                            <input type="text" class="form-control" id="porcentaje_descuento" name="porcentaje_descuento" placeholder="0 %">
                                        </div>

                                    </div>

                                    <a class="btn btn-danger" href="">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                                    <button type="submit" class="btn btn-primary pull-right" id="boton_enviar" name="boton_enviar">
                                        <i class="fa fa-calendar-plus-o fa-lg" aria-hidden="true"></i> Agregar Mes</button>

                                </form>
                                
                            </div>
                            <!-- /.box-body -->

                        <div class="box-footer">

                        </div>
                        <!-- /.box-footer -->

                    </div>
                    <!-- /.box -->

                    @if(isset($mesescolegiatura))
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <i class="fa fa-calendar"></i>
                                <h3 class="box-title">Meses de Pago</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="box-body">

                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th style="width: 20%">Mes</th>
                                        <th class="text-center" style="width: 25%">Periodo sin recargo</th>
                                        <th class="text-center" style="width: 25%">Periodo con recargo</th>
                                        <th class="text-center" style="width: 10%">Recargo.</th>
                                        <th class="text-center" style="width: 10%">Desc.</th>
                                    </tr>
                                    @foreach($mesescolegiatura as $registro)
                                        <tr>
                                            <td style="width: 10%">{{$registro->orden_mes}}</td>

                                            <td style="width: 20%">{{$registro->nombre_mes}}</td>

                                            <td class="text-center" style="width: 25%">
                                                <span class="badge bg-yellow">
                                                    {{ucwords($registro->fecha1_sin_recargo->format('D, d M Y'))}}
                                                </span>

                                                <span class="badge bg-yellow">
                                                    {{ucwords($registro->fecha2_sin_recargo->format('D, d M Y'))}}
                                                </span>
                                            </td>

                                            <td class="text-center" style="width: 25%">
                                                <span class="badge bg-red-active">
                                                    {{ucwords($registro->fecha3_con_recargo->format('D, d M Y'))}}
                                                </span>

                                                <span class="badge bg-red-active">
                                                    {{ucwords($registro->fecha4_con_recargo->format('D, d M Y'))}}
                                                </span>

                                            </td>
                                            <td class="text-center" style="width: 10%">
                                                <span class="label bg-gray-active">
                                                    {{$registro->porcentaje_recargo}} %
                                                </span>
                                            </td>

                                            <td class="text-center" style="width: 10%">

                                            </td>

                                        </tr>
                                    @endforeach
                                </table>

                            </div>

                            <div class="box-footer">

                            </div>

                        </div>
                    @else

                    @endif
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
        $(document).ready(function () {

            $('.nombre_mes').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Elegir mes de pago]'
                }
            });

            $('#periodo_sin_recargo').daterangepicker({
                autoUpdateInput : false,
                showWeekNumbers : true,
                locale: {
                    applyLabel  : 'Aplicar',
                    cancelLabel : 'Cancelar',
                    format      : 'DD-MM-YYYY',
                    fromLabel   : 'De',
                    toLabel     : 'A',
                    customRangeLabel : 'Personalizado',
                    weekLabel        : 'S',
                    daysOfWeek       : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    monthNames       :[
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'OCtubre',
                        'Noviembre',
                        'Diciembre'
                    ]
                }
            });

            $('#periodo_con_recargo').daterangepicker({
                autoUpdateInput : false,
                showWeekNumbers : true,
                locale: {
                    applyLabel  : 'Aplicar',
                    cancelLabel : 'Cancelar',
                    format      : 'DD-MM-YYYY',
                    fromLabel   : 'De',
                    toLabel     : 'A',
                    customRangeLabel : 'Personalizado',
                    weekLabel        : 'S',
                    daysOfWeek       : ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    monthNames       :[
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ]
                }
            });

            $('input[name="periodo_sin_recargo"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('input[name="periodo_con_recargo"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' / ' + picker.endDate.format('DD-MM-YYYY'));
            });

            $('input[name="periodo_sin_recargo"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $('input[name="periodo_con_recargo"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            $("#boton_enviar").click(function(){
                //Accedemos al objeto DateRangePicker asi como a sus propiedades y funciones a través del selector
                //al cual ha sido asociado el DateRangePicker
                var drp_sinrecargo = $('#periodo_sin_recargo').data('daterangepicker');
                var drp_conrecargo = $('#periodo_con_recargo').data('daterangepicker');

                var fecha_sin_recargo_inicial = drp_sinrecargo.startDate.format('YYYY-MM-DD');
                var fecha_sin_recargo_final   = drp_sinrecargo.endDate.format('YYYY-MM-DD');

                var fecha_con_recargo_inicial = drp_conrecargo.startDate.format('YYYY-MM-DD');
                var fecha_con_recargo_final   = drp_conrecargo.endDate.format('YYYY-MM-DD');


                if($('#orden_mes').val().length===0){
                    formularioIncorrecto('Falta el numero de orden del mes');
                }
                else if($('.nombre_mes').val()==="-1")
                {
                    formularioIncorrecto('Debe elegir un mes de la lista.');
                }
                else if($('#periodo_sin_recargo').val().length===0)
                {
                    formularioIncorrecto('Falta el periodo de fechas sin recargo');
                }
                else if($('#periodo_con_recargo').val().length===0)
                {
                    formularioIncorrecto('Falta el periodo de fechas con recargo');
                }
                else if(fecha_sin_recargo_inicial === fecha_sin_recargo_final)
                {
                    formularioIncorrecto('El periodo de fechas sin recargo es incorrecto');
                }
                else if(fecha_con_recargo_inicial === fecha_con_recargo_final)
                {
                    formularioIncorrecto('El periodo de fechas con recargo es incorrecto');
                }
                else if(fecha_sin_recargo_inicial === fecha_con_recargo_inicial)
                {
                    formularioIncorrecto('El periodo de fechas es incorrecto');
                }
                else if(fecha_sin_recargo_final === fecha_con_recargo_inicial)
                {
                    formularioIncorrecto('El periodo de fechas es incorrecto');
                }
                else if($('#porcentaje_recargo').val().length===0)
                {
                    formularioIncorrecto('Falta el porcentaje de recargo');
                }
                else
                {
                    //return true
                    ajaxSubmit();
                }

                return false;
            });

            function ajaxSubmit(){
                $.ajax({
                    type: "POST",
                    url: "{{route('guardarmespagocolegiatura')}}",
                    data: $("#form_mesesdepago").serialize(),
                    dataType: 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            //Recargar la página actual para reflejar los cambios
                            location.reload(true);
                        });
                    },
                    error: function(xhr,status, response ){
                        //Obtener el valor de los errores devueltos por el controlador
                        var error = jQuery.parseJSON(xhr.responseText);
                        //Obtener los mensajes de error
                        var info = error.message;
                        var extra = error.extra;
                        if(extra===true){
                            swal({
                                title:"Error:",
                                html: info,
                                type: "error",
                                allowOutsideClick: false,
                                confirmButtonColor: '#d33',
                                confirmButtonText: "Corregir"
                            });
                        }
                        else {
                            //Crear la lista de errores
                            var errorsHtml = '<ul>';
                            $.each(info, function (key,value) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            errorsHtml += '</ul>';
                            //Mostrar el y/o los errores devuelto(s) por el controlador
                            swal({
                                title:"Error:",
                                html: errorsHtml,
                                type: "error",
                                allowOutsideClick: false,
                                confirmButtonColor: '#d33',
                                confirmButtonText: "Corregir"
                            });
                        }

                    }
                });
            }

            function formularioIncorrecto(mensaje){
                swal({
                    title:"Error:",
                    text: mensaje,
                    type: "error",
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Corregir"
                });
            }

        });
    </script>
@endsection