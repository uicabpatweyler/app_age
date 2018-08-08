@extends('templates.app_age')

@section('title', 'Asignar Tutor a Alumno - Paso 2')

@section('content')

        <!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Asignar Tutor a Alumno
                <small>Paso 2</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-success">
                <div class="box-header with-border bg-green color-palette">
                    <h3 class="box-title">Elegir Alumno a Asignar</h3>
                </div>
                <div class="box-body">

                    <div class="box">
                        <div class="box-header">


                            <div class="box-tools pull-right">

                                <button class="btn btn-primary btn-sm pull-right" id="btn_guardar" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;" disabled>
                                    <i class="fa fa-floppy-o fa-lg"></i></button>

                                <a class="btn btn-danger btn-sm pull-right" href="{{route('asignar_tutor_elegirtutor')}}" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                            </div>

                        </div>

                        <div class="box-body">
                            <form action="" role="form" name="form_tutor_alumno" id="form_tutor_alumno">
                                {{csrf_field()}}
                                <input type="hidden" name="escuela_id" id="escuela_id" value="">
                                <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                                <input type="hidden" name="tutor_id" id="tutor_id" value="{{$tutor_id}}">
                                <input type="hidden" name="alumno_id" id="alumno_id" value="">
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="escuela_nombre">Escuela(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control" id="escuela_nombre" name="escuela_nombre" value="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ciclo_escolar">Ciclo Escolar(*)</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nombre_tutor">Tutor Elegido(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="{{$nombre_tutor}}" id="nombre_tutor" name="nombre_tutor" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nombre_alumno">Alumno Seleccionado(*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="" id="nombre_alumno" name="nombre_alumno" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table id="dt_lista_datos_inscripcion" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="width: 10%;">#</th>
                            <th style="width: 15%">Ciclo</th>
                            <th style="width: 20%;">Nombre(s)</th>
                            <th style="width: 20%;">Apellido Paterno</th>
                            <th style="width: 20%;">Apellido Materno</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach($dias as $dia)
                        <tr>
                            <td style="width: 10%;"><strong>{{$i++}}</strong></td>
                            <td style="width: 15%">{{$dia->CicloDatosInscripcionAlumno->ciclo_anioinicial}}-{{$dia->CicloDatosInscripcionAlumno->ciclo_aniofinal}}</td>
                            <td style="width: 20%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_primernombre)}} {{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_segundonombre)}}</td>
                            <td style="width: 20%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidopaterno)}}</td>
                            <td style="width: 20%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidomaterno)}}</td>
                            <td>{{$dia->EscuelaDatosInscripcionAlumno->escuela_nombre}}</td>
                            <td>{{$dia->escuela_id}}</td>
                            <td>{{$dia->alumno_id}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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

        $('#dt_lista_datos_inscripcion').DataTable({
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

        var table = $('#dt_lista_datos_inscripcion').DataTable();
        //Ocultar las siguientes columnas:
        //ESCUELA_ID, ESCUELA_NOMBRE, ALUMNO_ID
        table.columns( [5,6,7] ).visible( false );

        $('#dt_lista_datos_inscripcion tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            $('#escuela_nombre').val(data[5]);
            $('#escuela_id').val(data[6]);
            $('#alumno_id').val(data[7])
            $('#ciclo_escolar').val(data[1]);
            $('#nombre_alumno').val(data[2]+' '+data[3]+' '+data[4]);

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
                url:"{{route('asignar_tutor_alumno_store')}}",
                data: $("#form_tutor_alumno").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location.replace("{{route('asignar_tutor_elegirtutor')}}");
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