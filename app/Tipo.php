<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
  protected $fillable = ['nombre','id'];
    public static function llenarTabla(){
      $nombre=array("Memorias","Acuerdo de Memoria","Planes","Acuerdo de plan");
      $correlativo=array("3","4","1","2");
      $cuenta = Tipo::count();
      if($cuenta == 0){
      for($a=0;$a<count($nombre);$a++){
        Tipo::create([
          'id'=>$correlativo[$a],
          'nombre'=>$nombre[$a],
        ]);
      }
    }
  }
  public  static function nombreTipo($id){
    $c=Tipo::find($id);
    return $c->nombre;
  }

}
