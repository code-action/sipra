<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bitacora;
use Auth;

class EditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $tipo=$request->tipo;
      return view('proyectos.vistas',compact('tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      return view ('usuarios.editeditor',compact('usuario'));
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
      $mensaje['password.min']='El campo contraseña debe contener 3 caracteres mínimo';

      $usuario=User::find($id);
      $v=0;
      if($request['name']!=$usuario['name']){
        $v=1;
        $validar['name']='required|alpha_num|min:3|max:15|unique:users';
      }
      if($request['nombre']!=$usuario['nombre']){
        $v=1;
        $validar['nombre']='required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|min:3|max:30';
      }
      if($request['apellido']!=$usuario['apellido']){
        $v=1;
        $validar['apellido']='required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|min:3|max:30';
      }
      if($request['tipo']!=$usuario['tipo']){
        $v=1;
        $validar['apellido']='required';
      }
      if($request['email']!=$usuario['email']){
        $v=1;
        $validar['email']='required|email|unique:users';
      }
      if (trim($request['password'])==''){
       $pw=$usuario['password'];
     }else{
       $v=1;
       $pw=bcrypt($request['password']);
       $validar['password']= ' min:3 |required_if:bandera,1 |confirmed';
     }

      if($v==0){
          return redirect('/usuario')->with('mensaje','No hay cambios');
      }else{
        $this->validate($request,$validar,$mensaje);
        $anterior=$usuario->password;
        $request['password']=$pw;
        $usuario->fill($request->all());
        $usuario->save();
      if($request->password!=$anterior && Auth::user()->id==$usuario->id){
        return redirect('/loged');
      }
      }
      Bitacora::bitacora('Usuario editado: '.$request['name']);
      return redirect('/inicio')->with('mensaje','Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
