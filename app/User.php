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
       ->where('f_proyecto','!=',null)
       ->orderBy('name')->paginate(8);
     }
     public static function buscar($nombre,$estado){
       return User::nombre($nombre)->estado($estado)
       ->where('f_proyecto','=',null)
       ->orderBy('name')->paginate(8);
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
       $estudiante=User::find($id);
       $proy=Proyecto::find($estudiante->f_proyecto);
       return Carrera::nombreCarrera($proy->f_carrera);
     }
}
