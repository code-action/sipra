<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['n_acuerdo','f_proyecto','archivo_binario','archivo_peso','archivo_tipo','f_tipo'];

    public static function buscar($t){
      return Documento::f_tipo($t)->orderBy('nombre')->paginate(8);
    }
    public function scopeF_tipo($query, $t){
      $query->where('f_tipo', $t);
    }
}
