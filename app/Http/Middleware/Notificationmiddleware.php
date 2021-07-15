<?php

namespace App\Http\Middleware;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Closure;

class Notificationmiddleware
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

    $results=(new NotificationController)->getpushednotification();
        $message='';
        foreach ($results as $value) {
            # code...
         $message.="$value->content";; 

        }
    
   $request->session()->put('notificationmessage',$message);



        return $next($request);
    }
}
