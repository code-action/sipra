<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['titulo','cantidad','anio','f_carrera','n_acuerdo','horas'];


    public static function buscar($titulo){
      return Proyecto::titulo($titulo)->orderBy('titulo')->paginate(10);
    }
    public function scopeTitulo($query, $titulo){
      if (trim($titulo)!="") {
        $query->where('titulo','LIKE','%'.$titulo.'%');
      }
    }
    public static function buscar2($titulo){
      return Proyecto::anio($titulo)->orderBy('titulo')->paginate(10);
    }
    public function scopeAnio($query, $titulo){
      if (trim($titulo)!="") {
        $query->where('anio','LIKE','%'.$titulo.'%');
      }
    }
    public static function buscar3($f_carrera){
      return Proyecto::f_carrera($f_carrera)->orderBy('titulo')->paginate(10);
    }
    public function scopeF_carrera($query, $f_carrera){
      if (trim($f_carrera)!="") {
        $query->where('f_carrera','=',$f_carrera);
      }
    }
    public static function buscarT($titulo){ //recibe titulo y retorna en un array el id
      $proy=Proyecto::where('titulo','=',$titulo)->get(['id']);
      return $proy;
    }

    public static function existe($id){ //compara la cantidad del proyecto con la cantidad ingresada
      $proy=Proyecto::find($id);
      $estudiantes=User::where('f_proyecto','=',$id)->get();
      $cantidad=count($estudiantes);
      if($cantidad==$proy['cantidad']){
        return true;
      }
        return false;
    }
    public function carrera(){
    return $this->belongsTo('App\Carrera','f_carrera');
  }
  public function uniones(){
        return $this->hasMany('App\Union','f_proyecto');
    }
  public static function arrayAnio(){
    $arrayA= [];
    for($a=1991;$a<=date("Y");$a++){
      $arrayA[$a]=$a;
    }
    return $arrayA;
  }
}
