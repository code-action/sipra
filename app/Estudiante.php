<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
  protected $fillable = ['carne','nombre','apellido'];

  public static function buscar($nombre){
    return Estudiante::nombre($nombre)->orderBy('nombre')->paginate(8);
  }
  public function scopeNombre($query, $nombre){
    if (trim($nombre)!="") {
      $query->where('nombre','LIKE','%'.$nombre.'%');
    }
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

  public static function filaEstudiante($carne){ //05/10/2017 Recibe carné y retorna la fila completa
    $estudiante=Estudiante::where('carne','LIKE','%'.$carne.'%')->get();
    if(count($estudiante)==0){
      return "NE";
    }else{
      foreach($estudiante as $est){
        return $est;
      }
    }
  }
}
