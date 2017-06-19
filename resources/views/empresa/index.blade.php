@extends('templates.app_age')

@section('title', 'Empresa')

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
                            <h3 class="box-title">{{$empresa[0]->empresa_razonsocial}}</h3>
                        </div>
                        
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="bg-green color-palette" style="width: 20%"><strong>RFC:</strong></td>
                                    <td style="width: 80%">{{$empresa[0]->empresa_rfc}}</td>
                                </tr>
                                <tr>
                                    <td class="bg-green color-palette" style="width: 20%"><strong>Razón Social:</strong></td>
                                    <td style="width: 80%">{{$empresa[0]->empresa_razonsocial}}</td>
                                </tr>
                                <tr>
                                    <td class="bg-green color-palette" style="width: 20%"><strong>Regimén Fiscal:</strong></td>
                                    <td style="width: 80%">{{$empresa[0]->empresa_regimenfiscal}}</td>
                                </tr>
                                <tr>
                                    <td class="bg-green color-palette" style="width: 20%"><strong>Dirección:</strong></td>
                                    <td style="width: 80%">
                                        {{ $empresa[0]->empresa_direccion }}
                                        # {{ $empresa[0]->empresa_numexterior}}
                                        {{$empresa[0]->empresa_numinterior}}
                                        {{$empresa[0]->empresa_referencia}}.
                                        Colonia: {{$empresa[0]->empresa_colonia}}.
                                        C.P.:{{$empresa[0]->empresa_codigopostal}}.
                                        &nbsp;&nbsp;
                                        {{$empresa[0]->empresa_localidad}},
                                        {{$empresa[0]->empresa_delegacion}},
                                        {{$empresa[0]->empresa_estado}},
                                        {{$empresa[0]->empresa_pais}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-green color-palette" style="width: 20%">
                                        <strong>Teléfono:</strong>
                                    </td>
                                    <td style="width: 80%">
                                        {{$empresa[0]->empresa_telefono}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-green color-palette" style="width: 20%">
                                        <strong>E-mail:</strong>
                                    </td>
                                    <td style="width: 80%">
                                        {{$empresa[0]->empresa_email}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a class="btn btn-danger" href="#" title="Eliminar">
                                <i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Eliminar</a>

                            <a class="btn btn-info pull-right" href="{{route('editarempresa', $empresa[0]->id)}}" title="Editar">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        </div>
                        <!-- /.footer -->

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