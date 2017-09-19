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
 * Alumnos: Inscripcion
 */
Route::get('inscripcion_paso1',                   'Alumno\InscripcionController@inscripcion_paso1')->name('inscripcion_paso1');
Route::post('inscripcion_paso2',                  'Alumno\InscripcionController@inscripcion_paso2')->name('inscripcion_paso2');
Route::get('delegaciones_por_estado/{id_estado}', 'Alumno\InscripcionController@delegacionesPorEstado')->name('delegaciones_por_estado');
Route::get('colonias_por_delegacion/{id_estado}/{id_delegacion}', 'Alumno\InscripcionController@coloniasPorDelegacion')->name('colonias_por_delegacion');
Route::get('detalle_colonia/{id_colonia}',        'Alumno\InscripcionController@detalleColonia')->name('detalle_colonia');


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

