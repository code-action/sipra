<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\ManualRequest;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proyectos.create');
    }
    public function create()
    {
        return view('manual');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManualRequest $request)
    {

      \File::delete(public_path('archivos/manual/manual.pdf'));

      $request->file('archivo')->storeAs('manual','manual.pdf');
    }

    public function ayuda($n){
      return view('ayudas.eym',compact('n'));
    }

}
