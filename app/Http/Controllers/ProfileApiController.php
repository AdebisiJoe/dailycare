<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\accountcontroller;
use App\Http\Controllers\FoodCollectionController;
use DB;
use Auth;
use Response;
use Illuminate\Support\Facades\Hash;
use App\Members;
use App\User;

class ProfileApiController extends Controller
{

    private $userController;
    private $member;
    private $user;

    function __construct(){
        $this->middleware('jwt.auth');
        $this->userController = new UserController();
        $this->member = new Members();
        $this->user = new User();
    }


    /**
    *  @return json Returns all user profile information
    */
    public function getUserProfileInformation()
    {
        
        try{
            $username = Auth::user()->username;
    
            $records = DB::table('users as u')
            ->join('member_table as m', 'u.username', '=', 'm.username')
            ->select('u.*','m.*','u.id as idforuser','m.id as idformember')
            ->where('u.username','=',$username)
            ->first();

            return Response::json([
                'data' => $records
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * @return Response Stores New User Information
     */
    public function storeUserProfileInformation(Request $request)
    {
        try {
            // Fetch the user information using the username
            $username = Auth::user()->username;
            $result = DB::table('member_table')->where('username','=',$username)->first();

            // Get ID od the User
            $idformember=$result->id;

            // Update user information in users table
            $user = $this->user::find(Auth::user()->id);
            $user->email = $request->email;
            $user->name = $request->firstname;
            $user->save();

            // Update user information in members table
            $member = $this->member::find($idformember);
            $member->firstname = $request->firstname;
            $member->middlename = $request->middlename;
            $member->lastname = $request->lastname;
            $member->phonenumber= $request->phonenumber;
            $member->dob=$request->dob;
            $member->state =$request->state;
            $member->city =$request->city;
            $member->country =$request->country;
            $member->address =$request->address;

            $member->save();

            return Response::json([
                'data' => 'success'
            ],200);

        } catch (\Exception $e) {
            return Response::json([
                'data' => 'error'
            ],400);
        }
    }


    public function storeNewPasswordInformation(Request $request)
    {
        try {
            if ($this->userController->checkifpasswordexistforuser($request->oldpassword) == false) {

                return Response::json([
                    'data' => 'Incorrect old password'
                ],200);
            }else{
                $newpassword = $request->newpassword;

                $confirmnewpassword = $request->confirmnewpassword;

                if ($newpassword == $confirmnewpassword) {
                    $userid = Auth::user()->id;
                    $newpassword = Hash::make($newpassword);
                    DB::table('users')->where('id',$userid)->update(['password'=>$newpassword]);
                    return Response::json([
                        'data' => 'Password has been changed.'
                    ],200);
                }
                else {
                    return Response::json([
                        'data' => 'Password does not match please confirm password.'
                    ],200);
                }
            }
        } catch (\Exception $e) {
            return Response::json([
                'data' => 'error'
            ],400);
        }
    }

    
    public function storeNewBankInformation(Request $request)
    {
        try {
            $username = Auth::user()->username;

            $result = DB::table('member_table')->where('username','=',$username)->first();

            $idformember=$result->id;

            $member =  $this->member::find($idformember);

            $member->accountname =$request->accountname;
            $member->accountnumber = $request->accountnumber;
            $member->bankname =$request->bankname;
            $member->bankbranch =$request->bankbranch;
            $member->save();

            return Response::json([
                'data' => 'success'
            ],200);

        } catch (\Exception $e) {
            return Response::json([
                'data' => 'error'
            ],400);
        }
    }
}
