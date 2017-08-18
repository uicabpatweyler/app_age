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

Route::get('/', function () {
    //return view('welcome');
    return view('mainHome');
});

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
Route::post('eliminarclasificacion/{id}',                            'ClasificacionController@destroy')->name('eliminarclasificacion');
Route::post('guardarclasificacion',                                 'ClasificacionController@store')->name('guardarclasificacion');
Route::post('updateclasificacion/{id}',                             'ClasificacionController@update')->name('updateclasificacion');

/*
 * Configuración | Ciclo Escolar
 */
Route::get('ciclos','CicloEscolarController@index')->name('ciclos');
Route::get('nuevociclo','CicloEscolarController@create')->name('nuevociclo');
Route::get('editarciclo/{id}','CicloEscolarController@edit')->name('editarciclo');
Route::get('selectCiclos','CicloEscolarController@listaCiclosAjax')->name('selectCiclos');
Route::post('guardarciclo', 'CicloEscolarController@store')->name('guardarciclo');
Route::post('cambiarciclo', 'CicloEscolarController@cambiarCicloPredeterminado')->name('cambiarciclo');
Route::post('updateciclo/{id}', 'CicloEscolarController@update')->name('updateciclo');

/*
 * Configuración: Grupos
 */
Route::get('grupos',     'GrupoController@index')->name('grupos');
Route::get('nuevogrupo', 'GrupoController@create')->name('nuevogrupo');
Route::get('listargrupos/{id}', 'GrupoController@listaDeGrupos')->name('listargrupos');
Route::get('listaAjaxClasifPorEscuela/{id}', 'GrupoController@listaAjaxClasifPorEscuela')->name('listaAjaxClasifPorEscuela');
Route::get('editargrupo/{id}', 'GrupoController@edit')->name('editargrupo');
Route::get('mostrargrupo/{id}', 'GrupoController@show')->name('mostrargrupo');

Route::post('guardargrupo',     'GrupoController@store')->name('guardargrupo');
Route::post('updategrupo/{id}', 'GrupoController@update')->name('updategrupo');
Route::post('eliminargrupo/{id}', 'GrupoController@destroy')->name('eliminargrupo');;