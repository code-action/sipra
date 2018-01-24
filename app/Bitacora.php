<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;

class Bitacora extends Model
{
  protected $fillable = ['id_usuario','detalle'];

public static function bitacora($detalle){

  if(Auth::check()==1){
    Bitacora::create([
    'id_usuario'=>Auth::user()->id,
    'detalle'=>$detalle,
  ]);
}
}

public static function buscar($usuario){
  $bitacora = DB::table('bitacoras')
    ->select('bitacoras.*','users.nombre','users.apellido')
    ->join('users','bitacoras.id_usuario','=','users.id','left outer')
    ->where('users.nombre','LIKE','%'.$usuario.'%')
    ->orWhere('users.apellido','LIKE','%'.$usuario.'%')
    ->orWhere('bitacoras.detalle','LIKE','%'.$usuario.'%')
    ->orderBy('bitacoras.created_at','DESC')
    ->paginate(10);
    return $bitacora;
  }
  public static function buscar2($usuario){
    $bitacora = DB::table('bitacoras')
      ->select('bitacoras.*','users.name')
      ->join('users','bitacoras.id_usuario','=','users.id','left outer')
      ->where('users.name','LIKE','%'.$usuario.'%')
      ->orderBy('bitacoras.created_at','DESC')
      ->get();
      return $bitacora;
    }
    public static function eliminarBitacora($idUsuario){
      $bitacoras=Bitacora::where('id_usuario','=',$idUsuario)->get();
      foreach ($bitacoras as $b) {
        $b->delete();
      }
    }
}
