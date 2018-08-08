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
                <h1>Hoja de Incripción - Tutor del alumno</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">
                <form action="" role="form" method="post" id="form_datosdeltutor" name="form_datosdeltutor">
                    {{csrf_field()}}
                    <input type="hidden" name="id_ciclo" id="id_ciclo" value="{{$ciclo->id}}">
                    <input type="hidden" name="id_alumno" id="id_alumno" value="{{$alumno->id}}">
                    <input type="hidden" name="direccion_id" id="direccion_id" value="{{$direccion->id}}">
                    <input type="hidden" name="entidad_federativa" id="entidad_federativa" value="{{$direccion->entidad_federativa}}">
                    <input type="hidden" name="delegacion_municipio" id="delegacion_municipio" value="{{$direccion->delegacion_municipio}}">
                    
                    <div class="box box-success">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title"> Datos del tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                    <i class="fa fa-minus"></i></button>

                                <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                    <i class="fa fa-floppy-o fa-lg"></i></button>

                                <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                    <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                            </div>

                        </div>
                        <!-- box-body -->
                        <div class="box-body">
                            <!-- Inicia fila para el nombre del alumno y el ciclo escolar-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alumno">Alumno:</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" value="{{$alumno->alumno_primernombre}} {{$alumno->alumno_segundonombre}}" class="form-control" id="alumno_nombre" name="alumno_nombre" style="text-transform:capitalize" disabled>
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" value="{{$alumno->alumno_apellidopaterno}} {{$alumno->alumno_apellidomaterno}}" class="form-control" id="alumno_apellidos" name="alumno_apellidos" style="text-transform:capitalize" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="alumno">Ciclo:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="text" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" class="form-control" id="ciclo_escolar" name="ciclo_escolar" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina fila del nombre del alumno y el ciclo escolar-->

                            <!-- Inicia fila para el nombre y apellido del tutor -->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="tutor_nombre">Nombre del tutor:</label>
                                        <div class="row">
                                            <div class="col-xs-12 myerror">
                                                <input type="text" class="form-control" placeholder="Nombre (*)" id="tutor_nombre" name="tutor_nombre" style="text-transform:capitalize" required minlength="2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="tutor_apellidopaterno">Apellidos:</label>
                                        <div class="row">
                                            <div class="col-xs-6 myerror">
                                                <input type="text" class="form-control" placeholder="Apellido Paterno (*)" id="tutor_apellidopaterno" name="tutor_apellidopaterno" style="text-transform:capitalize" required minlength="2">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" class="form-control" placeholder="Apellido Materno" id="tutor_apellidomaterno" name="tutor_apellidomaterno" style="text-transform:capitalize">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina fila para el nombre y apellido del tutor -->

                            <!-- Inicia fila para el correo eléctronico del tutor -->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="tutor_email">Correo Electrónico:</label>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input type="email" class="form-control" placeholder="ejemplo@dominio.com" id="tutor_email" name="tutor_email">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Termina fila para el correo eléctronico del tutor -->

                            <br />
                            <!-- Inicia fila para el TabPanel de los datos del tutor -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="nav-tabs-custom">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-address-card fa-lg" aria-hidden="true"></i>&nbsp; Dirección</a></li>
                                            <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;Telefonos</a></li>
                                            <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>&nbsp;Lugar de Trabajo</a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="tab_1">
                                                <!-- Inicia fila: tipo de vialidad, nombre de vialidad, num. ext. y num int. -->
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">Tipo de Vialidad</label>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <select name="tipo_vialidad" id="tipo_vialidad" class="form-control" style="width: 100%;">
                                                                        <option value="" selected>(Valor Opcional)</option>
                                                                        <option value="Ampliación" {{($direccion->tipo_vialidad)=== "Ampliación" ? "selected" : ""}}>Ampliación</option>
                                                                        <option value="Andador" {{($direccion->tipo_vialidad)=== "Andador" ? "selected" : ""}}>Andador</option>
                                                                        <option value="Avenida" {{($direccion->tipo_vialidad)=== "Avenida" ? "selected" : ""}}>Avenida</option>
                                                                        <option value="Boulevard" {{($direccion->tipo_vialidad)=== "Boulevard" ? "selected" : ""}}>Boulevard</option>
                                                                        <option value="Calle" {{($direccion->tipo_vialidad)=== "Calle" ? "selected" : ""}}>Calle</option>
                                                                        <option value="Callejón" {{($direccion->tipo_vialidad)=== "Callejón" ? "selected" : ""}}>Callejón</option>
                                                                        <option value="Calzada" {{($direccion->tipo_vialidad)=== "Calzada" ? "selected" : ""}}>Calzada</option>
                                                                        <option value="Cerrada" {{($direccion->tipo_vialidad)=== "Cerrada" ? "selected" : ""}}>Cerrada</option>
                                                                        <option value="Circuito" {{($direccion->tipo_vialidad)=== "Circuito" ? "selected" : ""}}>Circuito</option>
                                                                        <option value="Circunvalación" {{($direccion->tipo_vialidad)=== "Circunvalación" ? "selected" : ""}}>Circunvalación</option>
                                                                        <option value="Continuación" {{($direccion->tipo_vialidad)=== "Continuación" ? "selected" : ""}}>Continuación</option>
                                                                        <option value="Corredor" {{($direccion->tipo_vialidad)=== "Corredor" ? "selected" : ""}}>Corredor</option>
                                                                        <option value="Diagonal" {{($direccion->tipo_vialidad)=== "Diagonal" ? "selected" : ""}}>Diagonal</option>
                                                                        <option value="Eje Vial" {{($direccion->tipo_vialidad)=== "Eje Vial" ? "selected" : ""}}>Eje Vial</option>
                                                                        <option value="Pasaje" {{($direccion->tipo_vialidad)=== "Pasaje" ? "selected" : ""}}>Pasaje</option>
                                                                        <option value="Peatonal" {{($direccion->tipo_vialidad)=== "Peatonal" ? "selected" : ""}}>Peatonal</option>
                                                                        <option value="Periférico" {{($direccion->tipo_vialidad)=== "Periférico" ? "selected" : ""}}>Periférico</option>
                                                                        <option value="Privada" {{($direccion->tipo_vialidad)=== "Privada" ? "selected" : ""}}>Privada</option>
                                                                        <option value="Prolongación" {{($direccion->tipo_vialidad)=== "Prolongación" ? "selected" : ""}}>Prolongación</option>
                                                                        <option value="Retorno" {{($direccion->tipo_vialidad)=== "Retorno" ? "selected" : ""}}>Retorno</option>
                                                                        <option value="Viaducto" {{($direccion->tipo_vialidad)=== "Viaducto" ? "selected" : ""}}>Viaducto</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label for="nombre_vialidad">Nombre de vialidad</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->nombre_vialidad}}" placeholder="Nombre de Vialidad (*)" id="nombre_vialidad" name="nombre_vialidad" style="text-transform:capitalize" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="numero_exterior">Num. Ext.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->numero_exterior}}" placeholder="Num. Ext. (*)" id="numero_exterior" name="numero_exterior" style="text-transform:capitalize" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">Num. Int.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <input type="text" class="form-control" value="{{$direccion->numero_interior}}" placeholder="Num. Int." id="numero_interior" style="text-transform:capitalize" name="numero_interior">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Termina fila: tipo de vialidad, nombre de vialidad, num. ext. y num int. -->

                                                <!-- Inicia fila: Entre Calles y Referencias Adicionales -->
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="entre_calles">Entre Calles</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->entre_calles}}" placeholder="Entre Calles" id="entre_calles" name="entre_calles" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="referencias_adicionales">Referencias Adicionales</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->referencias_adicionales}}" placeholder="Referencias Adicionales" id="referencias_adicionales" name="referencias_adicionales" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Termina fila: Entre Calles y Referencias Adicionales -->

                                                <!-- Inicia fila: Estado, Delegacion/Municipio y Colonia -->
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="direccion_estado">Estado (*)</label>
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
                                                            <label for="direccion_delegacion">Deleg/Munic. (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="direccion_delegacion" id="direccion_delegacion" class="form-control" style="width: 100%;" required disabled>
                                                                        <option value="" selected>[Elegir Deleg/Munic.]</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="direccion_colonia">Colonia (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="direccion_colonia" id="direccion_colonia" class="form-control" style="width: 100%;" required disabled>
                                                                        <option value="" selected>[Elegir Colonia]</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Termina fila: Estado, Delegacion/Municipio y Colonia -->

                                                <!-- Inicia fila: Localidad, Tipo de Asentamiento, Nombre de Asentamiento y Colonia -->
                                                <div class="row">

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="nombre_localidad">Localidad (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->nombre_localidad}}" name="nombre_localidad" id="nombre_localidad" style="text-transform:capitalize" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="tipo_asentamiento">Tipo Asentamiento(*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->tipo_asentamiento}}" name="tipo_asentamiento" id="tipo_asentamiento" style="text-transform:capitalize" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="nombre_asentamiento">Nombre Asentamiento(*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->nombre_asentamiento}}" name="nombre_asentamiento" id="nombre_asentamiento" style="text-transform:capitalize" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="codigo_postal">C.P.(*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->codigo_postal}}" placeholder="00000" name="codigo_postal" id="codigo_postal" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Termina fila: Localidad, Tipo de Asentamiento, Nombre de Asentamiento y Colonia -->
                                                
                                            </div>

                                            <!-- Inicia TabPanel Telefonos del Tutor -->
                                            <div role="tabpanel" class="tab-pane" id="tab_2">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Teléfono de casa</label>
                                                            <div class="row">
                                                                <div class="col-xs-8">
                                                                    <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_casa" id="telefono_casa" value="{{$datos_inscripcion->telefono_casa}}">
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
                                                                    <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_trabajo" id="telefono_trabajo">
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
                                                                    <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_celular" id="telefono_celular">
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
                                                                    <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_otro" id="telefono_otro">
                                                                </div>
                                                                <div class="col-xs-4">
                                                                    <input type="text" class="form-control" name="referencia4" id="referencia4" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Termina TabPanel Telefonos del Tutor -->

                                            <!-- Inicia TabPanel Lugar de Trabajo del Tutor -->
                                            <div role="tabpanel" class="tab-pane" id="tab_3">

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label for="">Nombre del lugar del trabajo</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" name="lugar_trabajo_tutor" id="lugar_trabajo_tutor" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">Tipo de Vialidad</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="tipo_vialidad_trabajo" id="tipo_vialidad_trabajo" class="form-control" style="width: 100%;">
                                                                        <option value="" selected>(Valor Opcional)</option>
                                                                        <option value="Ampliación">Ampliación</option>
                                                                        <option value="Andador">Andador</option>
                                                                        <option value="Avenida">Avenida</option>
                                                                        <option value="Boulevard">Boulevard</option>
                                                                        <option value="Calle">Calle</option>
                                                                        <option value="Callejón">Callejón</option>
                                                                        <option value="Calzada">Calzada</option>
                                                                        <option value="Cerrada">Cerrada</option>
                                                                        <option value="Circuito">Circuito</option>
                                                                        <option value="Circunvalación">Circunvalación</option>
                                                                        <option value="Continuación">Continuación</option>
                                                                        <option value="Corredor">Corredor</option>
                                                                        <option value="Diagonal">Diagonal</option>
                                                                        <option value="Eje Vial">Eje Vial</option>
                                                                        <option value="Pasaje">Pasaje</option>
                                                                        <option value="Peatonal">Peatonal</option>
                                                                        <option value="Periférico">Periférico</option>
                                                                        <option value="Privada">Privada</option>
                                                                        <option value="Prolongación">Prolongación</option>
                                                                        <option value="Retorno">Retorno</option>
                                                                        <option value="Viaducto">Viaducto</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label for="nombre_vialidad_trabajo">Nombre de vialidad</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" placeholder="Nombre de Vialidad" id="nombre_vialidad_trabajo" name="nombre_vialidad_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="numero_exterior_trabajo">Num. Ext.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" placeholder="Num. Ext." id="numero_exterior_trabajo" name="numero_exterior_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">Num. Int.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <input type="text" class="form-control" placeholder="Num. Int." id="numero_interior_trabajo" style="text-transform:capitalize" name="numero_interior_trabajo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="entre_calles_trabajo">Entre Calles</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" placeholder="Entre Calles" id="entre_calles_trabajo" name="entre_calles_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="referencias_adicionales_trabajo">Referencias Adicionales</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" placeholder="Referencias Adicionales" id="referencias_adicionales_trabajo" name="referencias_adicionales_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="direccion_estado_trabajo">Estado (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="direccion_estado_trabajo" id="direccion_estado_trabajo" class="form-control" style="width: 100%;">
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
                                                            <label for="direccion_delegacion_trabajo">Deleg/Munic. (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="direccion_delegacion_trabajo" id="direccion_delegacion_trabajo" class="form-control" style="width: 100%;" required disabled>
                                                                        <option value="" selected>[Elegir Deleg/Munic.]</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="direccion_colonia_trabajo">Colonia (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="direccion_colonia_trabajo" id="direccion_colonia_trabajo" class="form-control" style="width: 100%;" required disabled>
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
                                                            <label for="nombre_localidad_trabajo">Localidad</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" name="nombre_localidad_trabajo" id="nombre_localidad_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="tipo_asentamiento_trabajo">Tipo Asentamiento</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" name="tipo_asentamiento_trabajo" id="tipo_asentamiento_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="nombre_asentamiento_trabajo">Nombre Asentamiento</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" name="nombre_asentamiento_trabajo" id="nombre_asentamiento_trabajo" style="text-transform:capitalize">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="codigo_postal_trabajo">C.P.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" placeholder="00000" name="codigo_postal_trabajo" id="codigo_postal_trabajo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Termina TabPanel Lugar de Trabajo del Tutor -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina fila para el TabPanel de los datos del tutor -->

                        </div>

                    </div>
                    
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

        var flag_edit = false;
        //var flag_new = false;

        $('#tipo_vialidad').select2({
            allowClear: true,
            placeholder: '(Valor Opcional)'
        });

        $('#tipo_vialidad_trabajo').select2({
            allowClear: true,
            placeholder: '(Valor Opcional)'
        });

        $('#direccion_estado').select2({
            allowClear: true,
            placeholder: '[Elegir estado]'
        });

        $('#direccion_estado_trabajo').select2({
            allowClear: true,
            placeholder: '[Elegir estado]'
        });

        $('#direccion_delegacion').select2({
            allowClear: true,
            placeholder: '[Elegir Deleg/Munic.]'
        });

        $('#direccion_delegacion_trabajo').select2({
            allowClear: true,
            placeholder: '[Elegir Deleg/Munic.]'
        });

        $('#direccion_colonia').select2({
            allowClear: true,
            placeholder: '[Elegir Colonia]'
        });

        $('#direccion_colonia_trabajo').select2({
            allowClear: true,
            placeholder: '[Elegir Colonia]'
        });

        $("#telefono_casa").inputmask("(999)-999-9999");
        $("#telefono_trabajo").inputmask("(999)-999-9999");
        $("#telefono_celular").inputmask("(999)-999-9999");
        $("#telefono_otro").inputmask("(999)-999-9999");

        //El usuaro selecciona un estado
        $('#direccion_estado').change(function () {

            var estado_id = $(this).val();
            //El usuario no selecciono algun elemento
            if(estado_id===null)
            {

            }
            //El usuario elimina la seleccion del select
            else if(estado_id==="")
            {
                //Eliminamos el contenido de los input text correspondientes
                $('#direccion_delegacion').empty().change();
                $('#direccion_colonia').empty().change();
            }
            else
            {
                //Obtenemos el estado seleccionado del select correspondiente
                var entidad_federativa = $("#direccion_estado option:selected").html();
                //Lo guardamos en el input correspondiente
                $("#entidad_federativa").val(entidad_federativa);

                ///El usuario selecciono un elemento valido
                $("#direccion_delegacion").removeAttr('disabled');
                $('#direccion_delegacion').empty().change();
                $('#direccion_colonia').empty().change();

                //Consulta AJAX mediante el id del estado seleccionado
                $.getJSON('../../../../delegaciones_por_estado/'+estado_id, null, function (values) {
                    $('#direccion_delegacion').populateSelect(values);
                });
            }

        });

        //El usuario selecciona una delegacion
        $('#direccion_delegacion').change(function () {
            //El id del elemento seleccionado
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
                //Obtenemos la delegacion y/o municipio del select correspondiente
                var delegacion_municipio = $("#direccion_delegacion option:selected").html();
                //Lo guardamos en el input correspondiente
                $("#delegacion_municipio").val(delegacion_municipio);

                $("#direccion_colonia").removeAttr('disabled');

                $.getJSON('../../../../colonias_por_delegacion/'+estado_id+'/'+delegacion_id, null, function (values) {
                    $('#direccion_colonia').populateSelect(values);
                });
            }
        });

        $('#direccion_colonia').change(function () {
            var colonia_id = $(this).val();

            if(colonia_id===null || colonia_id==="")
            {

            }
            else
            {
                $("#nombre_localidad").removeAttr('disabled');
                $("#tipo_asentamiento").removeAttr('disabled');
                $("#nombre_asentamiento").removeAttr('disabled');
                $("#codigo_postal").removeAttr('disabled');

                $("#direccion_localidad").empty().change();
                $("#tipo_asentamiento").empty().change();
                $("#nombre_asentamiento").empty().change();
                $("#codigo_postal").empty().change();

                $.getJSON('../../../detalle_colonia/'+colonia_id, null, function (data) {
                    $("#nombre_localidad").val(data.cp_ciudad);
                    $("#tipo_asentamiento").val(data.cp_tipoasentamiento);
                    $("#nombre_asentamiento").val(data.cp_asentamiento);
                    $("#codigo_postal").val(data.cp_codigo);
                });

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
            rules: {
                tutor_nombre          : { required: true },
                tutor_apellidopaterno : { required: true},
                nombre_vialidad       : { required: true },
                numero_exterior       : { required: true },
                delegacion_municipio  : { required: true },
                entidad_federativa    : { required: true },
                direccion_delegacion  : { required: true },
                direccion_colonia     : { required: true },
                nombre_localidad      : { required: true },
                tipo_asentamiento     : { required: true },
                nombre_asentamiento   : { required: true },
                codigo_postal         : { required: true }
            },
            messages : {
                tutor_nombre : {
                    required: " (Incorrecto)",
                    minlength: " (Incorrecto)"

                },
                tutor_apellidopaterno : {
                    required: " (Incorrecto)",
                    minlength: " (Incorrecto)"

                },
                nombre_vialidad:{
                    required: " requerido"
                },
                numero_exterior : {
                    required: " requerido"
                },
                direccion_delegacion : {
                    required: " requerido"
                },
                direccion_colonia : {
                    required: " requerido"
                },
                nombre_localidad    : {
                    required: " requerido"
                },
                tipo_asentamiento : {
                    required: " requerido"
                },
                nombre_asentamiento : {
                    required: " requerido"
                },
                codigo_postal : {
                    required: " requerido"
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
            },
            submitHandler: function() {
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

                    //Llamamos a la funcion AJAX para enviar el formulario
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
                        //window.location.replace("datos_tutor/"+data.id_alumno+"/"+data.id_ciclo+"/"+data.id_direccion);
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
                        var message_user = error.message_user;
                        var error_numeric_code = error.error_numeric_code;
                        var message_error = error.message_error;
                        swal({
                            title: (error_numeric_code != 0 )?'Codigo de Error: '+error_numeric_code : 'Error de Excepción',
                            html: (error_numeric_code != 0 )? message_error : message_user,
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

    });
</script>
@endsection