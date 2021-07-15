<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class LockScreenController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function gotoaccount(Request $request){
    if(\Auth::check()){
      
      $value = $request->session()->get('locked');
      if($value==true){
         return redirect()->intended('/accountdashboard');
      }else{
            $username=\Auth::user()->username;
            $results = DB::table('users')
            ->where('username', '=', $username)
            ->get();
            foreach ($results as $key => $v) {

             $transactionpass = $v->transactionpass;
           }

           if($transactionpass==$request->input('transactionpass')){
            $request->session()->put('locked',true);
            return redirect()->intended('/accountdashboard');
              
           }else {
           	Session::flash('flash_error','something went wrong with your credentials');
           	return redirect()->intended('/showlock');
              
           }
        
        }
    }


    }


public function showlock(Request $request){
    if(\Auth::check()){
      
      $value = $request->session()->get('locked');
      if($value==true){
         return redirect()->intended('/accountdashboard');
      }else{

        return view('account.lock');
          }

        }
}

    public function showaccount(){
        return view('account.accountmaster'); 
    }
}

