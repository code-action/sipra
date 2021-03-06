<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Proyecto;

class ProyectoRequest extends FormRequest
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
            'titulo'=>'required|unique:proyectos|min:30|max:600',
            'n_acuerdo'=>'required|unique:proyectos|min:5',
            'cantidad'=>'required|integer',
            'f_carrera'=>'integer|required|not_in:0',
            'anio'=>'integer|required|not_in:0',
        ];
    }
    public function messages(){
      return [
        'titulo.required'=>'El campo título es obligatorio',
        'titulo.unique'=>'Título registrado, ingrese otro',
        'titulo.min'=>'El campo título debe contener 30 caracteres mínimo',
        'titulo.max'=>'El campo título debe contener 600 caracteres máximo',

        'n_acuerdo.required'=>'El campo n° de acuerdo es obligatorio',
        'n_acuerdo.unique'=>'N° de acuerdo ya ha sido registrado',
        'n_acuerdo.min'=>'El campo n° de acuerdo debe contener 5 caracteres mínimo',

        'cantidad.required'=>'El N° de estudiantes es obligatorio',
        'cantidad.integer'=>'El campo debe contener solamente números',

        'anio.integer'=>'El campo debe contener solamente números',
        'anio.required'=>'El campo año es obligatorio',
        'anio.not_in'=>'Seleccione una opción válida',

        'f_carrera.required'=>'El campo carrera es obligatorio',
        'f_carrera.not_in'=>'Seleccione una opción válida',

      ];
    }
}
