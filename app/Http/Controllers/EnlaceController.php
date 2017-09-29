<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Enlace;
use App\Documento;
use App\Estudiante;
use App\Http\Requests\EnlaceRequest;

class EnlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proy=Proyecto::find($request['doc']);
        return view('documentos.docs',compact('proy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $tit=Proyecto::find($request['id']);
      return view('proyectos.enlace',compact('tit'))->with('mensaje','Registro guardado');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $id= $request['id']; //Id recibido del desde vista enlace corresponde a un proyecto
      if(Proyecto::existe($id)){
        return redirect('/proyecto')->with('mensaje','Proyecto ya tiene ingresado todos los carné');
      }
      for($a=0;$a<$request['cantidad'];$a++){ //de acuerdo a la cantidad de carné se recorre el arreglo creado
      $valor='carne'.(String)$a; //se crea cadena carne + número para obtener nombre del campo
      $cadv='';
      for($b=0;$b<$a;$b++){
        $cadv=$cadv.'|different:carne'.(String)$b;//se recorren todos los carné y se aplica la validación de que no sean iguales
      }
      $val[$valor]='required|size:7|unique:enlaces,nf_carne'.$cadv;//se agregan las validaciones para ese campo
      $cad1=$valor.'.required';// campo * validaciones para crear los mensajes required
      $cad2=$valor.'.size';// campo * validaciones para crear los mensajes size.
      $cad3=$valor.'.different';
      $cad4=$valor.'.unique';
      $men[$cad1]='El campo carné es requerido';
      $men[$cad2]='El campo carné debe contener 7 caracteres';
      $men[$cad3]='El carné ya fue digitado en un campo anterior';
      $men[$cad4]='Este carné esta registrado en otro proyecto';
    }
    $this->validate($request,$val,$men);
    for($a=0;$a<$request['cantidad'];$a++){
      $valor='carne'.(String)$a;
      Enlace::create([
        'f_proyecto'=>$id,
        'nf_carne'=>$request[$valor],
      ]);
    }
    return redirect('/proyecto')->with('mensaje','Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $var=Documento::find($id);

        /*header("Content-Disposition: attachment; filename=Hola.pdf");
        header("Content-length: $var->archivo_peso");
        header("Content-type: $var->archivo_tipo");
        echo $var->archivo_binario;*/
        $contenido=stripslashes($var->archivo_binario);
        header("Content-type: $var->archivo_tipo");
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
    public function destroy($carne)
    {
        $enlaces=Enlace::where('nf_carne','=',$carne)->get();
        foreach($enlaces as $enlace){
          $id_proy=$enlace->f_proyecto;
          Enlace::destroy($enlace->id);

        }
        $estudiantes=Estudiante::where('carne','=',$carne)->get();
        foreach($estudiantes as $estudiante){
          Estudiante::destroy($estudiante->id);
        }
    $proy=Proyecto::find($id_proy);
    $proy['cantidad']=$proy['cantidad']-1;
    $proy->save();
    return redirect('/proyecto/'.(String)$id_proy)->with('mensaje','Registro Guardado');
    }
}
