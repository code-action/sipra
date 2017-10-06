<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConstanciaRequest extends FormRequest
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
            'archivo'=>'required|file|between:1,14800|mimes:pdf',
            'f_estudiante'=>'required',
        ];
    }

    public function messages(){
        return [
          'archivo.required'=>'El archivo es obligatorio',
          'archivo.file'=>'El archivo no fue subido correctamente',
          'archivo.between'=>'El peso permitido es de 1 KB a 14MB',
          'archivo.mimes'=>'Tipo de archivo no válido',

        ];
    }
}
