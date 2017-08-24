@extends('templates.app_age')

@section('title', 'Seleccionar Cuota de Inscripción')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Asignar Cuota de Inscripción
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <a class="btn btn-xs btn-success" href="javascript:history.back(1)">
                                <i class="fa fa-reply fa-lg" aria-hidden="true"></i> Regresar</a>

                            <h3 class="box-title"> Seleccionar cuota de inscripción</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="" name="form_asignar_cdi" id="form_asignar_cdi">
                            {{csrf_field()}}
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="grupo_cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="grupo_cicloescolar" name="grupo_cicloescolar" value="{{$grupo->CicloGrupo->ciclo_anioinicial}}-{{$grupo->CicloGrupo->ciclo_aniofinal}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_escuela" class="col-sm-2 control-label"><p class="text-left">Escuela:</p></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="grupo_escuela" name="grupo_escuela" value="{{$grupo->EscuelaGrupo->escuela_nombre}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_clasificacion" class="col-sm-2 control-label"><p class="text-left">Clasificación:</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  id="grupo_clasificacion" name="grupo_clasificacion" value="{{$grupo->ClasificacionGrupo->clasificacion_nombre}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="grupo_nombre" class="col-sm-2 control-label"><p class="text-left">Grupo:</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  id="grupo_nombre" name="grupo_nombre" value="{{$grupo->grupo_nombre}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cuotainscripcion_id" class="col-sm-2 control-label"><p class="text-left">Cuota de Inscripción:(*)</p></label>
                                    <div class="col-sm-5">
                                        <select id="cuotainscripcion_id" name="cuotainscripcion_id" class="form-control cuotainscripcion_id" style="width: 100%;">
                                            <option value="-1" selected>[Seleccione una cuota de inscripción]</option>
                                            @foreach($cuotas as $cuota)
                                                <option value="{{$cuota->id}}">{{$cuota->cuotainscripcion_nombre}} ( $ {{number_format($cuota->cuotainscripcion_cuota, 2, '.', ',')}} )</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-danger" href="">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                                <button type="submit" class="btn btn-primary pull-right" name="boton_enviar" id="boton_enviar">
                                    <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar Datos</button>
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
            $('.cuotainscripcion_id').select2({
                allowClear: true,
                placeholder: {
                    id: "-1",
                    text: '[Seleccione una cuota de inscripción]'
                }
            });
        });


    </script>
@endsection