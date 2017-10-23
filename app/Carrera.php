<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
  protected $fillable = ['codigo','nombre','horas','estado'];

  public static function buscar($nombre,$estado){
    return Carrera::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(8);
  }
  public function scopeNombre($query, $nombre){
    if (trim($nombre)!="") {
      $query->where('nombre','LIKE','%'.$nombre.'%');
    }
  }
  public function scopeEstado($query, $estado){
    if($estado == null){
      $estado = 1;
    }
    $query->where('estado', $estado);
  }

  public  static function nombreCarrera($id){
    $c=Carrera::find($id);
    return $c->nombre;
  }
  public static function arrayCarrera(){
      $carreras=Carrera::get();
      $arrayC= [];
      foreach($carreras as $carrera){
        $arrayC[$carrera->id]=$carrera->nombre;
      }
      return $arrayC;
  }
}
