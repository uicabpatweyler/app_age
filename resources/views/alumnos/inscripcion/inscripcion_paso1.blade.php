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
                        <form class="form-horizontal" method="get" action="{{route('inscripcion_paso1')}}" id="form_verificarcurp" name="form_verificarcurp">

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
                                @if( isset($alumnos) and isset($verificarCurp) )
                                    <a class="btn btn-social btn-danger" href="{{route('inscripcion_paso1')}}">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i> Cancelar
                                    </a>
                                @endif

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
                                                00{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}
                                            @elseif($alumno->id<100)
                                                0{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}
                                            @else
                                                0{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}
                                            @endif

                                        </td>
                                        <td>{{$alumno->alumno_curp}}</td>
                                        <td>{{ucwords($alumno->alumno_primernombre)}} {{ucwords($alumno->alumno_segundonombre)}} {{ucwords($alumno->alumno_apellidopaterno)}} {{ucwords($alumno->alumno_apellidomaterno)}}</td>
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

        $("#boton_siguiente").click(function(){
            if ($("#curp").inputmask("isComplete")){
                //Eliminamos la clase de error del cuadro de texto
                $(".curp").removeClass("has-error");
                //Obtenemos la CURP sin los espacios en blano
                var curp_alumno = $('#curp').inputmask('unmaskedvalue');
                //Se lo asignamos al campo oculto 'alumnocurp'
                $("#alumno_curp").val(curp_alumno);
                //Enviamos el formulario
                $("#form_verificarcurp").submit();
                //return false;
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

    });
</script>
@endsection