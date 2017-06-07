@extends('mylayouts.app_age')

@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Datos de la organización
                <small></small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-university" aria-hidden="true"></i> Ingrese los siguientes datos</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{route('altadeorganizacion')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="organizacion_rfc" class="col-sm-2 control-label"><p class="text-left">RFC: (*)</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_rfc" name="organizacion_rfc" placeholder="RFC">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="organizacion_razonsocial" class="col-sm-2 control-label"><p class="text-left">Razón Social (*)</p></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="organizacion_razonsocial" name="organizacion_razonsocial" placeholder="Razón Social">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_regimenfiscal" class="col-sm-2 control-label"><p class="text-left">Regimen Fiscal (*)</p></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="organizacion_regimenfiscal" name="organizacion_regimenfiscal" placeholder="Regimen Fiscal">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_direccion" class="col-sm-2 control-label"><p class="text-left">Dirección Fiscal (*)</p></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="organizacion_direccion" name="organizacion_direccion" placeholder="Calle">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_numexterior" class="col-sm-2 control-label"><p class="text-left">Número. Ext</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_numexterior" name="organizacion_numexterior" placeholder="Número Ext.">
                                </div>
                                <label for="organizacion_numinterior" class="col-sm-2 control-label">Número Int.</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_numinterior" name="organizacion_numinterior" placeholder="Número Int.">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_referencia" class="col-sm-2 control-label"><p class="text-left">Referencia</p></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="organizacion_referencia" name="organizacion_referencia" placeholder="Cruzamientos/Esquina/Entre Calles">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_estado" class="col-sm-2 control-label"><p class="text-left">Estado</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_estado" name="organizacion_estado">
                                </div>
                                <label for="organizacion_delegmunic" class="col-sm-2 control-label">Delegación/Municipio</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_delegmunic" name="organizacion_delegmunic">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_localidad" class="col-sm-2 control-label"><p class="text-left">Localidad</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_localidad" name="organizacion_localidad">
                                </div>
                                <label for="organizacion_colonia" class="col-sm-2 control-label">Colonia</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_colonia" name="organizacion_colonia">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organizacion_codpost" class="col-sm-2 control-label"><p class="text-left">Código Postal</p></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_codpost" name="organizacion_codpost">
                                </div>
                                <label for="organizacion_pais" class="col-sm-2 control-label">País</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="organizacion_pais" name="organizacion_pais">
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
@endsection