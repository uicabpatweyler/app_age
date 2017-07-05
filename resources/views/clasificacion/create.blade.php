@extends('templates.app_age')

@section('title', 'Agregar nueva clasificacion')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Nueva clasificación
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
                            <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">

                            <div class="box-body">

                                <div class="form-group">
                                    <label for="clasificacion_cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="clasificacion_cicloescolar" name="clasificacion_cicloescolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_id" class="col-sm-2 control-label"><p class="text-left">Escuela:</p></label>
                                    <div class="col-sm-5">
                                        <select name="escuela_id" id="escuela_id" class="form-control select_escuela_id" style="width: 100%;">
                                            <option value="-1" selected>[Elija una escuela]</option>
                                            @foreach($escuelas as $escuela)
                                                <option value="{{$escuela->id}}">
                                                    {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}</option>
                                            @endforeach    
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="clasificacion_nombre" class="col-sm-2 control-label"><p class="text-left">Clasificación:(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="clasificacion_nombre" name="clasificacion_nombre" placeholder="Clasificación">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="clasificacion_abreviacion" class="col-sm-2 control-label"><p class="text-left">Abreviación:</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="clasificacion_abreviacion" name="clasificacion_abreviacion" placeholder="Abreviación">
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
    $(document).ready(function () {
        $('.select_escuela_id').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elija una escuela]'
            }
        });
    });
</script>
@endsection