<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AccessAdmin
{
 /**
  * Check if the incoming request has a user allowed to access admin
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle(Request $request, Closure $next)
  {
    if (Gate::allows('access-admin')) {
      return $next($request);
    }
    
    return redirect()->route('home');
  }
}
