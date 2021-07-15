<?php

namespace App\Http\Middleware;

use Closure;

class shopadminlock
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
$value = $request->session()->get('openshopadmin',false);
         if($value==false){
            return redirect()->intended('/home');
         }
        
      return $next($request);
    }
}
