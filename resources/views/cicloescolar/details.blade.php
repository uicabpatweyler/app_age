@extends('templates.app_age')

@section('title', 'Editar Ciclo Escolar')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Editar ciclo escolar
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
                        <form class="form-horizontal" method="post" action="{{route('updateciclo', $ciclo->id)}}" id="form_editarciclo" name="form_editarciclo">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group ciclo_escolar">
                                    <label for="ciclo_anioinicial" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar: (*)</p></label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="ciclo_anioinicial" name="ciclo_anioinicial" placeholder="" value="{{$ciclo->ciclo_anioinicial}}">
                                    </div>

                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="ciclo_aniofinal" name="ciclo_aniofinal" placeholder="" value="{{$ciclo->ciclo_aniofinal}}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <a class="btn btn-danger" href="{{route('ciclos')}}">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                                <button type="submit" class="btn btn-primary pull-right" id="boton_guardar">
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
<!-- InputMask https://github.com/RobinHerbots/Inputmask -->
<script src="{{asset('adminlte/plugins/input-mask/dist/jquery.inputmask.bundle.js')}}"></script>

<script>
    $(document).ready(function(){
        $("#ciclo_anioinicial").inputmask("9{4}");
        $("#ciclo_aniofinal").inputmask("9{4}");



        $('#boton_guardar').click(function(){

            var anio_inicial = $("#ciclo_anioinicial").val();
            var anio_final = $("#ciclo_aniofinal").val();

            if ($("#ciclo_anioinicial").inputmask("isComplete") && $("#ciclo_aniofinal").inputmask("isComplete")){
                if(anio_inicial>=anio_final){
                    $(".ciclo_escolar").addClass("has-error");
                    swal({
                        title:"Error:",
                        text: "El ciclo escolar es incorrecto",
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });
                }else{ return true; }
            }else{
                $(".ciclo_escolar").addClass("has-error");
                swal({
                    title:"Error:",
                    text: "El ciclo escolar es incorrecto",
                    type: "error",
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Corregir"
                });
            }

            return false
        });


    });
</script>
@endsection