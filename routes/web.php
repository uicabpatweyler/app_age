<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/',     'HomeController@index')->name('home');

//Route::get('/', function () { return view('mainHome'); });

/*
 * Alumnos: Nueva Inscripcion
 */

Route::get('nueva_inscripcion',    'Alumno\InscripcionController@index')->name('nueva_inscripcion'); //eliminar
Route::post('guardar_inscripcion', 'Alumno\InscripcionController@store')->name('guardar_inscripcion');//eliminar
Route::post('guardar_datos_tutor', 'Alumno\InscripcionController@storeDatosTutor')->name('guardar_datos_tutor');//eliminar
Route::get('datos_tutor/{id_alumno}/{id_ciclo}/{id_direccion}','Alumno\InscripcionController@show')->name('datos_tutor'); //eliminar

Route::get('delegaciones_por_estado/{id_estado}',                    'EdosDelegCPController@delegacionesPorEstado')->name('delegaciones_por_estado');
Route::get('colonias_por_delegacion/{id_estado}/{id_delegacion}',    'EdosDelegCPController@coloniasPorDelegacion')->name('colonias_por_delegacion');
Route::get('detalle_colonia/{id_colonia}',                           'EdosDelegCPController@detalleColonia')->name('detalle_colonia');

Route::get('nuevo_alumno_index',                      'AlumnoController@index')->name('nuevo_alumno_index');
Route::get('nuevo_alumno_create/{curp}',              'AlumnoController@create')->name('nuevo_alumno_create');
Route::post('nuevo_alumno_store',                     'AlumnoController@store')->name('nuevo_alumno_store');
Route::get('alumno_parentesco/{id_alumno}/{ap}/{am}/{ciclo}/{escuela}', 'AlumnoController@auxiliar1')->name('alumno_parentesco');
route::get('test/{id_alumno}/{ap}/{am}',              'AlumnoController@test');
Route::post('verificar_curp_alumno',                  'AlumnoController@verificarCurpDelAlumno')->name('verificar_curp_alumno');

Route::get('nuevo_alumno_datospersonales/{id_alumno}/{id_ciclo}/{id_escuela}', 'AlumnoDatosPersonalesController@create')->name('nuevo_alumno_datospersonales');
Route::get('nuevo_alumno_delegaciones/{id_estado}',                            'AlumnoDatosPersonalesController@delegaciones')->name('nuevo_alumno_delegaciones');
Route::get('nuevo_alumno_colonias/{id_estado}/{id_delegacion}',                'AlumnoDatosPersonalesController@colonias')->name('nuevo_alumno_colonias');
Route::get('nuevo_alumno_detalles_colonia/{id_colonia}',                       'AlumnoDatosPersonalesController@detallesDeLaColonia')->name('nuevo_alumno_detalles_colonia');
Route::post('nuevo_alumno_datospersonales_store',                              'AlumnoDatosPersonalesController@store')->name('nuevo_alumno_datospersonales_store');
Route::post('nuevo_alumno_datospersonales_store2',                              'AlumnoDatosPersonalesController@store2')->name('nuevo_alumno_datospersonales_store2');
Route::get('utilizar_datos_personales_alumno/{id_datospersonales}/{id_alumno_a}/{id_alumno_b}/{id_ciclo}/{id_escuela}', 'AlumnoDatosPersonalesController@utilizarDatosPersonales')->name('utilizar_datos_personales_alumno');

Route::get('editar_alumno/{escuela}/{ciclo}/{alumno}', 'AlumnoController@edit')->name('editar_alumno');
Route::post('update_alumno/{id}', 'AlumnoController@update')->name('update_alumno');


Route::get('nuevo_tutor_create',                             'TutorController@create')->name('nuevo_tutor_create');
Route::post('nuevo_tutor_store',                             'TutorController@store')->name('nuevo_tutor_store');
Route::get('nuevo_tutor_elegirdireccion/{tutor_id}',         'TutorController@datosInscripcionAlumno')->name('nuevo_tutor_elegirdireccion');
Route::get('verificar_datosTutor/{nombre}/{ap}/{am}/{flag}', 'TutorController@verificaNombreApellidosTutor');

