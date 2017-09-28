<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
  protected $fillable = ['carne','nombre','apellido','f_carrera','estado'];

  public static function buscar($nombre,$estado){
    return Estudiante::nombre($nombre)->estado($estado)->orderBy('nombre')->paginate(8);
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

  public static function nombreEstudiante($carne){ //18/09 Recibe el carné y retorna nombre
    $estudiante=Estudiante::where('carne','LIKE','%'.$carne.'%')->get();
    if(count($estudiante)==0){
      return "NE";
    }else{
      foreach($estudiante as $est){
        $cad=$est->apellido.", ".$est->nombre;
        return $cad;
      }
    }
  }
}
