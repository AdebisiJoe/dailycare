<?php

namespace App\Http\Middleware;

use Closure;

class BonusCalculator
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
     $value = $request->session()->get('calculatebonus',false);
     $value2=$request->session()->get('calculatedownlines',false);
         if($value==true||$value2==true){

            return json_encode(["done"=>"done"]);
         }
        
      return $next($request);
    }
}
