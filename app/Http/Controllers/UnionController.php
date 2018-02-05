<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function ayuda($n){
      return view('ayudas.eym',compact('n'));
    }
}
