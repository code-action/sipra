<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\Enlace;
use App\Constancia;
use App\Bitacora;
use App\Http\Requests\ConstanciaRequest;

class ConstanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_estudiante=$request->id;
        return view('constancias.create',compact('id_estudiante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConstanciaRequest $request)
    {
      $binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
      $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
      $id_proy=Enlace::idEsProy($request->f_estudiante);
     try{
          Constancia::create([
            'f_estudiante'=>$request['f_estudiante'],
            'constancia_binario'=>$binario_contenido,
            'constancia_tipo'=>$_FILES['archivo']['type'],
            'constancia_peso'=>$_FILES['archivo']['size'],
          ]);
        }catch(\Exception $e){
          return redirect('/enlace?doc='.$id_proy)->with('error','Lo sentimos el documento no pudo ser registrado');
      }
      return redirect('/enlace?doc='.$id_proy)->with('mensaje','Registro guaradado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $var=Constancia::find($id);
      $contenido=stripslashes($var->constancia_binario);
      header("Content-type: $var->constancia_tipo");
      print $contenido;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $constancia=Constancia::find($id);
        return view('constancias.edit',compact('constancia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConstanciaRequest $request, $id)
    {
      $constancia=Constancia::find($id);
      $binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
      $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
      $id_proy=Enlace::idEsProy($constancia->f_estudiante);

     try{
          $constancia->constancia_binario=$binario_contenido;
          $constancia->constancia_tipo=$_FILES['archivo']['type'];
          $constancia->constancia_peso=$_FILES['archivo']['size'];
          $constancia->save();
        }catch(\Exception $e){
          return redirect('/enlace?doc='.$id_proy)->with('error','Lo sentimos el documento no pudo ser registrado');
      }
      return redirect('/enlace?doc='.$id_proy)->with('mensaje','Registro guaradado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $constancia=Constancia::find($id);
        Constancia::destroy($id);
        $id_proy=Enlace::idEsProy($constancia->f_estudiante);
        return redirect('/enlace?doc='.$id_proy)->with('mensaje','Registro eliminado');
    }
}
