<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Carrera;
use App\Bitacora;
use App\Http\Requests\CarreraRequest;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $state = $request->get('estado');
    $nombre = $request->get('nombre');
    $carreraAc= Carrera::buscar($nombre,$state);
    return view('carreras.index',compact('carreraAc','state','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carreras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarreraRequest $request)
    {
      Carrera::create($request->all());
      Bitacora::bitacora('Creación de nueva carrera: '.$request['nombre']);
      return redirect('/carrera')->with('mensaje','Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $ca=Carrera::find($id);
      return view('carreras.show',compact('ca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ca=Carrera::find($id);
      return view('carreras.edit',compact('ca'));
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
      $m['codigo.required']='El campo código es obligatorio';
      $m['codigo.min']='El campo código debe contener 6 caracteres mínimo';
      $m['codigo.max']='El campo código debe contener 6 caracteres máximo';
      $m['codigo.unique']='Código registrado, ingrese otro';

      $m['nombre.required']='El campo nombre es obligatorio';
      $m['nombre.min']='El campo nombre debe contener 8 caracteres mínimo';
      $m['nombre.unique']='Nombre registrado, ingrese otro';

      $b1=0;
      $b2=0;
      $ca=Carrera::find($id);
      if($request['codigo']==$ca['codigo']){
        $b1=1;
      }else{
        $validar['codigo']='required|min:6|max:6|unique:carreras';
      }

      if($request['nombre']==$ca['nombre']){
        $b2=1;
      }else{
        $validar['nombre']='required|min:8|unique:carreras';
      }
      if($b1==1 && $b2==1 && $ca['horas']==$request['horas']){
        return redirect('/carrera')->with('mensaje','No hay cambios');
      }
      else {
        $this->validate($request,$validar,$m);
        $ca->fill($request->all());
        $ca->save();
        Bitacora::bitacora('Modificación de carrera: '.$request['nombre']);
        return redirect('/carrera')->with('mensaje','Registro actualizado');
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
      {
  $carrera=Carrera::find($id);

  if($carrera['estado']==1){
    $carrera['estado']=0;
    $carrera->save();
    Bitacora::bitacora('Carrera enviada a inactivos: '.$carrera['nombre']);
    return redirect('/carrera')->with('mensaje','Nuevo registro inactivo');
    }
  else {
    $carrera['estado']=1;
    $carrera->save();
    Bitacora::bitacora('Carrera enviada a activos: '.$carrera['nombre']);
    return redirect('/carrera?estado=0')->with('mensaje','Nuevo registro activo');
  }
}
    }
}
