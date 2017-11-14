<?php

namespace App\Http\Middleware;

use Closure;

class Estudiante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(auth()->check()){
          switch (auth()->user()->tipo) {
              case '1':
                  return Redirect('/inicio');
                  break;

              case '2':
                  return Redirect('/inicio');
                  break;

              case '3':
                  //acceso estudiante
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
