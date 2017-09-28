<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    protected $fillable = ['f_proyecto','nf_carne'];


    Public static function proyCarnes($id){ //18/09
      return Enlace::where('f_proyecto','=',$id)->get();
    }
}
