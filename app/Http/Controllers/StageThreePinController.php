<?php

namespace App\Http\Controllers;

use App\GraphDB\MySQLToGraphDB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonalNotificationController;
use App\Pinrequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class StageThreePinController extends Controller
{
    //
    public $personalNotification;

    private $graphdb;
    private $generate_printable_pins = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->personalNotification = new PersonalNotificationController();
        $this->graphdb = new MySQLToGraphDB();
    }

    // =============================================================================================

    public function checkIfPinIsStageThreePIN(Request $request, $membershipid, $sponsorid)
    {
        if (strpos($membershipid, 'HA') !== false) {

            $pincount = DB::table('generatepinforstagethree')->where('membershipid', '=', $membershipid)->count();

            $owner_id = DB::table('generatepinforstagethree')->where('membershipid', '=', $membershipid)->first()->owner_id;

            if ($pincount > 0) {
                // PIN is a stage 3 pin
                // Check if $sponsorid is in users matrix
                $isMemberDownline = $this->graphdb->isMemberDownline($owner_id, $sponsorid);

                if ($isMemberDownline != null) {
                    dump("Process Registration");
                    $this->submitStageThreeReg($request);
                    
                    dd("Die at the dend of this query");
                } else {
                    // dump("Cancel Registration");
                    // $validator = "You cannot use a stage 3 pin outside the matrix of the owner. Please contact the support department.";
                    // return redirect('/register')->withErrors($validator)->withInput();
                }
            }
        } else {
            return 10;
        }
    }

    public function setpintoused($pin_string)
    {
        $string = trim($pin_string);
        DB::table('generatepinforstagethree')
            ->where('pin', '=', $pin_string)
            ->update(['used' => 1]);
    }

    public function getusermembershipid($pin)
    {
        $results = DB::table('generatepinforstagethree')
            ->where('pin', '=', $pin)
            ->get();
        foreach ($results as $key => $v) {
            $membershipid = $v->membershipid;
        }
        return $membershipid;
    }

    public function checkifpinisused($string, $membershipid)
    {

        $membershipid = strtoupper($membershipid);

        $string = trim($string);

        $results = DB::table('generatepinforstagethree')
            ->where('pin', '=', $string)
            ->where('membershipid', '=', $membershipid)
            ->where('used', '=', 0)
            ->count();
        if ($results > 0) {
            return "notused";
        } else {
            return "used";
        }
    }

    public function submitStageThreeReg($request)
    {
        dd($request);
        // return "Registration is currently unavailable please try again later.";

        try
        {
            DB::beginTransaction();
            $websitecontroller = new websitecontroller();
            $accountcontroller = new accountcontroller();
            $checkifpinisused = $this->checkifpinisused($request->registrationpin, $request->membershipid);
            if ($checkifpinisused == "used") {
                $validator = "The pin you entered is either USED, INVALID or the PIN's Membership ID is incorrect.";
                return redirect('/join-now')->withErrors($validator)->withInput();
            }

            $availability = $websitecontroller->checkusernameavailability($request->username);
            if ($availability == "available") {
                $validator = "please the username you entered is in use already";
                return redirect('/join-now')->withErrors($validator)->withInput();
            }

            // here we assign a person who registering without entering the parent username and refferer username a parent
            // $parentusername=$request->parentusername;
            // $reffererusername=$request->reffererusername;
            // $parentid=$websitecontroller->getid($request->parentusername);
            // $sponsorid=$websitecontroller->getid( $request->reffererusername);

            $parentid = strtoupper($request->reffererid);
            $sponsorid = strtoupper($request->reffererid);
            $pin = $request->registrationpin;
            $availability2 = $websitecontroller->checkreferreridavailability($sponsorid);
            $availability3 = $websitecontroller->checkparentidavailability($parentid);
            if ($availability2 == "notavailable") {

                $validator = "please the Referrer Id you entered is not available";
                return redirect('/join-now')->withErrors($validator)->withInput();
            }

            if ($availability3 == "notavailable") {

                $validator = "please the Parent Id you entered is not available";
                return redirect('/join-now')->withErrors($validator)->withInput();
            }

            // =====================================================================
            //     VALIDATION ADDED @ 17-APR-207
            // =====================================================================
            // =====================================================================
            // validate the Request through the validation rules

            $validator = Validator::make($request->all(), ['username' => 'required|unique:member_table|alpha_num|max:255|min:4', 'firstname' => 'required|alpha', 'lastname' => 'required|alpha', 'phonenumber' => 'required', 'sex' => 'required', 'dob' => 'required', 'accountnumber' => 'required|numeric', 'password' => 'required|min:4', 'transactionpass' => 'required|min:4', 'place' => 'required']);

            // take actions when the validation has failed

            if ($validator->fails()) {
                return redirect('/join-now')->withErrors($validator)->withInput();
            }

            $member = new members;
            $user = new User;
            $mlmusersrecords = new Mlmrecords;
            $matrix_type = new matrix_type;
            $matrix = new matrix;
            $todaysdate = date("Y-m-d");

            // $parenusername=$parentusername;
            // $parentid2=$this->getrealparent($parentid);
            // $position=$this->getfreeposition($parentid);getusermembershipid($pin)
            // $userid=$websitecontroller->getuniqueid();

            $userid = strtoupper($this->getusermembershipid($pin));

            // $parentid=$request->parentid;
            // not used again
            // $freeposition=$websitecontroller->getfreeposition($parentid);
            // $realparent=$freeposition["parent"];
            // $realposition=$freeposition["position"];

            $place = $request->place;

            //        $freepositionwithplace=$websitecontroller->getfreepositionwithplace($parentid,$place);
            //        $realparent=$freepositionwithplace["parent"];
            //        $realposition=$freepositionwithplace["position"];
            // new

            $freepositionwithplace = $this->graphdb->getfreepositionwithplace($parentid, $place);
            $realparent = strtoupper($freepositionwithplace["parent"]);
            $realposition = $freepositionwithplace["position"];
            $member->membershipid = $userid;
            $member->username = $request->username;
            $member->sponsorid = $sponsorid;
            $member->parentid = $realparent;

            // $member->parentid=$realparent;

            $member->registrationpin = $pin;
            $member->position = $realposition;

            // $member->position = $request->realposition;

            $member->stage = 0;

            // $member->datejoined = $todaysdate;
            // $member->uniqueid = $uniqueid;

            $member->firstname = $request->firstname;
            $member->middlename = $request->middlename;
            $member->lastname = $request->lastname;
            $member->phonenumber = $request->phonenumber;
            $member->sex = $request->sex;
            $member->dob = $request->dob;

            // $mlmusersrecords->email = $request->email;

            $member->country = $request->country;
            $member->state = $request->state;
            $member->city = 0;
            $member->address = 0;
            $member->children = 0;

            // $mlmusersrecords->transactionpass = $request->transactionpass;

            $member->accountname = 0;
            $member->accountnumber = $request->accountnumber;
            $member->bankname = 0;
            $member->bankbranch = 0;
            $member->numberofsubaccounts = 0;
            $member->type = 'main';
            $member->isownedby = $userid;
            $member->joindate = date('Y-m-d');
            $member->email = 0;
            $member->password = Hash::make($request->password);
            $member->role = 'user';
            $member->transactionpass = $request->transactionpass;
            $member->save();

            // Graph db getfreepositionwithplace

            $row_id = $member->id;
            $joindate = date('Y-m-d');
            $data = ["stage" => '0', "children" => '0', "sponsorID" => $sponsorid, "position" => $realposition, "membershipID" => $userid, "userName" => $request->username, "parentID" => $realparent, "rowID" => $row_id, "joinDate" => $joindate];
            $this->graphdb->create2($data);

            // Pay for referral

            $accountcontroller->payforreferral($sponsorid);

            // set the pin to used

            $this->setpintoused($request->registrationpin);
            $websitecontroller->setparentchildren($realparent);

            // Graph db set parent children

            $this->graphdb->setparentchildren($realparent);
            $user->name = $request->firstname;
            $user->email = 0;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = 'user';

            // $user->role =$request->username;

            $user->transactionpass = $request->transactionpass;
            $user->save();

            // $websitecontroller->create2('"'.$realparent.'"','"'.$userid.'"');//create relation table data

            $websitecontroller->creatematrix($userid, 0);
            (new accountcontroller)->addtocurrentamount($userid, 0, 0);
            $username = $request->username;

            // Commit Transaction

            DB::commit();

            // }
            // return redirect()->intended('/join-now');

            $login = 'username';

            // check login field

            $login_type = $login;

            // merge our login field into the request with either email or username as key
            // $request->merge([$login_type => $login ]);

            $credentials = ['username' => $username, 'password' => $request->password];
            if (Auth::attempt($credentials)) {
                Session::flash('flash_success', 'you have created a new account and logged in sucessfully');
                return redirect()->intended('/home');
            } else {
                return redirect()->intended('/login');
            }
        } catch (PDOException $e) {
            DB::rollback();
            $validator = "Something went wrong with this registration. Please contact the support department.";
            return redirect('/register')->withErrors($validator)->withInput();
        }
    }

    // =============================================================================================

    // =============================================================================================
    #Generate Stage Three Pins
    public function generateStageThreePins(Request $request)
    {
        $ids = explode(',', $request->ids);

        $numberofpins = $request->numberofpins;

        foreach ($ids as $key => $value) {
            $a = 1;
            while ($a <= $numberofpins) {
                // dump($value);
                $this->generatepin($value);
                // GeneratePins();
                $a++;
            }
        }

        $data = $this->generate_printable_pins;
        // dump($data);
        // dd();

        return view('stagethreepin.index', ['name' => $data]);
        // return view('stagethreepin.index', compact(['data'=>$data]));
        // return view('stagethreepin.index', ['data' => $this->generate_printable_pins]);
        // return view('stagethreepin.index')->with('data', $this->generate_printable_pins);
        // return view('stagethreepin.index')->with('data', 'Hammer');

        // return redirect()->back()->with('data', $this->generate_printable_pins);
    }

    public function showgeneratedpins()
    {
        $generated_pins = DB::table('generatepinforstagethree')->insert(['pin' => $string, 'membershipid' => $membershipid, 'date_generated' => $date, 'owner_id' => $user_id, 'printed' => 0, 'generated_by' => $generated_by_Id, 'used' => 0]);

    }

    // =============================================================================================
    public function generaterandomalphbet($random_string_length)
    {
        $characters = 'BCDFGHJKLMNPQRSTVWXYZ';
        $string = "";
        for ($i = 0; $i < $random_string_length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    public function generatepin($user_id)
    {

        $string = $this->random_str(10);

        if ($this->exists_in_db($string)) {
            # code...
            $string = $this->generatepin($user_id);

        }

        $this->savekey($string, $this->getmembershipid(), $user_id);

        return $string;
    }

    public function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return mb_strtoupper($str, 'UTF-8');
    }
    public function random_str2($length, $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return mb_strtoupper($str, 'UTF-8');
    }

    public function savekey($string, $membershipid, $user_id)
    {
        $matrix = new Matrix;
        $todaysdate = new \DateTime();
        $date = $todaysdate->format('Y-m-d');
        $generated_by_Id = Auth::user()->id;
        //INSERT INTO `generatepin`(`id`, `pin`, `membershipid`, `date_generated`, `accounttype`, `batch_id`, `printed`, `generated_by`,`printed_by`, `date_printed`, `printed_batch`, `used`)

        // array_push($this->generate_printable_pins, $string, $membershipid, $user_id);

        $id = DB::table('generatepinforstagethree')->insertGetId(['pin' => $string, 'membershipid' => $membershipid, 'date_generated' => $date, 'owner_id' => $user_id, 'printed' => 0, 'generated_by' => $generated_by_Id, 'used' => 0]);
        
        array_push($this->generate_printable_pins, ['serial_no' => $id, 'pin' => $string, 'pin_id' => $membershipid, 'owner_id' => $user_id]);
    }

    public function getlastid()
    {
        $lastid = DB::select('select max(id) as maxID from generatepinforstagethree');

        //echo $lastid->maxID;
        foreach ($lastid as $key => $v) {
            # code...
            $lastid = $v->maxID;
        }
        if ($lastid == null) {
            # code...
            return 1;
        } else {
            # code...
            return $lastid + 1;
        }

    }
    public function getthememberid()
    {
        $membershipid = $this->getmembershipid();
        return $membershipid;
    }

    public function getmembershipid()
    {
        $lastid = $this->getlastid();
        $string = 'HA';

        //$countstring=strlen($lastid);
        $number = 16000;
        $number += $lastid;
        $countstring1 = strlen($number);

        if ($countstring1 == 5) {
            # code...
            $string .= '000' . $number;
        } elseif ($countstring1 == 6) {
            # code...
            $string .= '00' . $number;
        } elseif ($countstring1 == 7) {
            # code...
            $string .= '0' . $number;
        } else {
            # code...
            $string .= $number;
        }

        return $string;
    }

    public function exists_in_db($pin)
    {

        $pincount = DB::table('generatepinforstagethree')->where('pin', '=', $pin)->count();
        if ($pincount > 0) {
            return true;
        } else {
            return false;
        }

    }

    //generate random key
    public function generateKey($length)
    {
        /// Random characters
        $characters = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        // set the array
        $keys = array();

        // loop to generate random keys and assign to an array
        while (count($keys) < $length) {
            $x = mt_rand(0, count($characters) - 1);
            if (!in_array($x, $keys)) {
                $keys[] = $x;
            }

        }

        // extract each key from array
        $random_chars = '';
        foreach ($keys as $key) {
            $random_chars .= $characters[$key];
        }

        // display random key
        return $random_chars;
    }

    public function subAdminPinRequest(Request $request)
    {
        //validate the Request through the validation rules
        $validator = Validator::make($request->all(),
            [
                'noofpins' => 'required|numeric',
            ]);
        //take actions when the validation has failed
        if ($validator->fails()) {
            return redirect('/subadminpinrequest')
                ->withErrors($validator)
                ->withInput();
        }
        //INSERT INTO `pinrequest`(`batch_id`, `user_id`, `no_of_pins`, `sent`, `viewed_by_admin`, `viewed_by_sub_admin`, `no_remaining_for_batch`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])

        $noofpins = $request->noofpins;
        $userId = Auth::User()->id;

        $pinrequest = new Pinrequest();
        $pinrequest->user_id = $userId;
        $pinrequest->no_of_pins = $noofpins;
        $pinrequest->sent = 0;
        $pinrequest->viewed_by_admin = 0;
        $pinrequest->viewed_by_sub_admin = 0;
        $pinrequest->no_remaining_for_batch = $noofpins;
        $pinrequest->save();

        Session::flash('flash_success', 'The Request for ' . $noofpins . ' Pins has been been saved you will get a response shortly');
        return redirect()->back();

    }

    public function showSubAdminPinRequestPage()
    {
        return view('admin.subAdminRequest');
    }

    public function showAllPinsReqestedByUser()
    {
        $userId = Auth::user()->id;
        $pinrequests = DB::table('pinrequest as p')->join('users as u', 'p.user_id', '=', 'u.id')->select('p.batch_id as batch_id', 'p.no_of_pins as no_of_pins', 'p.sent as sent', 'p.no_remaining_for_batch as no_remaining_for_batch', 'p.created_at as created_at', 'u.*')->where('p.user_id', '=', $userId)->paginate(10);

        return view('admin.showAllUserPinRequest')->with(['pinrequests' => $pinrequests]);

    }

    public function sendUserPinToUser($batchId)
    {
        //get the batch details
        $batchdetails = DB::table('pinrequest')->where('batch_id', $batchId)->get();
        foreach ($batchdetails as $value) {
            $userIdFromBatch = $value->user_id;
            $noofpins = $value->noofpins;
            $sent = $value->sent;
            $no_remaining_for_batch = $value->no_remaining_for_batch;

        }
        //check if the pins have been sent before or sent partially
        $noofpinssent = DB::table('generatepinforstagethree')->where('batch_id', $batchId)->count();

        if ($sent == 2 || $sent == 0) //some have ben sent already
        {
            //update with what is left
            DB::update(' UPDATE generatepinforstagethree SET batch_id = ? WHERE batch_id =0 ORDER BY id LIMIT ?', [$batchId, $no_remaining_for_batch]);

        }
        //get admin Id
        $userId = Auth::User()->id;
        //mark pins in generate pin table with batch_id

        //DB::table('generatepinforstagethree')->where('batch_id','=',0)->update(['batch_id'=>$batchId]);

        //check if the pins sent is up to the requested by sub admin
        //set status to sent half sent,sent,or non sent based on pin sent
        $noofpinssent = DB::table('generatepinforstagethree')->where('batch_id', $batchId)->count();

        if ($noofpinssent < $noofpins) {
            DB::table('pinrequest')->where('batch_id', '=', $batchId)->update(['sent' => 2]);
        } elseif ($noofpinssent == $noofpins) {
            DB::table('pinrequest')->where('batch_id', '=', $batchId)->update(['sent' => 1]);
        }

        //notify batch owner sendNotification($sender_id,$receiver_id,$message,$link)
        $this->personalNotification->sendNotification($userId, $userIdFromBatch, "Pins have been sent to you by the super admin", "/printbatch/" . $batchId);

    }
    public function ShowAllUserPinRequestToAdmin()
    {
        $pinrequests = DB::table('pinrequest as p')->join('users as u', 'p.user_id', '=', 'u.id')->select('p.batch_id as batch_id', 'p.no_of_pins as no_of_pins', 'p.sent as sent', 'p.no_remaining_for_batch as no_remaining_for_batch', 'p.created_at as created_at', 'u.*')->paginate(10);
        return view('admin.showAdminAllUserPinRequest')->with(['pinrequests' => $pinrequests]);
    }
    public function adminRequestNotification()
    {

    }

    public function subAdminRequestNotification()
    {

    }

    public function requestForPinReprint(Request $request)
    {

    }
    public function showPinsGeneratedPage()
    {
        $pinsgeneratedperday = DB::select('SELECT COUNT(*) as no_of_pins, date_generated , generated_by
FROM generatepinforstagethree
GROUP BY date_generated,generated_by');
        return view('admin.generatedpinspage')->with(['pinsgeneratedperday' => $pinsgeneratedperday]);
    }

    public function showGeneratePinPage()
    {
        return view('admin.generatepinpage');
    }

    public function showPrintPinPage()
    {
        return view('admin.printpinspage');
    }

    public function showPrintedPinsPage()
    {

        $printedpins = DB::select('SELECT COUNT(*) as no_of_pins, date_generated ,printed_by,date_printed,printed_batch,min(id) as minid,max(id) as maxid
        FROM generatepinforstagethree
        WHERE printed=1
        GROUP BY printed_by,printed_batch order by date_printed');
        return view('admin.printedpinspage')->with(['printedpins' => $printedpins]);
    }

}
