<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Members;
use App\Totalreg;
use App\User;
use App\Item;
use App\Mlmlevel;
use App\Mlmrecords;
use App\matrix_users;
use App\matrix;
use App\matrix_type;
use App\Generatepin;
use App\node;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\websitecontroller;
use App\Http\Controllers\StageThreePinController;

use App\GraphDB\MySQLToGraphDB;

class RegistrationController extends Controller
{

    private $graphdb;

    function __construct (){
        $this->graphdb=new MySQLToGraphDB();
    }

    public function testRegistration(){

     //HW00016003R

        $parentid="HW00016001";
        $place="L";
        $sponsorid="HW00016001";
        $username="mrtesteo";
        $userid="HW11113111";

     $freepositionwithplace=$this->graphdb->getfreepositionwithplace2($parentid,$place);
        $realparent=strtoupper($freepositionwithplace["parent"]);
        $realposition=$freepositionwithplace["position"];

        return $realparent.$realposition;

     // $data = ["stage" => '0', "children"=>'0', "sponsorID"=>$sponsorid, "position"=>$realposition,"membershipID"=>$userid, "userName"=>$username, "parentID"=>$realparent];

     //    $this->graphdb->create2($data);

     //    return "done";
    }


    public function submitreg(Request $request) {
        
        $stagethreepin = new StageThreePinController();
        $continueReg = $stagethreepin->checkIfPinIsStageThreePIN($request, $request->membershipid, $request->reffererid);
       
        // return "Registration is currently unavailable please try again later.";
        if($continueReg != 10){
            
            $validator = "You cannot use a stage 3 pin outside the matrix of the owner. Please contact the support department.";
            return redirect('/join-now')->withErrors($validator)->withInput();

        }else {
            try {

                DB::beginTransaction();

        $websitecontroller=new websitecontroller();
        $accountcontroller=new accountcontroller();

    $checkifpinisused=$this->checkifpinisused($request->registrationpin,$request->membershipid);
    if ($checkifpinisused=="used") {
# code...
      $validator="The pin you entered is either USED, INVALID or the PIN's Membership ID is incorrect.";
      return redirect('/join-now')
      ->withErrors($validator)
      ->withInput();
    }

    $availability=$websitecontroller->checkusernameavailability($request->username);
    if ($availability=="available") {
# code...
      $validator="please the username you entered is in use already";
      return redirect('/join-now')
      ->withErrors($validator)
      ->withInput();

    }


//here we assign a person who registering without entering the parent username and refferer username a parent
//$parentusername=$request->parentusername;
//$reffererusername=$request->reffererusername;
// $parentid=$websitecontroller->getid($request->parentusername);
//$sponsorid=$websitecontroller->getid( $request->reffererusername);

        $parentid=strtoupper($request->reffererid);
        $sponsorid=strtoupper($request->reffererid);
        $pin=$request->registrationpin;

        $availability2=$websitecontroller->checkreferreridavailability($sponsorid);
        $availability3=$websitecontroller->checkparentidavailability($parentid);
        if ($availability2=="notavailable") {
# code...
            $validator="please the Referrer Id you entered is not available";
            return redirect('/join-now')
                ->withErrors($validator)
                ->withInput();

        }
        if ($availability3=="notavailable") {
# code...
            $validator="please the Parent Id you entered is not available";
            return redirect('/join-now')
                ->withErrors($validator)
                ->withInput();

        }

//=====================================================================
//     VALIDATION ADDED @ 17-APR-207
//=====================================================================

// =====================================================================
//validate the Request through the validation rules


    $validator=Validator::make($request->all(),
  [
  'username' => 'required|unique:member_table|alpha_num|max:255|min:4',
  'firstname'=>'required|alpha',
  'lastname'=>'required|alpha',
  'phonenumber'=>'required',
  'password'=>'required|min:4',
  'place'=>'required',
  'country'=>'required',
  'state'=>'required',
  //'email'=>'required|email|unique:member_table',
  'email' =>'required'
  ]);
//take actions when the validation has failed
if ($validator->fails()){
  return redirect('/join-now')
  ->withErrors($validator)
  ->withInput();
}




        $member = new members;
        $user = new User;
        $mlmusersrecords = new Mlmrecords;
        $matrix_type=new matrix_type;
        $matrix=new matrix;
        $todaysdate = date("Y-m-d");
//$parenusername=$parentusername;

//$parentid2=$this->getrealparent($parentid);
//$position=$this->getfreeposition($parentid);getusermembershipid($pin)
//$userid=$websitecontroller->getuniqueid();
        $userid=strtoupper($this->getusermembershipid($pin));

//$parentid=$request->parentid;

//not used again
//$freeposition=$websitecontroller->getfreeposition($parentid);
//$realparent=$freeposition["parent"];
//$realposition=$freeposition["position"];

        $place=$request->place;


//        $freepositionwithplace=$websitecontroller->getfreepositionwithplace($parentid,$place);
//        $realparent=$freepositionwithplace["parent"];
//        $realposition=$freepositionwithplace["position"];

        //new

        $freepositionwithplace=$this->graphdb->getfreepositionwithplace($parentid,$place);
        $realparent=strtoupper($freepositionwithplace["parent"]);
        $realposition=$freepositionwithplace["position"];



        $member->membershipid =$userid;
        $member->username =$request->username;
        $member->sponsorid=$sponsorid;
        $member->parentid=$realparent;
// $member->parentid=$realparent;
        $member->registrationpin = $pin;
        $member->position =$realposition ;
//$member->position = $request->realposition;
        $member->stage=0;
//$member->datejoined = $todaysdate;
// $member->uniqueid = $uniqueid;


        $member->firstname = $request->firstname;
        $member->middlename = $request->middlename;
        $member->lastname = $request->lastname;
        $member->phonenumber= $request->phonenumber;
        $member->sex = $request->sex;
        $member->dob = $request->dob;
// $mlmusersrecords->email = $request->email;

        $member->country =$request->country;
        $member->state =$request->state;
        $member->city = 0;
        $member->address =0;
        $member->children =0;
// $mlmusersrecords->transactionpass = $request->transactionpass;
        $member->accountname =0;
        $member->accountnumber = $request->accountnumber;

        $member->bankname =0;
        $member->bankbranch = 0;
        $member->numberofsubaccounts= 0;
        $member->type = 'main';
        $member->isownedby =$userid;
        $member->joindate =date('Y-m-d');

        $member->email = 0;
        $member->password = \Hash::make($request->password);
        $member->role ='user';
        $member->transactionpass = $request->transactionpass;

        $member->save();


        //Graph db getfreepositionwithplace

        $row_id=$member->id;

       $joindate =date('Y-m-d');

        $data = ["stage" => '0', "children"=>'0', "sponsorID"=>$sponsorid, "position"=>$realposition, "membershipID"=>$userid, "userName"=>$request->username, "parentID"=>$realparent,"noofReferred"=>'0',"rowID"=>$row_id,"joinDate"=>$joindate];

        $this->graphdb->create2($data);

        // Pay for referral
        $accountcontroller->payforreferral($sponsorid);

            $sponsorCount=DB::table('member_table')
            ->where('sponsorid','=',$sponsorid)
            ->count();

         if($sponsorCount<=0||$sponsorCount==null){
            $sponsorCount=0;
         } 


        $this->graphdb->updatenoofReferred($sponsorid,$sponsorCount);

        //set the pin to used
        $this->setpintoused($request->registrationpin);


        

        $websitecontroller->setparentchildren($realparent);
        

        //Graph db set parent children

        $this->graphdb->setparentchildren($realparent);

        $user->name = $request->firstname;
        $user->email = 0;
        $user->username = $request->username;
        $user->password = \Hash::make($request->password);
        $user->role ='user';
// $user->role =$request->username;
        $user->transactionpass = $request->transactionpass;
        $user->save();

        //$websitecontroller->create2('"'.$realparent.'"','"'.$userid.'"');//create relation table data
        $websitecontroller->creatematrix($userid,0);
        (new accountcontroller)->addtocurrentamount($userid,0,0);
        $username=$request->username;

        // Commit Transaction
        DB::commit();


//}
//return redirect()->intended('/join-now');


        $login ='username';
// check login field
        $login_type =$login;

// merge our login field into the request with either email or username as key
//$request->merge([$login_type => $login ]);
        $credentials=[
            'username'=>$username,
            'password'=>$request->password,

        ];


        if (Auth::attempt($credentials)) {
            Session::flash('flash_success','you have created a new account and logged in sucessfully');
            return redirect()->intended('/home');
        } else {
            return redirect()->intended('/login');
        }
        } catch (PDOException $e) {
                DB::rollback();
                $validator="Something went wrong with this registration. Please contact the support department.";
                return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }



        }
    }

