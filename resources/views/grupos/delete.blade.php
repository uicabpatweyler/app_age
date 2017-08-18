@extends('templates.app_age')

@section('title', 'Eliminar Grupo')

@section('css')

    <style>
        label.error, label.error {
            /* remove the next line when you have trouble in IE6 with labels in list */
            color: red;
            font-style: italic
        }
    </style>
    @endsection


    @section('content')
            <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Eliminar Grupo
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
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="" name="form_grupo" id="form_grupo">
                            {{csrf_field()}}
                            <input type="hidden" name="grupo_id" id="grupo_id" value="{{$grupo->id}}">
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Ciclo:</strong></td>
                                        <td style="width: 80%">{{$grupo->CicloGrupo->ciclo_anioinicial}}-{{$grupo->CicloGrupo->ciclo_aniofinal}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Escuela:</strong></td>
                                        <td style="width: 80%">{{$grupo->EscuelaGrupo->escuela_nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Clasificación:</strong></td>
                                        <td style="width: 80%">{{$grupo->ClasificacionGrupo->clasificacion_nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Nombre del grupo:</strong></td>
                                        <td style="width: 80%">{{$grupo->grupo_nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Alumnos permitidos:</strong></td>
                                        <td style="width: 80%">{{$grupo->grupo_alumnospermitidos}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Grupo Disponible:</strong></td>
                                        <td style="width: 80%">
                                            @if($grupo->grupo_disponible===0)
                                                <span data-toggle="tooltip" title="No Disponible" class="badge bg-red">No</span>
                                            @else
                                                <span data-toggle="tooltip" title="Disponible" class="badge bg-light-blue">Si</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <a class="btn btn-danger" href="javascript:history.back(1)">
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
                                    type:"POST",
                                    url:"{{route('eliminargrupo', $grupo->id)}}",
                                    data: $("#form_grupo").serialize(),
                                    dataType : 'json',
                                    success: function(data){
                                        swal({
                                            title:"",
                                            text: data.message,
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Continuar'
                                        }).then(function(){
                                            window.location = "{{ route('grupos') }}";
                                        });
                                    }
                                });
                            }, 2000)
                        })
                    },
                }).then(function () {
                    window.location = "{{ route('grupos') }}";
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