<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Documento;
use App\Proyecto;
use App\Http\Requests\DocumentoRequest;
use App\Bitacora;
use App\Tipo;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   $tipo=$request['tipo'];
        $titulo = $request['titulo'];
        if(trim($titulo)!=""){
            //$proyectos= Proyecto::buscar($titulo);
            $proyectos=Documento::buscarUnion($tipo,$titulo);
          }else{
            $proyectos=Proyecto::orderBy('titulo')->paginate(8);
        }
        return view('documentos.index',compact('tipo','proyectos','titulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   $t= $request['tipo'];
        $id=$request['id'];
        return view('documentos.create',compact('t','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $val['archivo']='required|file|between:1,14800|mimes:pdf';

      if($request['f_tipo']==4){
        $val['n_acuerdo']='required | unique:documentos';}

      $mensaje['archivo.required']='El archivo es obligatorio';
      $mensaje['archivo.file']='El archivo no fue subido correctamente';
      $mensaje['archivo.between']='El peso permitido es de 1 KB a 14MB';
      $mensaje['archivo.mimes']='Tipo de archivo no válido';
      $mensaje['n_acuerdo.required']='El campo N° de acuerdo es obligatorio';
      $mensaje['n_acuerdo.unique']='El número de acuerdo ya esta ingresado';

      $this->validate($request,$val,$mensaje);

      $binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
      $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
      try{

      if($request['f_tipo']==4){
        Documento::create([
          'f_proyecto'=>$request['f_proyecto'],
          'n_acuerdo'=>$request['n_acuerdo'],
          'archivo_binario'=>$binario_contenido,
          'archivo_peso'=>$_FILES['archivo']['size'],
          'archivo_tipo'=>$_FILES['archivo']['type'],
          'f_tipo'=>$request['f_tipo'],
        ]);
       }else{
         Documento::create([
          'f_proyecto'=>$request['f_proyecto'],
          'archivo_binario'=>$binario_contenido,
          'archivo_peso'=>$_FILES['archivo']['size'],
          'archivo_tipo'=>$_FILES['archivo']['type'],
          'f_tipo'=>$request['f_tipo'],
        ]);
        }
      }catch(\Exception $e){
        return redirect('/enlace?doc='.(String)$request['f_proyecto'])->with('error','Lo sentimos el documento no pudo ser registrado');
      }
      Bitacora::bitacora('Nuevo documento en: '.Tipo::find($request['f_tipo'])->nombre);
      return redirect('/enlace?doc='.(String)$request['f_proyecto'])->with('mensaje','Registro Guardado');
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
        $doc=Documento::find($id);
        return view('documentos.edit',compact('doc'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  $doc=Documento::find($id);
        $v1=$v2=0;
        if($doc->f_tipo!=4){
          $v1=1;
        }elseif($request->n_acuerdo==$doc->n_acuerdo){
        $v1=1;
        }else{
        $val['n_acuerdo']='required | unique:documentos';
        $mensaje['n_acuerdo.required']='El campo N° de acuerdo es obligatorio';
        $mensaje['n_acuerdo.unique']='El número de acuerdo ya esta ingresado';
      }
      if($request->archivo!=null){
        $val['archivo']='required|file|between:1,14800|mimes:pdf';
        $mensaje['archivo.required']='El archivo es obligatorio';
        $mensaje['archivo.file']='El archivo no fue subido correctamente';
        $mensaje['archivo.between']='El peso permitido es de 1 KB a 14MB';
        $mensaje['archivo.mimes']='Tipo de archivo no válido';
      }else{
        $v2=1;
      }
      if($v1==1 && $v2==1){
        return redirect('/enlace?doc='.(String)$doc['f_proyecto'])->with('mensaje','No hay cambios');
      }else{
        $this->validate($request,$val,$mensaje);
        echo $v1.$v2;
        //Actualizar solo acuerdo
        if($v1==0 && $v2==1){
          $doc->n_acuerdo=$request['n_acuerdo'];
        }else{
          if($v1==0){
          $doc->n_acuerdo=$request['n_acuerdo'];
          }
          $binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
          $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
          $doc->archivo_binario=$binario_contenido;
          $doc->archivo_peso=$_FILES['archivo']['size'];
          $doc->archivo_tipo=$_FILES['archivo']['type'];
        }
        Bitacora::bitacora('Documento editado en: '.Tipo::find($doc->f_tipo)->nombre);
        $doc->save();
        return redirect('/enlace?doc='.(String)$doc['f_proyecto'])->with('mensaje','Registro Editado');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento=Documento::find($id);
        Bitacora::bitacora('Documento eliminado en: '.Tipo::find($documento->f_tipo)->nombre);
        Documento::destroy($id);
        return redirect('/enlace?doc='.$documento->f_proyecto)->with('mensaje','Registro eliminado');
    }
}
