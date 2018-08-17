@extends('templates.app_age')

@section('title', 'Agregar Nuevo Alumno')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Agregar Nuevo Alumno
                <small> Verificar C.U.R.P. para evitar duplicados</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Utilice este formulario si el alumno <strong>no ha sido registrado</strong> previamente en ciclos escolares anteriores.</h3>
                    </div>
                    <!-- /.box-header -->

                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="" id="form_verificarcurp" name="form_verificarcurp">
                        {{csrf_field()}}
                        <input type="hidden" name="alumno_curp" id="alumno_curp">

                        <!-- box-body start -->
                        <div class="box-body">

                            <div class="form-group curp">
                                <label for="curp" class="col-sm-2 control-label">C.U.R.P del alumno: (*)</label>

                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="curp" name="curp" placeholder="UIPW810622HYNCTY02" required >
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                                <a class="btn btn-social btn-danger" href="">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                                </a>

                            <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_verificarcurp">
                                <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>
                                Verificar C.U.R.P
                            </button>
                        </div>
                        <!-- /.box-footer -->

                    </form>
                    <!-- form end -->

                </div>
                <!-- /.box -->

                <div class="box box-success">
                    <div class="box-header with-border bg-green color-palette">
                        <h3 class="box-title">Listado de Alumnos: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                    </div>
                    <div class="box-body">
                        <table id="dt_listado_alumnos" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">Ciclo</th>
                                <th style="width: 15%; text-align: center"></th>
                                <th style="width: 15%; text-align: center">Alumno</th>
                                <th style="width: 15%; text-align: center"></th>
                                <th style="width: 20%; text-align: center">Grupo/Pago I.</th>
                                <th style="width: 20%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1 ?>
                            @foreach($dias as $dia)
                                <tr>
                                    <td style="width: 5%;"><strong>{{$i++}}</strong></td>
                                    <td style="width: 10%">{{$dia->CicloDatosInscripcionAlumno->ciclo_anioinicial}}-{{$dia->CicloDatosInscripcionAlumno->ciclo_aniofinal}}</td>
                                    <td style="width: 15%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_primernombre)}} {{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_segundonombre)}}</td>
                                    <td style="width: 15%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidopaterno)}}</td>
                                    <td style="width: 15%;">{{ucwords($dia->AlumnoDatosInscripcionAlumno->alumno_apellidomaterno)}}</td>
                                    <td style="width: 20%;" align="center">
                                        @if ($dia->grupo_nombre!=null)
                                            <small class="label label-success"><i class="fa fa-check"></i> {{$dia->grupo_nombre}}</small>
                                        @endif

                                        @if ($dia->pago_inscripcion!=null)
                                            <small class="label label-success"><i class="fa fa-dollar"></i> </small>
                                        @endif
                                    </td>
                                    <td style="width: 20%;" align="center">

                                        <a class="btn btn-xs btn-social btn-dropbox" href="">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar datos
                                        </a>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
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

        $('#dt_listado_alumnos').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            language: {
                url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
            }
        });

        $("#curp").inputmask("A{4} 9{6} A{1} A{2} A{3} 9|A{2}",{
            onKeyValidation: function(key, result){
                if (!result){
                    swal({
                        title:"Error:",
                        text: "La informacion ingresada de la CURP es incorrecta",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Reintentar"
                    });
                }
            },
            onincomplete : function(){
                $(".curp").addClass("has-error");
            },
            oncomplete : function(){
                $(".curp").removeClass("has-error");
            }
        });

        $("#boton_verificarcurp").click(function(){
            if ($("#curp").inputmask("isComplete")){
                //Eliminamos la clase de error del cuadro de texto
                $(".curp").removeClass("has-error");
                //Obtenemos la CURP sin los espacios en blano
                var curp_alumno = $('#curp').inputmask('unmaskedvalue');
                //Se lo asignamos al campo oculto 'alumnocurp'
                $("#alumno_curp").val(curp_alumno);
                //Enviamos el formulario
                ajaxSubmitFormVerificaCurp();
                return false;
            }
            else{
                $(".curp").addClass("has-error");
                $( "#curp").focus();
                swal({
                    title:"Error:",
                    text: "La CURP es incorrecta",
                    type: "error",
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Corregir"
                });
                return false;
            }
        });

        function ajaxSubmitFormVerificaCurp(){
            $.ajax({
                type:"POST",
                url:"{{route('verificar_curp_alumno')}}",
                data: $("#form_verificarcurp").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location.replace("nuevo_alumno_create/"+$('#curp').val());
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

    });
</script>

@endsection