<?php

use Illuminate\Http\Request;
use \App\Http\Controllers\DiputadosLegislaturaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('areas','AreaController');
Route::resource('diputados','DiputadoController');
Route::resource('distritos','DistritoController');
Route::resource('comisiones','ComisionController');
Route::resource('partidospoliticos','PartidoPoliticoController');
Route::resource('legislaturas','LegislaturaController');
Route::resource('diputadoslegislatura','DiputadosLegislaturaController');

Route::get('diputadoslegislatura/{numleg}', function ($numleg){
    DiputadosLegislaturaController::show($numleg);
});

Route::get('mesadirectiva',function (){
    $oDl = new DiputadosLegislaturaController();
    $oDl->mesaDirectiva($oDl->ultimaLegislatura());
});

Route::get('mesadirectiva/{numleg}',function ($numleg){
    $oDl = new DiputadosLegislaturaController();
    $oDl->mesaDirectiva($numleg);
});
