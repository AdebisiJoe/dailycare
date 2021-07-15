<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\galleryImages;

class WebsitePagesController extends Controller
{
    //

 public  function gotowebsitehome () {
 	//$results=(new NotificationController)->getpushednotification();

       	//foreach ($results as $value) {
    		# code...
    	// $message="<p>".$value->content."</p>";	
    	//}
    
   // $request->session()->put('notificationmessage',$message);


    //$galleryImages=galleryImages::where('gallery_id',5)->get();


    return view('website.index');//->with(['galleryimages'=>$galleryImages]);
  }

 
}
