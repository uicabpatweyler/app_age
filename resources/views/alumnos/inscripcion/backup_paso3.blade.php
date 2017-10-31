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
                    <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                    <input type="hidden" name="alumno_id" id="alumno_id" value="{{$alumno->id}}">
                    <input type="hidden" name="direccion_id" id="direccion_id" value="{{$direccion->id}}">
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
                                                                <label for="tutor_primerapellido">Apellido</label>
                                                                <div class="row">
                                                                    <div class="col-xs-6 myerror">
                                                                        <input type="text" class="form-control" placeholder="Apellido Paterno" id="tutor_primerapellido" name="tutor_primerapellido" style="text-transform:capitalize" required minlength="2">
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <input type="text" class="form-control" placeholder="Apellido Materno" id="tutor_segundoapellido" name="tutor_segundoapellido" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Termina fila para el nombre y apellidos del tutor -->

                                                    <!-- Inicia fila para el select del genero y correo electronico del tutor -->
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="tutor_genero">Sexo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="tutor_genero" id="tutor_genero" class="form-control" style="width: 100%;" required>
                                                                            <option value="" selected>[Elegir]</option>
                                                                            <option value="H">Hombre</option>
                                                                            <option value="M">Mujer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

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
                                                                        <input type="text" value="{{$direccion->nombre_vialidad}}" class="form-control" placeholder="Calle/Avenida" id="tutor_direccion_calle" name="tutor_direccion_calle" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_numinterior">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$direccion->numero_exterior}}" class="form-control" placeholder="Num. Int." id="tutor_direccion_numinterior" name="tutor_direccion_numinterior" style="text-transform:uppercase" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" value="{{$direccion->numero_interior}}" class="form-control" placeholder="Num. Ext." id="tutor_direccion_numexterior" style="text-transform:uppercase" name="tutor_direccion_numexterior">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_referencias">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$direccion->direccion_referencias}}" class="form-control" placeholder="Cruzamientos/Esquina/Entre Calles" id="tutor_direccion_referencias" name="tutor_direccion_referencias" style="text-transform:capitalize" required>
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
                                                                        <select name="direccion_estado" id="direccion_estado" class="form-control" style="width: 100%;">
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
                                                                        <select name="direccion_delegacion" id="direccion_delegacion" class="form-control" style="width: 100%;">
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
                                                                        <select name="direccion_colonia" id="direccion_colonia" class="form-control" style="width: 100%;">
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
                                                                        <input type="text" value="{{$direccion->direccion_localidad}}" class="form-control" name="tutor_direccion_localidad" id="tutor_direccion_localidad" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_delegacion"></label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$direccion->direccion_delegacion}}" class="form-control" name="tutor_direccion_delegacion" id="tutor_direccion_delegacion" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_estado"></label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$direccion->direccion_estado}}" class="form-control" name="tutor_direccion_estado" id="tutor_direccion_estado" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Inicia fila para los input text del nombre de la localidad, colonia y codigo postal -->
                                                    <div class="row">

                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_colonia">Detalles de la Colonia</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$direccion->direccion_colonia}}" class="form-control" name="tutor_direccion_colonia" id="tutor_direccion_colonia"  style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="tutor_direccion_codigopostal">C.P.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" value="{{$direccion->direccion_codigopostal}}" class="form-control" placeholder="00000" name="tutor_direccion_codigopostal" id="tutor_direccion_codigopostal" minlength="5" required>
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
                                                                        <input type="text" class="form-control" name="referencia1" id="referencia1" style="text-transform:capitalize">
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
                                                                        <input type="text" class="form-control" name="referencia2" id="referencia2" style="text-transform:capitalize">
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
                                                                        <input type="text" class="form-control" name="referencia3" id="referencia3" style="text-transform:capitalize">
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
                                                                        <input type="text" class="form-control" name="referencia4" id="referencia4" style="text-transform:capitalize">
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
                                                                        <input type="text" class="form-control" placeholder="Ocupación" id="tutor_ocupacion" name="tutor_ocupacion" style="text-transform:capitalize" minlength="2">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="tutor_lugardetrabajo">Lugar de Trabajo</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Lugar de trabajo" id="tutor_lugardetrabajo" name="tutor_lugardetrabajo" style="text-transform:capitalize" minlength="2">
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
                                                                <label for="tutor_ldt_numinterior">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Num. Int." id="tutor_ldt_numinterior" name="tutor_ldt_numinterior" style="text-transform:uppercase">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Num. Ext." id="tutor_ldt_numexterior" name="tutor_ldt_numexterior" style="text-transform:uppercase">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="tutor_ldt_referencias">&nbsp;</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Cruzamientos/Esquina/Entre Calles" id="tutor_ldt_referencias" name="tutor_ldt_referencias" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para los select de Estado, Delegacion/Municipio y Colonia -->
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="lugardetrabajo_estado">Estado</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="lugardetrabajo_estado" id="lugardetrabajo_estado" class="form-control" style="width: 100%;">
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
                                                                <label for="lugardetrabajo_delegacion">Deleg/Munic.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="lugardetrabajo_delegacion" id="lugardetrabajo_delegacion" class="form-control" style="width: 100%;">
                                                                            <option value="" selected>[Elegir Deleg/Munic.]</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="lugardetrabajo_colonia">Colonia</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="lugardetrabajo_colonia" id="lugardetrabajo_colonia" class="form-control" style="width: 100%;">
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
                                                                        <input type="text" class="form-control" name="tutor_ldt_colonia" id="tutor_ldt_colonia">
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

        $('#tutor_genero').select2({
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

        $('#lugardetrabajo_estado').select2({
            allowClear: true,
            placeholder: '[Elegir estado]'
        });

        $('#lugardetrabajo_delegacion').select2({
            allowClear: true,
            placeholder: '[Elegir Deleg/Munic.]'
        });

        $('#lugardetrabajo_colonia').select2({
            allowClear: true,
            placeholder: '[Elegir Colonia]'
        });

        $("#tutor_telefonocasa").inputmask("(999)-999-9999");
        $("#tutor_telefonotrabajo").inputmask("(999)-999-9999");
        $("#tutor_telefonocelular").inputmask("(999)-999-9999");
        $("#tutor_telefono_otro").inputmask("(999)-999-9999");

        //Desactivamos los select de Delegacion y Colonia, los cuales se activan hasta que el usuario elija un
        //estado de la lista
        $("#direccion_delegacion").attr('disabled','-1');
        $("#direccion_colonia").attr('disabled','-1');
        $("#lugardetrabajo_delegacion").attr('disabled','-1');
        $("#lugardetrabajo_colonia").attr('disabled','-1');

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

        //Funcion para llenar los select con los datos devueltos mediante AJAX
        $.fn.populateSelect = function (values) {

            var options='';

            $.each(values, function (key, row) {
                options += '<option value="' + row.value + '">' + row.text + '</option>';
            });

            $(this).html(options);
        };

        //El usuaro selecciona un estado
        $('#direccion_estado').change(function () {

            var estado_id = $(this).val();
            //El usuario no selecciono algun elemento del select
            if(estado_id===null){}
            //El usuario elimina la seleccion del select
            else if(estado_id==="")
            {
                //Eliminamos el contenido de los input text correspondientes
                $('#direccion_delegacion').empty().change();
                $('#direccion_colonia').empty().change();
                $("#direccion_delegacion").attr('disabled','-1');
                $("#direccion_colonia").attr('disabled','-1');
            }
            else
            {
                //El usuario selecciono un elemento valido
                //Activamos el select de las delegaciones
                $("#direccion_delegacion").removeAttr('disabled');
                //Removemos el contenido del select de las delegaciones
                $('#direccion_delegacion').empty().change();
                //Removemos el contenido del select de las colonias
                $('#direccion_colonia').empty().change();

                //Consulta AJAX mediante el id del estado seleccionado
                $.getJSON('../../../delegaciones_por_estado/'+estado_id, null, function (values) {
                    $('#direccion_delegacion').populateSelect(values);
                });
            }

        });

        $('#lugardetrabajo_estado').change(function () {

            var estado_id = $(this).val();
            //El usuario no selecciono algun elemento del select
            if(estado_id===null){}
            //El usuario elimina la seleccion del select
            else if(estado_id==="")
            {
                //Eliminamos el contenido de los input text correspondientes
                $('#lugardetrabajo_delegacion').empty().change();
                $('#lugardetrabajo_colonia').empty().change();
                $("#lugardetrabajo_delegacion").attr('disabled','-1');
                $("#lugardetrabajo_colonia").attr('disabled','-1');
            }
            else
            {
                //El usuario selecciono un elemento valido
                //Activamos el select de las delegaciones
                $("#lugardetrabajo_delegacion").removeAttr('disabled');
                //Removemos el contenido del select de las delegaciones
                $('#lugardetrabajo_delegacion').empty().change();
                //Removemos el contenido del select de las colonias
                $('#lugardetrabajo_colonia').empty().change();

                //Consulta AJAX mediante el id del estado seleccionado
                $.getJSON('../../../delegaciones_por_estado/'+estado_id, null, function (values) {
                    $('#lugardetrabajo_delegacion').populateSelect(values);
                });
            }

        });



        //El usuario selecciona una delegacion
        $('#direccion_delegacion').change(function () {
            //El id del elemento seleccionado
            var estado_id = $("#direccion_estado").val();
            var delegacion_id = $(this).val();

            if(delegacion_id===null) {}
            else if(delegacion_id === "" ) { $('#direccion_colonia').empty().change(); }
            else if(estado_id==="") {}
            else
            {
                $("#direccion_colonia").removeAttr('disabled');


                $.getJSON('../../../colonias_por_delegacion/'+estado_id+'/'+delegacion_id, null, function (values) {
                    $('#direccion_colonia').populateSelect(values);
                });
            }
        });

        $('#lugardetrabajo_delegacion').change(function () {
            //El id del elemento seleccionado
            var estado_id = $("#lugardetrabajo_estado").val();
            var delegacion_id = $(this).val();

            if(delegacion_id===null) {}
            else if(delegacion_id === "" ) { $('#lugardetrabajo_colonia').empty().change(); }
            else if(estado_id==="") {}
            else
            {
                $("#lugardetrabajo_colonia").removeAttr('disabled');

                $.getJSON('../../../colonias_por_delegacion/'+estado_id+'/'+delegacion_id, null, function (values) {
                    $('#lugardetrabajo_colonia').populateSelect(values);
                });
            }
        });

        //El usuario elegio una colonia del select
        $('#direccion_colonia').change(function () {
            var colonia_id = $(this).val();

            if(colonia_id===null || colonia_id===""){}
            else
            {
                //El usuario ha seleccionado un Estado, Delegacion y una nueva COLONIA
                //Eliminamos los valores contenidos en los siguientes input:text
                $("#tutor_direccion_localidad").empty().change();
                $("#tutor_direccion_delegacion").empty().change();
                $("#tutor_direccion_estado").empty().change();
                $("#tutor_direccion_colonia").empty().change();
                $("#tutor_direccion_codigopostal").empty().change();

                //Obtenemos los detalles de la nueva colonia seleccionada por el usuario
                $.getJSON('../../../detalle_colonia/'+colonia_id, null, function (data) {

                    //Obtenemos el nombre del estado seleccionado
                    var estado = $("#direccion_estado option:selected").html();
                    //Obtenemos el nombre de la delegacion seleccionada
                    var delegacion = $("#direccion_delegacion option:selected").html();

                    //Asignamos los nuevos valores a los input:text correspondientes
                    $("#tutor_direccion_estado").val(estado);
                    $("#tutor_direccion_delegacion").val(delegacion);
                    $("#tutor_direccion_localidad").val(data.cp_ciudad);
                    $("#tutor_direccion_colonia").val(data.cp_asentamiento+' ( '+data.cp_tipoasentamiento+' )');
                    $("#tutor_direccion_codigopostal").val(data.cp_codigo);
                });

            }
        });

        $("#lugardetrabajo_colonia").change(function(){
            var colonia_id = $(this).val();

            if(colonia_id===null || colonia_id===""){}
            else{
                $("#tutor_ldt_localidad").empty().change();
                $("#tutor_ldt_colonia").empty().change();
                $("#tutor_ldt_codigopostal").empty().change();

                $.getJSON('../../../detalle_colonia/'+colonia_id, null, function (data) {
                    $("#tutor_ldt_localidad").val(data.cp_ciudad);
                    $("#tutor_ldt_colonia").val(data.cp_asentamiento+' ( '+data.cp_tipoasentamiento+' )');
                    $("#tutor_ldt_codigopostal").val(data.cp_codigo);
                });
            }
        });

        jQuery.validator.setDefaults({
            submitHandler: function (form) {

                //Selects de la direccion de trabajo del tutor
                var estado_ldt    = $("#lugardetrabajo_estado option:selected").html();
                var delegacion_ldt = $("#lugardetrabajo_delegacion option:selected").html();

                if(estado_ldt==='[Elegir estado]' && delegacion_ldt==='[Elegir Deleg/Munic.]'){
                    estado_ldt     = null;
                    delegacion_ldt = null;
                }

                $("#tutor_ldt_estado").val(estado_ldt);
                $("#tutor_ldt_delegacion").val(delegacion_ldt);

                swal({
                    title: '¿Desea guardar los datos del tutor?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si'
                }).then(function () {
                    ajaxSubmit();
                })

            }
        });

        function ajaxSubmit(){
            $.ajax({
                type:"POST",
                url:"{{route('guardar_datos_tutor')}}",
                data: $("#form_datosdeltutor").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location = "{{route('inscripcion_paso1')}}";
                    });
                },
                error: function(xhr,status, response ){
                    //Obtener el valor de los errores devueltos por el controlador
                    var error = jQuery.parseJSON(xhr.responseText);
                    //Obtener los mensajes de error
                    var info = error.message;
                    //Verificar si el mensaje proviene de una Excepcion al guardar los datos
                    var excepcion = error.exception;
                    if(excepcion===true)
                    {
                        var error_message_user = error.error_message_user;
                        swal({
                            title:'Error de excepcion',
                            html: error_message_user,
                            type: "error",
                            allowOutsideClick: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: "Reintentar"
                        });
                    }
                    else
                    {
                        //Crear la lista de errores
                        var errorsHtml = '<ul>';
                        $.each(info, function (key,value) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        errorsHtml += '</ul>';
                        //Mostrar el y/o los errores devuelto(s) por el controlador
                        swal({
                            title:"Error:",
                            html: errorsHtml,
                            type: "error",
                            allowOutsideClick: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: "Corregir"
                        });
                    }

                }
            });
        }

        $("#form_datosdeltutor").validate({
            errorElement: "span",
            errorPlacement: function(error, element) {

                $( element )
                        .closest( "form" )
                        .find( "label[for='" + element.attr( "id" ) + "']" )
                        .append( error );
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".myerror" ).addClass( "has-error" ).removeClass( "has-success" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).parents( ".myerror" ).addClass( "has-success" ).removeClass( "has-error" );
            },

            rules : {
                tutor_primernombre           : { required: true },
                tutor_primerapellido         : { required: true },
                tutor_genero                 : { required: true },
                tutor_direccion_calle        : { required: true },
                tutor_direccion_numinterior  : { required: true },
                tutor_direccion_referencias  : { required: true },
                tutor_direccion_localidad    : { required: true },
                tutor_direccion_delegacion   : { required: true },
                tutor_direccion_estado       : { required: true },
                tutor_direccion_colonia      : { required: true },
                tutor_direccion_codigopostal : { required: true },
                direccion_delegacion         : { required: true },
                direccion_colonia            : { required: true }
            },

            messages :{
                tutor_primernombre           : { required: "(*)", minlength: " (Incorrecto)"},
                tutor_primerapellido         : { required: "(*)", minlength: " (Incorrecto)"},
                tutor_genero                 : { required: "(*)" },
                tutor_direccion_calle        : { required: "(*)" },
                tutor_direccion_numinterior  : { required: "(*)" },
                tutor_direccion_referencias  : { required: "(*)" },
                tutor_direccion_localidad    : { required: "(*)" },
                tutor_direccion_delegacion   : { required: "(*)" },
                tutor_direccion_estado       : { required: "(*)" },
                tutor_direccion_colonia      : { required: "(*)" },
                tutor_direccion_codigopostal : { required: "(*)", minlength: " (Incorrecto)" },
                direccion_delegacion         : { required: "(*)" },
                direccion_colonia            : { required: "(*)" }
            },

            invalidHandler: function(event, validator) {
                // 'this' refers to the form
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = 'Los campos marcados en rojo con (*) son obligatorios.';
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