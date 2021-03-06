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
Route::get('/primerAdministrador', function () {
  $users=DB::select('select * from users');
  $cuenta= count($users);
  if ($cuenta==0) {
      return view('plantillas.primerUsuario');
  } else {
      return view('auth/log');
  }
});

Route::get('/logout', function () {
  return Redirect('/loged');
});

Route::post('correo','LogedController@correo');
Route::resource('loged','LogedController');

Route::get('/cambiarpassword/er6542kj9p','LogedController@cambio');

Route::group(['middleware'=>'adminedit'], function(){ //ADMINISTRADOR Y EDITOR
  Route::get('/inicio', function () {
      return view('plantillas.inicio');
  });
  Route::match(['get','post'],'/ayudar/{numero}','UnionController@ayuda');
  Route::resource('carrera','CarreraController');
  Route::resource('estudiante','EstudianteController');
  Route::match(['get','post'],'/obtenerhoras/{id}','CarreraController@horas');

  Route::resource('proyecto','ProyectoController');
  Route::match(['get','post'],'/buscarEstudiante/{id}','ProyectoController@estudiante');
  Route::match(['get','post'],'/proyecto/eliminar','ProyectoController@eliminar');
  Route::resource('documento','DocumentoController');
  Route::resource('enlace','EnlaceController');
  Route::resource('constancia','ConstanciaController');
  Route::resource('editor','EditorController');
  Route::resource('union','UnionController');
  Route::get('/vermanual',function(){
      echo "<html style='overflow:hidden;'>
<embed src='/sipra/public/archivos/manual/manual.pdf' width='100%' height='100%'>
      </html>";
    });
});
Route::group(['middleware'=>'admin'], function(){ //SOLO ADMINISTRADOR
  Route::resource('usuario','UserController');
  Route::resource('bitacora','BitacoraController');
});
Route::group(['middleware'=>'estudiante'], function(){ //SOLO ESTUDIANTE
  Route::resource('accesoEstudiante','DocumentoEstudianteController');
  Route::match(['get','post'],'/ver/{id}','DocumentoEstudianteController@verDocumento');
  Route::match(['get','post'],'/ver2/{id}','DocumentoEstudianteController@verConstancia');
    Route::match(['get','post'],'/ayudar2/{numero}','UnionController@ayuda');
});

Route::resource('auxiliar','AuxiliarController');
