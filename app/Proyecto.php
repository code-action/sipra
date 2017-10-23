<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['titulo','cantidad','anio','f_carrera'];


    public static function buscar($titulo){
      return Proyecto::titulo($titulo)->orderBy('titulo')->paginate(8);
    }
    public function scopeTitulo($query, $titulo){
      if (trim($titulo)!="") {
        $query->where('titulo','LIKE','%'.$titulo.'%');
      }
    }
    public static function buscar2($titulo){
      return Proyecto::anio($titulo)->orderBy('titulo')->paginate(8);
    }
    public function scopeAnio($query, $titulo){
      if (trim($titulo)!="") {
        $query->where('anio','LIKE','%'.$titulo.'%');
      }
    }
    public static function buscarT($titulo){ //recibe titulo y retorna en un array el id
      $proy=Proyecto::where('titulo','=',$titulo)->get(['id']);
      return $proy;
    }

    public static function existe($id){ //compara la cantidad del proyecto con la cantidad ingresada
      $proy=Proyecto::find($id);
      $enlace=Enlace::where('f_proyecto','=',$id)->get();
      $cantidad=count($enlace);
      if($cantidad==$proy['cantidad']){
        return true;
      }
        return false;
    }
}
