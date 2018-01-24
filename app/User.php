<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['f_proyecto','name','email','password','estado','nombre','apellido','tipo'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = ['password', 'remember_token'];
     public static function buscarEstudiantes($nombre){
       return User::nombre($nombre)->estado(1)
       ->where('tipo','=',3)
       ->orderBy('name')->paginate(10);
     }
     public static function buscar($nombre,$estado){
       return User::nombre($nombre)->estado($estado)
       ->where('tipo','!=',3)
       ->orderBy('name')->paginate(10);
     }
     public function scopeNombre($query, $nombre){
       if (trim($nombre)!="") {
         $query->where('nombre','LIKE','%'.$nombre.'%')
         ->orWhere('name', 'LIKE','%'.$nombre.'%')
         ->orWhere('apellido', 'LIKE','%'.$nombre.'%');
       }
     }
     public function scopeEstado($query, $estado){
       if($estado == null){
         $estado = 1;
       }
       $query->where('estado', $estado);
     }

     public function nombreUser($id){
       $us=User::find($id);
       return $us['name'];
     }
     public static function carreraEstudiante($id){
       $union=Union::where('f_estudiante',$id)->get()->first();
       return $union->proyecto->carrera->nombre;
     }

     public static function comprobar($id,$n_acuerdo){
       $uniones=Union::where('f_estudiante','=',$id)->get();
       foreach ($uniones as $u) {
         if($u->proyecto->n_acuerdo==$n_acuerdo){
           return true;
         }
       }
       return false;
     }
     public static function eliminarEstudiante($id){
       $est=User::find($id);
       $existe=Union::where('f_estudiante','=',$id)->first();
       if(count($existe)==0){
         Constancia::eliminarConstancia($id);
         Bitacora::eliminarBitacora($id);
         $est->delete();
       }
     }
}
