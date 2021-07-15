<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

use DB;

class GenealogyApiController extends Controller
{
    function __construct(){
        $this->middleware('jwt.auth');
        $this->userController=new UserController();
        $this->accountcontroller=new accountcontroller();
    }


    public function getMatrixMembers(Request $request)
    {
        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];
            $matrix_id=$this->userController->getusermatrix($membershipid);


            $result2 = DB::table('matrix_users')->leftJoin('member_table','member_table.membershipid','=','matrix_users.user_id')->select('matrix_users.position','member_table.firstname','member_table.middlename','member_table.lastname','member_table.username','member_table.phonenumber','member_table.stage','member_table.membershipid')->where('matrix_users.matrix_id', $matrix_id)->orderBy('matrix_users.user_id','DESC')->orderBy('matrix_users.position','ASC')->get();

            return json_encode(['matrixMembers'=>$result2]);

        }catch(\Exception $e){
            return response('error',400);
        }

    }


}