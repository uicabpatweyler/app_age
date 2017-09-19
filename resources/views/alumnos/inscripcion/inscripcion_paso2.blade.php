@extends('templates.app_age')

@section('title', 'Hoja de Inscripción')

@section('css')
    <style>
        label span.error { color: red; }

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
                                    <div class="form-group alumno_primernombre">
                                        <label for="alumno_primernombre">Nombre</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Primer Nombre" id="alumno_primernombre" name="alumno_primernombre" required>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Segundo Nombre" id="alumno_segundonombre" name="alumno_segundonombre">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Apellidos</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Apellido Paterno" id="alumno_apellidopaterno" name="alumno_apellidopaterno">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Apellido Materno" id="alumno_apellidomaterno" name="alumno_apellidomaterno">
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
                                                <input type="text" class="form-control" id="alumno_curp" name="alumno_curp" value="{{$alumno_curp}}">
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
                                                    <input type="text" class="form-control" id="alumno_fechanac" name="alumno_fechanac">
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
                                                <input type="text" class="form-control" id="alumno_edad" name="alumno_edad">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Sexo</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select name="alumno_genero" id="alumno_genero" class="form-control alumno_genero" style="width: 100%;">
                                                    <option value="-1" selected>[Elegir]</option>
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
                                        <label for="">Dirección</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Calle/Avenida" id="direccion_calle" name="direccion_calle">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Int." id="direccion_numerointerior" name="direccion_numerointerior">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Num. Ext." id="direccion_numeroexterior" name="direccion_numeroexterior">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="Cruzamientos/Esquina/Entre Calles" id="direccion_referencias" name="direccion_referencias">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fila para la Colonia, C.P., Localidad, Estado -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Estado *</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select name="direccion_estado" id="direccion_estado" class="form-control direccion_estado" style="width: 100%;">
                                                    <option value="-1" selected>[Elegir estado]</option>
                                                    @foreach($estados as $estado)
                                                        <option value="{{$estado->id}}">{{$estado->estado_nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Deleg/Munic.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="col-xs-12">
                                                    <select name="direccion_delegacion" id="direccion_delegacion" class="form-control direccion_delegacion" style="width: 100%;">
                                                        <option value="-1" selected>[Elegir Deleg/Munic.]</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Colonia</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <select name="direccion_colonia" id="direccion_colonia" class="form-control direccion_colonia" style="width: 100%;">
                                                    <option value="-1" selected>[Elegir Colonia]</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Localidad</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" name="direccion_localidad" id="direccion_localidad">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">C.P.</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" placeholder="00000">
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


        $('.alumno_genero').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elegir]'
            }
        });

        $('.direccion_estado').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elegir estado]'
            }
        });

        $('.direccion_delegacion').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elegir Deleg/Munic.]'
            }
        });

        $('.direccion_colonia').select2({
            allowClear: true,
            placeholder: {
                id: "-1",
                text: '[Elegir Colonia]'
            }
        });

        $("#contacto_telefonocasa").inputmask("(999)-999-9999");
        $("#contacto_telefonotutor").inputmask("(999)-999-9999");
        $("#contacto_telefonocelular").inputmask("(999)-999-9999");
        $("#contacto_telefono_otro").inputmask("(999)-999-9999");

        jQuery.validator.setDefaults({
            submitHandler: function() {
                alert("submitted!");
            }
        });
        //https://jqueryvalidation.org/
        //https://jqueryvalidation.org/files/demo/
        //https://jqueryvalidation.org/files/demo/bootstrap/index.html

        $("#form_hojadeinscripcion").validate({

            errorPlacement: function(error, element) {
                // Append error within linked label
                $( element ).closest( "form" ).find( "label[for='" + element.attr( "id" ) + "']" ).append( error );
                //console.log(element.attr( "id" ));
                //$('.'+element.attr( "id" )).addClass("has-error");
            },
            errorElement: "span",
            rules:{
                alumno_primernombre : { required: true }
            },
            messages :{
                alumno_primernombre : " (requerido)"
            }

        });

    });
</script>
@endsection