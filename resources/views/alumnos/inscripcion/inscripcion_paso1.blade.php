@extends('templates.app_age')

@section('title', 'Nueva inscripción')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Inscripción de un nuevo alumno
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Para iniciar ingrese la <strong>C.U.R.P.</strong> del alumno</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
                        </div>
                        <!-- /.box-header -->

                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="{{route('inscripcion_verificacurp')}}" id="form_verificarcurp" name="form_verificarcurp">
                            {{csrf_field()}}
                            <input type="hidden" name="alumnocurp" id="alumnocurp">

                            <!-- box-body start -->
                            <div class="box-body">

                                <div class="form-group curp_alumno">
                                    <label for="alumno_curp" class="col-sm-2 control-label">C.U.R.P del alumno: (*)</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="alumno_curp" name="alumno_curp" placeholder="UIPW810622HYNCTY02" required >
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <a class="btn btn-social btn-danger" href="#">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                                </a>

                                <button type="submit" class="btn btn-primary btn-social btn-dropbox pull-right" id="boton_siguiente">
                                    <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>
                                    Siguiente
                                </button>
                            </div>
                            <!-- /.box-footer -->

                        </form>
                        <!-- form end -->

                    </div>
                    <!-- /.box -->

                    @if( isset($alumnos) and isset($verificarCurp) )
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <i class="fa fa-warning"></i>
                                <h3 class="box-title">{{$verificarCurp > 1 ? 'Se encontraron '.$verificarCurp.'Coincidencias' : 'Se encontro '.$verificarCurp.' coincidencia.'}}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Matricula</th>
                                        <th>CURP</th>
                                        <th>Nombre</th>
                                    </tr>
                                    <tr>
                                        @foreach($alumnos as $alumno)
                                        @endforeach
                                        <td>
                                            @if($alumno->id<10)
                                                00{{$alumno->id}}
                                            @elseif($alumno->id<100)
                                                0{{$alumno->id}}
                                            @else
                                                {{$alumno->id}}
                                            @endif
                                        </td>
                                        <td>{{$alumno->alumno_curp}}</td>
                                        <td>{{ucfirst($alumno->alumno_primernombre)}} {{ucfirst($alumno->alumno_segundonombre)}} {{ucfirst($alumno->alumno_apellidopaterno)}} {{ucfirst($alumno->alumno_apellidomaterno)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    @endif


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
        //$("#escuela_clavect").inputmask("9{2}A{3}9{4}A{1}");
        $("#alumno_curp").inputmask("A{4} 9{6} A{1} A{2} A{3} 9|A{2}",{
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
                $(".curp_alumno").addClass("has-error");
            },
            oncomplete : function(){
                $(".curp_alumno").removeClass("has-error");
            }
        });

        $("#boton_siguiente").click(function(){
            if ($("#alumno_curp").inputmask("isComplete")){
                //Eliminamos la clase de error del cuadro de texto
                $(".curp_alumno").removeClass("has-error");
                //Obtenemos la CURP sin los espacios en blano
                var curp_alumno = $('#alumno_curp').inputmask('unmaskedvalue');
                //Se lo asignamos al campo oculto 'alumnocurp'
                $("#alumnocurp").val(curp_alumno);
                //Enviamos el formulario
                $("#form_verificarcurp").submit();
                //return false;
            }
            else{
                $(".curp_alumno").addClass("has-error");
                $( "#alumno_curp").focus();
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

    });
</script>
@endsection