    public function addaccountregister(Request $request){
        
        // return "Registration is currently unavailable please try again later.";
        try {

     

        DB::beginTransaction();

        $checkifpinisused=$this->checkifpinisused($request->registrationpin,$request->membershipid);


        if ($checkifpinisused=="used") {
            $validator="The pin you entered is either USED, INVALID or the PIN's Membership ID is incorrect.";
            return redirect('/addaccount')
                ->withErrors($validator)
                ->withInput();
        }

        $websitecontroller=new websitecontroller();
        $accountcontroller=new accountcontroller();
        $member = new members;
        $user = new User;
        $mlmusersrecords = new Mlmrecords;
        $matrix_type=new matrix_type;
        $matrix=new matrix;
        $todaysdate = date("Y-m-d");
        $username=Auth::user()->username;

        $validator=Validator::make($request->all(),
            [
                'registrationpin'=>'required',
                'place'=>'required',
            ]);

//take actions when the validation has failed
        if ($validator->fails()){
            return redirect('/addaccount')
                ->withErrors($validator)
                ->withInput();
        }

        $pin =$request->registrationpin;

        $results=DB::table('member_table')
            ->where('username','=',$username)
            ->get();
        foreach ($results as $key => $v) {
            $sponsorid=strtoupper($v->membershipid);
            $parentid=strtoupper($v->membershipid);
            $stage=0;
            $firstname =$v->firstname;
            $middlename =$v->middlename;
            $lastname = $v->lastname;
            $phonenumber= $v->phonenumber;
            $sex = $v->sex;
            $dob =$v->dob;
            $country = 0;
            $state =$v->state;
            $city = 0;
            $address =0;
            $children =0;
            $accountname =0;
            $accountnumber = $v->accountnumber;
            $bankname =0;
            $bankbranch = 0;

        }
        $numberofsubaccounts=$this->getsubaccounts($username);
        $numberofsubaccounts=$numberofsubaccounts+1;

        $username1=$username.$numberofsubaccounts;
//check if username already exists if yes edit it add a count to it

        $availability=$this->checkusernameavailabilitycount($username1);
        if ($availability>0) {
            $username1=$username1.$availability+1;
        }

        $userid=strtoupper($this->getusermembershipid($pin));
//$parentid=$request->parentid;

        $accountcontroller->payforreferral($parentid);

        $sponsorCount=DB::table('member_table')
            ->where('sponsorid','=',$sponsorid)
            ->count();

         if($sponsorCount<=0||$sponsorCount==null){
            $sponsorCount=0;
         } 


        $this->graphdb->updatenoofReferred($sponsorid,$sponsorCount);
        /*$freeposition=$websitecontroller->getfreeposition($parentid);
        $realparent=$freeposition["parent"];
        $realposition=$freeposition["position"];*/


        $place=$request->place;

        //former
        //$freepositionwithplace=$websitecontroller->getfreepositionwithplace($parentid,$place);
        //new
        $freepositionwithplace=$this->graphdb->getfreepositionwithplace($parentid,$place);
        $realparent=strtoupper($freepositionwithplace["parent"]);
        $realposition=$freepositionwithplace["position"];

        $member->membershipid =$userid;
        $member->username =$username1;
        $member->sponsorid=$sponsorid;
        $member->parentid=$realparent;
        $member->registrationpin = $pin;
        $member->position =$realposition ;
        $member->stage=0;
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
        $member->accountname =0;
        $member->accountnumber = $accountnumber;
        $member->bankname =0;
        $member->bankbranch = 0;
        $member->type = 'subaccount';
        $member->isownedby =$sponsorid;
        $member->joindate =date('Y-m-d');


        $member->save();
         
         $row_id=$member->id;

        //graph db

        $joindate =date('Y-m-d');

        $data = ["stage" => '0', "children"=>'0', "sponsorID"=>$sponsorid, "position"=>$realposition, "membershipID"=>$userid, "userName"=>$username1, "parentID"=>$realparent,"noofReferred"=>'0',"rowID"=>$row_id,"joinDate"=>$joindate];

        $this->graphdb->create2($data);


        $this->setpintoused($pin);
//$lavel=1;
//$sponsorid=$websitecontroller->getid( $reffererusername);
        $websitecontroller->setparentchildren($realparent);
        $this->graphdb->setparentchildren($realparent);
        $this->setsubaccounts($username);


        $websitecontroller->creatematrix($userid,0);
        (new accountcontroller)->addtocurrentamount($userid,0,0);

        // Commit Transaction
        DB::commit();
        
        Session::flash('flash_success','you have added a new account sucessfully');
        return redirect()->intended('/addaccount');

        } catch (PDOException $e) {
                DB::rollback();
                $validator="Something went wrong with this registration. Please contact the support department.";
                return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    public function checkusernameavailabilitycount($username)
    {
        return   DB::table('member_table')
            ->where('username','=',$username)
            ->count();
    }



    public function registerfirstuser(Request $request){
        $websitecontroller=new websitecontroller();
        $accountcontroller=new accountcontroller();

        $pinmembershipId=$this->getusermembershipid($request->registrationpin);

        $checkifpinisused=$this->checkifpinisused($request->registrationpin,$pinmembershipId);

        if ($checkifpinisused=="used") {
            $validator="The pin you entered is either USED, INVALID or the PIN's Membership ID is incorrect.";
            return redirect('/mlmsetting')
                ->withErrors($validator)
                ->withInput();

        }

        $availability=$websitecontroller->checkusernameavailability($request->username);
        if ($availability=="available") {
            $validator="please the username you entered is in use already";
            return redirect('/mlmsetting')
                ->withErrors($validator)
                ->withInput();

        }


        $pin=$request->registrationpin;


//validate the Request through the validation rules
        $validator=Validator::make($request->all(),
            [
                'username'=>'required',
                'firstname'=>'required',
                'lastname'=>'required',
                'phonenumber'=>'required',
                'sex'=>'required',
                'dob'=>'required',
                'accountnumber'=>'required',
                'password'=>'required',
                'transactionpass'=>'required',
            ]);
//take actions when the validation has failed
        if ($validator->fails()){
            return redirect('/mlmsetting')
                ->withErrors($validator)
                ->withInput();
        }


//$uniqueid = $websitecontroller->getuniqueid();
        $this->setpintoused($request->registrationpin);
        $member = new members;
        $user = new User;
        $mlmusersrecords = new Mlmrecords;
        $matrix_type=new matrix_type;
        $matrix=new matrix;
        
        $todaysdate = date("Y-m-d");

        $userid=$this->getusermembershipid($pin);

        $member->membershipid =$userid;
        $member->username =$request->username;
        $member->sponsorid=0;
        $member->parentid=0;

        $member->registrationpin = $pin;
        $member->position =0;

        $member->stage=0;



        $member->firstname = $request->firstname;
        $member->middlename = $request->middlename;
        $member->lastname = $request->lastname;
        $member->phonenumber= $request->phonenumber;
        $member->sex = $request->sex;
        $member->dob = $request->dob;


        $member->country = 0;
        $member->state =$request->state;
        $member->city = 0;
        $member->address =0;
        $member->children =0;
        $member->accountname =0;
        $member->accountnumber = $request->accountnumber;
        $member->bankname =0;
        $member->bankbranch = 0;
        $member->joindate =date('Y-m-d');

        $member->email = 0;
        $member->password = \Hash::make($request->password);
        $member->role ='user';
        $member->transactionpass = $request->transactionpass;

        $member->save();

        $row_id=$member->id;

        $user->name = $request->firstname;
        $user->email = 0;
        $user->username = $request->username;
        $user->password = \Hash::make($request->password);
        $user->role ='firstuser';
// $user->role =$request->username;
        $user->transactionpass = $request->transactionpass;
        $user->save();
       // $websitecontroller->create2("0",'"'.$userid.'"');//create relation table data
        $data = ["stage" => '0', "children"=>'0', "sponsorID"=>'0', "position"=>'0', "membershipID"=>$userid, "userName"=>$request->username, "parentID"=>'0',"noofReferred"=>'0',"rowID"=>$row_id,"joinDate"=>$todaysdate];

        $this->graphdb->create2($data);

        $websitecontroller->creatematrix($userid,0);
        (new accountcontroller)->addtocurrentamount($userid,0,0);
        return redirect()->intended('/mlmsetting');


    }
    public function getusermembershipid($pin){
        $results=DB::table('generatepin')
            ->where('pin','=',$pin)
            ->get();
        foreach ($results as $key => $v) {
# code...
            $membershipid=$v->membershipid;
        }
        return $membershipid;
    }


    public function registeradmin(Request $request){
//validate the Request through the validation rules
        $availability1=new websitecontroller();
        $availability=$availability1->checkusernameavailability($request->username);
        if ($availability=="available") {
# code...
            $validator="please the username you entered is in use already";
            return redirect('/mlmsetting')
                ->withErrors($validator)
                ->withInput();

        }
        $validator=Validator::make($request->all(),[

            'firstname'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
            'transactionpass'=>'required',
            'role'=>'required'
        ]);
//take actions when the validation has failed
        if ($validator->fails()){
            return redirect('/mlmsetting')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User;
        $user->name = $request->firstname;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = \Hash::make($request->password);
        $user->role =$request->role;
        $user->transactionpass = $request->transactionpass;
        $user->save();

        Session::flash('flash_success','you have added a new admin account successfully');
        return redirect()->intended('/mlmsetting');
    }

    public function registerbyreferall($membershipid){

        return view('website.joinbyreferral')->with('parentusername',$membershipid)->with('sponsorusername',$membershipid);
    }

    public function checkifpinisused($string,$membershipid){

        $membershipid=strtoupper($membershipid);

        $string=trim($string);

        $results=DB::table('generatepin')
            ->where('pin','=',$string)
            ->where('membershipid','=',$membershipid)
            ->where('used','=',0)
            ->count();
        if ($results>0) {
# code...
            return "notused";
        } else {
# code...
            return "used";
        }

    }

    public function setpintoused($string){
        $string=trim($string);
        DB::table('generatepin')
            ->where('pin','=',$string)
            ->update(['used' => 1]);
    }
    public function getsubaccounts($username){
        $results=DB::table('member_table')
            ->where('username','=',$username)
            ->get();
        foreach ($results as $key => $v) {
# code...
            $numberofsubaccounts=$v->numberofsubaccounts;
        }
        return $numberofsubaccounts;
    }

    public function setsubaccounts($username){
        DB::table('member_table')
            ->where('username',"=",$username)
            ->increment('numberofsubaccounts',1);
    }


}
