<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class MarketingToolsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');  
    }
    public function index()
    {
    	// $membership_id = DB::table('member_table')->where('username', 'Lento')->first()->membershipid;
    	$membership_id = DB::table('member_table')->where('username', Auth::user()->username)->first()->membershipid;

    	return view('marketing.referrallink', ['username' => $membership_id]);
    }

    // //Custom Post
    // public function customPost(Request $request)
    // {
    // 	switch (key($_GET['shareTo'])) {
    // 		case 'ma':
	   //  		return redirect('mailto:?&subject='.$request->title.'&body='.$request->description .'%0A%0AFrom '.$request->author);
    // 			break;
    // 		case 'tw':
	   //  		return redirect('mailto:?&subject='.$request->title.'&body='.$request->description .'%0A%0AFrom '.$request->author);	
    // 			break;
    // 		case 'fb':
    // 			return redirect('https://facebook.com/sharer/sharer.php?u=')
    // 			# code...
    // 			break;
    // 		case 'gp':
    // 			# code...
    // 			break;
    // 		case 'ld':
    // 			# code...
    // 			break;
    // 		case 'wa':
    // 			# code...
    // 			break;
    // 	}
    // }
}