Route::get('nuevo_tutor_datospersonales/{tutor_id}/{ciclo_id}/{dp}', 'TutorDatosPersonalesController@create')->name('nuevo_tutor_datospersonales');
Route::post('nuevo_tutor_datospersonales_store', 'TutorDatosPersonalesController@store')->name('nuevo_tutor_datospersonales_store');

Route::get('asignar_tutor_elegirtutor', 'TutorAlumnoController@index')->name('asignar_tutor_elegirtutor');
Route::get('asignar_tutor_elegiralumno/{tutor_id}/{ciclo_id}', 'TutorAlumnoController@create')->name('asignar_tutor_elegiralumno');
Route::post('asignar_tutor_alumno_store', 'TutorAlumnoController@store')->name('asignar_tutor_alumno_store');

Route::get('grupo_alumno_elegiralumno', 'GrupoAlumnoController@index')->name('grupo_alumno_elegiralumno');
Route::get('grupo_alumno_elegirgrupo/{escuela}/{ciclo}/{alumno}', 'GrupoAlumnoController@create')->name('grupo_alumno_elegirgrupo');
Route::post('grupo_alumno_store','GrupoAlumnoController@store')->name('grupo_alumno_store');
Route::get('grupo_alumno_cambiogrupo', 'GrupoAlumnoController@cambioDeGrupo')->name('grupo_alumno_cambiogrupo');
Route::post('grupo_alumno_update', 'GrupoAlumnoController@update')->name('grupo_alumno_update');

Route::get('pago_inscripcion_create/{id_inscripcion}','PagoCuotaInscripcionController@create')->name('pago_inscripcion_create');
Route::post('pago_inscripcion_store',                 'PagoCuotaInscripcionController@store')->name('pago_inscripcion_store');

Route::get('pago_colegiatura_index','PagoCuotaColegiaturaController@index')->name('pago_colegiatura_index');
Route::get('pago_colegiatura_create/{escuela}/{ciclo}/{grupo}/{alumno}', 'PagoCuotaColegiaturaController@create')->name('pago_colegiatura_create');
Route::post('pago_colegiatura_store',  'PagoCuotaColegiaturaController@store')->name('pago_colegiatura_store');

Route::get('pdf_ReciboInscripcion/{id_pago}', 'Pdf\ReciboInscripcionController@pdf_ReciboInscripcion')->name('pdf_ReciboInscripcion');
Route::get('pdf_ReciboColegiatura/{id_pago}', 'Pdf\ReciboColegiaturaController@pdf_ReciboColegiatura')->name('pdf_ReciboColegiatura');


Route::get('nuevo_producto_create', 'ProductoController@create')->name('nuevo_producto_create');
Route::get('productos_index', 'ProductoController@index')->name('productos_index');
Route::post('producto_asignar_precio', 'ProductoPrecioController@asignarPrecio')->name('producto_asignar_precio');
Route::post('nuevo_producto_store', 'ProductoController@store')->name('nuevo_producto_store');
Route::get('lista_categorias/{ciclo_id}/{escuela_id}', 'CategoriaProductoController@listaCategorias')->name('lista_categorias');
Route::get('lista_subcategorias/{categoria_id}', 'ClasificacionProductoController@listaSubCategorias')->name('lista_subcategorias');
Route::get('lista_clasificaciones/{subcategoria_id}', 'ClasificacionProductoController@listaClasificaciones')->name('lista_clasificaciones');

Route::get('nuevo_inventario_create', 'EntradaProductoController@create')->name('nuevo_inventario_create');
Route::post('nuevo_inventario_store', 'EntradaProductoController@store')->name('nuevo_inventario_store');
Route::get('items_inventario_create', 'ItemInventarioController@index');
Route::get('lista_productos_categorias/{categoria_id}','ItemInventarioController@listaProductosCategorias')->name('lista_productos_categorias');
/*
 * Impresiones | Hoja de Inscripción
 */
