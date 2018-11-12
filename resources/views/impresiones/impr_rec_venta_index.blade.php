@extends('templates.app_age')

@section('title', 'Imprimir Recibo de Venta')

@section('content')
        <!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Imprimir Recibo de Venta</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">Listado de Recibos del Ciclo Escolar: {{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="dt_listado_recibos_venta" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th style="width: 5%">Recibo</th>
                                <th style="width: 15%; text-align: center;">Fecha</th>
                                <th style="width: 5%;  text-align: center;">Estado</th>
                                <th style="width: 45%; text-align: center;">Alumno</th>
                                <th style="width: 10%; text-align: center">Total</th>
                                <th style="width: 20%;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recibos as $recibo)
                                <tr>
                                    <td>{{$recibo->folio_recibo}}</td>
                                    <td>{{$recibo->fecha_venta}}</td>
                                    <td>
                                        @if ($recibo->venta_cancelada==false)
                                            <small class="label label-primary"><i class="fa fa-check"></i></small>
                                        @else
                                            <small class="label label-danger">&nbsp;Cancelado</small>
                                        @endif
                                    </td>
                                    <td>{{ucwords($recibo->nombreAlumno)}}</td>
                                    <td>$ {{number_format($recibo->cantidad_recibida_mxn,2,'.',',')}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-social btn-dropbox" href="{{route('pdf_ReciboSalidaVenta',['id_salida'=>$recibo->id])}}" target="_blank">
                                            <i class="fa fa-print" aria-hidden="true"></i> Imprimir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    $('#dt_listado_recibos_venta').DataTable({
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