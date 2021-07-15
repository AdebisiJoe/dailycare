<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Training;
use App\Event;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    

    public function registerForEvent(Request $request){
     $validator=Validator::make($request->all(),
	[
	'membershipid'=>'required',
	'noofpins'=>'required'
	]);
	 
	//take actions when the validation has failed
	if ($validator->fails()){
	  return redirect('/training')
	  ->withErrors($validator)
	  ->withInput();
	} 

	$event = new Event;
	$event->name =$request->name;
	$event->noofpins =$request->noofpins;
	
	$event->save();
    }

    public function generateCode(){

	}
	
	public function showTrainingPage(){
		return view();
	}

    public function registerForTraining(Request $request){

     try{
       //validate the Request through the validation rules
	$validator=Validator::make($request->all(),
	[
	'name'=>'required',
	'sex'=>'required',
	'programme'=>'required',
	'email'=>'required',
	'phonenumber'=>'required',
	'country'=>'required',
	'state'=>'required'
	]);
	 
	//take actions when the validation has failed
	if ($validator->fails()){
	  return redirect('/training')
	  ->withErrors($validator)
	  ->withInput();
	} 

	$training = new Training;
	$training->name =$request->name;
	$training->sex =$request->sex;
	$training->programme =$request->programme;
	$training->email =$request->email;
	$training->phonenumber =$request->phonenumber;
	$training->country =$request->country;
	$training->state =$request->state;
	$training->save();
	Session::flash('flash_success','You have registered for the Training Successfully we would contact you shortly');
	return redirect()->intended('/training');
   }catch(PDOException $e){
    DB::rollback();
	$validator="Something went wrong with this registration. Please contact the support department.";
	return redirect('/training')
			->withErrors($validator)
			->withInput();
   }

    }

    public function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	$str = '';
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
	$str .= $keyspace[random_int(0, $max)];
	}

	return mb_strtoupper($str, 'UTF-8');
	}




}