Route::get('impr_hojainscrip_index','ImprHojaInscripcionController@index')->name('impr_hojainscrip_index');
Route::get('impr_rec_inscrip_index', 'ImprReciboInscripcionController@index')->name('impr_rec_inscrip_index');
Route::get('impr_rec_coleg_index', 'ImprReciboColegiaturaController@index')->name('impr_rec_coleg_index');
Route::get('impr_rec_venta_index', 'ImprReciboVentaController@index')->name('impr_rec_venta_index');
Route::get('impr_lista_asist_index', 'ListaAsistenciaController@index')->name('impr_lista_asist_index');

Route::get('reporte_pago_coleg_index','ReportePagoColegiaturaController@index')->name('reporte_pago_coleg_index');
Route::get('pagos_colegitura_por_dia/{fecha}','ReportePagoColegiaturaController@pagosColegiaturaPorDia')->name('pagos_colegitura_por_dia');
Route::get('reporte_venta_diario', 'ReporteVentaController@reporteVentaPorDia')->name('reporte_venta_diario');

Route::get('reporte_pago_inscrip_index','ReportePagoInscripcionController@index')->name('reporte_pago_inscrip_index');
Route::get('pagos_inscripcion_por_dia/{fecha}','ReportePagoInscripcionController@pagosInscripcionPorDia')->name('pagos_inscripcion_por_dia');
Route::get('kardex_productos_index','Pdf\KardexProducto@index')->name('kardex_productos_index');

Route::get('pdf_HojaInscripcionAlumno/{id_ga}','Pdf\HojaInscripcionController@pdf_HojaInscrpcionPorAlumno')->name('pdf_HojaInscripcionAlumno');
Route::get('pdf_ReporteDiarioColegiatura/{fecha}', 'Pdf\ReporteDiarioColegiaturaController@pdf_ReporteDiarioColegiatura')->name('pdf_ReporteDiarioColegiatura');
Route::get('pdf_ReporteDiarioInscripcion/{fecha}', 'Pdf\ReporteDiarioInscripcionController@pdf_ReporteDiarioInscripcion')->name('pdf_ReporteDiarioInscripcion');
Route::get('pdf_KardexProducto/{categoria_id}','Pdf\KardexProducto@pdf_KardexProducto')->name('pdf_KardexProducto');
Route::get('pdf_ReciboSalidaVenta/{id_salida}', 'Pdf\ReciboSalidaVenta@pdf_ReciboSalidaVenta')->name('pdf_ReciboSalidaVenta');
Route::get('pdf_ListaDeAsistencia/{grupo}/{mes_anio}/{maestro}/{fecha}','Pdf\ListaDeAsistencia@pdf_ListaDeAsistencia')->name('pdf_ListaDeAsistencia');
Route::get('pdf_ReporteDiarioVentas/{fecha}','Pdf\ReporteDiarioVentasController@pdf_ReporteDiarioVentas')->name('pdf_ReporteDiarioVentas');
Route::get('pdf_ReporteDeudoresPorGrupo/{id_ciclo}/{id_grupo}', 'Pdf\ReporteDeudoresPorGrupoController@pdf_ReporteDeudoresPorGrupo')->name('pdf_ReporteDeudoresPorGrupo');
Route::get('pdf_DeudoresGrupoMes/{mes_reporte}', 'Pdf\ReporteDeudorGrupoMesController@pdf_DeudoresGrupoMes')->name('pdf_DeudoresGrupoMes');

Route::get('alumnos_deudores_index', 'ReporteAlumnoDeudorController@index')->name('alumnos_deudores_index');

Route::get('dataTableAlumnos', 'NuevaVentaController@dataTableAlumnos')->name('dataTableAlumnos');

