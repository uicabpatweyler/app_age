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
});
</script>
@endsection