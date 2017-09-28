<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnioRequest extends FormRequest
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
              'year'=>'required|between:1991,'.date("Y").'|numeric|unique:anios',
          ];
      }
      public function messages()
      {
          return [
            'year.required'=>'El campo año es requerido',
            'year.between'=>'El campo año debe estar entre 1991 y '.date("Y").', el año actual',
            'year.numeric'=>'El campo año debe ser numérico',
            'year.unique'=>'Año ya se encuentra ingresado',
          ];
      }
}
