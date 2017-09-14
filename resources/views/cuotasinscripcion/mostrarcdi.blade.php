@extends('templates.app_age')

@section('title', 'Eliminar Cuota de Inscripción')

@section('content')
            <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Eliminar Cuota de Inscripción
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
                        <form class="form-horizontal" method="post" action="" name="form_cdi" id="form_cdi">
                            {{csrf_field()}}
                            <input type="hidden" name="cdi_id" id="cdi_id" value="">
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Ciclo:</strong></td>
                                        <td style="width: 80%">{{$cuota->CicloCDI->ciclo_anioinicial}}-{{$cuota->CicloCDI->ciclo_aniofinal}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Escuela:</strong></td>
                                        <td style="width: 80%">{{$cuota->EscuelaCDI->escuela_nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Nombre:</strong></td>
                                        <td style="width: 80%">{{$cuota->cuotainscripcion_nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Cuota:</strong></td>
                                        <td style="width: 80%">$ {{number_format($cuota->cuotainscripcion_cuota, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-gray color-palette" style="width: 20%"><strong>Grupo Disponible:</strong></td>
                                        <td style="width: 80%">
                                            @if($cuota->cuotainscripcion_disponible===0)
                                                <span data-toggle="tooltip" title="No Disponible" class="badge bg-red">No</span>
                                            @else
                                                <span data-toggle="tooltip" title="Disponible" class="badge bg-light-blue">Si</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <p></p>
                                @if(isset($mensaje))
                                    <div class="callout callout-danger">
                                        <h4><i class="icon fa fa-warning"></i> Atención!</h4>
                                        <p>{{$mensaje}}</p>
                                    </div>

                                @else

                                @endif

                            </div>
                        </form>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            @if(isset($mensaje))
                                <a class="btn btn-danger pull-right" href="javascript:history.back(1)">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>
                            @else
                                <a class="btn btn-danger" href="javascript:history.back(1)">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i>&nbsp;  Cancelar</a>

                                <button type="submit" class="btn btn-primary pull-right" name="boton_eliminar" id="boton_eliminar">
                                    <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</button>
                            @endif
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
                                    url:"{{route('eliminarcdi', $cuota->id)}}",
                                    data: $("#form_cdi").serialize(),
                                    dataType : 'json',
                                    success: function(data){
                                        swal({
                                            title:"",
                                            text: data.message,
                                            type: "success",
                                            allowOutsideClick: false,
                                            confirmButtonText: 'Continuar'
                                        }).then(function(){
                                            window.location = "{{route('lista_cdi', $cuota->escuela_id)}}";
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