<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DbFunctionsController extends Controller
{
    public function UpdateMemberTableWithNewValues(){

    	$members=DB::table('member_table')->where('type','main')->get();

    	foreach ($members as $member) {
    		$username=$member->username;
    		$result=DB::table('users')->where('username',$username)->first();
    		//dd($result);
    		//dd($result->email);
    		$email=$result->email;
    		$password=$result->password;
    		$role=$result->role;
    		$profileimage=$result->profileimage;
    		$transactionpass=$result->transactionpass;
    		$banned=$result->banned;
    		$banned_date=$result->banned_date;
    		$remember_token=$result->remember_token;
    		$created_at=$result->created_at;
    		$updated_at=$result->updated_at;
            
            DB::table('member_table')->where('username', $username)
            ->update(['email' => $email,'password' => $password,'role' => $role,'profileimage' => $profileimage,'transactionpass' => $transactionpass,'banned' => $banned,'banned_date' => $banned_date,'remember_token' => $remember_token,'created_at' => $created_at,'updated_at' => $updated_at]);

    	}

    	return "done";
    }
}
