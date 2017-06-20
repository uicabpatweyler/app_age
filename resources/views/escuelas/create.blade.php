@extends('templates.app_age')

@section('title','Agregar nueva escuela')

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
                                    <label for="escuela_tiposervicio" class="col-sm-2 control-label"><p class="text-left">Tipo de Servicio:</p></label>
                                    <div class="col-sm-3">
                                        <select id="escuela_tiposervicio" name="escuela_tiposervicio" class="form-control escuela_tiposervicio" style="width: 100%;">
                                            <option value="-1" selected>[Elija una opción]</option>
                                            @foreach($tiposdeservicio as $tipodeservicio)
                                                <option value="{{$tipodeservicio->id}}">{{$tipodeservicio->tiposervicio_nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <select id="escuela_nivel" name="escuela_nivel" class="form-control escuela_nivel" style="width: 100%;">
                                            <option value="-1" selected>[Seleccione un nivel]</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <select id="escuela_servicio" name="escuela_servicio" class="form-control escuela_servicio" style="width: 100%;">
                                            <option value="-1" selected>[Tipo de Servicio]</option>
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
<script>
    //http://www.snie.sep.gob.mx/SNIESC/default.aspx
    $(document).ready(function () {
        $('.escuela_tiposervicio').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elija una opción]'
            }
        });

        $('.escuela_nivel').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Seleccione un nivel]'
            }
        });

        $('.escuela_servicio').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Tipo de Servicio]'
            }
        });

        $(".escuela_nivel").attr('disabled','-1');
        $(".escuela_servicio").attr('disabled','-1');

        $.fn.populateSelect = function (values) {
            var options = '';
            $.each(values, function (key, row) {
                options += '<option value="' + row.value + '">' + row.text + '</option>';
            });
            $(this).html(options);
        }

        $('.escuela_tiposervicio').change(function () {

            $(".escuela_nivel").removeAttr('disabled');

            $('.escuela_nivel').empty().change();
            $('.escuela_servicio').empty().change();

            var tiposervicio_id = $(this).val();

            $.getJSON('/listaAjaxNiveles/'+tiposervicio_id, null, function (values) {
                $('.escuela_nivel').populateSelect(values);
            });
        });

        $('.escuela_nivel').change(function () {
            var nivel_id = $(this).val();
            if(nivel_id===null){
                console.log('No hacer nada');
            }
            else{
                $(".escuela_servicio").removeAttr('disabled');
                $(".escuela_servicio").empty().change();
                $.getJSON('/listaAjaxServicios/'+nivel_id, null, function (values) {
                    $('.escuela_servicio').populateSelect(values);
                });
            }
        });
    });



</script>
@endsection