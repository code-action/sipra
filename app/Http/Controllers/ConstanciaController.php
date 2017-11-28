<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\User;
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
      $id_proy=User::find($request->f_estudiante)->f_proyecto;
     try{
          Constancia::create([
            'f_estudiante'=>$request['f_estudiante'],
            'constancia_binario'=>$binario_contenido,
            'constancia_tipo'=>$_FILES['archivo']['type'],
            'constancia_peso'=>$_FILES['archivo']['size'],
          ]);
        }catch(\Exception $e){
          try{
            $fh=$hora = date('d').date('m').date('y').date('G').date('i').date('s').".pdf";
            $request->file('archivo')->storeAs('constancias',$fh);
            $constancia = new Constancia;
            $constancia->f_estudiante=$request['f_estudiante'];
            $constancia->constancia_binario="0";
            $constancia->carpeta=$fh;
            $constancia->save();
          }catch(\Exception $e){
            return redirect('/enlace?doc='.$id_proy)->with('error','Lo sentimos el documento no pudo ser registrado');
          }
      }
      Bitacora::bitacora('Nueva constancia, estudiante: '.User::find($request['f_estudiante'])->name);
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
      if($var->carpeta!=null){
        $contenido=stripslashes($var->constancia_binario);
        header("Content-type: $var->constancia_tipo");
        print $contenido;
      }else{
        echo "
        <html style='overflow:hidden;'>
<embed src='/sipra/public/archivos/constancias/".$var->carpeta."' width='100%' height='100%'>
        </html>";
      }
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
      $id_proy=User::find($constancia->f_estudiante)->f_proyecto;

      if($constancia->carpeta!=null){
        $dir='archivos/constancias/'.$constancia->carpeta;
        \File::delete(public_path($dir));
      }
     try{
          $constancia->constancia_binario=$binario_contenido;
          $constancia->constancia_tipo=$_FILES['archivo']['type'];
          $constancia->constancia_peso=$_FILES['archivo']['size'];
          $constancia->carpeta="null";
          $constancia->save();
        }catch(\Exception $e){
          try{
            $fh=$hora = date('d').date('m').date('y').date('G').date('i').date('s').".pdf";
            $request->file('archivo')->storeAs('constancias',$fh);
            $constancia->constancia_binario="0";
            $constancia->carpeta=$fh;
            $constancia->save();
          }catch(\Exception $e){
            return redirect('/enlace?doc='.$id_proy)->with('error','Lo sentimos el documento no pudo ser registrado');
          }
      }
      Bitacora::bitacora('Constancia editada, estudiante: '.$constancia->f_estudiante);
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
      if($constancia->carpeta!=null){
        $dir='archivos/constancias/'.$constancia->carpeta;
        \File::delete(public_path($dir));
      }
        $id_proy=User::find($constancia->f_estudiante)->f_proyecto;
        Constancia::destroy($id);
        Bitacora::bitacora('Constancia eliminada, estudiante: '.$constancia->f_estudiante);
        return redirect('/enlace?doc='.$id_proy)->with('mensaje','Registro eliminado');
    }
}
