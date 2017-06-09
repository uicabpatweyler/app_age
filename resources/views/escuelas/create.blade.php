@extends('templates.app_age')

@section('title','Agregar nueva escuela')

@section('css')
<!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
@endsection

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Agregar nueva escuela
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
                        <form action="" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="escuela_nivel" class="col-sm-2 control-label"><p class="text-left">Nivel:</p></label>
                                    <div class="col-sm-3">
                                        <select id="escuela_nivel" name="escuela_nivel" class="form-control escuela_nivel" style="width: 100%;">
                                            <option value="-1" selected>No Aplica</option>
                                            <option>Pre-escolar</option>
                                            <option>Primaria</option>
                                            <option>Secundaria</option>
                                            <option>Preparatoria</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre:(*)</p></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="escuela_nombre" name="escuela_nombre" placeholder="Nombre de la escuela">
                                    </div>
                                    <label for="escuela_clavect" class="col-sm-1 control-label">Clave</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_clavect" name="escuela_clavect" placeholder="Clave CT">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_direccion" class="col-sm-2 control-label"><p class="text-left">Dirección(*)</p></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="escuela_direccion" name="escuela_direccion" placeholder="Direccion">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="escuela_numexterior" name="escuela_numexterior" placeholder="Num. Ext.">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="escuela_numinterior" name="escuela_numinterior" placeholder="Num. Int.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_referencias" class="col-sm-2 control-label"><p class="text-left">Referencias</p></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="escuela_referencias" name="escuela_referencias" placeholder="Cruzamientos/Esquina/Entre Calles">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_estado" class="col-sm-2 control-label"><p class="text-left">Estado(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_estado" name="escuela_estado">
                                    </div>
                                    <label for="escuela_delegacionmunicipio" class="col-sm-2 control-label">Delegación/Municipio(*)</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_delegacionmunicipio" name="escuela_delegacionmunicipio">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_localidad" class="col-sm-2 control-label"><p class="text-left">Localidad(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_localidad" name="escuela_localidad">
                                    </div>
                                    <label for="escuela_colonia" class="col-sm-2 control-label">Colonia(*)</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_colonia" name="escuela_colonia">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_codpost" class="col-sm-2 control-label"><p class="text-left">Código Postal(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_codpost" name="escuela_codpost">
                                    </div>
                                    <label for="escuela_pais" class="col-sm-2 control-label">País(*)</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="escuela_pais" name="escuela_pais">
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
<!-- Select2 -->
<script src="{{asset('adminlte//plugins/select2/select2.full.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
    $(".escuela_nivel").select2();
</script>
@endsection