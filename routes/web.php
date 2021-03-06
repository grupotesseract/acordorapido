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

Route::get('dashboard', 'HomeController@dashboard');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    //adminlte_routes
});

Route::resource('avisos', AvisosController::class);
Route::resource('alunos', ClientesController::class);
Route::resource('escolas', EmpresasController::class);
Route::get('titulos/modulo/{estado}', 'TitulosController@showModulo');
Route::resource('titulos', TitulosController::class);
Route::resource('avisomodelos', ModeloAvisosController::class);

Route::get('avisospendentes', 'AvisosController@pendentes');

Route::get('importacao/{id}/titulos', 'TitulosController@titulos');
Route::get('importacao/{estado}', 'TitulosController@importacao');
Route::post('importa/{estado}', 'TitulosController@importa');

Route::post('sms', 'AvisosController@enviarAviso');
Route::post('envialote', 'AvisosController@enviarLoteAviso');

Route::get('avisos/sms/{aviso_id}', 'AvisosController@enviaSMS');
Route::post('avisos/ligacao/', 'AvisosController@salvaLigacao');



