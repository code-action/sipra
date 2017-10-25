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
  $users=DB::select('select * from users');
  $cuenta= count($users);
  if ($cuenta==0) {
      return view('plantillas.primerUsuario');
  } else {
      return view('auth/log');
  }
});

Route::get('/inicio', function () {
    return view('plantillas.inicio');
});

Route::get('/logout', function () {
  return Redirect('/loged');
});

Route::post('correo','LogedController@correo');
Route::resource('loged','LogedController');


Route::group(['middleware'=>'adminedit'], function(){ //ADMINISTRADOR Y EDITOR
  Route::resource('carrera','CarreraController');
  Route::resource('estudiante','EstudianteController');

  Route::resource('proyecto','ProyectoController');
  Route::resource('documento','DocumentoController');
  Route::resource('enlace','EnlaceController');
  Route::resource('constancia','ConstanciaController');
});
Route::group(['middleware'=>'admin'], function(){ //SOLO ADMINISTRADOR
  Route::resource('usuario','UserController');
    Route::resource('bitacora','BitacoraController');
});
