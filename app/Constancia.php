<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constancia extends Model
{
    protected $fillable = ['f_estudiante','constancia_binario','constancia_peso','constancia_tipo'];

    public static function contador($id){
      return Constancia::where('f_estudiante','=',$id)->count();
    }

    public static function eliminarConstancia($id_est){

      $constancias=Constancia::where('f_estudiante','=',$id_est)->get();
      foreach ($constancias as $constancia) {
        if($constancia->carpeta!=null){
          $dir='archivos/constancias/'.$constancia->carpeta;
          \File::delete(public_path($dir));
        }
          Constancia::destroy($constancia->id);
      }
    }
}
