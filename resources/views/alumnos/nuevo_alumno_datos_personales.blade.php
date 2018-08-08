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
                <h1>Agregar Nuevo Alumno</h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="col-md-12">

                    <form action="" role="form" method="post" id="form_nuevoalumno_datospersonales" name="form_nuevoalumno_datospersonales">
                        {{csrf_field()}}
                        <input type="hidden" name="entidad_federativa" id="entidad_federativa">
                        <input type="hidden" name="delegacion_municipio" id="delegacion_municipio">
                        <input type="hidden" name="escuela_id" id="escuela_id" value="{{$escuela->id}}">
                        <input type="hidden" name="ciclo_id" id="ciclo_id" value="{{$ciclo->id}}">
                        <input type="hidden" name="alumno_id" id="alumno_id" value="{{$alumno->id}}">

                        <!-- Inicia: Datos Personales del alumno -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"> Datos personales del alumno</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>

                                <div class="box-tools pull-right">

                                    <button type="button" class="btn btn-success btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                                        <i class="fa fa-minus"></i></button>

                                    <button type="submit" class="btn btn-primary btn-sm pull-right" data-toggle="tooltip" title="Guardar" style="margin-right: 5px;">
                                        <i class="fa fa-floppy-o fa-lg"></i></button>

                                    <a class="btn btn-danger btn-sm pull-right" href="" data-toggle="tooltip" title="Cancelar" style="margin-right: 5px;">
                                        <i class="fa fa-ban fa-lg" aria-hidden="true"></i></a>

                                </div>

                            </div>


                            <div class="box-body">

                                <!-- Fila para la escuela y el ciclo escolar -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="escuela_nombre">Escuela</label>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <input type="text" class="form-control" id="escuela_nombre" name="escuela_nombre" value="{{$escuela->escuela_nombre}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ciclo_escolar">Ciclo Escolar</label>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input type="text" class="form-control" id="ciclo_escolar" name="ciclo_escolar" value="{{$ciclo->ciclo_anioinicial}}-{{$ciclo->ciclo_aniofinal}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fila para el nombre y apellidos del alumno -->
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alumno_nombre">Nombre</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="{{$alumno->alumno_primernombre}} {{$alumno->alumno_segundonombre}}" id="alumno_nombre" name="alumno_nombre" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="alumno_apellidos">Apellidos</label>
                                            <div class="row">
                                                <div class="col-xs-12 myerror">
                                                    <input type="text" class="form-control" value="{{$alumno->alumno_apellidopaterno}} {{$alumno->alumno_apellidomaterno}}" placeholder="" id="alumno_apellidos" name="alumno_apellidos" style="text-transform:capitalize" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Fila para la CURP, Fecha Nac., Edad y Sexo -->
                                <div class="row">

                                </div>
                                <br />
                                <!-- Fila para el TabPanel de Dirección, Telefonos y Otros Datos -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- Begin Custom Tabs -->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-address-card fa-lg" aria-hidden="true"></i>&nbsp; Dirección</a></li>
                                                <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;Telefonos</a></li>
                                                <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i>&nbsp;Educación y Trabajo</a></li>
                                                <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i></i>&nbsp;Otros Datos</a></li>
                                            </ul>

                                            <div class="tab-content">

                                                <div class="tab-pane active" id="tab_1">

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="">Tipo de Vialidad</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <select name="tipo_vialidad" id="tipo_vialidad" class="form-control" style="width: 100%;">
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
                                                                <label for="nombre_vialidad">Nombre de vialidad (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Nombre de Vialidad" id="nombre_vialidad" name="nombre_vialidad" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="numero_exterior">Num. Ext. (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Num. Ext." id="numero_exterior" name="numero_exterior" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="">Num. Int.</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Num. Int." id="numero_interior" style="text-transform:capitalize" name="numero_interior">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para la direccion -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="entre_calles">Entre Calles</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Entre Calles" id="entre_calles" name="entre_calles" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="referencias_adicionales">Referencias Adicionales</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="Referencias Adicionales" id="referencias_adicionales" name="referencias_adicionales" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para los select de Estado, Delegacion/Municipio y Colonia -->
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
                                                                        <select name="direccion_delegacion" id="direccion_delegacion" class="form-control" style="width: 100%;" required>
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
                                                                        <select name="direccion_colonia" id="direccion_colonia" class="form-control" style="width: 100%;" required>
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
                                                                <label for="nombre_localidad">Localidad (*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="nombre_localidad" id="nombre_localidad" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="tipo_asentamiento">Tipo Asentamiento(*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="tipo_asentamiento" id="tipo_asentamiento" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="nombre_asentamiento">Nombre Asentamiento(*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" name="nombre_asentamiento" id="nombre_asentamiento" style="text-transform:capitalize" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="codigo_postal">C.P.(*)</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12 myerror">
                                                                        <input type="text" class="form-control" placeholder="00000" name="codigo_postal" id="codigo_postal" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.tab-pane Dirección -->

                                                <div class="tab-pane" id="tab_2">
                                                    <!-- Fila los telefonos de contacto del alumno -->
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Teléfono de casa</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_casa" id="telefono_casa">
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type="text" class="form-control" name="referencia1" id="referencia1" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Telefono tutor</label>
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" placeholder="(983)-123-45678" name="telefono_tutor" id="telefono_tutor">
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
                                                <!-- /.tab-pane Telefonos -->

                                                <div class="tab-pane" id="tab_3">
                                                    <!-- Fila para la escuela y lugar de trabajo -->
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Escuela:</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Escuela" name="alumno_escuela" id="alumno_escuela" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Lugar de trabajo:</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Lugar de Trabajo" name="alumno_lugartrabajo" id="alumno_lugartrabajo" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Fila para el ultimo grado escolar a cursar y correo electronico -->
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Último grado escolar a cursar:</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Último grado escolar a cursar" name="alumno_ultimogrado" id="alumno_ultimogrado" style="text-transform:capitalize">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Correo Electrónico:</label>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <input type="text" class="form-control" placeholder="Correo Electrónico" name="alumno_email" id="alumno_email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.tab-pane Educación y Trabajo -->

                                                <div class="tab-pane" id="tab_4">
                                                    <!-- Fila los select de la encuesta -->
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="encuesta_pregunta1">¿Cómo te enteraste de la escuela?</label>
                                                                <div class="row">
                                                                    <div class="col-xs-6 myerror">
                                                                        <select name="encuesta_pregunta1" id="encuesta_pregunta1" class="form-control" style="width: 100%;">
                                                                            <option value="" selected>[Elegir]</option>
                                                                            <option value="Radio">Radio</option>
                                                                            <option value="Periodico">Periodico</option>
                                                                            <option value="Familiares">Familiares</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="encuesta_pregunta2">¿Por qué quieres estudiar inglés?</label>
                                                                <div class="row">
                                                                    <div class="col-xs-6 myerror">
                                                                        <select name="encuesta_pregunta2" id="encuesta_pregunta2" class="form-control" style="width: 100%;">
                                                                            <option value="" selected>[Elegir]</option>
                                                                            <option value="Escuela">Escuela</option>
                                                                            <option value="Empleo">Empleo</option>
                                                                            <option value="Tiempo Libre">Tiempo Libre</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- /.tab-pane Encuesta -->

                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- End Custom Tabs -->
                                    </div>
                                    <!-- /. col-sm-12 -->
                                </div>
                                <!-- Termina Fila para el TabPanel de Dirección, Telefonos y Otros Datos -->
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

        $('#tipo_vialidad').select2({
            allowClear: true,
            placeholder: '(Valor Opcional)'
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

        $('#encuesta_pregunta1').select2({
            allowClear: true,
            placeholder: '[Elegir]'
        });

        $('#encuesta_pregunta2').select2({
            allowClear: true,
            placeholder: '[Elegir]'
        });

        $("#telefono_casa").inputmask("(999)-999-9999");
        $("#telefono_tutor").inputmask("(999)-999-9999");
        $("#telefono_celular").inputmask("(999)-999-9999");
        $("#telefono_otro").inputmask("(999)-999-9999");
        //email mask
        $("#alumno_email").inputmask({
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

        //Desactivamos los campos que forman parte de la colonia y el codigo postal
        $("#direccion_delegacion").attr('disabled','-1');
        $("#direccion_colonia").attr('disabled','-1');
        $("#nombre_localidad").attr('disabled','-1');
        $("#tipo_asentamiento").attr('disabled','-1');
        $("#nombre_asentamiento").attr('disabled','-1');
        $("#codigo_postal").attr('disabled','-1');

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
                //El usuario selecciono un elemento valido
                $("#direccion_delegacion").removeAttr('disabled');
                $('#direccion_delegacion').empty().change();
                $('#direccion_colonia').empty().change();

                //Consulta AJAX mediante el id del estado seleccionado
                $.getJSON('../../../../nuevo_alumno_delegaciones/'+estado_id, null, function (values) {
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
                $("#direccion_colonia").removeAttr('disabled');


                $.getJSON('../../../../nuevo_alumno_colonias/'+estado_id+'/'+delegacion_id, null, function (values) {
                    $('#direccion_colonia').populateSelect(values);
                });
            }
        });

        //El usuario selecciona una colonia
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

                $.getJSON('../../../../nuevo_alumno_detalles_colonia/'+colonia_id, null, function (data) {
                    $("#nombre_localidad").val(data.cp_ciudad);
                    $("#tipo_asentamiento").val(data.cp_tipoasentamiento);
                    $("#nombre_asentamiento").val(data.cp_asentamiento);
                    $("#codigo_postal").val(data.cp_codigo);
                });

            }
        });

        $("#form_nuevoalumno_datospersonales").validate({
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
            rules:{
                nombre_vialidad          : { required: true },
                numero_exterior          : { required: true },
                tipo_asentamiento        : { required: true },
                nombre_asentamiento      : { required: true },
                codigo_postal            : { required: true },
                nombre_localidad         : { required: true },
                direccion_estado         : { required: true },
                direccion_delegacion     : { required: true },
                direccion_colonia        : { required: true }
            },
            messages :{
                nombre_vialidad:{
                    required: " requerido"
                },
                numero_exterior : {
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
                },
                nombre_localidad    : {
                    required: " requerido"
                },
                direccion_estado  : {
                    required: " requerido"
                },
                direccion_delegacion : {
                    required: " requerido"
                },
                direccion_colonia : {
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
                    title: '¿Desea guardar los datos del alumno?',
                    text: "",
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si'
                }).then(function () {
                    //Obtenemos el estado seleccionado del select correspondiente
                    var entidad_federativa = $("#direccion_estado option:selected").html();
                    //Lo guardamos en el input correspondiente
                    $("#entidad_federativa").val(entidad_federativa);
                    //Obtenemos la delegacion y/o municipio del select correspondiente
                    var delegacion_municipio = $("#direccion_delegacion option:selected").html();
                    //Lo guardamos en el input correspondiente
                    $("#delegacion_municipio").val(delegacion_municipio);

                    //Llamamos a la funcion AJAX para enviar el formulario
                    ajaxSubmit();
                })
            }
        });

        function ajaxSubmit(){
            $.ajax({
                type:"POST",
                url:"{{route('nuevo_alumno_datospersonales_store')}}",
                data: $("#form_nuevoalumno_datospersonales").serialize(),
                dataType : 'json',
                success: function(data){
                    swal({
                        title:"",
                        text: data.message,
                        type: "success",
                        allowOutsideClick: false,
                        confirmButtonText: 'Continuar'
                    }).then(function(){
                        window.location.replace("{{route('nuevo_alumno_index')}}");
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