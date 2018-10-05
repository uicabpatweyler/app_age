@extends('templates.app_age')

@section('title', 'Pago de la cuota de inscripción')

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
                        <h3 class="box-title">Pago de la cuota de inscripción</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Ciclo Escolar:</td>
                                        <td style="width: 70%" class=""> <strong>{{$inscripcion->CicloGrupoAlumno->ciclo_anioinicial}}-{{$inscripcion->CicloGrupoAlumno->ciclo_aniofinal}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Escuela:</td>
                                        <td style="width: 70%" class=""> <strong>{{$inscripcion->EscuelaGrupoAlumno->escuela_nombre}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Alumno:</td>
                                        <td style="width: 70%" class=""> <strong>{{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_primernombre)}} {{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_segundonombre)}} {{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_apellidopaterno)}} {{ucwords($inscripcion->AlumnoGrupoAlumno->alumno_apellidomaterno)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-light-blue color-palette">Matricula:</td>
                                        <td style="width: 70%" class="">
                                            @if($inscripcion->alumno_id<10)
                                                <strong>00{{$inscripcion->alumno_id}}-{{$inscripcion->AlumnoGrupoAlumno->created_at->format('dmy')}}</strong>
                                            @elseif($inscripcion->alumno_id<100)
                                                <strong>0{{$inscripcion->alumno_id}}-{{$inscripcion->AlumnoGrupoAlumno->created_at->format('dmy')}}</strong>
                                            @else
                                                <strong>0{{$inscripcion->alumno_id}}-{{$inscripcion->AlumnoGrupoAlumno->created_at->format('dmy')}}</strong>
                                            @endif
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
                                        <td style="width: 70%" class="text-center"> <strong>{{$inscripcion->ClasifGrupoAlumno->clasificacion_nombre}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%" class="bg-green color-palette">Grupo :</td>
                                        <td style="width: 70%" class="text-center"> <strong>{{$inscripcion->GrupoDeGrupoAlumno->grupo_nombre}}</strong> </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 15%" class="bg-gray color-palette text-center">Cantidad</th>
                                        <th style="width: 50%" class="bg-gray color-palette text-center">Concepto</th>
                                        <th style="width: 20%" class="bg-gray color-palette text-center">Ciclo</th>
                                        <th style="width: 15%" class="bg-gray color-palette text-center">Importe</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="width: 15%" class="text-center">1</td>
                                        <td style="width: 50%" class="text-center">Cuota de Inscripción</td>
                                        <td style="width: 20%" class="text-center">{{$inscripcion->CicloGrupoAlumno->ciclo_anioinicial}}-{{$inscripcion->CicloGrupoAlumno->ciclo_aniofinal}}</td>
                                        <td style="width: 15%" class="text-center">$ {{number_format($cuota->cuotainscripcion_cuota,2,'.',',')}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-12">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 15%" class=""></th>
                                        <th style="width: 50%" class=""></th>
                                        <th style="width: 20%" class="bg-gray color-palette text-center">Total</th>
                                        <th style="width: 15%" class="text-center">$ {{number_format($cuota->cuotainscripcion_cuota,2,'.',',')}}</th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>

                        <br />

                        <div class="col-sm-12">
                            <div class="row">
                                <table class="table">

                                    <tr>
                                        <td style="width: 15%" class=""></td>
                                        <td style="width: 60%" class="">
                                            <button class="btn  btn-social btn-dropbox" id="btn_pagoinscripcion" data-toggle="tooltip" title="" style="margin-right: 5px;">
                                                <i class="fa fa-usd" aria-hidden="true"></i> Pagar Inscripción</button>

                                            <button class="btn  btn-social btn-facebook" id="btn_imprimir" data-toggle="tooltip" title="" style="margin-right: 5px;" disabled>
                                                <i class="fa fa-print" aria-hidden="true"></i> Imprimir Recibo</button>

                                            <button class="btn  btn-social btn-linkedin" id="btn_hojainscripcion" data-toggle="tooltip" title="" style="margin-right: 5px;" disabled>
                                                <i class="fa fa-address-card-o" aria-hidden="true"></i> Hoja de Inscripción</button>

                                        </td>
                                        <td style="width: 10%" class=""></td>
                                        <td style="width: 15%" class=""></td>
                                    </tr>


                                </table>
                            </div>
                        </div>

                        <form action="post" role="form" name="form_pagoinscripcion" id="form_pagoinscripcion">
                            {{csrf_field()}}
                            <input type="hidden" name="escuela_id" id="escuela_id" value="{{$inscripcion->escuela_id}}">
                            <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$inscripcion->ciclo_id}}">
                            <input type="hidden" name="grupo_id" id="grupo_id" value="{{$inscripcion->grupo_id}}">
                            <input type="hidden" name="alumno_id" id="alumno_id" value="{{$inscripcion->alumno_id}}">
                            <input type="hidden" name="clasifgrupo_id" id="clasifgrupo_id" value="{{$inscripcion->clasifgrupo_id}}">
                            <input type="hidden" name="inscripcion_id" id="inscripcion_id" value="{{$inscripcion->id}}">
                            <input type="hidden" name="serie_recibo" id="serie_recibo" value="{{$num_recibo->serie}}">
                            <input type="hidden" name="folio_recibo" id="folio_recibo" value="{{$num_recibo->folio}}">
                            <input type="hidden" name="cantidad_concepto" id="cantidad_concepto" value="1">
                            <input type="hidden" name="importe_cuota" id="importe_cuota" value="{{$cuota->cuotainscripcion_cuota}}">
                            <input type="hidden" name="porcentaje_descuento" id="porcentaje_descuento" value="0">
                            <input type="hidden" name="descuento_pesos" id="descuento_pesos" value="0">
                            <input type="hidden" name="fecha_pago" id="fecha_pago" value="">

                        </form>

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

    var idPagoInscripcion = 0;

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

    console.log(moment().format('HH:mm:ss'));

    $( "#btn_pagoinscripcion" ).click(function() {
        swal({
            title: 'Pago de inscripción',
            text: "Se procedera a realizar el pago correspondiente",
            type: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Si'
        }).then(function () {
            ajaxSubmit();
        }).catch(swal.noop);

        $("#btn_hojainscripcion" ).click(function() {
            window.open('{{route('pdf_HojaInscripcionAlumno',['id_ga'=>$inscripcion->id])}}');
            return false;
        });

        $("#btn_imprimir" ).click(function() {
            window.open('../../pdf_ReciboInscripcion/'+idPagoInscripcion);
            return false;
        });

        function ajaxSubmit(){
            $("#fecha_pago").val(moment($("#datepicker").val(), "DD-MMMM-YYYY").format('YYYY-MM-DD')+moment().format('HH:mm:ss'));
            $.ajax({
                type:"POST",
                url:"{{route('pago_inscripcion_store')}}",
                data: $("#form_pagoinscripcion").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        idPagoInscripcion = data.pago_inscripcion_id;
                        $("#btn_imprimir").removeAttr('disabled');
                        $("#btn_hojainscripcion").removeAttr('disabled');
                        $('#btn_pagoinscripcion').attr("disabled", true);
                        //window.location.replace("");
                    }).catch(swal.noop);
                },
                error: function(xhr,status, response ){
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

    });
});
</script>
@endsection