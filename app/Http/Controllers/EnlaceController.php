<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Constancia;
use App\Documento;
use App\Estudiante;
use App\Bitacora;
use App\User;
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
      $bproy=Proyecto::find($id);
      if(Proyecto::existe($id)){
        return redirect('/proyecto')->with('mensaje','Proyecto ya tiene ingresado todos los carné');
      }
      for($a=0;$a<$request['cantidad'];$a++){ //de acuerdo a la cantidad de carné se recorre el arreglo creado
      $valor='carne'.(String)$a; //se crea cadena carne + número para obtener nombre del campo
      $valorn='nombre'.(String)$a;
      $valora='apellido'.(String)$a;
      $cadv='';
      for($b=0;$b<$a;$b++){
        $cadv=$cadv.'|different:carne'.(String)$b;//se recorren todos los carné y se aplica la validación de que no sean iguales
      }
      $val[$valor]='required|size:7|unique:users,name'.$cadv;//se agregan las validaciones para campo carne
      $val[$valorn]='required|min:3|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/';//Validaciones campo nombre
      $val[$valora]='required|min:3|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/';//Validaciones campo apellid
      $cad1=$valor.'.required';// campo * validaciones para crear los mensajes required
      $cad2=$valor.'.size';// campo * validaciones para crear los mensajes size.
      $cad3=$valor.'.different';
      $cad4=$valor.'.unique';

      $cadn1=$valorn.'.required';
      $cadn2=$valorn.'.min';
      $cadn3=$valorn.'.regex';

      $cada1=$valora.'.required';
      $cada2=$valora.'.min';
      $cada3=$valora.'.regex';

      $men[$cad1]='El campo carné es requerido';
      $men[$cad2]='El campo carné debe contener 7 caracteres';
      $men[$cad3]='El carné ya fue digitado en un campo anterior';
      $men[$cad4]='Este carné esta registrado en otro proyecto';

      $men[$cadn1]='El campo nombre es requerido';
      $men[$cadn2]='El campo nombre debe contener nínimo 3 caracteres';
      $men[$cadn3]='El campo nombre requiere solamente letras';

      $men[$cada1]='El campo apellido es requerido';
      $men[$cada2]='El campo apellido debe contener nínimo 3 caracteres';
      $men[$cada3]='El campo apellido requiere solamente letras';
    }
    $this->validate($request,$val,$men);
    for($a=0;$a<$request['cantidad'];$a++){
      $valor='carne'.(String)$a;
      $valorn='nombre'.(String)$a;
      $valora='apellido'.(String)$a;

      User::create([
        'f_proyecto'=>$id,
        'name'=>$request[$valor],
        'nombre'=>$request[$valorn],
        'apellido'=>$request[$valora],
        'tipo'=>'3',
        'password'=>bcrypt($bproy->n_acuerdo),


      ]);
      Bitacora::bitacora('Nuevo estudiante agregado, carné: '.$request[$valor]);
    }
    return redirect('/enlace?doc='.(String)$id)->with('mensaje','Registro Guardado');
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
        if($var->carpeta==null){
        /*header("Content-Disposition: attachment; filename=Hola.pdf"); Para descarga directa*/
        $contenido=stripslashes($var->archivo_binario);
        header("Content-type: $var->archivo_tipo");
        print $contenido;
      }else {
//         echo "
// <embed src='/sipra/public/archivos/acuerdomemoria/".$var->carpeta."' width='100%' height='100%'>
// ";
return redirect("/archivos/acuerdomemoria/".$var->carpeta);
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
        $estudiante=User::find($id);
        $carne=$estudiante->name;
        $id_proy=$estudiante->f_proyecto;
        $constancia=Constancia::where('f_estudiante','=',$id);
        foreach ($constancia as $c) {
          Constancia::destroy($c->id);
          Bitacora::bitacora('Constancia eliminada, carné: '.$carne);
        }
        $proy=Proyecto::find($id_proy);
          User::destroy($estudiante->id);
    $proy['cantidad']=$proy['cantidad']-1;
    $proy->save();
    Bitacora::bitacora('Estudiante eliminado, carné: '.$carne);
    return redirect('/proyecto/'.(String)$id_proy)->with('mensaje','Registro Guardado');
    }
}
