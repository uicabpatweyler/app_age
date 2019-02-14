@extends('templates.app_age')

@section('title', 'Recuperar Recibo de Venta')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Recuperar Recibo de Venta</h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">

                    <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title">Detalles del recibo de venta</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <form action="" method="POST" id="frm_recuperar_recibo_venta" name="frm_recuperar_recibo_venta">
                                {{csrf_field()}}
                                <input type="hidden" id="id_salida_producto" name="id_salida_producto" value="{{$salida->id}}">

                                <div class="row">

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="grupo">Recibo #:</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control text-bold text-center" style="color: red; font-size: large" id="folio_recibo" name="folio_recibo" value="{{$salida->folio_recibo < 100 ? '000'.$salida->folio_recibo : $salida->folio_recibo}}" disabled>
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
                                                        <input type="text" class="form-control" id="fecha_cancelacion" name="fecha_cancelacion" style="text-transform: capitalize" readonly>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="box-footer">
                            <a class="btn btn-social btn-danger" href="javascript:history.back()">
                                <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_guardar">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Recuperar Recibo
                            </button>
                        </div>
                        <!-- /.box-footer -->

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
        $('#fecha_cancelacion').val(moment('{{$salida->fecha_cancelacion->format('Y-m-d')}}', 'YYYY-MM-DD').format('DD-MMMM-YYYY'));

        $("#boton_guardar").click(function(){
            swal({
                title: 'Confirmar acción',
                html: '¿Desea realmente recuperar el recibo de venta #: <strong>'+ $('#folio_recibo').val()  + '</strong>?',
                type: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText:'Si'
            }).then(function () {
                ajaxSubmitForm();
            }).catch(swal.noop);
        });


        function ajaxSubmitForm(){
            $.ajax({
                type:"POST",
                url:"{{route('recuperar_venta')}}",
                data: $("#frm_recuperar_recibo_venta").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location.replace("{{route('cancelar_venta_index')}}");
                    });
                },
                error: function(xhr,status, response ){
                    //Obtener el valor del error devuelto por el controlador
                    var error = jQuery.parseJSON(xhr.responseText);
                    //Obtener el mensaje de error
                    var info = error.message;
                    //Mostrar el y/o los errores devuelto(s) por el controlador
                    swal({
                        title:"Error:",
                        html: info,
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Entendido"
                    });
                }
            });
        }

    });
</script>
@endsection