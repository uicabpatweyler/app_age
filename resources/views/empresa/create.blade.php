@extends('templates.app_age')

@section('title', 'Datos de la empresa')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Datos de la Empresa
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Ingrese los siguientes datos</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="{{route('guardarempresa')}}" id="form_empresa">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group empresa_rfc">
                                    <label for="empresa_rfc" class="col-sm-2 control-label"><p class="text-left">RFC: (*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_rfc" name="empresa_rfc" placeholder="RFC" value="{{old('empresa_rfc')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="empresa_razonsocial" class="col-sm-2 control-label"><p class="text-left">Razón Social (*)</p></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="empresa_razonsocial" name="empresa_razonsocial" placeholder="Razón Social" value="{{old('empresa_razonsocial')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_regimenfiscal" class="col-sm-2 control-label"><p class="text-left">Regimen Fiscal (*)</p></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="empresa_regimenfiscal" name="empresa_regimenfiscal" placeholder="Regimen Fiscal" value="{{old('empresa_regimenfiscal')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_direccion" class="col-sm-2 control-label"><p class="text-left">Dirección Fiscal (*)</p></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="empresa_direccion" name="empresa_direccion" placeholder="Calle" value="{{old('empresa_direccion')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_numexterior" class="col-sm-2 control-label"><p class="text-left">Número. Ext(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_numexterior" name="empresa_numexterior" placeholder="Número Ext." value="{{old('empresa_numexterior')}}">
                                    </div>
                                    <label for="empresa_numinterior" class="col-sm-2 control-label">Número Int.</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_numinterior" name="empresa_numinterior" placeholder="Número Int." value="{{old('empresa_numinterior')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_referencia" class="col-sm-2 control-label"><p class="text-left">Referencia (*)</p></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="empresa_referencia" name="empresa_referencia" placeholder="Cruzamientos/Esquina/Entre Calles" value="{{old('empresa_referencia')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_telefono" class="col-sm-2 control-label"><p class="text-left">Teléfono</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_telefono" name="empresa_telefono" placeholder="(983)-000-0000" value="{{old('empresa_telefono')}}">
                                    </div>
                                    <label for="empresa_email" class="col-sm-2 control-label">E-mail</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_email" name="empresa_email" placeholder="usuario@dominio.com" value="{{old('empresa_email')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_estado" class="col-sm-2 control-label"><p class="text-left">Estado(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_estado" name="empresa_estado" value="{{old('empresa_estado')}}">
                                    </div>
                                    <label for="empresa_delegacion" class="col-sm-2 control-label">Delegación/Municipio(*)</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_delegacion" name="empresa_delegacion" value="{{old('empresa_delegacion')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_localidad" class="col-sm-2 control-label"><p class="text-left">Localidad(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_localidad" name="empresa_localidad" value="{{old('empresa_localidad')}}">
                                    </div>
                                    <label for="empresa_colonia" class="col-sm-2 control-label">Colonia(*)</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_colonia" name="empresa_colonia" value="{{old('empresa_colonia')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="empresa_codigopostal" class="col-sm-2 control-label"><p class="text-left">Código Postal(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_codigopostal" name="empresa_codigopostal" value="{{old('empresa_codigopostal')}}">
                                    </div>
                                    <label for="empresa_pais" class="col-sm-2 control-label">País(*)</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="empresa_pais" name="empresa_pais" value="{{old('empesa_pais')}}">
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar</button>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar Datos</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
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
        $("#empresa_rfc").inputmask("A{3,4}-9{6}-A|9{3}");
        $("#empresa_telefono").inputmask("(999)-999-9999");

        //Validacion del formulario
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });

            $("#form_empresa").validate({
                focusCleanup: true,
                rules: {
                    empresa_rfc: { required: true },
                    empresa_razonsocial:{ required: true }
                },
                invalidHandler: function(event, validator){
                    var errors = validator.numberOfInvalids();
                    if (errors){
                        var message = errors == 1
                            ? 'You missed 1 field. It has been highlighted'
                            : 'You missed ' + errors + ' fields. They have been highlighted';
                        swal({
                            title:"Error:",
                            text: message,
                            type: "error",
                            allowOutsideClick: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: "Corregir"
                        });
                        //console.log(message);
                    }
                }
            });

        });
</script>
@endsection