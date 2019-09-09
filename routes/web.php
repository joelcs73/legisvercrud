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
    return view('welcome');
});

// Auth::routes();
// Agrego ['register' => false] para deshabilitar que se registren
// Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('','UsuarioController@opcionesmenu');

// Route::get('/menu','UsuarioController@opcionesmenu');
Route::get('/legisladores/','LegisladorController@index');
// Route::get('/licencias','DiputadoController@nombreDiputadosCombo');
Route::get('/licencias','DiputadosLegislaturaController@nombreDiputadosCombo');

Route::get('/legisladores/{idDiputado}','DiputadosLegislaturaController@licencia')->name('diputado.licencia');