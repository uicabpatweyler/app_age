@extends('templates.app_age')

@section('title', 'Reporte de Pagos de Colegiatura')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Reporte de Alumnos Deudores
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">

                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">Generar Reporte <small>Los campos marcados con (*) son obligatorios</small></h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="mes_reporte">Del Mes de: (*)</label>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <select class="form-control" name="mes_reporte" id="mes_reporte" style="width: 100%;" required>
                                                <option value="" selected="selected">[Elija un mes]</option>
                                                <option value="8">Agosto</option>
                                                <option value="9">Septiembre</option>
                                                <option value="10">Octubre</option>
                                                <option value="11">Noviembre</option>
                                                <option value="12">Diciembre</option>
                                                <option value="1">Enero</option>
                                                <option value="2">Febrero</option>
                                                <option value="3">Marzo</option>
                                                <option value="4">Abril</option>
                                                <option value="5">Mayo</option>
                                                <option value="6">Junio</option>
                                                <option value="7">Julio</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <button class="btn  btn-social btn-facebook pull-right" id="btn_generar" name="btn_generar">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Imprimir Reporte</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box -->

                <div class="box box-success">
                    <div class="box-header with-border bg-green color-palette">
                        <h3 class="box-title">Vista Previa</h3>
                    </div>
                    <div class="box-body">
                        <table id="dt_listado_grupos" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>Grupo</th>
                                <th class="text-center">Grupo/Mes</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Deudores</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0; $i<count($array_detalle); $i++)
                                <tr>
                                    <td><strong>{{ $array_detalle[$i]['nivel_grupo'] }}</strong></td>
                                    <td>{{ $array_detalle[$i]['nombre_mes'] }}</td>
                                    <td class="{{ $array_detalle[$i]['alumnos_con_pago']==0 ? 'text-center' : '' }}">
                                        @if($array_detalle[$i]['alumnos_con_pago']==0)
                                            <i class="fa fa-exclamation-triangle fa-lg text-red" aria-hidden="true"></i>
                                        @elseif($array_detalle[$i]['porcentaje'] < 100)
                                            <div class="progress-group">

                                                <span class="progress-text">{{ $array_detalle[$i]['alumnos_con_pago'] }} de {{ $array_detalle[$i]['alumnos_inscritos'] }}</span>
                                                <span class="progress-number"><b>{{ $array_detalle[$i]['porcentaje'] }} %</b></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-red" style="width: {{ $array_detalle[$i]['porcentaje'] }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="progress-group">

                                                <span class="progress-text">{{ $array_detalle[$i]['alumnos_con_pago'] }} de {{ $array_detalle[$i]['alumnos_inscritos'] }}</span>
                                                <span class="progress-number"><b>{{ $array_detalle[$i]['porcentaje'] }} %</b></span>

                                                <div class="progress sm">
                                                    <div class="progress-bar progress-bar-primary" style="width: {{ $array_detalle[$i]['porcentaje'] }}%"></div>
                                                </div>
                                            </div>
                                        @endif

                                    </td>
                                    <td class="text-center text-bold">

                                        @if($array_detalle[$i]['alumnos_deudores'] == 0)
                                            <i class="fa fa-check fa-lg text-blue" aria-hidden="true"></i> - Ninguno
                                        @else
                                            {{ $array_detalle[$i]['alumnos_deudores'] }}
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-social btn-dropbox" href="{{route('pdf_ReporteDeudoresPorGrupo',['id_ciclo'=>$array_detalle[$i]['ciclo_id'], 'id_grupo'=>$array_detalle[$i]['grupo_id'] ])}}" target="_blank">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
                                        </a>
                                    </td>
                                </tr>
                            @endfor

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
$(document).ready(function(){

    var groupColumn = 0; // Nivel - Nombre Grupo
    var mes_seleccionado ='';
    var urlRoot = "{{Request::root()}}";

    $('#mes_reporte').select2({
        allowClear: true,
        placeholder: '[Elija un mes]'
    });

    $('#dt_listado_grupos').DataTable({
        "paging"       : true,
        "lengthChange" : false,
        "searching"    : true,
        "ordering"     : false,
        "info"         : true,
        "autoWidth"    : true,
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 12,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        },
        language: {
            url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
        }
    });

    $('#mes_reporte').change(function () {
        mes_seleccionado = $(this).val();

        //El usuario no selecciono algun elemento
        if(mes_seleccionado===null) { mes_seleccionado='';}

        //El usuario elimina la seleccion del select
        else if(mes_seleccionado===""){ mes_seleccionado='';}

    });

    $("#btn_generar").click(function(){

        if(mes_seleccionado.length===0){
            swal({
                title: 'Atención',
                html: 'Elija un mes de la lista.',
                type: "error",
                allowOutsideClick: false,
                showConfirmButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Corregir'
            }).catch(swal.noop);
        }
        else{
                window.open(urlRoot+'/pdf_DeudoresGrupoMes/'+mes_seleccionado+'/', '_blank');
                return false;
            }

    });
});
</script>
@endsection