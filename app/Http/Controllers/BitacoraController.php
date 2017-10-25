<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bitacora;
use App\User;
use App\Http\Requests\UsuariocRequest;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $usuario=$request->usuario;
      $bitacoras=Bitacora::buscar();
        $usr = new User;
        return view('bitacoras.index',compact('bitacoras','usr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuariocRequest $request)
    {
      $request['password']=bcrypt($request['password']);
      User::create($request->all());
      $arreglo=User::where('name','=',$request['name'])->get();
      foreach ($arreglo as $fila) {
        $id_u=$fila->id;
      }
      Bitacora::create([
      'id_usuario'=>$id_u,
      'detalle'=>'Primer usuario administrador',
    ]);
      return redirect('/')->with('mensaje','Registro Guardado');
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
}
