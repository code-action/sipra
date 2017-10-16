<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\Constancia;
use App\Proyecto;
use App\Http\Requests\ProyectoRequest;
use App\Documento;
use App\Enlace;
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
      $titulo = $request['titulo'];
      if(trim($titulo)!=""){
      $proyectos= Proyecto::buscar($titulo);
    }else{
      $proyectos=Proyecto::orderBy('titulo')->paginate(8);
    }
      return view('proyectos.index',compact('proyectos','titulo'));

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
    public function store(ProyectoRequest $request)
    {
        Proyecto::create($request->all());
        $titl=Proyecto::buscarT($request['titulo']);
        foreach ($titl as $t){
          $tit=$t;
        }
        Bitacora::bitacora('Nuevo proyecto creado');
        return redirect('/enlace/create?id='.$tit['id'])->with('mensaje','Registro Guardado');
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
      $m['titulo.max']='El campo título debe contener 250 caracteres máximo';

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
        $v1=$v2=$v3=$v4=0;
        if($request->titulo==$proyecto->titulo){
          $v1=1;
        }else{
          $val['titulo']='required|unique:proyectos|min:30|max:250';
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
        if($v1==1 && $v2==1 && $v3==1 && $v4==1){
          return redirect('/carrera')->with('mensaje','No hay cambios');
        }else{
          $this->validate($request,$val,$m);
          $proyecto->fill($request->all());
          $proyecto->save();
          Bitacora::bitacora('Proyecto editado');
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
          Documento::destroy($d->id);
        }
        $enlaces=Enlace::where('f_proyecto',"=",$id)->get();
        foreach($enlaces as $e){
          $estudiantes=Estudiante::where('carne','=',$e->nf_carne)->get();
          foreach($estudiantes as $est){
            Constancia::where('f_estudiante','=',$est->id)->delete();
            Estudiante::destroy($est->id);
          }
          Enlace::destroy($e->id);
        }
        Proyecto::destroy($id);
        Bitacora::bitacora('Proyecto eliminado');
        return redirect('/proyecto')->with('mensaje','Proyecto eliminado');
    }
}
