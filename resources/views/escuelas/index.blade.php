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
                                <th>Nivel</th>
                                <th>Nombre de la escuela</th>
                                <th>Acciones</th>
                            </tr>
                            <?php $i=1 ?>
                            @foreach($escuelas as $escuela)
                            <tr>
                                <td>{{$i++}}</td>
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
            swal({
                title: '¿Esta seguro de querer eliminar la siguiente escuela?',
                text: "{{$escuela->escuela_nombre}}",
                type: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarla!',
                showLoaderOnConfirm: true,
                cancelButtonText: 'No, me equivoque',
                focusCancel: true
            }).then(function () {
               $.ajax({
                   type:"GET",
                   url:"{{route('eliminarescuela', $escuela->id)}}",
                   dataType : 'json',
                   success: function(data){
                       swal({
                           title:"",
                           text: data.message,
                           type: "success",
                           allowOutsideClick: false,
                           confirmButtonText: 'Continuar'
                       }).then(function(){
                           window.location = "{{ route('escuelas') }}";
                       });
                   }
               });
            }).catch(swal.noop);
        });
    });
</script>
@endsection