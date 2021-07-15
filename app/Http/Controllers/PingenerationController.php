<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Pinrequest;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\PersonalNotificationController;
use Illuminate\Support\Facades\Auth;

class PingenerationController extends Controller
{
    //
    public $personalNotification;
  public function __construct()
  {
    $this->middleware('auth');
    $this->personalNotification=new PersonalNotificationController();
  }
  public function generaterandomalphbet($random_string_length)
  {
    $characters = 'BCDFGHJKLMNPQRSTVWXYZ';
    $string = "";
    for ($i = 0; $i < $random_string_length; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $string;
  }

  public function generatepin()
  {
   
   
    $string=$this->random_str(10);
   

    if ($this->exists_in_db($string)){
       # code...
     $string=$this->generatepin();

   }


   $this->savekey($string,$this->getmembershipid());

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

  return  mb_strtoupper($str, 'UTF-8');
}

public function savekey($string,$membershipid)
{
  $matrix = new Matrix;
  $todaysdate = new \DateTime();
  $date = $todaysdate->format('Y-m-d');
  $generated_by_Id=Auth::user()->id;
//INSERT INTO `generatepin`(`id`, `pin`, `membershipid`, `date_generated`,
// `accounttype`, `batch_id`, `printed`, `generated_by`,
// `printed_by`, `date_printed`, `printed_batch`, `used`)


    DB::table('generatepin')->insert(['pin' => $string,'membershipid'=>$membershipid,'date_generated' => $date,'printed'=>0,'generated_by'=>$generated_by_Id,'used' => 0]);

}
public function getlastid(){
$lastid=DB::select('select max(id) as maxID from generatepin');

//echo $lastid->maxID;
foreach ($lastid as $key => $v) {
  # code...
 $lastid=$v->maxID;
}
if ($lastid==null) {
  # code...
  return 1;
} else {
  # code...
  return  $lastid+1;
}


}
public function getthememberid(){
  $membershipid=$this->getmembershipid();
  return $membershipid;
}

public function  getmembershipid(){
$lastid=$this->getlastid();
$string='URS';

//$countstring=strlen($lastid);
$number=1000;
$number+=$lastid;
$countstring1=strlen($number);

if ($countstring1==4) {
  $string.='0000'.$number;
 } 
elseif ($countstring1==5) {
  # code...
  $string.='000'.$number;
} elseif ($countstring1==6) {
  # code...
  $string.='00'.$number;
} elseif ($countstring1==7) {
  # code...
  $string.='0'.$number;
}else{
  # code...
  $string.=$number;
}


return $string;
}


public function exists_in_db($pin)
{

 $pincount= DB::table('generatepin')->where('pin','=',$pin)->count();
 if ($pincount>0) {
  return true;
}
else {
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
    if (!in_array($x, $keys))
      $keys[] = $x;
  }

        // extract each key from array
  $random_chars = '';
  foreach ($keys as $key)
    $random_chars .= $characters[$key];

        // display random key
  return $random_chars;
}

public function subAdminPinRequest(Request $request)
{
    //validate the Request through the validation rules
    $validator=Validator::make($request->all(),
        [
            'noofpins'=>'required|numeric',
        ]);
//take actions when the validation has failed
    if ($validator->fails()){
        return redirect('/subadminpinrequest')
            ->withErrors($validator)
            ->withInput();
    }
 //INSERT INTO `pinrequest`(`batch_id`, `user_id`, `no_of_pins`, `sent`, `viewed_by_admin`, `viewed_by_sub_admin`, `no_remaining_for_batch`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])

    $noofpins=$request->noofpins;
    $userId=Auth::User()->id;

    $pinrequest=new Pinrequest();
    $pinrequest->user_id=$userId;
    $pinrequest->no_of_pins=$noofpins;
    $pinrequest->sent=0;
    $pinrequest->viewed_by_admin=0;
    $pinrequest->viewed_by_sub_admin=0;
    $pinrequest->no_remaining_for_batch=$noofpins;
    $pinrequest->save();

 Session::flash('flash_success','The Request for '.$noofpins.' Pins has been been saved you will get a response shortly');
 return redirect()->back();

}

public function showSubAdminPinRequestPage()
{
    return view('admin.subAdminRequest');
}

public function showAllPinsReqestedByUser()
{
    $userId=Auth::user()->id;
    $pinrequests=DB::table('pinrequest as p')->join('users as u','p.user_id','=','u.id')->select('p.batch_id as batch_id','p.no_of_pins as no_of_pins','p.sent as sent','p.no_remaining_for_batch as no_remaining_for_batch','p.created_at as created_at','u.*')->where('p.user_id','=',$userId)->paginate(10);

    return view('admin.showAllUserPinRequest')->with(['pinrequests'=>$pinrequests]);

}

public function sendUserPinToUser($batchId)
{
    //get the batch details
    $batchdetails=DB::table('pinrequest')->where('batch_id',$batchId)->get();
    foreach ($batchdetails as $value)
    {
     $userIdFromBatch=$value->user_id;
     $noofpins=$value->noofpins;
     $sent=$value->sent;
     $no_remaining_for_batch=$value->no_remaining_for_batch;

    }
//check if the pins have been sent before or sent partially
    $noofpinssent=DB::table('generatepin')->where('batch_id',$batchId)->count();

    if ($sent==2||$sent==0)//some have ben sent already
    {
     //update with what is left
        DB::update(' UPDATE generatepin SET batch_id = ? WHERE batch_id =0 ORDER BY id LIMIT ?',[$batchId,$no_remaining_for_batch]);

    }
//get admin Id
    $userId=Auth::User()->id;
//mark pins in generate pin table with batch_id

    //DB::table('generatepin')->where('batch_id','=',0)->update(['batch_id'=>$batchId]);

//check if the pins sent is up to the requested by sub admin
//set status to sent half sent,sent,or non sent based on pin sent
    $noofpinssent=DB::table('generatepin')->where('batch_id',$batchId)->count();

    if ($noofpinssent<$noofpins)
    {
        DB::table('pinrequest')->where('batch_id','=',$batchId)->update(['sent'=>2]);
    }
    elseif ($noofpinssent==$noofpins)
    {
        DB::table('pinrequest')->where('batch_id','=',$batchId)->update(['sent'=>1]);
    }

//notify batch owner sendNotification($sender_id,$receiver_id,$message,$link)
$this->personalNotification->sendNotification($userId,$userIdFromBatch,"Pins have been sent to you by the super admin","/printbatch/".$batchId);

}
public function ShowAllUserPinRequestToAdmin()
{
    $pinrequests=DB::table('pinrequest as p')->join('users as u','p.user_id','=','u.id')->select('p.batch_id as batch_id','p.no_of_pins as no_of_pins','p.sent as sent','p.no_remaining_for_batch as no_remaining_for_batch','p.created_at as created_at','u.*')->paginate(10);
    return view('admin.showAdminAllUserPinRequest')->with(['pinrequests'=>$pinrequests]);
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
    $pinsgeneratedperday=DB::select('SELECT COUNT(*) as no_of_pins, g.date_generated as date_generated ,min(g.id) as minid ,MAX(g.id) as maxid,
    g.generated_by as generated_by,u.name as name FROM generatepin 
    as g left JOIN  users as u on g.generated_by=u.id GROUP BY date_generated,generated_by');
    
  return view('admin.generatedpinspage')->with(['pinsgeneratedperday'=>$pinsgeneratedperday]);
}

public function showUnprintedPinPage()
{
    $unprintedpins=DB::select('SELECT count(*) as numberofpins, min(g.id) as minid ,MAX(g.id) as maxid,
    g.generated_by,g.date_generated FROM generatepin as g where 
    g.used !=1 group by g.date_generated having count(*)>50');
  return view('admin.unprintedpinspage')->with(['unprintedpins'=>$unprintedpins]);
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

    $printedpins=DB::select('SELECT COUNT(*) as no_of_pins, date_generated ,printed_by,date_printed,printed_batch,min(g.id) as minid,max(g.id) as maxid
FROM generatepin as g
WHERE printed=1
GROUP BY printed_by,printed_batch order by date_printed');
    return view ('admin.printedpinspage')->with(['printedpins'=>$printedpins]);
}

}