//Esta pendiente por terminar la cancelacion de la venta 13Noviembre2018
Route::get('nueva_venta', 'NuevaVentaController@index')->name('nueva_venta');
Route::get('cancelar_venta_index', 'NuevaVentaController@cancelarVentaIndex')->name('cancelar_venta_index');
Route::get('cancelar_venta_edit/{id}', 'NuevaVentaController@edit')->name('cancelar_venta_edit');
Route::post('salida_producto_store', 'NuevaVentaController@store')->name('salida_producto_store');


/*
 * Configuración | Empresa
 */
Route::get('empresa', 'EmpresaController@index')->name('empresa');
Route::get('nuevaempresa', 'EmpresaController@create')->name('nuevaempresa');
Route::post('guardarempresa', 'EmpresaController@store')->name('guardarempresa');
Route::post('updateempresa/{id}', 'EmpresaController@update')->name('updateempresa');
Route::get('editarempresa/{id}', 'EmpresaController@edit')->name('editarempresa');

/*
 * Configuración | Niveles
 */
Route::get('niveles', 'NivelController@index')->name('niveles');
Route::get('nuevonivel','NivelController@create')->name('nuevonivel');

/*
 * Configuración | Escuelas
 */
Route::get('escuelas',               'EscuelaController@index')->name('escuelas');
Route::get('nuevaescuela',           'EscuelaController@create')->name('nuevaescuela');
Route::get('editarescuela/{id}',     'EscuelaController@edit')->name('editarescuela');
Route::post('guardarescuela',        'EscuelaController@store')->name('guardarescuela');
Route::post('updateescuela/{id}',    'EscuelaController@update')->name('updateescuela');
Route::get('eliminarescuela/{id}',   'EscuelaController@destroy')->name('eliminarescuela');
Route::get('listaAjaxNiveles/{id}',  'EscuelaController@listaAjaxNiveles')->name('listaAjaxNiveles');
Route::get('listaAjaxServicios/{id}','EscuelaController@listaAjaxServicios')->name('listaAjaxServicios');

/*
 * Configuracion | Clasificacion
 */
Route::get('clasificaciones',                                       'ClasificacionController@index')->name('clasificaciones');
Route::get('nuevaclasificacion',                                    'ClasificacionController@create')->name('nuevaclasificacion');
Route::get('clasificacionesPorEscuela/{id}',                        'ClasificacionController@filtrarClasificaciones')->name('clasificacionesPorEscuela');
Route::get('editarclasificacion/{id_clasificacion}/{id_escuela}',   'ClasificacionController@edit')->name('editarclasificacion');
Route::get('mostrarclasificacion/{id_clasificacion}/{id_escuela}',  'ClasificacionController@show')->name('mostrarclasificacion');
Route::get('eliminarclasificacion/{id}',                            'ClasificacionController@destroy')->name('eliminarclasificacion');
Route::post('guardarclasificacion',                                 'ClasificacionController@store')->name('guardarclasificacion');
Route::post('updateclasificacion/{id}',                             'ClasificacionController@update')->name('updateclasificacion');

/*
 * Configuración | Ciclo Escolar
 */
Route::get('ciclos',             'CicloEscolarController@index')->name('ciclos');
Route::get('nuevociclo',         'CicloEscolarController@create')->name('nuevociclo');
Route::get('editarciclo/{id}',   'CicloEscolarController@edit')->name('editarciclo');
Route::get('selectCiclos',       'CicloEscolarController@listaCiclosAjax')->name('selectCiclos');
Route::get('eliminarciclo/{id}', 'CicloEscolarController@destroy')->name('eliminarciclo');
Route::post('guardarciclo',      'CicloEscolarController@store')->name('guardarciclo');
Route::post('cambiarciclo',      'CicloEscolarController@cambiarCicloPredeterminado')->name('cambiarciclo');
Route::post('updateciclo/{id}',  'CicloEscolarController@update')->name('updateciclo');

/*
 * Configuración: Grupos
 */
