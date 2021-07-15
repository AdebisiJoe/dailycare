<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Auth;
use DB;


class MatrixApiController extends Controller
{
    function __construct(){
        $this->middleware('jwt.auth');
        $this->userController = new UserController();

    }

    public function matrixTree(){

        $username = Auth::user()->username;

        $customerusername=Auth::user()->username;
        $results = DB::table('member_table')
            ->where('username', '=', $customerusername)
            ->get();
        foreach ($results as $key => $v) {
            # code...
            $membershipid=$v->membershipid;
            $stage=$v->stage;
        }

        $members = DB::table('member_table as m')
            ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
            ->where('t.ancestor', '=', $membershipid)
            ->where('m.stage', '=',$stage)
            ->paginate(10);



        $data="";
        $data.=$this->userController->drawtree2($membershipid);





        return view('webview.matrixtree')->with(['data'=>$data]);
    }
}
