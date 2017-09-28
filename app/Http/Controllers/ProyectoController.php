<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proyecto;
use App\Http\Requests\ProyectoRequest;
use App\Documento;
use App\Enlace;


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
        $documentos=Documento::where('f_proyecto',"=",$id)->get();
        foreach($documentos as $d){
          Documento::destroy($d->id);
        }
        $enlaces=Enlace::where('f_proyecto',"=",$id)->get();
        foreach($enlaces as $e){
          Enlace::destroy($e->id);
        }
        Proyecto::destroy($id);
        return redirect('/proyecto')->with('mensaje','Proyecto eliminado');

    }
}
