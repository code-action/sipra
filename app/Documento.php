<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = ['n_acuerdo','carpeta','f_proyecto','archivo_binario','archivo_peso','archivo_tipo','f_tipo'];

    public static function buscar($t){
      return Documento::f_tipo($t)->paginate(8);
    }
    public function scopeF_tipo($query, $t){
      $query->where('f_tipo', $t);
    }
    public static function idTipoExiste($id,$tipo){
      $docs=Documento::where('f_proyecto','=',$id)->where('f_tipo','=',$tipo)->get();
      return $docs;
    }

    public static function buscarUnion($tipo,$busqueda){
      $proyectos = DB::table('proyectos')
    ->select('proyectos.*','documentos.n_acuerdo')
    ->join('documentos','proyectos.id','=','documentos.f_proyecto','left outer')
    ->where('documentos.f_tipo','=',$tipo)
    ->where('proyectos.titulo','LIKE','%'.$busqueda.'%')
    ->orWhere('documentos.n_acuerdo', 'LIKE','%'.$busqueda.'%')
    ->paginate(8);
    return $proyectos;
    }

    public static function contador($id){
      return Documento::where('f_proyecto','=',$id)->count();
    }
    public static function eliminarDocumento($id){
      $documentos=Documento::where('f_proyecto',"=",$id)->get();
      foreach($documentos as $d){
        if($d->carpeta!=null){
          $guardar[1]="plan";
          $guardar[2]="acuerdoplan";
          $guardar[3]="memoria";
          $guardar[4]="acuerdomemoria";
          $dir='archivos/'.$guardar[$d['f_tipo']].'/'.$d->carpeta;
          \File::delete(public_path($dir));
        }
        Documento::destroy($d->id);
      }
    }
}
