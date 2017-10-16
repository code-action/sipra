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
    return view('auth/log');
});

Route::get('/inicio', function () {
    return view('plantillas.inicio');
});

Route::get('/logout', function () {
  Auth::logout();
  return Redirect('/');
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

Route::group(['middleware'=>'adminedit'], function(){ //ADMINISTRADOR Y EDITOR
});
Route::group(['middleware'=>'admin'], function(){ //SOLO ADMINISTRADOR
});
