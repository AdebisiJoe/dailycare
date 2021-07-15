<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;

use DB;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;


class adminlock
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
        $value = $request->session()->get('openadmin',false);
         if($value==false){
            return redirect()->intended('/home');
         }
        
   return $next($request);
    }
}
