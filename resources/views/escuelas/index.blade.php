@extends('templates.app_age')

@section('title', 'Escuelas')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Escuelas</h3>
                    </div>

                    <div class="box-body">

                        <a class="btn btn-success" href="{{route('nuevaescuela')}}">
                            <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>&nbsp;  Agregar Escuela</a>

                        <br /><br />

                        <table class="table table-striped">
                            <tr>
                                <th style="width: 50px">#</th>
                                <th style="display: none">ID</th>
                                <th>Nivel</th>
                                <th>Nombre de la escuela</th>
                                <th>Acciones</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach($escuelas as $escuela)
                            <tr>
                                <td>{{$i++}}</td>
                                <td style="display: none">{{$escuela->id}}</td>
                                <td>{{$escuela->NivelEscuela->nivel_nombre}}</td>
                                <td>{{$escuela->escuela_nombre}}</td>
                                <td>
                                    <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                    |
                                    <a class="btn btn-xs btn-info" href="{{route('editarescuela',$escuela->id)}}" title="Editar">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <!-- /.box-body -->

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
    //https://stackoverflow.com/questions/39321621/uncaught-in-promise-cancel-using-sweetalert2
    $(document).ready(function () {
        $(".btn-danger").click(function () {

            //Columna 1 = ID de la escuela. Columna no visible
            var id_escuela = $(this).parents("tr").find("td")[1].innerHTML;

            swal({
                title: '¿Esta seguro de querer eliminar la escuela elegida?',
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
                   url:'eliminarescuela/'+id_escuela,
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