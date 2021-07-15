<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Session;

class NotificationController extends Controller
{

	//Check if user is logged in
	public function __construct() {
		$this->middleware('auth');
	}

	public function all()
	{
		return DB::table('mlm_notification')
			->where('deleted', 0)
			->get();
	}

	public function find($id)
	{
		$results = DB::table('mlm_notification')
			->where('id', $id)
			->where('deleted', 0)
			->first();

    	return view('notification.edit', ['results'=> $results]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
	        'title' => 'required|unique:mlm_notification',
	        'content' => 'required',
        ]);
			// title 	content 	created_by 	created_at 	updated_at 	updated_by 	deleted_at 	deleted_by 	published 	deleted 
		DB::table('mlm_notification')
			 ->insert(
			 	[
				    'title' => $request->title,
				    'content' => $request->content,
				    'created_at' => date('Y-m-d h:i:s'),
				    'created_by' => Auth::user()->username,
				    'published' => $request->published,
			 	]
			);
    	$results = self::all();
    	return view('notification.index', ['results'=> $results]);
	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'id' => 'required',
	        'title' => 'required',
	        'content' => 'required',
        ]);

		if(DB::table('mlm_notification')
			->where('id', $request->id)
			->update(
			 	[
				    'title' => $request->title,
				    'content' => $request->content,
				    'updated_at' => date('Y-m-d h:i:s'),
				    'updated_by' => Auth::user()->username,
				    'published' => $request->published,
			 	]
			)){

    	$results = self::all();
    	return view('notification.index', ['results'=> $results]);
		}
	}

	public function delete($id)
	{
		DB::table('mlm_notification')
			->where('id', $id)
			->update([
				'deleted'	 => 1,
			    'deleted_at' => date('Y-m-d h:i:s'),
			    'deleted_by' => Auth::user()->username,
				]);
    	
    	$results = self::all();
    	return view('notification.index', ['results'=> $results]);
	}

    public function getAllNotifications()
    {
    	$results = self::all();
    	return view('notification.index', ['results'=> $results]);
    }

    public function getpushednotification(){
    	$results = self::all();


     return $results;
    }

}
