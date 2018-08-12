@extends('templates.app_age')

@section('title', 'Ciclos Escolares')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">

                    <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title"> Ciclos Escolares</h3>
                        </div>
                        <!-- /.box-header -->

                            <div class="box-body">

                                <a class="btn btn-success" href="{{route('nuevociclo')}}">
                                    <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>&nbsp;  Agregar ciclo escolar</a>

                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cambiarCiclo">
                                    <i class="fa fa-refresh" aria-hidden="true"></i> Cambiar Ciclo Predeterminado
                                </button>

                                <br /><br />

                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th style="display: none">ID</th>
                                        <th>Ciclo Escolar</th>
                                        <th>Predeterminado</th>
                                        <th>Acciones</th>
                                    </tr>
                                    <?php $i=1 ?>

                                    @foreach($ciclos as $ciclo)

                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td style="display: none">{{$ciclo->id}}</td>
                                            <td>{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</td>
                                            <td>
                                                @if($ciclo->ciclo_actual==1)
                                                    <span class="badge bg-green">Ciclo Actual de Trabajo</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($ciclo->ciclo_actual==1)
                                                    <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar
                                                    |
                                                    <a class="btn btn-xs btn-info" href="{{route('editarciclo',$ciclo->id)}}" title="Editar">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                @else
                                                    <a class="btn btn-xs btn-danger" href="#" title="Eliminar">
                                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>
                                                    |
                                                    <a class="btn btn-xs btn-info" href="{{route('editarciclo',$ciclo->id)}}" title="Editar">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                @endif

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

            <div class="modal fade" tabindex="-1" role="dialog" id="cambiarCiclo"  aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-aqua-active">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Cambiar ciclo predeterminado</h4>
                        </div>
                        <form action="{{route('cambiarciclo')}}" class="form-inline" method="post">
                            <div class="modal-body">
                                {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="selectCiclosEscolares"> Lista de Ciclos:</label>
                                        <select name="selectCiclosEscolares" id="selectCiclosEscolares">

                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fa fa-times-circle fa-lg" aria-hidden="true" title="Cancelar"></i> Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary" id="boton_guardar">
                                    <i class="fa fa-floppy-o fa-lg" aria-hidden="true"></i> Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $("#selectCiclosEscolares").select2({
            minimumResultsForSearch: Infinity
        });

            $.ajax({
                type:"GET",
                dataType:"json",
                url: "selectCiclos"
            }).done(function(data){
                $(this).rellenarSelectDeCiclos(data);
            });

            $.fn.rellenarSelectDeCiclos = function (valores) {
                var opcionesDelSelect = '';
                $.each(valores, function(key,row){
                    opcionesDelSelect += '<option value="' + row.id +  '">' + row.anio1 + '-' + row.anio2 + '</option>';
                });
                $('#selectCiclosEscolares').html(opcionesDelSelect);
            };

        $(".btn-danger").click(function () {
            //Columna 1 = ID del ciclo escolar. Columna no visible
            var id_ciclo = $(this).parents("tr").find("td")[1].innerHTML;

            swal({
                title: '¿Esta seguro de querer eliminar el ciclo escolar elegido?',
                text: "",
                type: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!',
                showLoaderOnConfirm: true,
                cancelButtonText: 'No, me equivoqué',
                focusCancel: true
            }).then(function () {
                $.ajax({
                    type:"GET",
                    url:'eliminarciclo/'+id_ciclo,
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