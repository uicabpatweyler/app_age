@extends('templates.app_age')

@section('title', 'Editar Alumno')
@section('css')
    <style>
        span.error { color: #a94442; }
    </style>
    @endsection

    @section('content')
            <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Editar Alumno</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">

                    <form action="{{route('update_alumno',['id'=>$alumno_id])}}" role="form" method="post" id="form_nuevoalumno_create" name="form_nuevoalumno_create" >
                        {{csrf_field()}}
                        <input type="hidden" name="escuela" id="escuela" value="{{$escuela_id}}">
                        <input type="hidden" name="ciclo_id" id="ciclo" value="{{$ciclo_id}}">
                        <input type="hidden" name="alumno_id" id="alumno" value="{{$alumno_id}}">


                        <!-- Inicia: Datos Personales del alumno -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Datos del alumno</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn_guardar" name="btn_guardar" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="{{route('nuevo_alumno_index')}}" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>

                            </div>


                            <div class="box-body">

                                <!-- Fila para la escuela y el ciclo escolar -->
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="escuela_id">Escuela (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <select class="form-control" name="escuela_id" id="escuela_id" style="width: 100%;" required>
                                                        <option value="" selected>[Elija una opción]</option>
                                                        @foreach($escuelas as $escuela)
                                                            <option value="{{$escuela->id}}" {{($escuela->id)== $escuela_id ? "selected" : ""}}>{{$escuela->escuela_nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ciclo_escolar">Ciclo Escolar</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila para el nombre y apellidos del alumno -->
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alumno_primernombre">Nombre</label>
                                            <div class="row">
                                                <div class="col-xs-6 myerror">
                                                    <input type="text" class="form-control" value="{{$alumno->alumno_primernombre}}" placeholder="Primer Nombre (*)" id="alumno_primernombre" name="alumno_primernombre" style="text-transform:capitalize" required minlength="2">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" value="{{$alumno->alumno_segundonombre}}" placeholder="Segundo Nombre" id="alumno_segundonombre" name="alumno_segundonombre" style="text-transform:capitalize">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alumno_apellidopaterno">Apellidos</label>
                                            <div class="row">
                                                <div class="col-xs-6 myerror">
                                                    <input type="text" class="form-control" value="{{$alumno->alumno_apellidopaterno}}" placeholder="Apellido Paterno (*)" id="alumno_apellidopaterno" name="alumno_apellidopaterno" required minlength="2" style="text-transform:capitalize">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" value="{{$alumno->alumno_apellidomaterno}}" placeholder="Apellido Materno" id="alumno_apellidomaterno" name="alumno_apellidomaterno" style="text-transform:capitalize">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Fila para la CURP, Fecha Nac., Edad y Sexo -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group curp_error">
                                            <label for="alumno_curp">C.U.R.P. (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" id="alumno_curp" name="alumno_curp" value="{{$alumno->alumno_curp}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="alumno_fechanacimiento">Fecha Nac. (d-m-a):</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="alumno_fechanacimiento" name="alumno_fechanacimiento" value="{{$alumno->alumno_fechanacimiento->format('d-m-Y')}}" required>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="alumno_genero">Sexo (*)</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <select name="alumno_genero" id="alumno_genero" class="form-control" style="width: 100%;" required>
                                                        <option value="" selected>[Elija una opción]</option>
                                                        <option value="H" {{($alumno->alumno_genero)=== 'H' ? "selected" : ""}}>Hombre</option>
                                                        <option value="M" {{($alumno->alumno_genero)=== 'M' ? "selected" : ""}}>Mujer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">

                                    </div>
                                </div>

                            </div>
                            <!-- /. box-body -->
                        </div>
                        <!-- /. box-success -->

                    </form>

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

    $('#escuela_id').select2({
        allowClear: true,
        placeholder: '[Elija una escuela]'
    });

    $('#alumno_genero').select2({
        allowClear: true,
        placeholder: '[Elegir]'
    });

    $("#alumno_fechanacimiento").inputmask("99-99-9999");

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
            $(".curp_error").addClass("has-error");
        },
        oncomplete : function(){
            $(".curp_error").removeClass("has-error");
        }
    });

    $("#form_nuevoalumno_create").validate({
        errorElement: "span",
        errorPlacement: function(error, element) {

            $( element )
                    .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                    .append( error );
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".myerror" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".myerror" ).addClass( "has-success" ).removeClass( "has-error" );
        },
        rules : {
            escuela_id               : { required: true },
            alumno_primernombre      : { required: true },
            alumno_apellidopaterno   : { required: true },
            alumno_curp              : { required: true },
            alumno_fechanacimiento   : { required: true },
            alumno_genero            : { required: true },
        },
        messages : {
            escuela_id : {
                required: " requerido"

            },
            alumno_primernombre : {
                required: " (Incorrecto)",
                minlength: " (Incorrecto)"

            },
            alumno_apellidopaterno : {
                required: " (Incorrecto)",
                minlength: " (Incorrecto)"

            },
            alumno_curp : {
                required: " (Incorrecto)"

            },
            alumno_fechanacimiento : {
                required: " (*)"

            },
            alumno_genero :{
                required: "(Incorrecto)"
            }
        },
        invalidHandler: function(event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = 'Los campos marcados con (*) son obligatorios.';
                swal({
                    title:"Error:",
                    text: message,
                    type: "error",
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Corregir"
                });

            }
        },
        submitHandler: function(form) {
            swal({
                title: '¿Desea guardar los datos del alumno?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Si'
            }).then(function () {
                form.submit();
            })
        }
    });


});
</script>
@endsection