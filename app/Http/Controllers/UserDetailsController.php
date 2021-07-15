<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class UserDetailsController extends Controller
{
    public function getUserDetails(Request $request){


        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];
            $userAccountDetails=DB::table('member_table as m')
                ->where('m.membershipid','=',$membershipid)
                ->get();
            return json_encode(['useraccountdetails'=>$userAccountDetails]);
        }catch (\Exception $e)
        {
            return response('error',400);
        }


    }
}
