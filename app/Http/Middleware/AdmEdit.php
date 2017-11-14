<?php

namespace App\Http\Middleware;

use Closure;

class AdmEdit
{

  public function handle($request, Closure $next)
  {   if(auth()->check()){
      switch (auth()->user()->tipo) {
          case '1':
              //Acceso administrador
              break;

          case '2':
              //Acceso editor
              break;
          case '3':
              return Redirect('/accesoEstudiante');
              break;

          default:
              return Redirect('/'); //aqui
              break;
      }
      return $next($request);
  }else{
    return Redirect('/');
  }
  }
}
