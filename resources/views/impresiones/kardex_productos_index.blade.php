@extends('templates.app_age')

@section('title', 'Reporte de Kardex de Productos')

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
                        <h3 class="box-title">Imprimir Kardex de Productos por Categoria <small>Los campos marcados con (*) son obligatorios</small></h3>
                    </div>
                    <!-- /.box-header -->



                    <div class="box-body">
                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="categoria_id">Categoria (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12 myerror">
                                            <select class="form-control" name="categoria_id" id="categoria_id" style="width: 100%;" required>
                                                <option value="" selected="selected">[Elija una categoria]</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">
                                                        {{$categoria->categprod_nombre}}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="btn  btn-social btn-dropbox" id="btn_generar_reporte" disabled>
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Reporte PDF</button>
                                        </div>
                                    </div>
                                </div>

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

        var categoria_id;
        var urlRoot = "{{Request::root()}}";

        $('#categoria_id').select2({
            allowClear: true,
            placeholder: '[Elija una categoria]'
        });

        $('#categoria_id').change(function () {
            categoria_id = $(this).val();

            //El usuario no selecciono algun elemento
            if(categoria_id===null) {}

            //El usuario elimina la seleccion del select
            else if(categoria_id===""){
                $("#btn_generar_reporte").attr("disabled", true);
            }
            else{
                $("#btn_generar_reporte").removeAttr('disabled');
            }
        });

        $("#btn_generar_reporte" ).click(function() {
            window.open(urlRoot+'/pdf_KardexProducto/'+categoria_id);
            return false;
        });
    });
</script>
@endsection