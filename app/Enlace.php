<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    protected $fillable = ['f_proyecto','nf_carne'];

    Public static function proyCarnes($id){ //18/09
      return Enlace::where('f_proyecto','=',$id)->get();
    }
    Public static function carneProy($c){ //03/10
      $fila=Enlace::where('nf_carne','=',$c)->get();
      foreach ($fila as $f) {
        return $f->f_proyecto;
      }
    }
    public static function idEsProy($id){
      $est=Estudiante::find($id);
      return Enlace::carneProy($est->carne);

    }

}
