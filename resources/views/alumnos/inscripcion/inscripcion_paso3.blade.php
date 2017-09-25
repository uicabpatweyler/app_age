@extends('templates.app_age')

@section('title', 'Datos del tutor')

@section('css')
    <style>
        span.error { color: #a94442; }
    </style>
@endsection

@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">

    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
                <h1>Hoja de Inscripción</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <form action="" role="form" method="post" id="form_datosdeltutor" name="form_datosdeltutor">
                    {{csrf_field()}}
                    <input type="hidden" name="ciclo_id" id="ciclo_id">
                    <input type="hidden" name="alumno_id" id="alumno_id">
                    <input type="hidden" name="registro_id" id="registro_id">
                    <input type="hidden" name="tutor_direccion_estado" id="tutor_direccion_estado">
                    <input type="hidden" name="tutor_direccion_delegacion" id="tutor_direccion_delegacion">
                    <input type="hidden" name="tutor_ldt_estado" id="tutor_ldt_estado">
                    <input type="hidden" name="tutor_ldt_delegacion" id="tutor_ldt_delegacion">


                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Datos del tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="{{route('inscripcion_paso1')}}" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>
                        </div>

                        <div class="box-body">

                            <!-- Inicia fila para el nombre y apellidos del alumno -->
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alumno">Alumno</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="text" value="{{$alumno->alumno_primernombre}} {{$alumno->alumno_segundonombre}}" class="form-control" id="alumno_nombres" name="alumno_nombres" style="text-transform:capitalize" disabled>
                                                </div>
                                                <div class="col-xs-6">
                                                    <input type="text" value="{{$alumno->alumno_apellidopaterno}} {{$alumno->alumno_apellidomaterno}}" class="form-control" id="alumno_apellidos" name="alumno_apellidos" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Matricula</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                @if($alumno->id<10)
                                                    <input type="text" class="form-control" value="00{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}" readonly>
                                                @elseif($alumno->id<100)
                                                    <input type="text" class="form-control" value="0{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}" readonly>
                                                @else
                                                    <input type="text" class="form-control" value="0{{$alumno->id}}-{{$alumno->created_at->format('dmy')}}" readonly>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Ciclo</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Termina fila para el nombre y apellidos del alumno -->
                            <br />
                            <!-- Inicia fila para el TabPanel de los datos del tutor -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-address-card fa-lg" aria-hidden="true"></i>&nbsp; Datos Personales</a></li>
                                            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;Telefonos</a></li>
                                            <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>&nbsp;Lugar de Trabajo</a></li>
                                        </ul>
                                        <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">

                                                    <!-- Inicia fila para el nombre y apellidos del tutor -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="tutor_primernombre">Nombre</label>
                                                                <div class="row">
                                                                    <div class="col-xs-6 myerror">
                                                                        <input type="text" class="form-control" placeholder="Primer Nombre" id="tutor_primernombre" name="tutor_primernombre" style="text-transform:capitalize" required minlength="2">
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <input type="text" class="form-control" placeholder="Segundo Nombre" id="tutor_segundonombre" name="tutor_segundonombre" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="tutor_apellidopaterno">Apellido</label>
                                                                <div class="row">
                                                                    <div class="col-xs-6 myerror">
                                                                        <input type="text" class="form-control" placeholder="Apellido Paterno" id="tutor_apellidopaterno" name="tutor_apellidopaterno" style="text-transform:capitalize" required minlength="2">
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <input type="text" class="form-control" placeholder="Apellido Materno" id="tutor_apellidomaterno" name="tutor_apellidomaterno" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Termina fila para el nombre y apellidos del tutor -->

                                                    <!-- Inicia fila para el correo electronico del tutor -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="tutor_email">Correo Electrónico</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="Correo Electrónico" name="tutor_email" id="tutor_email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Termina fila para el correo electronico del tutor -->

                                                    <!-- Inicia fila para la direccion del tutor (Calle, Num Int, Num Ext y Referencias -->
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_calle">Dirección</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_calle}}" class="form-control" placeholder="Calle/Avenida" id="tutor_direccion_calle" name="tutor_direccion_calle" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_numinterior">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_numerointerior}}" class="form-control" placeholder="Num. Int." id="tutor_direccion_numinterior" name="tutor_direccion_numinterior" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_numeroexterior}}" class="form-control" placeholder="Num. Ext." id="tutor_direccion_numexterior" style="text-transform:capitalize" name="tutor_direccion_numexterior">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_referencias">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_referencias}}" class="form-control" placeholder="Cruzamientos/Esquina/Entre Calles" id="tutor_direccion_referencias" name="tutor_direccion_referencias" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Inicia fila para la direccion del tutor (Calle, Num Int, Num Ext y Referencias -->

                                                    <!-- Inicia fila para los select de Estado, Delegacion y Colonia -->
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_estado">Estado</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="direccion_estado" id="direccion_estado" class="form-control" style="width: 100%;" required>
                                                                            <option value="" selected>[Elegir estado]</option>
                                                                            @foreach($estados as $estado)
                                                                                <option value="{{$estado->id}}">{{$estado->estado_nombre}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_delegacion">Deleg/Munic.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="direccion_delegacion" id="direccion_delegacion" class="form-control" style="width: 100%;" required>
                                                                            <option value="" selected>[Elegir Deleg/Munic.]</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_colonia">Colonia</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="direccion_colonia" id="direccion_colonia" class="form-control" style="width: 100%;" required>
                                                                            <option value="" selected>[Elegir Colonia]</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Termina fila para los select de Estado, Delegacion y Colonia -->

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_localidad">Localidad</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_localidad}}" class="form-control" name="tutor_direccion_localidad" id="tutor_direccion_localidad" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_delegacion"></label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_delegacion}}" class="form-control" name="tutor_direccion_delegacion" id="tutor_direccion_delegacion" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_estado"></label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_estado}}" class="form-control" name="tutor_direccion_estado" id="tutor_direccion_estado" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Inicia fila para los input text del nombre de la localidad, colonia y codigo postal -->
                                                    <div class="row">

                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label for="direccion_colonia_2">Detalles de la Colonia</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_colonia}}" class="form-control" name="direccion_colonia_2" id="direccion_colonia_2"  style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="direccion_codigopostal">C.P.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$alumno_datospersonales->direccion_codigopostal}}" class="form-control" placeholder="00000" name="direccion_codigopostal" id="direccion_codigopostal" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Termina fila para los input text del nombre de la localidad, colonia y codigo postal -->

                                                </div>
                                                <div class="tab-pane" id="tab_2">
                                                    <!-- Inicia fila para  los telefonos de contacto del tutor -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Teléfono de casa</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="tutor_telefonocasa" id="tutor_telefonocasa">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia1" id="referencia1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Telefono del trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="tutor_telefonotrabajo" id="tutor_telefonotrabajo">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia2" id="referencia2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Celular</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="tutor_telefonocelular" id="tutor_telefonocelular">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia3" id="referencia3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Otro</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="tutor_telefono_otro" id="tutor_telefono_otro">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia4" id="referencia4">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Termina fila para  los telefonos de contacto del tutor -->
                                                </div>
                                                <div class="tab-pane" id="tab_3">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="tutor_ocupacion">Ocupación</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Ocupación" id="tutor_ocupacion" name="tutor_ocupacion" style="text-transform:capitalize" required minlength="2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="tutor_lugardetrabajo">Lugar de Trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Lugar de trabajo" id="tutor_lugardetrabajo" name="tutor_lugardetrabajo" style="text-transform:capitalize" required minlength="2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para la direccion -->
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_ldt_calle">Dirección del Lugar de Trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Calle/Avenida" id="tutor_ldt_calle" name="tutor_ldt_calle" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="lugartrabajo_numerointerior">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Num. Int." id="tutor_ldt_numinterior" name="tutor_ldt_numinterior" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Num. Ext." id="tutor_ldt_numexterior" name="tutor_ldt_numexterior" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_ldt_referencias">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Cruzamientos/Esquina/Entre Calles" id="lugartrabajo_referencias" name="lugartrabajo_referencias" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para los select de Estado, Delegacion/Municipio y Colonia -->
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_ldt_estado">Estado</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="direccion_ldt_estado" id="direccion_ldt_estado" class="form-control" style="width: 100%;">
                                                                            <option value="" selected>[Elegir estado]</option>
                                                                            @foreach($estados as $estado)
                                                                                <option value="{{$estado->id}}">{{$estado->estado_nombre}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_ldt_delegacion">Deleg/Munic.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="direccion_ldt_delegacion" id="direccion_ldt_delegacion" class="form-control" style="width: 100%;">
                                                                            <option value="" selected>[Elegir Deleg/Munic.]</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="direccion_ldt_colonia">Colonia</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="direccion_ldt_colonia" id="direccion_ldt_colonia" class="form-control" style="width: 100%;">
                                                                            <option value="" selected>[Elegir Colonia]</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para los input text del nombre de la localidad, colonia y codigo postal -->
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="tutor_ldt_localidad">Localidad</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="tutor_ldt_localidad" id="tutor_ldt_localidad" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label for="tutor_ldt_colonia">Detalles de la Colonia</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="lugartrabajo_colonia_2" id="lugartrabajo_colonia_2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="tutor_ldt_codigopostal">C.P.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="00000" name="tutor_ldt_codigopostal" id="tutor_ldt_codigopostal">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Termina fila para el TabPanel de los datos del tutor -->

                        </div>
                        <!-- /. box-body -->

                    </div>
                    <!-- /. box-success -->

                    </form>

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

        $('#direccion_estado').select2({
            allowClear: true,
            placeholder: '[Elegir estado]'
        });

        $('#direccion_delegacion').select2({
            allowClear: true,
            placeholder: '[Elegir Deleg/Munic.]'
        });

        $('#direccion_colonia').select2({
            allowClear: true,
            placeholder: '[Elegir Colonia]'
        });

        $('#direccion_ldt_estado').select2({
            allowClear: true,
            placeholder: '[Elegir estado]'
        });

        $('#direccion_ldt_delegacion').select2({
            allowClear: true,
            placeholder: '[Elegir Deleg/Munic.]'
        });

        $('#direccion_ldt_colonia').select2({
            allowClear: true,
            placeholder: '[Elegir Colonia]'
        });

        $("#tutor_telefonocasa").inputmask("(999)-999-9999");
        $("#tutor_telefonotrabajo").inputmask("(999)-999-9999");
        $("#tutor_telefonocelular").inputmask("(999)-999-9999");
        $("#tutor_telefono_otro").inputmask("(999)-999-9999");

        //Desactivamos select de Delegacion y Colonia, los cuales se activan hasta que el usuario elija un
        //estado de la lista
        $("#direccion_delegacion").attr('disabled','-1');
        $("#direccion_colonia").attr('disabled','-1');
        $("#direccion_ldt_delegacion").attr('disabled','-1');
        $("#direccion_ldt_colonia").attr('disabled','-1');

        //email mask
        $("#tutor_email").inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
        });

    });
</script>
@endsection