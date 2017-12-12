<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = ['f_proyecto','comentario','estudiante'];

    public static function eliminarComentario($id){
      $comentarios=Comentario::where('f_proyecto','=',$id)->get();
      foreach ($comentarios as $c) {
        $c->delete();
      }
    }
}
