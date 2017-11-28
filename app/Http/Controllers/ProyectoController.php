<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\Constancia;
use App\Proyecto;
use App\Http\Requests\ProyectoRequest;
use App\Documento;
use App\User;
use App\Bitacora;


class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $titulo = $request->titulo;
      $titulodos = $request->titulodos;
      if(trim($request->busqueda)==""){
        $busqueda=1;
      }else{
        $busqueda=$request->busqueda;
      }
      if($busqueda==1){
        $proyectos= Proyecto::buscar($titulo);
      }elseif ($busqueda==2) {
        $proyectos=Proyecto::buscar2($titulo);
      }elseif($busqueda==3){
        $proyectos=Proyecto::buscar3($titulodos);
      }else{
        $proyectos=Proyecto::orderBy('titulo')->paginate(8);
      }
      return view('proyectos.index',compact('proyectos','busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $validar['titulo']='required|unique:proyectos|min:30|max:600';
        $validar['n_acuerdo']='required|unique:proyectos|min:5';
        $validar['cantidad']='required|integer';
        $validar['f_carrera']='integer|required|not_in:0';
        $validar['anio']='integer|required|not_in:0';
        $validar['horas']='required|integer|min:1|max:'.(String)$request->limite;

        $mensaje['titulo.required']='El campo título es obligatorio';
        $mensaje['titulo.unique']='Título registrado, ingrese otro';
        $mensaje['titulo.min']='El campo título debe contener 30 caracteres mínimo';
        $mensaje['titulo.max']='El campo título debe contener 600 caracteres máximo';

        $mensaje['n_acuerdo.required']='El campo n° de acuerdo es obligatorio';
        $mensaje['n_acuerdo.unique']='N° de acuerdo ya ha sido registrado';
        $mensaje['n_acuerdo.min']='El campo n° de acuerdo debe contener 5 caracteres mínimo';

        $mensaje['cantidad.required']='El N° de estudiantes es obligatorio';
        $mensaje['cantidad.integer']='El campo debe contener solamente números';

        $mensaje['anio.integer']='El campo debe contener solamente números';
        $mensaje['anio.required']='El campo año es obligatorio';
        $mensaje['anio.not_in']='Seleccione una opción válida';

        $mensaje['f_carrera.required']='El campo carrera es obligatorio';
        $mensaje['f_carrera.not_in']='Seleccione una opción válida';

        $mensaje['horas.required']='El campo horas es obligatorio';
        $mensaje['horas.min']='El campo horas debe ser mayor que 0';
        $mensaje['horas.max']='El campo horas no debe exceder las '.$request->limite.' horas';

        $this->validate($request,$validar,$mensaje);

        $request->n_acuerdo=$request->n_acuerdo;
        $proy=Proyecto::create($request->all());
        Bitacora::bitacora('Nuevo proyecto creado número de acuerdo: '.$request->n_acuerdo);
        return redirect('/enlace/create?id='.$proy['id'])->with('mensaje','Registro Guardado');
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

        return view('proyectos.show',compact('proy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $proyecto=Proyecto::find($id);
       return view('proyectos.edit',compact('proyecto'));
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
      $m['titulo.required']='El campo título es obligatorio';
      $m['titulo.unique']='Título registrado, ingrese otro';
      $m['titulo.min']='El campo título debe contener 30 caracteres mínimo';
      $m['titulo.max']='El campo título debe contener 600 caracteres máximo';

      $m['n_acuerdo.required']='El campo n° de acuerdo es obligatorio';
      $m['n_acuerdo.unique']='N° de acuerdo ya ha sido registrado';
      $m['n_acuerdo.min']='El campo n° de acuerdo debe contener 5 caracteres mínimo';

      $m['cantidad.required']='El N° de estudiantes es obligatorio';
      $m['cantidad.integer']='El campo debe contener solamente números';

      $m['anio.integer']='El campo debe contener solamente números';
      $m['anio.required']='El campo año es obligatorio';
      $m['anio.not_in']='Seleccione una opción válida';

      $m['f_carrera.required']='El campo carrera es obligatorio';
      $m['f_carrera.not_in']='Seleccione una opción válida';

        $proyecto=proyecto::find($id);
        if($request->vc=='no'){
          $request->cantidad=$proyecto->cantidad;
        }
        $v1=$v2=$v3=$v4=$v5=0;
        if($request->titulo==$proyecto->titulo){
          $v1=1;
        }else{
          $val['titulo']='required|unique:proyectos|min:30|max:600';
        }
        if($request->n_acuerdo==$proyecto->n_acuerdo){
          $v5=1;
        }else{
          $val['n_acuerdo']='required|unique:proyectos|min:5';
        }
        if($request->cantidad==$proyecto->cantidad){
          $v2=1;
        }else{
          $val['cantidad']='required|integer';
        }
        if($request->anio==$proyecto->anio){
          $v3=1;
        }else{
          $val['anio']='integer|required|not_in:0';
        }
        if($request->f_carrera==$proyecto->f_carrera){
          $v4=1;
        }else{
          $val['f_carrera']='integer|required|not_in:0';
        }
        if($v1==1 && $v2==1 && $v3==1 && $v4==1 && $v5==1){
          return redirect('/proyecto')->with('mensaje','No hay cambios');
        }else{
          $this->validate($request,$val,$m);
          $proyecto->fill($request->all());
          if($v5==0){
            $estudiantes=User::where('f_proyecto','=',$proyecto->id)->get();
            foreach ($estudiantes as $est) {
              $est->password=bcrypt($request['n_acuerdo']);
              $est->save();
            }
          }
          $proyecto->save();
          Bitacora::bitacora('Proyecto editado número de acuerdo: '.$request->n_acuerdo);
          return redirect('/proyecto')->with('mensaje','Registro actualizado');
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
        $documentos=Documento::where('f_proyecto',"=",$id)->get();
        foreach($documentos as $d){
          if($d->carpeta!=null){
            $guardar[1]="plan";
            $guardar[2]="acuerdoplan";
            $guardar[3]="memoria";
            $guardar[4]="acuerdomemoria";
            $dir='archivos/'.$guardar[$d['f_tipo']].'/'.$d->carpeta;
            \File::delete(public_path($dir));
          }
          Documento::destroy($d->id);
        }
        $estudiantes=User::where('f_proyecto',"=",$id)->get();
        foreach($estudiantes as $est){
            $constancia=Constancia::where('f_estudiante','=',$est->id)->first();
            if (count($constancia)>0) {
              if($constancia->carpeta!=null){
                $dir='archivos/constancias/'.$constancia->carpeta;
                \File::delete(public_path($dir));
              }
              Constancia::destroy($constancia->id);
            }
            $bitacoras=Bitacora::where('id_usuario','=',$est->id)->get();
            foreach ($bitacoras as $b) {
              Bitacora::destroy($b->id);
            }
            User::destroy($est->id);
        }
        Proyecto::destroy($id);
        Bitacora::bitacora('Proyecto eliminado');
        return redirect('/proyecto')->with('mensaje','Proyecto eliminado');
    }
}
