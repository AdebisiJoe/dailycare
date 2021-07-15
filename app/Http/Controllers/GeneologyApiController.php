<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use DB;
use Auth;
use Response;

class GeneologyApiController extends Controller
{

    private $userController;

    function __construct(){
        $this->middleware('jwt.auth');
        $this->userController = new UserController();
    }


    /**
    *  @return json Returns all user profile information
    */
    public function getUserGeneology()
    {
        try{
			$customerusername = Auth::user()->username;

			$membershipid = DB::table('member_table')->where('username', '=', $customerusername)->first()->membershipid;
			
			$data = $this->userController->drawtree2($membershipid);

			return Response::make($data, 200);

            // return Response::json([
            //     'data' => $data
            // ],200);

        }catch (\Exception $e) {
            return response('error',400);
        }
    }
}

