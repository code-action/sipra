<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
  protected $fillable = ['carne','nombre','apellido'];

  public static function buscar($nombre){
    return Estudiante::nombre($nombre)->orderBy('nombre')->paginate(10);
  }
  public function scopeNombre($query, $nombre){
    if (trim($nombre)!="") {
      $query->where('nombre','LIKE','%'.$nombre.'%')
      ->orWhere('carne', 'LIKE','%'.$nombre.'%')
      ->orWhere('apellido', 'LIKE','%'.$nombre.'%')
      ;
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
  public static function carreraEstudiante($carne){
    $enlaces=Enlace::where('nf_carne','=',$carne)->get();
    foreach ($enlaces as $enlace) {
      $id_proy=$enlace->f_proyecto;
    }
    $proy=Proyecto::find($id_proy);
    return Carrera::nombreCarrera($proy->f_carrera);
  }
}
