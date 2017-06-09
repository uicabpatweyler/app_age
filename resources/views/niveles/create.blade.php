@extends('templates.app_age')

@section('title', 'Agregar nuevo nivel')

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
                    Agregar nuevo nivel
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
                        <form class="form-horizontal" method="post" action="">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nivel_categoria" class="col-sm-2 control-label"><p class="text-left">Categoría del nivel: (*)</p></label>
                                    <div class="col-sm-3">
                                        <select class="form-control nivel_categoria" style="width: 100%;">
                                            <option selected="selected" value="-1">[Seleccione una opcion]</option>
                                            <option value="Educación inicial">Educación inicial</option>
                                            <option value="Educación básica">Educación básica</option>
                                            <option value="Educación preescolar">Educación preescolar</option>
                                            <option value="Educación primaria">Educación primaria</option>
                                            <option value="Educación secundaria">Educación secundaria</option>
                                            <option value="Educación media superior"> Educación media superior</option>
                                            <option value="Educación superior"> Educación superior</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nivel_nombre" class="col-sm-2 control-label"><p class="text-left">Nombre del nivel: (*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="nivel_nombre" name="nivel_nombre" placeholder="Nivel">
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
    $(".nivel_categoria").select2();
</script>
@endsection