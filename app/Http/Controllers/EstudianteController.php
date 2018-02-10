<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Bitacora;
use App\Enlace;
use App\Proyecto;
use App\Http\Requests\EstudianteRequest;
use App\Union;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$state = $request->get('estado');
      $nombre = $request->get('nombre');
      $estudiantes= User::buscarEstudiantes($nombre);
      return view('estudiantes.index',compact('estudiantes','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteRequest $request)
    {
      $proy=Proyecto::find($request['id_proy']);
      $proy->cantidad=$proy->cantidad+1;
      $proy->save();
      $nuevoe=User::create([
        'f_proyecto'=>$request['id_proy'],
        'name'=>$request['carne'],
        'nombre'=>$request['nombre'],
        'apellido'=>$request['apellido'],
        'tipo'=>'3',
        'password'=>bcrypt($proy->n_acuerdo),
      ]);
      Union::create([
        'f_estudiante'=>$nuevoe->id,
        'f_proyecto'=>$request['id_proy'],
      ]);
      Bitacora::bitacora('Nuevo estudiante agregado, carné: '.$request['carne']);
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
        $est=User::find($id);

        return view('estudiantes.show',compact('est'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $estudiante=User::find($id);
      $estudiante->carne=$estudiante->name;
      return view('estudiantes.edit',compact('estudiante'));
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
        $est=User::find($id);
        $cc=0;
        $carnea=$est->name;
        if($request['carne']!=$est['name']){
          $cc=1;
          $val['carne']='required|min:7|max:7|unique:users,name';
        }
        $val['nombre']='required|min:3|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/';
        $val['apellido']='required|min:3|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*)+$/';
        //$val['f_carrera']='integer|required|not_in:0';

        $m['carne.required']='El campo carné es obligatorio';
        $m['carne.min']='El campo carné debe contener 7 caracteres mínimo';
        $m['carne.max']='El campo carné debe contener 7 caracteres máximo';
        $m['carne.unique']='Carné registrado, ingrese otro';
        $m['nombre.required']='El campo nombre es obligatorio';
        $m['nombre.min']='El campo nombre debe contener 3 caracteres mínimo';
        $m['nombre.regex']='El campo nombre requiere solamente letras';
        $m['apellido.required']='El campo apellido es obligatorio';
        $m['apellido.min']='El campo apellido debe contener 3 caracteres mínimo';
        $m['apellido.regex']='El campo apellido requiere solamente letras';
      //  $m['f_carrera.required']='El campo carrera es obligatorio';
      //  $m['f_carrera.not_in']='Seleccione una opción válida';



        if($request['carne']==$est['name'] && $request['nombre']==$est['nombre'] && $request['apellido']==$est['apellido']){
          return redirect('/estudiante')->with('mensaje','No hay cambios');
        }else{
          $this->validate($request,$val,$m);
          $est->fill($request->all());
          $est->name=$request->carne;
          $est->save();
          Bitacora::bitacora('Estudiante editado carné: '.$request['carne']);
          return redirect('/estudiante/')->with('mensaje','Registro actualizado');
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

    }
}
