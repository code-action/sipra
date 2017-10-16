<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsuariocRequest;
use App\Http\Requests\UsuariouRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Bitacora;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $state = $request->get('estado');
      $name = $request->get('nombre');
      $usuarioAc= User::buscar($name,$state);
      return view('usuarios.index',compact('usuarioAc','state','name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariocRequest $request)
    {
      $request['password']=bcrypt($request['password']);
      User::create($request->all());
      Bitacora::bitacora('Nuevo usuario creado: '.$request['name']);
      return redirect('/usuario')->with('mensaje','Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $usuario=User::find($id);
      return view ('usuarios.show',compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $usuario=User::find($id);
      return view ('usuarios.edit',compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validar['nombre']='required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|min:3|max:30';
      $validar['apellido']='required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|min:3|max:30';
      $validar['tipo']='required';
      $validar['password']='confirmed';

      $mensaje['name.required']='El campo usuario es obligatorio';
      $mensaje['name.alpha_num']='El campo usuario requiere solamente números y letras sin espacios';
      $mensaje['name.min']='El campo usuario debe contener 3 caracteres mínimo';
      $mensaje['name.max']='El campo usuario debe contener 15 caracteres máximo';
      $mensaje['name.unique']='Usuario registrado, ingrese otro';

      $mensaje['nombre.required']='El campo nombre es obligatorio';
      $mensaje['nombre.regex']='El campo nombre requiere solamente letras';
      $mensaje['nombre.min']='El campo nombre debe contener 3 caracteres mínimo';
      $mensaje['nombre.max']= 'El campo nombre debe contener 30 caracteres máximo';

      $mensaje['apellido.required']='El campo apellido es obligatorio';
      $mensaje['apellido.regex']='El campo apellido requiere solamente letras';
      $mensaje['apellido.min']='El campo apellido debe contener 3 caracteres mínimo';
      $mensaje['apellido.max']='el campo apellido debe contener 30 caracteres máximo';

      $mensaje['tipo.required']='El campo tipo de usuario es obligatorio';

      $mensaje['email.required']='El campo correo es obligatorio';
      $mensaje['email.email']='El campo correo requiere una estructura propia';
      $mensaje['email.email']='El campo correo requiere una estructura propia';
      $mensaje['email.unique']='Correo registrado, ingrese otro';

      $mensaje['password.confirmed']='La confirmación de contraseña debe ser igual';

      $usuario=User::find($id);
      if($request['name']!=$usuario['name']){
        $validar['name']='required|alpha_num|min:3|max:15|unique:users';
      }else{
        $validar['name']='required|alpha_num|min:3|max:15';
      }
      if($request['email']!=$usuario['email']){
        $validar['email']='required|email|unique:users';
      }else{
        $validar['email']='required|email';
      }
      $this->validate($request,$validar,$mensaje);
      if(!empty($request['password'])){
        $this->validate($request, ['password' => 'min:3'],['password.min'=>'El campo contraseña debe contener 3 caracteres mínimo']);
          $request['password']=bcrypt($request['password']);
      }else{
          $request['password']=$usuario['password'];
      }
      if($request['name']==$usuario['name'] && $request['nombre']==$usuario['nombre'] && $request['apellido']==$usuario['apellido'] && $request['email']==$usuario['email'] && $request['tipo']==$usuario['tipo']){
        if($request['password']==$usuario['password']){
          return redirect('/usuario')->with('mensaje','No hay cambios');
        }
      }else{
      $usuario->fill($request->all());
      $usuario->save();
      }
      Bitacora::bitacora('Usuario editado: '.$request['name']);
      return redirect('/usuario')->with('mensaje','Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $usuario=User::find($id);

      if($usuario['estado']==1){
        $usuario['estado']=0;
        $usuario->save();
        Bitacora::bitacora('Usuario enviado a inactivos: '.$usuario['name']);
        return redirect('/usuario')->with('mensaje','Nuevo registro inactivo');
        }
      else {
        $usuario['estado']=1;
        $usuario->save();
        Bitacora::bitacora('Usuario enviado a activos: '.$usuario['name']);
        return redirect('/usuario?estado=0')->with('mensaje','Nuevo registro activo');
      }
    }
}
