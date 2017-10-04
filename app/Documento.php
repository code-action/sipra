<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['n_acuerdo','f_proyecto','archivo_binario','archivo_peso','archivo_tipo','f_tipo'];

    public static function buscar($t){
      return Documento::f_tipo($t)->paginate(8);
    }
    public function scopeF_tipo($query, $t){
      $query->where('f_tipo', $t);
    }
    public static function idTipoExiste($id,$tipo){
      $docs=Documento::where('f_proyecto','=',$id)->where('f_tipo','=',$tipo)->get();
      return $docs;
    }
}
