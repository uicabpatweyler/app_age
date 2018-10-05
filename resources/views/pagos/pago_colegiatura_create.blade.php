@extends('templates.app_age')

@section('title', 'Pago de Colegiatura')

@section('content')

    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Pago de Colegiatura
                    <small> Personalizar Pago</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="box box-success">
                    <div class="box-header with-border bg-green color-palette">
                        <h3 class="box-title">Detalles del Pago</h3>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Ciclo Escolar:</td>
                                        <td style="width: 70%" class=""> <strong>{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Escuela:</td>
                                        <td style="width: 70%" class=""> <strong>{{$escuela->escuela_nombre}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Alumno:</td>
                                        <td style="width: 70%" class="">
                                            <strong>{{ucwords($alumno->alumno_primernombre)}} {{ucwords($alumno->alumno_segundonombre)}} {{ucwords($alumno->alumno_apellidopaterno)}} {{ucwords($alumno->alumno_apellidomaterno)}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Matricula:</td>
                                        <td style="width: 70%" class="">
                                            <strong>
                                                @if($alumno->id<10)
                                                    <strong>00{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}</strong>
                                                @elseif($alumno->id<100)
                                                    <strong>0{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}</strong>
                                                @else
                                                    <strong>0{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}</strong>
                                                @endif
                                            </strong>
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
                                            <strong>
                                                @if($num_recibo->serie!=null)
                                                    <strong>{{$num_recibo->serie}} - </strong>
                                                @endif
                                                @if($num_recibo->folio<10)
                                                    <strong>00{{$num_recibo->folio}}</strong>
                                                @elseif($num_recibo->folio<100)
                                                    <strong>0{{$num_recibo->folio}}</strong>
                                                @else
                                                    <strong>{{$num_recibo->folio}}</strong>
                                                @endif
                                            </strong>
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
                                        <td style="width: 70%" class="text-center"> <strong>{{$grupo->ClasificacionGrupo->clasificacion_nombre}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Grupo :</td>
                                        <td style="width: 70%" class="text-center"> <strong>{{$grupo->grupo_nombre}}</strong> </td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn  btn-social btn-dropbox pull-right" id="btn_calcular" name="btn_calcular">
                                    <i class="fa fa-calculator" aria-hidden="true"></i> Calcular Total a Pagar</button>

                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" style="font-size: 16pt; text-align: right; font-weight: bold; color: red;" id="input_total_a_pagar" name="input_total_a_pagar" value="" readonly>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn  btn-social btn-dropbox pull-right" id="btn_pagocolegiatura" name="btn_pagocolegiatura" disabled>
                                    <i class="fa fa-usd" aria-hidden="true"></i> Realizar Pago</button>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn  btn-social btn-facebook" id="btn_imprimir" name="btn_imprimir" disabled>
                                    <i class="fa fa-print" aria-hidden="true"></i> Imprimir Recibo</button>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-danger" id="btn_cancelar" name="btn_cancelar">
                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancelar/Finalizar</button>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <form action="" class="form-horizontal" method="post" id="form_meses_pago_colegiatura" name="form_meses_pago_colegiatura">

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

                            @for($i=0; $i<count($meses_de_pago); $i++)


                                <div class="form-group">

                                    <div class="col-sm-1">
                                        <input type="checkbox" class="minimal" name="chk_{{$meses_de_pago[$i]['nombre_mes']}}" id="chk_{{$meses_de_pago[$i]['nombre_mes']}}">
                                    </div>

                                    <div class="col-sm-3">
                                        <input type="hidden" name="numorden_{{$meses_de_pago[$i]['nombre_mes']}}" id="numorden_{{$meses_de_pago[$i]['nombre_mes']}}" value="{{$meses_de_pago[$i]['orden_mes']}}">
                                        <input type="text" class="form-control" id="{{$meses_de_pago[$i]['nombre_mes']}}" name="{{$meses_de_pago[$i]['nombre_mes']}}" value="Colegiatura de {{$meses_de_pago[$i]['nombre_mes']}}" required readonly>
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="colegiatura_{{$meses_de_pago[$i]['nombre_mes']}}" name="colegiatura_{{$meses_de_pago[$i]['nombre_mes']}}" value="{{$meses_de_pago[$i]['cuota_colegiatura']}}" required readonly>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="recargo_{{$meses_de_pago[$i]['nombre_mes']}}" name="recargo_{{$meses_de_pago[$i]['nombre_mes']}}" value="{{$meses_de_pago[$i]['porcentaje_recargo']}}" required disabled>
                                            <span class="input-group-addon">%</span>
                                        </div>

                                    </div>

                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="descuento_{{$meses_de_pago[$i]['nombre_mes']}}" name="descuento_{{$meses_de_pago[$i]['nombre_mes']}}" value="{{$meses_de_pago[$i]['porcentaje_descuento']}}" required disabled>
                                        <span class="input-group-addon">%</span>
                                    </div>

                                    </div>

                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="importe_{{$meses_de_pago[$i]['nombre_mes']}}" name="importe_{{$meses_de_pago[$i]['nombre_mes']}}" value="{{$meses_de_pago[$i]['cuota_colegiatura']}}" required disabled>
                                    </div>
                                </div>

                                @endfor
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

    function auxiliar(){
        //Verificamos si el boton esta activado/desactivado para desactivar
        if($("#btn_pagocolegiatura").attr('disabled')){}
        else{ $("#btn_pagocolegiatura").prop('disabled', true); }

        //Reiniciamos a cero el campo total a pagar
        if ($("#input_total_a_pagar").inputmask("hasMaskedValue")){
            //alert('hasMaskedValue=true');
            $("#input_total_a_pagar").inputmask('remove');
            $("#input_total_a_pagar").val('$ 0.00');
        }
        else{
            //alert('hasMaskedValue=false');
            $("#input_total_a_pagar").val('$ 0.00');
        }
    }

    //Cuando el usuario presiona y marca el Checkbox
    $('input').on('ifChecked', function(event){

        auxiliar();

        //obtenemos lo que esta despues del guien bajo, que es el nombre del mes, que determina la fila
        var fila = $(this).attr("name").slice(4);

        //Desactivamos los controles correspondientes
        $("#recargo_"+fila).removeAttr("disabled");
        $("#descuento_"+fila).removeAttr("disabled");
        $("#importe_"+fila).removeAttr("disabled");

        var importe_colegiatura = 0;
        var colegiatura         = 0;
        importe_colegiatura     = $("#colegiatura_"+fila).inputmask('unmaskedvalue') * 1;


        $("#recargo_"+fila).keyup(function () {

            auxiliar();

            var recargo_porcentaje   = $(this).val();
            var descuento_porcentaje = $("#descuento_"+fila).val();


            if(recargo_porcentaje.length==0){
                var recargo_pesos   = importe_colegiatura * (0/100);
                var descuento_pesos = importe_colegiatura  * (descuento_porcentaje/100);

               colegiatura = (importe_colegiatura + recargo_pesos) - descuento_pesos;

                $("#importe_"+fila).val(colegiatura);
            }
            else{
                var recargo_pesos   = importe_colegiatura * (recargo_porcentaje/100);
                var descuento_pesos = importe_colegiatura  * (descuento_porcentaje/100);

                colegiatura = (importe_colegiatura + recargo_pesos) - descuento_pesos;

                $("#importe_"+fila).val(colegiatura);

            }

        }).keyup();

        $("#descuento_"+fila).keyup(function () {

            auxiliar();

            var recargo_porcentaje   = $("#recargo_"+fila).val();
            var descuento_porcentaje = $(this).val();

            if(descuento_porcentaje.length==0){
                var recargo_pesos   = importe_colegiatura * (recargo_porcentaje/100);
                var descuento_pesos = importe_colegiatura  * (0/100);

                colegiatura         = (importe_colegiatura + recargo_pesos) - descuento_pesos;

                $("#importe_"+fila).val(colegiatura);
            }
            else{
                var recargo_pesos   = importe_colegiatura * (recargo_porcentaje/100);
                var descuento_pesos = importe_colegiatura  * (descuento_porcentaje/100);

                colegiatura = (importe_colegiatura + recargo_pesos) - descuento_pesos;

                $("#importe_"+fila).val(colegiatura);

            }

        }).keyup();


    });

    function countInputsEnabled(){
        var $i=0;

        $("input[name^='importe']").each(function() {
            var elemento = this;
            var nombre    = elemento.name;

            if($("#"+nombre).attr('disabled')){}
            else{ $i++; }
        });

        return $i;
    }
    //Cuando el usuario presiona y desmarca el Checkbox
    $('input').on('ifUnchecked', function(event){
       auxiliar();

        //obtenemos lo que esta despues del guien bajo, que es el nombre del mes, que determina la fila
        var fila = $(this).attr("name").slice(4);

        $("#recargo_"+fila).prop('disabled', true);
        $("#descuento_"+fila).prop('disabled', true);
        $("#importe_"+fila).prop("disabled", true);

        $("#importe_"+fila).val($("#colegiatura_"+fila).val());

        var $i=0;

        $("input[name^='importe']").each(function() {
            var elemento = this;
            var nombre    = elemento.name;

            if($("#"+nombre).attr('disabled')){}
            else{ $i++; }
        });

        if($i===0){ auxiliar(); }

    });

    //Todos los input text que contengan 'colegiatura'
    $("input[name^='colegiatura']").inputmask({
        alias: 'numeric',
        groupSeparator : ',',
        autoGroup : true,
        digits : 2,
        digitsOptional: false,
        placeholder: '0',
        prefix: '$ '
    });

    //Todos los input text que contengan 'recargo'
    $("input[name^='recargo']").inputmask({
        alias: 'numeric',
        groupSeparator : '',
        autoGroup : false,
        digits : 0,
        digitsOptional: false,
        placeholder: '',
        prefix: ''
    });

    //Todos los input text que contengan 'recargo'
    $("input[name^='descuento']").inputmask({
        alias: 'numeric',
        groupSeparator : '',
        autoGroup : false,
        digits : 0,
        digitsOptional: false,
        placeholder: '',
        prefix: ''
    });

    //Todos los input text que contengan 'importe'
    $("input[name^='importe']").inputmask({
        alias: 'numeric',
        groupSeparator : ',',
        autoGroup : true,
        digits : 2,
        digitsOptional: false,
        placeholder: '0',
        prefix: '$ '
    });

    $("#btn_cancelar").click(function(){
        swal({
            title: 'Confirmar',
            html: 'Desea cancelar la operacionn actual?',
            type: "warning",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, me equivoque',
            confirmButtonText: 'Si'
        }).then(function () {
            window.location.replace('{{route('pago_colegiatura_index')}}');
        }).catch(swal.noop);
    });

    $("#btn_pagocolegiatura").click(function(){
        var num_meses = countInputsEnabled();
        if(num_meses==0){alert('Ningun mes seleccionado');}
        else{
            var mes_meses = (num_meses <=1) ? num_meses + ' mes de colegiatura ?' : num_meses + ' meses de colegiatura ?';

            swal({
                title: 'Confirmar pago de colegiatura',
                html: 'Desea realizar el pago de: '+ $('#input_total_a_pagar').val() + ' que corrresponde a ' + mes_meses,
                type: "info",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Verificar',
                confirmButtonText: 'Si, es correcto'
            }).then(function () {
                $('#btn_calcular').attr("disabled", true);
                $('#btn_pagocolegiatura').attr("disabled", true);
                enviarMesesSeleccionados();

            }).catch(swal.noop);
            //alert('Pagar: '+num_meses+' '+'meses');
        }
    });

    function enviarMesesSeleccionados(){
        //http://programacionextrema.com/2015/11/09/obtener-todos-los-checkbox-seleccionados-en-jquery/
        //http://pandamonios.com/blog/array-dinamico-en-jquery-php/

        var DATA 	= [];
        var DATOS   = [];
        item = {};

        item["escuela_id"]     = "{{$escuela->id}}";
        item["ciclo_id"]       = "{{$ciclo->id}}";
        item["alumno_id"]      = "{{$alumno->id}}";
        item["grupo_id"]       = "{{$grupo->id}}";
        item["clasifgrupo_id"] = "{{$grupo->clasificacion_id}}";
        item["serie_recibo"]   = "{{($num_recibo->serie!=null) ? $num_recibo->serie : 'null'}}";
        item["folio_recibo"]   = "{{$num_recibo->folio}}";
        item["fecha_pago"]     = moment($("#datepicker").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD');

        if($("#input_total_a_pagar").inputmask("hasMaskedValue")){
            item["cantidad_recibida_mxn"]  = $("#input_total_a_pagar").inputmask('unmaskedvalue');
        }

        DATOS.push(item);

        $("input:checkbox:checked").each(function() {

            var fila = $(this).attr("name").slice(4);

            item = {};

            if($("#colegiatura_"+fila).inputmask("hasMaskedValue")){
                item ["importe_colegiatura"]  = $("#colegiatura_"+fila).inputmask('unmaskedvalue');
            }

            item["orden_mes"]   = $("#numorden_"+fila).val();
            item ["nombre_mes"] = fila;

            var rec = $("#recargo_"+fila).val();
            if(rec.length==0){
                item ["porcentaje_recargo"] 	    = 0;
            }else{
                item ["porcentaje_recargo"] 	    = $("#recargo_"+fila).val();
            }

            var desc = $("#descuento_"+fila).val();
            if(desc.length==0){
                item ["porcentaje_descuento"] 	    = 0;
            }
            else{
                item ["porcentaje_descuento"] 	    = $("#descuento_"+fila).val();
            }
            var now = moment().format('HH:mm:ss');
            item["fecha_pago"] = moment($("#datepicker").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD');


            DATA.push(item);

        });
        INFO 	= new FormData();
        aInfo 	= JSON.stringify(DATA);
        bInfo   = JSON.stringify(DATOS);

        INFO.append('meses',     aInfo);
        INFO.append('adicional', bInfo);

        var idPagoColegiatura = 0;
        var urlRoot = "{{Request::root()}}";

        $("#btn_imprimir" ).click(function() {
            window.open(urlRoot+'/pdf_ReciboColegiatura/'+idPagoColegiatura);
            return false;
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: INFO,
            type: 'POST',
            url : ' {{route('pago_colegiatura_store')}}',
            processData: false,
            contentType: false,
            dataType : 'json',
            success: function(data){
                swal({
                    title:"",
                    text: data.message,
                    type: "success",
                    allowOutsideClick: false,
                    confirmButtonText: 'Continuar'
                }).then(function(){
                    idPagoColegiatura = data.pago_colegiatura_id;
                    $("#btn_imprimir").removeAttr('disabled');
                }).catch(swal.noop);
            },
            error: function(xhr,status, response ){

                $('#btn_calcular').removeAttr('disabled');
                $('#btn_pagocolegiatura').removeAttr('disabled');
                $("#btn_imprimir").attr("disabled", true);

                //Obtener el valor de los errores devueltos por el controlador
                var error = jQuery.parseJSON(xhr.responseText);
                //Obtener los mensajes de error
                var info = error.message;
                //Verificar si el mensaje proviene de una Excepcion al guardar los datos
                var excepcion = error.exception;

                if(excepcion===true)
                {
                    var message_user = error.message_user;
                    var error_numeric_code = error.error_numeric_code;
                    var message_error = error.message_error;
                    swal({
                        title: (error_numeric_code != 0 )?'Codigo de Error: '+error_numeric_code : 'Error de Excepción',
                        html: (error_numeric_code != 0 )? message_error : message_user,
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Reintentar"
                    }).catch(swal.noop);
                }
                else
                {
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
                    }).catch(swal.noop);
                }

            }
        });
    }

    $( "#btn_calcular" ).click(function() {

        var aux      = 0;
        var cantidad = 0;

        //http://www.purojavascript.com/2012/05/recorrer-campos-de-un-formulario-con.html
        $("input[name^='importe']").each(function() {
            var elemento = this;
            var nombre    = elemento.name;
            aux = $("#"+nombre).inputmask('unmaskedvalue') * 1;

            if($("#"+nombre).attr('disabled')){}
            else{ cantidad = cantidad + aux; }

        });

        if(cantidad==0){auxiliar() }
        else{
            $("#btn_pagocolegiatura").removeAttr("disabled");

            $('#input_total_a_pagar').inputmask({
                alias: 'numeric',
                groupSeparator : ',',
                autoGroup : true,
                digits : 2,
                digitsOptional: false,
                placeholder: '0',
                prefix: '$ '
            });

            $('#input_total_a_pagar').val(cantidad);

        }
    });

});
</script>
@endsection