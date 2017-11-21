<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constancia extends Model
{
    protected $fillable = ['f_estudiante','constancia_binario','constancia_peso','constancia_tipo'];

    public static function contador($id){
      return Constancia::where('f_estudiante','=',$id)->count();
    }
}
