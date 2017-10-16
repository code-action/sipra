<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
  public function handle($request, Closure $next)
  {   if(auth()->check()){
      switch (auth()->user()->tipo) {
          case '1':
              //Acceso administrador
              break;

          case '2':
              return Redirect('/inicio');
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
