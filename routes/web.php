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
Route::get('empresa', 'EmpresaController@index')->name('nuevaempresa');

/*
 * Configuración | Niveles
 */
Route::get('niveles', 'NivelController@index')->name('niveles');
Route::get('nuevonivel','NivelController@create')->name('nuevonivel');

/*
 * Configuración | Escuelas
 */
Route::get('nuevaescuela','EscuelaController@create')->name('nuevaescuela');

/*
 * Configuracion | Clasificacion
 */
Route::get('nuevaclasificacion', 'ClasificacionController@create')->name('nuevaclasificacion');

/*
 * Configuración | Ciclo Escolar
 */
Route::get('nuevociclo','CicloEscolarController@create')->name('nuevociclo');