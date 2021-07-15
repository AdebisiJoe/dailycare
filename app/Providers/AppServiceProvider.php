<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    //    view()->composer('layouts.app',function($view){
    //        $ticketController=new TicketsController();
    //        $view->with('userMessageCount',$ticketController->countUserMessages());
    //    });

    //    view()->composer('layouts.app',function($view){
    //        $ticketController=new TicketsController();
    //        $view->with('userMessages',$ticketController->returnUserMessages());
    //    });

    //    view()->composer('layouts.app',function($view){
    //        $userController=new UserController();
    //        $view->with('userJoinDate',$userController->getJoinDate());
    //    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
