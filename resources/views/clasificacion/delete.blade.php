@extends('templates.app_age')

@section('title', 'Eliminar clasificacion')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Eliminar clasificación
                    <small></small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> ¿Realmente desea eliminar el siguiente registro?</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- form start -->
                            <form class="form-horizontal" method="post" action="" name="form_clasificacion" id="form_clasificacion">
                                {{csrf_field()}}
                                <input type="hidden" name="clasificacion_id" value="{{$id_clasificacion}}">
                                <div class="form-group">
                                    <label for="clasificacion_cicloescolar" class="col-sm-2 control-label"><p class="text-left">Ciclo Escolar:(*)</p></label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="clasificacion_cicloescolar" name="clasificacion_cicloescolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="escuela_id" class="col-sm-2 control-label"><p class="text-left">Escuela:</p></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="escuela_id" id="escuela_id" value="{{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="clasificacion_nombre" class="col-sm-2 control-label"><p class="text-left">Clasificación:(*)</p></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="clasificacion_nombre" name="clasificacion_nombre" value="{{$clasificacion->clasificacion_nombre}}" disabled>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a class="btn btn-danger" href="{{route('clasificaciones')}}">
                                <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                            <button type="submit" class="btn btn-primary pull-right" name="boton_eliminar" id="boton_eliminar">
                                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</button>
                        </div>
                        <!-- /.box-footer -->
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

            $("#boton_eliminar").click(function(){
                swal({
                    title: "¿Estás seguro?",
                    text: "¡Esta acción no se puede revertir!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Estoy de acuerdo',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    preConfirm: function () {
                        return new Promise(function (resolve, reject) {
                            setTimeout(function() {
                                $.ajax({
                                    type:"GET",
                                    url:"{{route('eliminarclasificacion', $id_clasificacion)}}",
                                    dataType : 'json',
                                    success: function(data){
                                        swal({
                                            title:"",
                                            text: data.message,
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Continuar'
                                        }).then(function(){
                                            window.location = "{{ route('clasificaciones') }}";
                                        });
                                    },
                                    error: function (xhr,status, response) {
                                        //Obtener el valor de los errores devueltos por el controlador
                                        var error = jQuery.parseJSON(xhr.responseText);
                                        var error_server = error.error_server;
                                        var error_code   = error.error_code;
                                        var error_message_user = error.error_message_user;
                                        swal({
                                            title:'Error: '+error_code+'. SQLSTATE: '+error_server,
                                            html: error_message_user,
                                            type: "error",
                                            allowOutsideClick: false,
                                            confirmButtonColor: '#d33',
                                            confirmButtonText: "Corregir"
                                        });
                                    }
                                });
                            }, 2000)
                        })
                    },
                }).then(function () {
                    window.location = "{{ route('clasificaciones') }}";
                },function(dismiss){
                    if (dismiss === 'cancel') {
                        //El usuario decidio cancelar la eliminacion del registro
                        return false;
                    }
                })

            });
        });
    </script>
@endsection