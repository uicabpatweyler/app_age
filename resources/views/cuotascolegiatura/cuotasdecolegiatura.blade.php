@extends('templates.app_age')

@section('title', 'Lista de Cuotas de Colegiatura')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <div class="box box-success">

                    <div class="box-header with-border">
                        <a class="btn btn-xs btn-success" href="javascript:history.back(1)">
                            <i class="fa fa-reply fa-lg" aria-hidden="true"></i> Regresar</a>

                        <h3 class="box-title">{{$escuela->NivelEscuela->nivel_nombre}} - {{$escuela->escuela_nombre}}</h3>
                        <small>&nbsp;&nbsp;(Cuotas de colegiatura de la escuela elegida)</small>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <table class="table table-striped" id="clasificaciones">
                            <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="display: none">ID</th>
                                <th>Ciclo</th>
                                <th>Nombre</th>
                                <th>Cuota</th>
                                <th>Disponible</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <?php $i=1 ?>
                            @foreach($cuotas as $cuota)
                                <tr>
                                    <td><p class="text-center"><strong>{{$i++}}</strong></p></td>
                                    <td style="display: none">{{$cuota->id}}</td>
                                    <td>{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</td>
                                    <td>{{$cuota->cuotacolegiatura_nombre}}</td>
                                    <td>$ {{number_format($cuota->cuotacolegiatura_cuota, 2, '.', ',')}}</td>
                                    <td>
                                        @if($cuota->cuotacolegiatura_disponible===0)
                                            <span data-toggle="tooltip" title="No Disponible" class="badge bg-red">No</span>
                                        @else
                                            <span data-toggle="tooltip" title="Disponible" class="badge bg-light-blue">Si</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar" href="#">
                                            <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                        |
                                        <a class="btn btn-xs btn-info" data-toggle="tooltip" title="Editar" href="{{route('editar_cdc', $cuota->id)}}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                        |
                                        <a class="btn btn-xs btn-warning" data-toggle="tooltip" title="Configurar Meses de Pago" href="{{route('asignarmesesdepago', $cuota->id)}}">
                                            <i class="fa fa-cogs" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->

                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->

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

        $(".btn-danger").click(function () {
            //Columna 1 = ID de la cuota de colegiatura. Columna no visible
            var id_cdc = $(this).parents("tr").find("td")[1].innerHTML;

            swal({
                title: '¿Esta seguro de querer eliminar la cuota de colegiatura elegida?',
                text: "",
                type: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarla!',
                showLoaderOnConfirm: true,
                cancelButtonText: 'No, me equivoqué',
                focusCancel: true
            }).then(function () {
                $.ajax({
                    type:"GET",
                    url:'../eliminarcdc/'+id_cdc,
                    dataType : 'json',
                    success: function(data){
                        swal({
                            title:"",
                            text: data.message,
                            type: "success",
                            allowOutsideClick: false,
                            confirmButtonText: 'Continuar'
                        }).then(function(){
                            location.reload(true);
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
            }).catch(swal.noop);

        });

    });
</script>
@endsection