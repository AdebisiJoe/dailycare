<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\DB;

class SubaccountApiController extends Controller
{


    function __construct(){
        $this->middleware('jwt.auth');
    }

    public function getSubAccounts(Request $request){
        $mainAccountId=$request->mainaccountid;

        $results=DB::table('member_table as me')
            ->leftJoin('mlm_groups as ml', 'me.membershipid', '=', 'ml.owner_id')
            ->where('isownedby','=',$mainAccountId)
            ->where('type','=','subaccount')
            ->get();

        return Response::json([
            'data'=>$results
        ],200);
    }
}
