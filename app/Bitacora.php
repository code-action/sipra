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
    ->select('bitacoras.*','users.name')
    ->join('users','bitacoras.id_usuario','=','users.id','left outer')
    ->where('users.name','LIKE','%'.$usuario.'%')
    ->orderBy('bitacoras.created_at','DESC')
    ->paginate(8);
    return $bitacora;
    //return Bitacora::orderBy('created_at','desc')->paginate(8);
  }
}
