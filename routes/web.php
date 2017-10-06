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

/*Route::get('/', function () {
    return view('plantillas.principalc');
});*/
Route::get('/', function () {
    return view('auth/log');
});

Route::resource('loged','LogedController');

Route::resource('usuario','UserController');
Route::resource('carrera','CarreraController');
Route::resource('estudiante','EstudianteController');
Route::resource('bitacora','BitacoraController');
Route::resource('proyecto','ProyectoController');
Route::resource('documento','DocumentoController');
Route::resource('enlace','EnlaceController');
Route::resource('constancia','ConstanciaController');
