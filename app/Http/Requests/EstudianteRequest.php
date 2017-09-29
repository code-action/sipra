<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteRequest extends FormRequest
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
            'carne'=>'required|min:7|max:7|unique:estudiantes',
            'nombre'=>'required|min:3|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            'apellido'=>'required|min:3|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/',
            //'f_carrera'=>'integer|required|not_in:0',
        ];
    }

    public function messages(){
        return [
          'carne.required'=>'El campo carné es obligatorio',
          'carne.min'=>'El campo carné debe contener 7 caracteres mínimo',
          'carne.max'=>'El campo carné debe contener 7 caracteres máximo',
          'carne.unique'=>'Carné registrado, ingrese otro',

          'nombre.required'=>'El campo nombre es obligatorio',
          'nombre.min'=>'El campo nombre debe contener 3 caracteres mínimo',
          'nombre.regex'=>'El campo nombre requiere solamente letras',

          'apellido.required'=>'El campo apellido es obligatorio',
          'apellido.min'=>'El campo apellido debe contener 3 caracteres mínimo',
          'apellido.regex'=>'El campo apellido requiere solamente letras',

          //'f_carrera.required'=>'El campo carrera es obligatorio',
          //'f_carrera.not_in'=>'Seleccione una opción válida',
        ];
    }
}
