@extends('templates.app_age')

@section('title', 'Asignar Tutor a Alumno - Paso 2')

@section('content')

        <!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Asignar Grupo a Alumno
                <small>Paso 2: Elegir grupo</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-success">
                <div class="box-header with-border bg-green color-palette">
                    <h3 class="box-title">Datos del Grupo a Asignar</h3>
                </div>
                <div class="box-body">

                    <div class="box">
                        <div class="box-header">


                            <div class="box-tools pull-right">

                                <button class="btn btn-primary btn-sm pull-right" id="btn_guardar" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;" disabled>
                                    <i class="fa fa-floppy-o fa-lg"></i></button>

                                <a class="btn btn-danger btn-sm pull-right" href="{{route('grupo_alumno_elegiralumno')}}" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                            </div>

                        </div>

                        <div class="box-body">
                            <form action="" role="form" name="form_grupo_alumno" id="form_grupo_alumno">
                                {{csrf_field()}}
                                <input type="hidden" name="escuela_id" id="escuela_id" value="{{$escuela_id}}">
                                <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo_id}}">
                                <input type="hidden" name="alumno_id" id="alumno_id" value="{{$alumno_id}}">
                                <input type="hidden" name="grupo_id" id="grupo_id" value="">
                                <input type="hidden" name="clasifgrupo_id" id="clasifgrupo_id" value="">
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">

                                <div class="row">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="escuela_nombre">Escuela(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control" id="escuela_nombre" name="escuela_nombre" value="{{$e->escuela_nombre}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="nombre_alumno">Alumno (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="{{$a->alumno_primernombre}} {{$a->alumno_segundonombre}} {{$a->alumno_apellidopaterno}} {{$a->alumno_apellidomaterno}}" id="nombre_alumno" name="nombre_alumno" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="ciclo_escolar">Ciclo(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="{{$c->ciclo_anioinicial}}-{{$c->ciclo_aniofinal}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nombre_nivel">Nivel(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="" id="nombre_nivel" name="nombre_nivel" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nombre_grupo">Grupo(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="" id="nombre_grupo" name="nombre_grupo" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>

                        <table class="table table-striped" id="dt_listado_grupos">
                            <thead>
                            <tr>
                                <th style="width: 10%; text-align: center">#</th>
                                <th style="display: none">ID</th>
                                <th style="width: 20%; text-align: center">Ciclo</th>
                                <th style="width: 25%; text-align: center">Nivel</th>
                                <th style="width: 25%; text-align: center">Nombre</th>
                                <th style="width: 20%; text-align: center">Alumnos</th>
                                <th style="display: none"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1 ?>
                            @foreach($grupos as $grupo)
                                <tr>
                                    <td align="center"><strong>{{$i++}}</strong></td>
                                    <td style="display: none">{{$grupo->id}}</td>
                                    <td align="center">{{$grupo->CicloGrupo->ciclo_anioinicial}}-{{$grupo->CicloGrupo->ciclo_aniofinal}}</td>
                                    <td align="center">{{$grupo->ClasificacionGrupo->clasificacion_nombre}}</td>
                                    <td align="center">{{$grupo->grupo_nombre}}</td>
                                    <td></td>
                                    <td style="display: none">{{$grupo->clasificacion_id}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
            $('#dt_listado_grupos').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                language: {
                    url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                }
            });

            var table = $('#dt_listado_grupos').DataTable();

            $('#dt_listado_grupos tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                $('#grupo_id').val(data[1])
                $('#nombre_nivel').val(data[3]);
                $('#nombre_grupo').val(data[4]);
                $('#clasifgrupo_id').val(data[6]);

                $("#btn_guardar").removeAttr('disabled');

            } );

            $( "#btn_guardar" ).click(function() {
                swal({
                    title: '¿Los datos son correctos?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si'
                }).then(function () {
                    ajaxSubmit();
                }).catch(swal.noop);
                //$( "#form_tutor_alumno" ).submit();
            });

            function ajaxSubmit(){
                $.ajax({
                    type:"POST",
                    url:"{{route('grupo_alumno_store')}}",
                    data: $("#form_grupo_alumno").serialize(),
                    dataType : 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            window.location.replace("../../../../pago_inscripcion_create/"+data.grupo_alumno_id);
                        }).catch(swal.noop);
                    },
                    error: function(xhr,status, response ){
                        //Obtener el valor de los errores devueltos por el controlador
                        var error = jQuery.parseJSON(xhr.responseText);
                        //Obtener los mensajes de error
                        var info = error.message;
                        //Verificar si el mensaje proviene de una Excepcion al guardar los datos
                        var excepcion = error.exception;

                        if(excepcion===true)
                        {
                            var message_user = error.message_user;
                            var error_numeric_code = error.error_numeric_code;
                            var message_error = error.message_error;
                            swal({
                                title: (error_numeric_code != 0 )?'Codigo de Error: '+error_numeric_code : 'Error de Excepción',
                                html: (error_numeric_code != 0 )? message_error : message_user,
                                type: "error",
                                allowOutsideClick: false,
                                confirmButtonColor: '#d33',
                                confirmButtonText: "Reintentar"
                            }).catch(swal.noop);
                        }
                        else if(error.integridad===true){
                            console.log(error.message);
                            swal({
                                title: 'Error de duplicación',
                                html: error.message,
                                type: "error",
                                allowOutsideClick: false,
                                confirmButtonColor: '#d33',
                                confirmButtonText: "Verificar"
                            }).catch(swal.noop);
                        }
                        else
                        {
                            //Crear la lista de errores
                            var errorsHtml = '<ul>';
                            $.each(info, function (key,value) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            errorsHtml += '</ul>';
                            //Mostrar el y/o los errores devuelto(s) por el controlador
                            swal({
                                title:"Error:",
                                html: errorsHtml,
                                type: "error",
                                allowOutsideClick: false,
                                confirmButtonColor: '#d33',
                                confirmButtonText: "Corregir"
                            }).catch(swal.noop);
                        }

                    }
                });
            }
        });
    </script>
@endsection