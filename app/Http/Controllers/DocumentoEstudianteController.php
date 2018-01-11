<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Proyecto;
use App\Documento;
use App\Bitacora;
use App\Tipo;
use App\Constancia;
use App\Union;
use App\User;

class DocumentoEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $uniones=Union::where('f_estudiante',Auth::user()->id)->get();
      if(count($uniones)>1){
        $est=User::find(Auth::user()->id);
        return view('acceso.varios',compact('est','uniones'));
      }elseif(count($uniones)==1){
        foreach ($uniones as $union) {
          $proy=$union->proyecto;
          return view('acceso.index',compact('proy'));
        }
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $t= $request['tipo'];
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
    {
      $val['archivo']='required|file|between:1,14800|mimes:pdf';

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
        $documento= new Documento;
        if($request['f_tipo']==4){
          $documento['n_acuerdo']=$request['n_acuerdo'];
        }
        try{
          $documento['f_proyecto']=$request['f_proyecto'];
          $documento['archivo_binario']=$binario_contenido;
          $documento['archivo_peso']=$_FILES['archivo']['size'];
          $documento['archivo_tipo']=$_FILES['archivo']['type'];
          $documento['f_tipo']=$request['f_tipo'];
          $documento->save();
        }catch(\Exception $e){
            try{
              $fh=$hora = date('d').date('m').date('y').date('G').date('i').date('s').".pdf";
              $guardar[1]="plan";
              $guardar[2]="acuerdoplan";
              $guardar[3]="memoria";
              $guardar[4]="acuerdomemoria";

              $request->file('archivo')->storeAs($guardar[$request['f_tipo']],$fh);
              $documento['f_proyecto']=$request['f_proyecto'];
              $documento['carpeta']=$fh;
              $documento['archivo_binario']="0";
              $documento['f_tipo']=$request['f_tipo'];
              $documento->save();

            }catch(\Exception $e){
              return redirect('accesoEstudiante')->with('error','Lo sentimos el documento no pudo ser registrado');
            }
          }
        Bitacora::bitacora('Nuevo documento en: '.Tipo::find($request['f_tipo'])->nombre);
        return redirect('accesoEstudiante')->with('mensaje','Registro Guardado');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $proy=Proyecto::find($id);
        return view('acceso.index',compact('proy'));
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
          $doc->n_acuerdo=$request['n_acuerdo'];
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
          return redirect('accesoEstudiante')->with('mensaje','No hay cambios');
        }else{
          $this->validate($request,$val,$mensaje);
          echo $v1.$v2;
          //Actualizar solo acuerdo
          if($v2==0){
            $guardar[1]="plan";
            $guardar[2]="acuerdoplan";
            $guardar[3]="memoria";
            $guardar[4]="acuerdomemoria";
            if($doc->carpeta!=null){
              $dir='archivos/'.$guardar[$doc['f_tipo']].'/'.$doc->carpeta;
              \File::delete(public_path($dir));
            }
            try{
              $binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;
              $binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
              $doc->archivo_binario=$binario_contenido;
              $doc->carpeta="null";
              $doc->archivo_peso=$_FILES['archivo']['size'];
              $doc->archivo_tipo=$_FILES['archivo']['type'];
              $doc->save();
            }catch(\Exception $e){
              try{
                $fh=$hora = date('d').date('m').date('y').date('G').date('i').date('s').".pdf";

                $request->file('archivo')->storeAs($guardar[$doc['f_tipo']],$fh);
                $doc['carpeta']=$fh;
                $doc['archivo_binario']="0";
                $doc->save();
              }catch(\Exception $e){
                return redirect('accesoEstudiante')->with('error','Lo sentimos el documento no pudo ser registrado');
              }
            }
          }else{
            $doc->save();
          }
          Bitacora::bitacora('Documento editado en: '.Tipo::find($doc->f_tipo)->nombre);
          return redirect('accesoEstudiante')->with('mensaje','Registro Editado');
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
      if($documento->carpeta!=null){
        $guardar[1]="plan";
        $guardar[2]="acuerdoplan";
        $guardar[3]="memoria";
        $guardar[4]="acuerdomemoria";
        $dir='archivos/'.$guardar[$documento['f_tipo']].'/'.$documento->carpeta;
        \File::delete(public_path($dir));
      }
      Bitacora::bitacora('Documento eliminado en: '.Tipo::find($documento->f_tipo)->nombre);
      Documento::destroy($id);
      return redirect('accesoEstudiante')->with('mensaje','Registro eliminado');
    }
    public function verDocumento($id){
          $var=Documento::find($id);
          if($var->carpeta==null){
          $contenido=stripslashes($var->archivo_binario);
          header("Content-type: $var->archivo_tipo");
          print $contenido;
        }else {
          $guardar[1]="plan";
          $guardar[2]="acuerdoplan";
          $guardar[3]="memoria";
          $guardar[4]="acuerdomemoria";
          echo "
          <html style='overflow:hidden;'>
    <embed src='/sipra/public/archivos/".$guardar[$var['f_tipo']]."/".$var->carpeta."' width='100%' height='100%'>
          </html>
    ";
        }
    }

    public function verConstancia($id){
      $var=Constancia::find($id);
      if($var->carpeta==null){
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
}
