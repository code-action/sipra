<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = ['f_proyecto','f_estudiante'];

    public function proyecto(){
    return $this->belongsTo('App\Proyecto','f_proyecto');
  }
  public function estudiante(){
  return $this->belongsTo('App\User','f_estudiante');
}
}
