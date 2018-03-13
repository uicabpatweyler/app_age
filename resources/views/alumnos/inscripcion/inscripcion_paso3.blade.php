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
                <form action="" role="form" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id_dirección" id="id_direccion" value="{{$direccion->id}}">
                    
                    <div class="box box-success">
                        <!-- box-header -->
                        <div class="box-header with-border">
                            <h3 class="box-title"> Datos del tutor</h3><small>&nbsp;&nbsp;(Los campos marcados con (*) son obligatorios)</small>
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
                                        <label for="tutor_nombre">Apellidos:</label>
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
                                        <label for="tutor_nombre">Correo Electrónico:</label>
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

                                                <div class="row">
                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-danger btn-xs"  id="boox_tool_cancel" data-toggle="tooltip" title="Cancelar" disabled ><i class="fa fa-undo" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-success btn-xs" id="boox_tool_editar_direccion" data-toggle="tooltip" title="Editar dirección"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-primary btn-xs" id="boox_tool_save_update" data-toggle="tooltip" title="Guardar/Actualizar" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-warning btn-xs" id="boox_tool_nueva_direccion" data-toggle="tooltip" title="Nueva dirección" style="margin-right: 10px;"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>



                                                <!-- Inicia fila: tipo de vialidad, nombre de vialidad, num. ext. y num int. -->
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">Tipo de Vialidad</label>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <select name="tipo_vialidad" id="tipo_vialidad" class="form-control" style="width: 100%;" disabled>
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
                                                                    <input type="text" class="form-control" value="{{$direccion->nombre_vialidad}}" placeholder="Nombre de Vialidad (*)" id="nombre_vialidad" name="nombre_vialidad" style="text-transform:capitalize" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="numero_exterior">Num. Ext.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->numero_exterior}}" placeholder="Num. Ext. (*)" id="numero_exterior" name="numero_exterior" style="text-transform:capitalize" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">Num. Int.</label>
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <input type="text" class="form-control" value="{{$direccion->numero_interior}}" placeholder="Num. Int." id="numero_interior" style="text-transform:capitalize" name="numero_interior" disabled>
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
                                                                    <input type="text" class="form-control" value="{{$direccion->entre_calles}}" placeholder="Entre Calles" id="entre_calles" name="entre_calles" style="text-transform:capitalize" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="referencias_adicionales">Referencias Adicionales</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->referencias_adicionales}}" placeholder="Referencias Adicionales" id="referencias_adicionales" name="referencias_adicionales" style="text-transform:capitalize" disabled>
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
                                                            <label for="entidad_federativa">Estado (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="entidad_federativa" id="entidad_federativa" class="form-control" style="width: 100%;" disabled>
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
                                                            <label for="delegacion_municipio">Deleg/Munic. (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="delegacion_municipio" id="delegacion_municipio" class="form-control" style="width: 100%;" required disabled>
                                                                        <option value="" selected>[Elegir Deleg/Munic.]</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="select_colonia">Colonia (*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <select name="select_colonia" id="select_colonia" class="form-control" style="width: 100%;" required disabled>
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
                                                                    <input type="text" class="form-control" value="{{$direccion->nombre_localidad}}" name="nombre_localidad" id="nombre_localidad" style="text-transform:capitalize" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="tipo_asentamiento">Tipo Asentamiento(*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->tipo_asentamiento}}" name="tipo_asentamiento" id="tipo_asentamiento" style="text-transform:capitalize" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="nombre_asentamiento">Nombre Asentamiento(*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->nombre_asentamiento}}" name="nombre_asentamiento" id="nombre_asentamiento" style="text-transform:capitalize" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="codigo_postal">C.P.(*)</label>
                                                            <div class="row">
                                                                <div class="col-xs-12 myerror">
                                                                    <input type="text" class="form-control" value="{{$direccion->codigo_postal}}" placeholder="00000" name="codigo_postal" id="codigo_postal" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Termina fila: Localidad, Tipo de Asentamiento, Nombre de Asentamiento y Colonia -->
                                                
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="tab_2">Telefonos del cliente</div>
                                            <div role="tabpanel" class="tab-pane" id="tab_3">Lugar de trabajo</div>
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

        $('#entidad_federativa').select2({
            allowClear: true,
            placeholder: '[Elegir estado]'
        });

        $('#delegacion_municipio').select2({
            allowClear: true,
            placeholder: '[Elegir Deleg/Munic.]'
        });

        $('#select_colonia').select2({
            allowClear: true,
            placeholder: '[Elegir Colonia]'
        });

        var arregloControles = [
            '#tipo_vialidad',
            '#nombre_vialidad',
            '#numero_exterior',
            '#numero_interior',
            '#nombre_localidad',
            '#tipo_asentamiento',
            '#nombre_asentamiento',
            '#codigo_postal',
            '#entre_calles',
            '#referencias_adicionales',
            '#entidad_federativa'
        ];

        /*
        * El usuario presiona el boton para Editar los datos de la direccion
        */
        $('#boox_tool_editar_direccion').click(function () {

            swal({
                title: 'Atención',
                text: '¿Desea editar la dirección actual?',
                type: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Si'
            }).then(function () {

                flag_edit = true;

                //1: Activamos los controles para editar la dirección actual
                enableDisableAddress(false);

                //2: Activamos el boton de Cancelar
                $('#boox_tool_cancel').prop('disabled', false);

                //3: Desactivamos el boton de Editar y Nueva Dirección
                $('#boox_tool_editar_direccion').prop('disabled', true);
                $('#boox_tool_nueva_direccion').prop('disabled', true);
                //Activamos el boton para guardar los cambios
                $('#boox_tool_save_update').prop('disabled', false);

                console.log(flag_edit);

            }).catch(swal.noop);


        });

        /*
         * El usuario presiona el boton Cancelar
         */
        $('#boox_tool_cancel').click(function () {

            if(flag_edit===true){
                swal({
                    title: 'Atención',
                    text: '¿Desea cancelar la edición de la dirección actual?',
                    type: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si'
                }).then(function () {

                    flag_edit = false;

                    //1: Limpiamos y asignamos los valores originales a los input correspondientes
                    test();

                    //2: Desactivamos los controles para editar la dirección actual
                    enableDisableAddress(true);

                    //Limpiamos los select de Delegacion y Colonia
                    $('#delegacion_municipio').empty().change();
                    //$('#select_colonia').empty().change();

                    //Desactivamos los select de Delegacion y Colonia
                    $('#delegacion_municipio').prop('disabled', true);
                    //$('#select_colonia').prop('disabled', true);

                    //3: Desactivamos el boton de Cancelar y el de Guardar/Actualizar
                    $('#boox_tool_cancel').prop('disabled', true);
                    $('#boox_tool_save_update').prop('disabled', true);

                    //4: Activamos los botones de Editar y Nueva Dirección
                    $('#boox_tool_editar_direccion').prop('disabled', false);
                    $('#boox_tool_nueva_direccion').prop('disabled', false);

                    console.log(flag_edit);

                }).catch(swal.noop);

            }

        });

        function test(){

            //https://select2.org/programmatic-control/add-select-clear-items
            $('#tipo_vialidad').val('{{$direccion->tipo_vialidad}}'); //Seleccionar la opcion con la que se cargo el formulario
            $('#tipo_vialidad').trigger('change'); // Notify any JS components that the value changed

            $('#entidad_federativa').val(null).trigger('change');

            $('#nombre_vialidad').val('{{$direccion->nombre_vialidad}}');
            $('#numero_exterior').val('{{$direccion->numero_exterior}}');
            $('#numero_interior').val('{{$direccion->numero_interior}}');
            $('#entre_calles').val('{{$direccion->entre_calles}}');
            $('#referencias_adicionales').val('{{$direccion->referencias_adicionales}}');
            $('#nombre_localidad').val('{{$direccion->nombre_localidad}}');
            $('#tipo_asentamiento').val('{{$direccion->tipo_asentamiento}}');
            $('#nombre_asentamiento').val('{{$direccion->nombre_asentamiento}}');
            $('#codigo_postal').val('{{$direccion->codigo_postal}}');
        }

        /*
        * Funcion para activar o desactivar los controles del formulario de la sección de
        * la direccion del tutor (la direccion es la misma que se registra al momento de inscribir a
        * un nuevo alumno.
        */
        function enableDisableAddress(value){
            $.each(arregloControles, function(ind,elem){
                $(elem).prop('disabled', value);
            });
        }

        //El usuaro selecciona un estado
        $('#entidad_federativa').change(function () {

            var estado_id = $(this).val();
            //El usuario no selecciono algun elemento
            if(estado_id===null)
            {

            }
            //El usuario elimina la seleccion del select
            else if(estado_id==="")
            {
                //Eliminamos el contenido de los select correspondientes
                $('#delegacion_municipio').empty().change();
                $('#select_colonia').empty().change();
            }
            else
            {
                //El usuario selecciono un elemento valido
                $("#delegacion_municipio").removeAttr('disabled');
                $('#delegacion_municipio').empty().change();
                $('#select_colonia').empty().change();

                //Consulta AJAX mediante el id del estado seleccionado
                $.getJSON('../../../../delegaciones_por_estado/'+estado_id, null, function (values) {
                    $('#delegacion_municipio').populateSelect(values);
                });
            }

        });

        //El usuario selecciona una delegacion
        $('#delegacion_municipio').change(function () {
            //El id del elemento seleccionado
            var estado_id = $("#entidad_federativa").val();
            var delegacion_id = $(this).val();

            if(delegacion_id===null)
            {

            }
            else if(delegacion_id === "" )
            {
                $('#select_colonia').empty().change();
            }
            else if(estado_id==="")
            {

            }
            else
            {
                $("#select_colonia").removeAttr('disabled');

                $.getJSON('../../../../colonias_por_delegacion/'+estado_id+'/'+delegacion_id, null, function (values) {
                    $('#select_colonia').populateSelect(values);
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


    });
</script>
@endsection