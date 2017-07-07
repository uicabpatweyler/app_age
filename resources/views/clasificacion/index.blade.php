@extends('templates.app_age')

@section('title', 'Clasificaciones')

@section('content')
    <!-- Full Width Column -->
    <div class="content-wrapper">

        <div class="container">

            <!-- Main content -->
            <section class="content">

                <div class="col-md-12">

                    <div class="box box-success">

                        <div class="box-header with-border">
                            <h3 class="box-title"> Clasificaciones para el ciclo: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <select class="form-control select2" name="escuela_id" id="escuela_id" style="width: 100%;">
                                            <option value="-1" selected="selected">[Elija una escuela]</option>
                                            @foreach($escuelas as $escuela)
                                                <option value="{{$escuela->id}}">
                                                    {{$escuela->NivelEscuela->nivel_nombre}}  -  {{$escuela->escuela_nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a class="btn btn-primary form-control" name="boton_enviar" id="boton_enviar" href="">
                                            <i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i>&nbsp;  Enviar</a>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a class="btn btn-success form-control" href="{{route('nuevaclasificacion')}}">
                                            <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>&nbsp;  Agregar</a>
                                    </div>
                                </div>

                            </div>

                            <table class="table table-striped" id="clasificaciones">
                                <thead>
                                <tr>
                                    <th style="width: 10%;"></th>
                                    <th>Clasificacion</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
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
    $(document).ready(function () {
        $('.select2').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elija una escuela]'
            }
        });


        $("#boton_enviar").click(function(){
            var escuela_id = $('.select2').val();

            if(escuela_id==="-1"){
                swal({
                    title:"Error:",
                    text: "Debe elegir una lista de la escuela",
                    type: "error",
                    allowOutsideClick: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Corregir"
                });
                return false;
            }
            else{
                var i = 0;

                $('#clasificaciones').DataTable( {
                    paging: false,
                    searching: false,
                    ordering: false,
                    info:true,
                    destroy: true,
                    ajax: "clasificacionesPorEscuela/"+escuela_id,
                    columns: [
                        { data: null,
                            render: function(){
                                //'<p class="text-center">'+i+=1+'</p>'
                                i+=1;
                                return '<b><p class="text-center">'+i+'</p></b>';
                            }
                        },
                        { data: "clasificacion_nombre" },
                        { data: null,
                            "render": function ( data, type, full, meta ) {
                                var buttons='';
                                buttons += '<a class="'+"btn btn-xs btn-info"+'" href="/editarclasificacion/'+data.id+'">';
                                buttons += '<i class="'+"fa fa-pencil-square-o"+'" aria-hidden="'+"true"+'"></i>';
                                buttons += 'Editar';
                                buttons += '</a>';
                                buttons += ' | ';
                                buttons += '<a class="'+"btn btn-xs btn-danger"+'" href="/eliminarclasificacion/'+data.id+'">';
                                buttons += '<i class="'+"fa fa-trash-o fa-lg"+'" aria-hidden="'+"true"+'"></i>';
                                buttons += 'Eliminar';
                                buttons += '</a>';
                                return buttons;
                            }
                        }
                    ],
                    language: {
                        url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
                    }
                });

                return false;
            }

        });
    });
</script>
@endsection