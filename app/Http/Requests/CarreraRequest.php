<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarreraRequest extends FormRequest
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
  'codigo'=>'required|min:6|max:6|unique:carreras',
  'nombre'=>'required|min:8|unique:carreras',
  'horas'=>'required',
];
}
  public function messages()
  {
    return [
      'codigo.required'=>'El campo código es obligatorio',
      'codigo.min'=>'El campo código debe contener 6 caracteres mínimo',
      'codigo.max'=>'El campo código debe contener 6 caracteres máximo',
      'codigo.unique'=>'Código registrado, ingrese otro',

      'nombre.required'=>'El campo nombre es obligatorio',
      'nombre.min'=>'El campo nombre debe contener 8 caracteres mínimo',
      'nombre.unique'=>'Nombre registrado, ingrese otro',

      'horas.required'=>'El campo de horas es obligatorio',
    ];
  }
}
