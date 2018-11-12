@extends('templates.app_age')

@section('title', 'Cambio de Grupo')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Cambiar Alumno de Grupo</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <div class="box box-success box-solid">

                    <div class="box-header with-border">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <h3 class="box-title">Complete los siguientes campos</h3> <small> Los campos marcados con (*) son obligatorios</small>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <form action="POST" id="frm_cambio_grupo" name="frm_cambio_grupo">
                            {{csrf_field()}}
                            <input type="hidden" id="id_grupo_alumno" name="id_grupo_alumno">
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nombre_alumno">Alumno: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="grupo_alumno">Grupo Actual: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="grupo_alumno" name="grupo_alumno" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="grupo_alumno_2">Nuevo Grupo: (*)</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select class="form-control" name="nuevo_grupo" id="nuevo_grupo" style="width: 100%;" required>
                                                    <option value="" selected="selected">[Elija un grupo]</option>
                                                    @foreach($grupos as $grupo)
                                                        <option value="{{ $grupo->numAlumnos < $grupo->grupo_alumnospermitidos ? $grupo->id : 0 }}">
                                                            {{$grupo->grupo_nombre}} ( {{$grupo->numAlumnos}} de {{$grupo->grupo_alumnospermitidos}} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </form>

                    </div>

                    <div class="box-footer">
                        <a class="btn btn-social btn-danger" href="">
                            <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                        </a>

                        <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_guardar">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Guardar Cambios
                        </button>
                    </div>

                </div>
                <!-- /.box -->

                <div class="box box-primary box-solid">

                    <div class="box-header with-border">
                        <h3 class="box-title">Alumnos Inscritos en el Ciclo Escolar: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="dt_listado_alumnos" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th style="width: 40%; text-align: center;">Alumno</th>
                                <th style="width: 30%; text-align: center;">Grupo Actual</th>
                                <th style="width: 15%; text-align: center;">Estado</th>
                                <th style="width: 15%"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($alumnos as $alumno)
                                <tr>
                                    <td>{{$alumno->id}}</td>
                                    <td style="width: 50%; text-align: left;">{{ucwords($alumno->nombreAlumno)}}</td>
                                    <td style="width: 20%; text-align: center;">
                                        {{$alumno->grupo_nombre}}
                                    </td>
                                    <td style="width: 15%; text-align: center;">
                                        <span class="badge bg-blue-gradient">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                                        </span>
                                    </td>
                                    <td style="width: 15%; text-align: center;">
                                        <button name="btn_elegir" id="btn_elegir" class="btn btn-xs bg-light-blue-gradient">
                                            <i class="fa fa-hand-o-right" aria-hidden="true"></i> Elegir
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
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
    var id_grupo=null;
    var urlRoot = "{{Request::root()}}";

    $('#nuevo_grupo').select2({
        allowClear: true,
        placeholder: '[Elija un grupo]'
    });

    $('#nuevo_grupo').change(function (){
        id_grupo = $(this).val();

        if(id_grupo==="0"){
            swal({
                title:"Error:",
                text: "El grupo seleccionado excede el numero de alumnos permitidos",
                type: "error",
                allowOutsideClick: false,
                confirmButtonColor: '#d33',
                confirmButtonText: "Corregir"
            }).catch(swal.noop);

            $(this).val(null).trigger('change');
        }
    });

    $("#boton_guardar").click(function(){

        if($('#nombre_alumno').val().length===0 || $('#grupo_alumno').val().length===0){
            swal({
                title: 'Atención',
                html: 'Es necesario que elija un alumno de la lista de Alumnos Inscritos',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }

        else if (id_grupo==="" || id_grupo === null){
            swal({
                title:"Error:",
                text: "Es necesario que elija el nuevo grupo de destino del alumno.",
                type: "error",
                allowOutsideClick: false,
                confirmButtonColor: '#d33',
                confirmButtonText: "Corregir"
            }).catch(swal.noop);
        }
        else{
            swal({
                title: 'Confirmar acción',
                html: '¿Desea hacer el cambio de grupo del alumno: <strong>'+ $('#nombre_alumno').val()  + '</strong>?',
                type: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText:'Si'
            }).then(function () {
                ajaxSubmitFormCambioDeGrupo();
            }).catch(swal.noop);
        }
    });

    function ajaxSubmitFormCambioDeGrupo(){
        $.ajax({
            type:"POST",
            url:"{{route('grupo_alumno_update')}}",
            data: $("#frm_cambio_grupo").serialize(),
            dataType : 'json',
            success: function(data){
                swal({
                    title:"",
                    text: data.message,
                    type: "success",
                    allowOutsideClick: false,
                    confirmButtonText: 'Continuar'
                }).then(function(){
                    location.reload()
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

    var dataTableAlumnos = $('#dt_listado_alumnos').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        language: {
            url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
        }
    });

    $('#dt_listado_alumnos tbody').on( 'click', 'button', function () {
        var data = dataTableAlumnos.row( $(this).parents('tr') ).data();
        $('#id_grupo_alumno').val(data[0]);
        $('#nombre_alumno').val(data[1]);
        $('#grupo_alumno').val(data[2]);

    });
});
</script>
@endsection