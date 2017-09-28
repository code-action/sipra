<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariocRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
     {
         return [
           'name' => 'required|alpha_num|min:3|max:15|unique:users',
           'nombre' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|min:3|max:30',
           'apellido' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/|min:3|max:30',
           'tipo'=>'required',
       'email' => 'required|email|unique:users',
       'password' => 'confirmed|min:3|required_if:bandera,1',
         ];
     }
     public function messages()
     {
         return [
             'name.required' => 'El campo usuario es obligatorio',
             'name.alpha_num' => 'El campo usuario requiere solamente números y letras sin espacios',
             'name.min'=>'El campo usuario debe contener 3 caracteres mínimo',
             'name.max'=>'El campo usuario debe contener 15 caracteres máximo',
             'name.unique'=>'Usuario registrado, ingrese otro',

             'nombre.required' => 'El campo nombre es obligatorio',
             'nombre.regex' => 'El campo nombre requiere solamente letras',
             'nombre.min'=>'El campo nombre debe contener 3 caracteres mínimo',
             'nombre.max'=>'El campo nombre debe contener 30 caracteres máximo',

             'apellido.required' => 'El campo apellido es obligatorio',
             'apellido.regex' => 'El campo apellido requiere solamente letras',
             'apellido.min'=>'El campo apellido debe contener 3 caracteres mínimo',
             'apellido.max'=>'el campo apellido debe contener 30 caracteres máximo',

             'tipo.required'=>'El campo tipo de usuario es obligatorio',

             'email.required'=>'El campo correo es obligatorio',
             'email.email'=>'El campo correo requiere una estructura propia',
             'email.unique'=>'Correo registrado, ingrese otro',

             'password.required_if'=>'El campo contraseña es obligatorio',
             'password.min'=>'El campo contraseña debe contener 3 caracteres mínimo',
             'password.confirmed'=>'La confirmación de contraseña debe ser igual',


         ];
     }
}
