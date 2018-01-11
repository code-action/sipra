<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Auth;
use DB;
use Session;
use Redirect;
use Crypt;
use App\Bitacora;
use App\User;
use Config;
class LogedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Bitacora::bitacora('Salida del sistema');
        Auth::logout();
        return Redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $usuario=User::where('name','=',$request->name)->first();
      if(count($usuario)==1){
        if($usuario->tipo==3){
          $request['password']=strtoupper($request->password);
          $existe=User::comprobar($usuario->id,$request['password']);
          if($existe==true){
            $request['password']=$usuario->name;
          }else{
              return redirect('/')->with('error','Usuario o contraseña incorrecta');
          }

        }
      }
      if(Auth::attempt(['name'=>$request['name'],'password'=>$request['password']])){
          if(Auth::user()->estado!=0){
            Bitacora::bitacora('Ingreso al sistema');
            $conteo=Bitacora::count();
            if($conteo>300){
              $diferencia=$conteo-300;
              $borradores=DB::table('bitacoras')->take($diferencia)->orderBy('id')->get();
              foreach ($borradores as $borrador) {
                Bitacora::destroy($borrador->id);
              }
            }
            return redirect('/inicio');
          }else{
            Auth::logout();
            return redirect('/')->with('error','Usuario inactivo');
          }
      }else{
          return redirect('/')->with('error','Usuario o contraseña incorrecta');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function correo(Request $request){
      mail($request['email'], "Recuperar contraseña","Hola");
      $count=0;
      $usuario= User::where('email', '=',$request['email'])->get();
      foreach ($usuario as $us) {
          $u=$us->name;
          $c=$us->password;
          $count=$count+1;
      }

      if($count==1){
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $cad = "";
      for($i=0;$i<12;$i++)
      {
          $cad .= substr($str,rand(0,62),1);
      }

    DB::beginTransaction();
     DB::table('users')
          ->where('email',$request['email'])
          ->update([
          'password'=>bcrypt($cad),
          ]);

      $mensaje='Su usuario es: '.$u.' Su contraseña es :'.$cad;
      mail($request['email'], "Sistema Informático para el resguardo de archivos (SIPRA):Recuperar contraseña", $mensaje);

      DB::commit();
      return redirect('/')->with('mensaje','Usuario y nueva contraseña enviados');
      }
      else{

          return redirect('/')->with('error','Ningún usuario registrado con ese correo');
      }
    }
}
