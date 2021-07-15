<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\websitecontroller;
use App\Http\Controllers\accountcontroller;
use App\Http\Controllers\RegistrationController;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Response;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Members;
use App\User;


class RegistrationApiController extends Controller
{


    private $websiteController;
    private $accountController;
    private $registrationController;
    public function __construct(){
        $this->websiteController = new websitecontroller();
        $this->accountController = new accountcontroller();
        $this->registrationController = new RegistrationController();
   }

    public function registerUser(Request $request)
    {

        $checkifpinisused = $this->registrationController->checkifpinisused($request->registrationpin,$request->membershipid);
        if ($checkifpinisused == "used") {
          # code...
            return Response::json([
               'data' => [
                  'error' => 'The pin you entered is either USED, INVALID or the PIN Membership ID is incorrect.'
               ]
            ],400);
        }


        $availability = $this->websiteController->checkusernameavailability($request->username);
        if ($availability == "available") {
# code...

            return Response::json([
                'data' => [
                    'error' => 'The username you entered is in use already'
                ]
            ],400);

        }

        $parentid = $request->parentid;
        $sponsorid = $request->reffererid;
        $pin = $request->registrationpin;

        $availability2 = $this->websiteController->checkreferreridavailability($sponsorid);
        $availability3 = $this->websiteController->checkparentidavailability($parentid);
        if ($availability2 == "notavailable") {


            return Response::json([
                'data' => [
                    'error' => 'The Referrer Id you entered is not available'
                ]
            ],400);

        }
        if ($availability3 == "notavailable") {

            return Response::json([
                'data' => [
                    'error' => 'The Parent Id you entered is not available'
                ]
            ],400);

        }

//=====================================================================
//     VALIDATION ADDED @ 17-APR-207
//=====================================================================

// =====================================================================
//validate the Request through the validation rules
        $validator = Validator::make($request->all(),
            [
                'username' => 'required|unique:member_table|alpha_num|max:255|min:4',
                'firstname' => 'required|alpha',
                'lastname' => 'required|alpha',
                'phonenumber' => 'required',
                'sex' => 'required',
                'dob' => 'required',
                'accountnumber' => 'required|numeric',
                'password' => 'required|min:4',
                'transactionpass' => 'required|min:4',
                'place' => 'required',
            ]);
//take actions when the validation has failed
        if ($validator->fails()) {

            return Response::json([
                'data' => [
                'error'=>$validator->errors()->getMessages()

                    ]
            ],400);

           // return response()->json($validator->errors()->messages(), 200);

        }


        $member = new members;
        $user = new User;

        $todaysdate = date("Y-m-d");
        $userid = $this->registrationController->getusermembershipid($pin);
        $this->accountController->payforreferral($sponsorid);
        $place = $request->place;
        $freepositionwithplace = $this->websiteController->getfreepositionwithplace($parentid, $place);
        $realparent = $freepositionwithplace["parent"];
        $realposition = $freepositionwithplace["position"];

//set the pin to used
        $this->registrationController->setpintoused($request->registrationpin);

        $this->websiteController->setparentchildren($realparent);
        $member->membershipid = $userid;
        $member->username = $request->username;
        $member->sponsorid = $sponsorid;
        $member->parentid = $realparent;

        $member->registrationpin = $pin;
        $member->position = $realposition;
        $member->stage = 0;
        $member->firstname = $request->firstname;
        $member->middlename = $request->middlename;
        $member->lastname = $request->lastname;
        $member->phonenumber = $request->phonenumber;
        $member->sex = $request->sex;
        $member->dob = $request->dob;


        $member->country = 0;
        $member->state = $request->state;
        $member->city = 0;
        $member->address = 0;
        $member->children = 0;
        $member->accountname = 0;
        $member->accountnumber = $request->accountnumber;

        $member->bankname = 0;
        $member->bankbranch = 0;
        $member->numberofsubaccounts = 0;
        $member->type = 'main';
        $member->isownedby = $userid;
        $member->joindate = date('Y-m-d');

        $member->email = 0;
        $member->password = \Hash::make($request->password);
        $member->role = 'user';
        $member->transactionpass = $request->transactionpass;

        $member->save();

        $user->name = $request->firstname;
        $user->email = 0;
        $user->username = $request->username;
        $user->password = \Hash::make($request->password);
        $user->role = 'user';
        $user->transactionpass = $request->transactionpass;
        $user->save();

        $this->websiteController->create2('"' . $realparent . '"', '"' . $userid . '"');//create relation table data
        $this->websiteController->creatematrix($userid, 0);
        $this->accountController->addtocurrentamount($userid, 0, 0);
        $username = $request->username;

        $credentials = [
            'username' => $username,
            'password' => $request->password,

        ];

        //on success return login credentials

      //  return Response::json([
        //    'data'=>$credentials
       // ],200);

        $token=$this->loginInUserIfRegistrationIsSuccessful($credentials);


        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));

        return Response::json([
            'data' => [
                'token'=>$token,
                'success'=>'Your Registration was Successful'
            ]
        ],200);

    }

    public function loginInUserIfRegistrationIsSuccessful(array $credentials){
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return $token;
    }

    public function addAccount(Request $request){



        $checkifpinisused=$this->registrationController->checkifpinisused($request->registrationpin,$request->membershipid);


        if ($checkifpinisused == "used") {
            # code...
            return Response::json([
                'data' => [
                    'error' => 'The pin you entered is either USED, INVALID or the PIN Membership ID is incorrect.'
                ]
            ],400);
        }

        $websitecontroller=new websitecontroller();
        $accountcontroller=new accountcontroller();
        $member = new members;
        $user = new User;


        $todaysdate = date("Y-m-d");
//$parenusername=$parentusername;

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        $username=$user->username;
       // $username=Auth::user()->username;

        $validator=Validator::make($request->all(),
            [
                'registrationpin'=>'required',
                'place'=>'required',
            ]);
//take actions when the validation has failed
        if ($validator->fails()){


            return Response::json([
                'error'=>$validator->errors()->getMessages()
            ],400);
        }

        $pin =$request->registrationpin;

        $results=DB::table('member_table')
            ->where('username','=',$username)
            ->get();
        foreach ($results as $key => $v) {
# code...
//$username=$v->username;
// $membershipid =$v->membershipid;
//$username =$v->username;
            $sponsorid=$v->membershipid;
            $parentid=$v->membershipid;
// $member->parentid=$realparent;

//$position =$realposition ;
//$member->position = $request->realposition;
            $stage=0;
//$member->datejoined = $todaysdate;
// $member->uniqueid = $uniqueid;


            $firstname =$v->firstname;
            $middlename =$v->middlename;
            $lastname = $v->lastname;
            $phonenumber= $v->phonenumber;
            $sex = $v->sex;
            $dob =$v->dob;
// $mlmusersrecords->email = $request->email;

            $country = 0;
            $state =$v->state;
            $city = 0;
            $address =0;
            $children =0;
// $mlmusersrecords->transactionpass = $request->transactionpass;
            $accountname =0;
            $accountnumber = $v->accountnumber;
            $bankname =0;
            $bankbranch = 0;

        }
        $numberofsubaccounts=$this->registrationController->getsubaccounts($username);
        $numberofsubaccounts=$numberofsubaccounts+1;

        $username1=$username.$numberofsubaccounts;
//check if username already exists if yes edit it add a count to it

        $availability=$this->registrationController->checkusernameavailabilitycount($username1);
        if ($availability>0) {
            $username1=$username1.$availability+1;
        }

        $userid=$this->registrationController->getusermembershipid($pin);



        $this->accountController->payforreferral($parentid);




        $place=$request->place;
        $freepositionwithplace=$this->websiteController->getfreepositionwithplace($parentid,$place);

        $realparent=$freepositionwithplace["parent"];
        $realposition=$freepositionwithplace["position"];


        $this->registrationController->setpintoused($pin);
//$lavel=1;
//$sponsorid=$websitecontroller->getid( $reffererusername);
        $this->websiteController->setparentchildren($realparent);
        $member->membershipid =$userid;
        $member->username =$username1;
        $member->sponsorid=$sponsorid;
        $member->parentid=$realparent;
// $member->parentid=$realparent;
        $member->registrationpin = $pin;
        $member->position =$realposition ;
//$member->position = $request->realposition;
        $member->stage=0;
//$member->datejoined = $todaysdate;
// $member->uniqueid = $uniqueid;


        $member->firstname = $firstname;
        $member->middlename = $middlename;
        $member->lastname = $lastname;
        $member->phonenumber= $phonenumber;
        $member->sex = $sex;
        $member->dob = $dob;
// $mlmusersrecords->email = $request->email;

        $member->country = 0;
        $member->state =$state;
        $member->city = 0;
        $member->address =0;
        $member->children =0;
// $mlmusersrecords->transactionpass = $request->transactionpass;
        $member->accountname =0;
        $member->accountnumber = $accountnumber;
        $member->bankname =0;
        $member->bankbranch = 0;
        $member->type = 'subaccount';
        $member->isownedby =$sponsorid;
        $member->joindate =date('Y-m-d');


        $member->save();
        $this->registrationController->setsubaccounts($username);

// $user->role =$request->username;

        $this->websiteController->create2('"'.$realparent.'"','"'.$userid.'"');//create relation table data
        $this->websiteController->creatematrix($userid,0);
        $this->accountController->addtocurrentamount($userid,0,0);




         return Response::json([
             'data'=>[
                 'success'=>'you have added a new account successfully'
             ]
         ],200);


    }

    public function checkIfMembershipIdExist(Request $request){

        $membershipid=$request->membershipid;

        $total = DB::table('member_table')
            ->where('membershipid', '=', $membershipid)
            ->count();
        $results = DB::table('member_table')
            ->where('membershipid', '=', $membershipid)
            ->get();
        $data = "";
        if ($total > 0) {

            foreach ($results as $key => $value) {
                $memberid = $value->membershipid;
                $firstname = $value->firstname;
                $lastname = $value->lastname;
            }

            $userData=["availability" => "available", "firstname" => $firstname, "lastname" => $lastname];

            return Response::json([
                'data'=>$userData
            ],200);



        } else {


            return Response::json([
                'data'=>["availability" => "not-available"]
            ],400);
        }

    }


    public  function checkUsernameAvailability(Request $request)
    {
        $username = $request->username;

        $total = DB::table('member_table')
            ->where('username', '=', $username)
            ->count();
        $data = "";
        if ($total > 0) {
            // $data.="<img src='{{asset('images/availableimg/not-available.png') }}'/>";
            return response()->json(["availability" => "not-available"]);

        } else {
            // $data.="<img src='{{asset('images/availableimg/available.png') }}'/>";
            return response()->json(["availability" => "available"]);
        }
    }
}