Route::get('grupos',                         'GrupoController@index')->name('grupos');
Route::get('nuevogrupo',                     'GrupoController@create')->name('nuevogrupo');
Route::get('listargrupos/{id}',              'GrupoController@listaDeGrupos')->name('listargrupos');
Route::get('listaAjaxClasifPorEscuela/{id}', 'GrupoController@listaAjaxClasifPorEscuela')->name('listaAjaxClasifPorEscuela');
Route::get('editargrupo/{id}',               'GrupoController@edit')->name('editargrupo');
Route::get('mostrargrupo/{id}',              'GrupoController@show')->name('mostrargrupo');
Route::get('eliminargrupo/{id}',             'GrupoController@destroy')->name('eliminargrupo');
Route::post('guardargrupo',                  'GrupoController@store')->name('guardargrupo');
Route::post('updategrupo/{id}',              'GrupoController@update')->name('updategrupo');

//Seleccionar cuota de inscripcion y colegiatura
Route::get('seleccionar_cdi/{id_grupo}', 'GrupoController@seleccionarCDI')->name('seleccionar_cdi');
Route::get('seleccionar_cdc/{id_grupo}', 'GrupoController@seleccionarCDC')->name('seleccionar_cdc');

/*
 * Configuracion: Cuotas de Inscripción
 */
//CDI = Cuota De Inscripcion
Route::get('cuotasdeinscripcion',        'CuotaInscripcionController@index')->name('cuotasdeinscripcion');
Route::get('nueva_cdi',                  'CuotaInscripcionController@create')->name('nueva_cdi');
Route::get('lista_cdi/{id}',             'CuotaInscripcionController@listaCdi')->name('lista_cdi');
Route::get('editar_cdi/{id_cdi}',        'CuotaInscripcionController@edit')->name('editar_cdi');
Route::get('mostrarcdi/{id_cdi}',        'CuotaInscripcionController@show')->name('mostrar_cdi');
Route::get('eliminarcdi/{id_cdi}',       'CuotaInscripcionController@destroy')->name('eliminarcdi');
Route::post('guardarcuota_cdi',          'CuotaInscripcionController@store')->name('guardarcuota_cdi');
Route::post('updatecdi/{id_cdi}',        'CuotaInscripcionController@update')->name('updatecdi');


/*
 * Configuración: Cuotas de Colegiatura
 */
//CDC = Cuota De Colegiatura
Route::get('cuotasdecolegiatura',     'CuotaColegiaturaController@index')->name('cuotasdecolegiatura');
Route::get('nueva_cdc',               'CuotaColegiaturaController@create')->name('nueva_cdc');
Route::get('lista_cdc/{id}',          'CuotaColegiaturaController@listaCdc')->name('lista_cdc');
Route::get('asignarmesesdepago/{id}', 'CuotaColegiaturaController@asignarMesesDePago')->name('asignarmesesdepago');
Route::get('editar_cdc/{id_cdc}',     'CuotaColegiaturaController@edit')->name('editar_cdc');
Route::get('eliminarcdc/{id_cdc}',    'CuotaColegiaturaController@destroy')->name('eliminar_cdc');
Route::post('guardarcuota_cdc',       'CuotaColegiaturaController@store')->name('guardarcuota_cdc');
Route::post('update_cdc/{id_cdc}',    'CuotaColegiaturaController@update')->name('update_cdc');

/*
 * Entidad Compuesta para las relaciones entre Grupos y Cuotas de Inscripción
 */
Route::post('guardar_grupo_cdi', 'GrupoCdiController@store')->name('guardar_grupo_cdi');

/*
 * Entidad Compuesta para las relaciones entre Grupos y Cuotas de Colegiatura
 */
Route::post('guardar_grupo_cdc', 'GrupoCdcController@store')->name('guardar_grupo_cdc');

/*
 * Meses de Pago de la Colegiatura
 */
Route::post('guardarmespagocolegiatura', 'MesPagoColegiaturaController@store')->name('guardarmespagocolegiatura');

