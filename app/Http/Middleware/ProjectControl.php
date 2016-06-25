<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectControl extends Validator
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
         if(Auth::user()->role->name == "Eleve") {
             if (Auth::user()->projects()->find($request->id)) {
                 return $next($request);
             } else {
                 echo "Pas de permission";
             }
         }else{
             return $next($request);
         }
    }
}
