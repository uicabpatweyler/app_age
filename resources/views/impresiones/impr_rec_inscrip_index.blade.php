@extends('templates.app_age')

@section('title', 'Imprimir Recibo de Pago de Inscripción')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Imprimir Recibo de Pago de Inscripción</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Opciones de Impresión</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp; Número de recibo ó alumno</a></li>
                                        <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-address-book-o" aria-hidden="true"></i>&nbsp;Por Grupo</a></li>

                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">

                                            <div class="box box-success">
                                                <div class="box-header with-border bg-green color-palette">
                                                    <h3 class="box-title">Listado de Recibos Ciclo: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                                                </div>
                                                <div class="box-body">
                                                    <table id="dt_listado_recibos_alumnos" class="table table-bordered table-striped" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 5%">Recibo</th>
                                                            <th style="width: 15%; text-align: center;">Fecha</th>
                                                            <th style="width: 5%;  text-align: center;">Estado</th>
                                                            <th style="width: 15%"></th>
                                                            <th style="width: 15%">Alumno</th>
                                                            <th style="width: 15%"></th>
                                                            <th style="width: 10%; text-align: center">Grupo</th>
                                                            <th style="width: 20%;"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($pagosDeInscripcion as $pagoDeInscripcion)
                                                            <tr>
                                                                <td style="width: 5%">
                                                                    <strong>{{$pagoDeInscripcion->folio_recibo}}</strong>
                                                                </td>
                                                                <td style="width: 15%; text-align: center">
                                                                    {{ucwords($pagoDeInscripcion->created_at->format('D d, M Y'))}}
                                                                </td>
                                                                <td style="width: 5%; text-align: center">
                                                                    @if ($pagoDeInscripcion->pago_cancelado==false)
                                                                        <small class="label label-primary"><i class="fa fa-check"></i></small>
                                                                    @else
                                                                        <small class="label label-danger">&nbsp;Cancelado</small>
                                                                    @endif
                                                                </td>
                                                                <td style="width: 15%">
                                                                    {{ucwords($pagoDeInscripcion->AlumnoPagoDeInscripcion->alumno_primernombre)}} {{ucwords($pagoDeInscripcion->AlumnoPagoDeInscripcion->alumno_segundonombre)}}
                                                                </td>
                                                                <td style="width: 15%">
                                                                    {{ucwords($pagoDeInscripcion->AlumnoPagoDeInscripcion->alumno_apellidopaterno)}}
                                                                </td>
                                                                <td style="width: 15%">
                                                                    {{ucwords($pagoDeInscripcion->AlumnoPagoDeInscripcion->alumno_apellidomaterno)}}
                                                                </td>
                                                                <td style="width: 10%; text-align: center">
                                                                    <small class="label label-success"><i class="fa fa-check"></i>{{$pagoDeInscripcion->GrupoPagoDeInscripcion->grupo_nombre}}</small>
                                                                </td>
                                                                <td style="width: 20%; text-align: center">
                                                                    <a class="btn btn-xs btn-social btn-dropbox" href="{{route('pdf_ReciboInscripcion',['id_pago'=>$pagoDeInscripcion->id])}}" target="_blank">
                                                                        <i class="fa fa-print" aria-hidden="true"></i> Imprimir
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->

                                        </div>

                                        <div class="tab-pane" id="tab_2">

                                            <div class="box box-success">
                                                <div class="box-header with-border bg-green color-palette">
                                                    <h3 class="box-title">Listado de Grupos: </h3>
                                                </div>
                                                <div class="box-body">

                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


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
    $('#dt_listado_recibos_alumnos').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        language: {
            url: "{{asset('adminlte/plugins/datatables/Spanish.json')}}"
        }
    });
});
</script>
@endsection