@extends('templates.app_age')

@section('title', 'Hoja de Inscripción')

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

                <form action="" role="form" method="post" id="form_hojadeinscripcion" name="form_hojadeinscripcion">
                    {{csrf_field()}}

                    <!-- Inicia: Datos Personales del alumno -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Datos personales del alumno</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                    <i class="fa fa-minus"></i></button>

                                <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                    <i class="fa fa-floppy-o fa-lg"></i></button>

                                <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                    <i class="fa fa-ban fa-lg"></i></button>

                            </div>

                        </div>


                        <div class="box-body">

                            <!-- Fila para el nombre y apellidos del alumno -->
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alumno_primernombre">Nombre</label>
                                        <div class="row">
                                            <div class="col-xs-6 myerror">
                                                <input type="text" class="form-control" placeholder="Primer Nombre" id="alumno_primernombre" name="alumno_primernombre" style="text-transform:capitalize" required minlength="2">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Segundo Nombre" id="alumno_segundonombre" name="alumno_segundonombre" style="text-transform:capitalize">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alumno_apellidopaterno">Apellidos</label>
                                        <div class="row">
                                            <div class="col-xs-6 myerror">
                                                <input type="text" class="form-control" placeholder="Apellido Paterno" id="alumno_apellidopaterno" name="alumno_apellidopaterno" required minlength="2" style="text-transform:capitalize">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Apellido Materno" id="alumno_apellidomaterno" name="alumno_apellidomaterno" style="text-transform:capitalize">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Fila para la CURP, Fecha Nac., Edad y Sexo -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">C.U.R.P.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="alumno_curp" name="alumno_curp" value="{{$alumno_curp}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Fecha Nac.:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="alumno_fechanac" name="alumno_fechanac" disabled>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Edad</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" id="alumno_edad" name="alumno_edad" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="alumno_genero">Sexo</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <select name="alumno_genero" id="alumno_genero" class="form-control" style="width: 100%;" required>
                                                    <option value="" selected>[Elegir]</option>
                                                    <option value="H">Hombre</option>
                                                    <option value="M">Mujer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para la direccion -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="direccion_calle">Dirección</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="Calle/Avenida" id="direccion_calle" name="direccion_calle" style="text-transform:capitalize" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="direccion_numerointerior">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="Num. Int." id="direccion_numerointerior" name="direccion_numerointerior" style="text-transform:capitalize" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Ext." id="direccion_numeroexterior" style="text-transform:capitalize" name="direccion_numeroexterior">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="direccion_referencias">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="Cruzamientos/Esquina/Entre Calles" id="direccion_referencias" name="direccion_referencias" style="text-transform:capitalize" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para la Colonia, C.P., Localidad, Estado -->
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

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="direccion_localidad">Localidad</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" name="direccion_localidad" id="direccion_localidad" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="direccion_colonia_2">Detalles de la Colonia</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" name="direccion_colonia_2" id="direccion_colonia_2" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="direccion_codigopostal">C.P.</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="00000" name="direccion_codigopostal" id="direccion_codigopostal" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila los telefonos de contacto del alumno -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Teléfono de casa</label>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" placeholder="(983)-123-45678" name="contacto_telefonocasa" id="contacto_telefonocasa">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" name="referencia1" id="referencia1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Telefono tutor</label>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <input type="text" class="form-control" placeholder="(983)-123-45678" name="contacto_telefonotutor" id="contacto_telefonotutor">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" name="referencia2" id="referencia3">
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
                                                <input type="text" class="form-control" placeholder="(983)-123-45678" name="contacto_telefonocelular" id="contacto_telefonocelular">
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
                                                <input type="text" class="form-control" placeholder="(983)-123-45678" name="contacto_telefono_otro" id="contacto_telefono_otro">
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="text" class="form-control" name="referencia4" id="referencia4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para la escuela y lugar de trabajo -->
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Escuela:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Escuela">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Lugar de trabajo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Lugar de Trabajo">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Fila para el ultimo grado escolar a cursar y correo electronico -->
                            <div class="row">

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="">Último grado escolar a cursar:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Último grado escolar a cursar">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="">Correo Electrónico:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Correo Electrónico">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Termina: Datos Personales del alumno -->

                    <!-- Inicia: Datos Personales del tutor -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Datos del Papá/Mamá ó Tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-warning btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                    <i class="fa fa-minus"></i></button>

                                <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                    <i class="fa fa-floppy-o fa-lg"></i></button>

                                <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                    <i class="fa fa-ban fa-lg"></i></button>

                            </div>

                        </div>
                        <div class="box-body">

                            <!-- Fila para el nombre y apellidos del tutor -->
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Nombre:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Nombre(s)">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Apellidos:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Apellido(s)">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Sexo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Sexo">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Fila para la direccion del tutor -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Dirección:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Dirección">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Int.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Ext.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Referencias">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para la Colonia, C.P., Localidad, Estado -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Colonia:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Colonia">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">C.P.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="77620">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Localidad</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Localidad" value="Chetumal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Deleg./Munic.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Deleg./Munic." value="Othón P. Blanco">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Estado</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Estado" value="Quintana Roo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila los telefonos de contacto del tutor -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Teléfono de casa:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Celular:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Telefóno del trabajo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Otro:</label>
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="col-xs-5">
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para el lugar de trabajo del tutor -->
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Nombre del lugar de trabajo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Nombre(s)">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6"></div>
                            </div>

                            <!-- Fila para la direccion de trabajo del tutor -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Dirección del lugar de trabajo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Dirección">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Int.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Ext.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Referencias">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para la Colonia, C.P., Localidad, Estado del lugar de trabajo del tutor -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Colonia:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Colonia">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">C.P.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="77620">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Localidad</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Localidad" value="Chetumal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Deleg./Munic.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Deleg./Munic." value="Othón P. Blanco">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Estado</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Estado" value="Quintana Roo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para el correo electrónico del tutor -->
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Correo Electrónico:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Nombre(s)">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-8"></div>

                            </div>

                        </div>
                    </div>
                    <!-- Termina: Datos Personales del tutor -->

                    <!-- Inicia: Otros Datos -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Otros Datos</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-info btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                    <i class="fa fa-minus"></i></button>

                                <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;" id="boton_guardar">
                                    <i class="fa fa-floppy-o fa-lg"></i></button>

                                <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                    <i class="fa fa-ban fa-lg"></i></button>

                            </div>

                        </div>
                        <div class="box-body">

                            <!-- Fila para preguntas de encuesta -->
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">¿ Comó te enteraste de la escuela ?:</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">¿ Porqué quieres estudiar Inglés ?:</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="email" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Termina: Otros Datos -->

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

        //https://momentjs.com/docs/
        //https://github.com/uxsolutions/bootstrap-datepicker

        var curp = "{{$curp}}";
        var curp_split = curp.split(" ");
        var fecha_nac = curp_split[1];
        moment.locale('es');

        $("#alumno_fechanac").datepicker({
            format: "dd-MM-yyyy",
            language: "es",
            autoclose: true,
            todayBtn: "linked",
            defaultViewDate: { year: moment(fecha_nac, "YYMMDD").format('YYYY'), month: moment(fecha_nac, "YYMMDD").subtract(1, 'months').format('MM'), day: moment(fecha_nac, "YYMMDD").format('DD') }
        });

        $("#alumno_fechanac").val(moment(fecha_nac, "YYMMDD").format('DD-MMMM-YYYY'));
        $("#alumno_edad").val(moment(fecha_nac, "YYMMDD").fromNow(true));


        $('#alumno_genero').select2({
            allowClear: true,
            placeholder: '[Elegir]'
        });

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

        $("#contacto_telefonocasa").inputmask("(999)-999-9999");
        $("#contacto_telefonotutor").inputmask("(999)-999-9999");
        $("#contacto_telefonocelular").inputmask("(999)-999-9999");
        $("#contacto_telefono_otro").inputmask("(999)-999-9999");

        $("#direccion_delegacion").attr('disabled','-1');
        $("#direccion_colonia").attr('disabled','-1');
        $("#direccion_localidad").attr('disabled','-1');
        $("#direccion_codigopostal").attr('disabled','-1')
        $("#direccion_colonia_2").attr('disabled','-1')

        $.fn.populateSelect = function (values) {

            var options='';

            $.each(values, function (key, row) {
                options += '<option value="' + row.value + '">' + row.text + '</option>';
            });

            $(this).html(options);
        };

        $('#direccion_estado').change(function () {

            var estado_id = $(this).val();

            console.log("Estado id: "+estado_id)

            if(estado_id===null)
            {

            }
            if(estado_id==="")
            {
                $('#direccion_delegacion').empty().change();
                $('#direccion_colonia').empty().change();
            }
            else
            {
                $("#direccion_delegacion").removeAttr('disabled');
                $('#direccion_delegacion').empty().change();
                $('#direccion_colonia').empty().change();

                $.getJSON('../delegaciones_por_estado/'+estado_id, null, function (values) {
                    $('#direccion_delegacion').populateSelect(values);
                });
            }

        });

        $('#direccion_delegacion').change(function () {

            var estado_id = $("#direccion_estado").val();
            var delegacion_id = $(this).val();

            if(delegacion_id===null)
            {

            }
            else if(delegacion_id === "" )
            {
                $('#direccion_colonia').empty().change();
            }
            else if(estado_id==="")
            {

            }
            else
            {
                $("#direccion_colonia").removeAttr('disabled');


                $.getJSON('../colonias_por_delegacion/'+estado_id+'/'+delegacion_id, null, function (values) {
                    $('#direccion_colonia').populateSelect(values);
                });
            }
        });

        $('#direccion_colonia').change(function () {
            var colonia_id = $(this).val();

            console.log("Colonia id: "+colonia_id);

            if(colonia_id===null || colonia_id==="")
            {

            }
            else
            {
                $("#direccion_localidad").removeAttr('disabled');
                $("#direccion_colonia_2").removeAttr('disabled');
                $("#direccion_codigopostal").removeAttr('disabled');

                $("#direccion_localidad").empty().change();
                $("#direccion_colonia_2").empty().change();
                $("#direccion_codigopostal").empty().change();

                $.getJSON('../detalle_colonia/'+colonia_id, null, function (data) {
                    $("#direccion_localidad").val(data.cp_ciudad);
                    $("#direccion_colonia_2").val(data.cp_asentamiento+' ( '+data.cp_tipoasentamiento+' )');
                    $("#direccion_codigopostal").val(data.cp_codigo);
                });

            }
        });


        jQuery.validator.setDefaults({
            submitHandler: function() {
                alert("submitted!");
            }
        });
        //https://jqueryvalidation.org/
        //https://jqueryvalidation.org/files/demo/
        //https://jqueryvalidation.org/files/demo/bootstrap/index.html

        $("#form_hojadeinscripcion").validate({

            //errorElement: "em",
            errorElement: "span",
            errorPlacement: function(error, element) {

                $( element )
                    .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                    .append( error );

                //error.addClass( "help-block" );
                //error.insertAfter( element );
                //console.log(element.attr( "id" )+"Error: errorPlacement");
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".myerror" ).addClass( "has-error" ).removeClass( "has-success" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).parents( ".myerror" ).addClass( "has-success" ).removeClass( "has-error" );
            },
            rules:{
                alumno_primernombre      : { required: true },
                alumno_apellidopaterno   : { required: true },
                alumno_genero            : { required: true },
                direccion_calle          : { required: true },
                direccion_numerointerior : { required: true },
                direccion_referencias    : { required: true },
                direccion_estado         : { required: true },
                direccion_delegacion     : { required: true },
                direccion_colonia        : { required: true },
                direccion_localidad      : { required: true },
                direccion_codigopostal   : { required: true }

            },
            messages :{
                alumno_primernombre : {
                    required: " (*)",
                    minlength: " (Incorrecto)"

                },
                alumno_apellidopaterno : {
                    required: " (*)",
                    minlength: " (Incorrecto)"

                },
                alumno_genero :{
                    required: " (*)"
                },
                direccion_calle:{
                    required: " (*)"
                },
                direccion_numerointerior : {
                    required: " (*)"
                },
                direccion_referencias : {
                    required: " (*)"
                },
                direccion_estado : {
                    required: " (*)"
                },
                direccion_delegacion : {
                    required: " (*)"
                },
                direccion_colonia    : {
                    required: " (*)"
                },
                direccion_localidad  : {
                    required: " (*)"
                },
                direccion_codigopostal : {
                    required: " (*)"
                }
            },
            invalidHandler: function(event, validator) {
                // 'this' refers to the form
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = 'Los campos marcados con (*) son obligatorios.';
                    swal({
                        title:"Error:",
                        text: message,
                        type: "error",
                        allowOutsideClick: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Corregir"
                    });

                }
            }

        });

    });
</script>
@endsection