<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Input;
use App\Http\Controllers\PingenerationController;
use App\Members;
use App\GraphDB\MySQLToGraphDB;
class AdminController extends Controller
{
    //

  private $graphdb;
  public function __construct()
  {
    $this->middleware('auth');
    $this->graphdb=new MySQLToGraphDB();
  }


  public function showlmssetting()
  {
        // INSERT INTO `mlm_stagebonus`(`id`, `bonus`, `stage_number`, `name`, `noofdownlines`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
    $mlmlevel = DB::table('mlm_stagebonus')
    ->join('stage_bonus', 'mlm_stagebonus.stage_number', '=', 'stage_bonus.level_number')
    ->select('mlm_stagebonus.*', 'stage_bonus.stage_number', 'stage_bonus.bonus')
    ->get();
        //$mlmlevel = Mlmlevel::all();
    $countrycurrencies = DB::table('mlm_country')
    ->select('mlm_country.*')
    ->get();
    $referralbonus = DB::table('referralamount')
    ->where('id', 1)
    ->get();
    $firstusercount = DB::table('users')
    ->where('role', "firstuser")
    ->count();


    return view('admin.adminsetting')->with('mlmlevel', $mlmlevel)->with('countrycurrencies', $countrycurrencies)->with('referralbonus', $referralbonus)->with('firstusercount', $firstusercount);
  }

  public function truncatetables()
  {


  }

  public function backuptables()
  {


  }
  public function test(){

    //$generate = new pingenerationController();
    //$pin = $generate->generatepin("dhdjdjjd",1); 
    //$pins=$this->printpin();
    $number=10;
    $pin="";
    while($number>0){
     $generate = new pingenerationController();
       // $pin = $generate->generatepin($email, $accounttype);
     $pin.="<br/>"+$generate->generatepin(1);
     $number--;  
   }
   var_dump($pin);
 }

 public function pingenerator(Request $request)
 {
    //$post = $request->all();
  $generate = new PingenerationController;
  $number=$request->inputnumber;
  //$accounttype=$request->registernum;
    //$number = $post['number'];
  $number1=$number." Pins Generated";
    //$accounttype = $post['accounttype'];
  while($number>0){

       // $pin = $generate->generatepin($email, $accounttype);
   $pin = $generate->generatepin();
   $number--;  
 }

    //return response()->json(["pin" => $number1]);
 Session::flash('flash_success',$number1);
 //return redirect()->back();
 return redirect()->back();
}
public function printpin(Request $request){
  $post=$request->all();
  $number = $post['number'];
    //$number1=$number." Pins Generated";
 // $accounttype = $post['accounttype'];

    $printed_by_Id=Auth::user()->id;
  $result=DB::table('generatepin')
  ->where('used','=', 0)
  ->where('printed','=', 0)
  ->limit($number)
  ->get();
    //INSERT INTO `generatepin`(`id`, `pin`, `membershipid`, `date_generated`,
// `accounttype`, `batch_id`, `printed`, `generated_by`,
// `printed_by`, `date_printed`, `printed_batch`, `used`)
    $todaysdate = new \DateTime();
    $date = $todaysdate->format('Y-m-d');
    $print_batch=uniqid().$date;

    $table="<br/>";
    $table="<table class='table'>";
    $table.="<thead>";
    $table.="</thead>";
    $table.="<tbody>";

  foreach ($result as $key => $v) {
      # code...
    $pin=$v->pin;

    DB::table('generatepin')
    ->where('pin','=',$v->pin)
    ->update(['printed' => 1,'printed_by'=>$printed_by_Id,'date_printed'=>$date,'printed_batch'=>$print_batch]);


      $table.="<tr style='font-size:25px;font-weight: bold;'>";
      $table.="<th>SERIAL NO</th>";
      $table.="<th>MEMBERSHIP ID</th>";
      $table.="<th>PIN</th>";
      $table.="</tr>";
      $table.="</tr>";
      $table.="<td style='font-size:25px;font-weight: bold;'>".$v->id."</td>";
      $table.="<td style='font-size:25px;font-weight: bold;'>".$v->membershipid."</td>";
      $table.="<td style='font-size:25px;font-weight: bold;'>".$v->pin."</td>";
      $table.="</tr>";




  }
    $table.="</tbody>";
    $table.="</table>";

    $result2=["data"=>$table];

 // $someJSON = json_encode($result);

  return response()->json($result2);


}

public function showuserstages(){

    //orWhere
    //$qualifiedfor2=;
    //$qualifiedfor4=;
    //$qualifiedfor6=;

  $qualifiedfor2= DB::table('member_table as m')
  ->join('refferal_bonus as r', 'm.membershipid', '=', 'r.membershipid')
    //->where('r.noofreffered', '=','2')
  ->Where('r.noofreffered', '>=','2')
  ->Where('r.noofreffered', '<','4')
  ->get();


  $qualifiedfor4= DB::table('member_table as m')
  ->join('refferal_bonus as r', 'm.membershipid', '=', 'r.membershipid')
    //->where('r.noofreffered', '=','4')
  ->Where('r.noofreffered', '>=','4')
  ->Where('r.noofreffered', '<','6')
  ->get();

  $qualifiedfor6= DB::table('member_table as m')
  ->join('refferal_bonus as r', 'm.membershipid', '=', 'r.membershipid')  
   // ->where('r.noofreffered', '=','6')
  ->Where('r.noofreffered', '>=','6')

  ->get();

  $stage0= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->where('m.stage', '=','0')
  ->get();

  $stage1= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=', 'HW00016001')
  ->where('m.stage', '=','1')
  ->get();
  $stage2= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->where('m.stage', '=','2')
  ->get();
  $stage3= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=', 'HW00016001')
  ->where('m.stage', '=','3')
  ->get();
  $stage4= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->where('m.stage', '=','4')
  ->get();
  $stage5= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->where('m.stage', '=','5')
  ->get();


  return view('admin.viewuserstages')->with(['stage0'=>$stage0,'stage1'=>$stage1,'stage2'=>$stage2,'stage3'=>$stage3,'stage4'=>$stage4,'stage5'=>$stage5,'qualifiedfor2'=>$qualifiedfor2,'qualifiedfor4'=>$qualifiedfor4,'qualifiedfor6'=>$qualifiedfor6]);
}

public function getautocompletemembershipid(Request $request) {
      $term =$request->term;//jquery
      $data=DB::table('member_table as m')
      ->join('current_amount_in_account as ct', 'ct.userid', '=', 'm.membershipid')
      ->select('member_table.firstname as firstname','current_amount_in_account.amount as amount')
      ->where('member_table','LikE','%'.$term.'%')
      ->take(10)
      ->get();
      $result= array();
      foreach ($data as $key => $v) {
       $result[]=['name'=>$v->firstname,'price'=>$v->amount];
     }
     return response()->json($result);
   }



   public function showdeduct(){
    return view('admin.deductfromaccount');
  }

  public function processdeduct(Request $request)
  {
      //Get User stage
    $user = Db::table('member_table as mt')
    ->join('refferal_bonus as rf', 'rf.membershipid', '=', 'mt.membershipid')      
    ->join('stagecompletionbonus as scb', 'scb.membershipid', '=', 'mt.membershipid')      
    ->select('rf.bonus', 'rf.noofreffered', 'mt.stage')
    ->first();

    $user_stage = $user->stage;
    $user_no_ref = $user->noofreffered;
    $user_bonus = $user->bonus;

  }

  public function showpayouts(){
   
   $payouts=DB::table('payoutcash as p')
   ->join('member_table as mt', 'mt.membershipid', '=', 'p.userid')
   ->select('p.*','mt.accountname as accountname','mt.accountnumber as accountnumber','mt.bankname as bankname','mt.bankbranch as bankbranch')
   ->where('p.status','pending')
   ->paginate(10);
   return view('admin.payouts')->with(['payouts'=>$payouts]);
 }

 public function setpayoutstatus(Request $request){
   $post = $request->all();
   $status = $post['status'];
   $userid = $post['userid'];
   $payoutid = $post['id'];
   $datepaid=date('Y-m-d');
   $payouts=DB::table('payoutcash')
   ->where('userid',$userid )
   ->where('id',$payoutid )
   ->update(['status'=>$status,'datepaid'=>$datepaid]);

   

   return response()->json(['newstatus'=>$status]);

 }
 public function showpaidpayout(){
   $payouts=DB::table('payoutcash as p')
   ->join('member_table as mt', 'mt.membershipid', '=', 'p.userid')
   ->select('p.*','mt.accountname as accountname','mt.accountnumber as accountnumber','mt.bankname as bankname','mt.bankbranch as bankbranch')
   ->where('p.status','paid')
   ->paginate(10);
   // $payouts=DB::table('payoutcash')
   // ->where('status','paid')
   // ->paginate(2);
   return view('admin.viewpaidpayout')->with(['payouts'=>$payouts]);
 }

 public function accoutdetails(){
  $stagezerocash= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',0)
  ->sum('foodcash');
  $stageonecash= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',1)
  ->sum('foodcash');
  $stagetwocash= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',2)
  ->sum('foodcash');
  $stagetwocash+= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',2)
  ->sum('payoutcash');
  $stagethreecash= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',3)
  ->sum('foodcash');
  $stagethreecash+= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',3)
  ->sum('payoutcash');
  $stagefourcash= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',4)
  ->sum('foodcash');
  $stagefourcash+= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',4)
  ->sum('payoutcash');
  $stagefivecash= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',5)
  ->sum('foodcash');
  $stagefivecash+= DB::table('member_table as m')
  ->join('tempcurrentamount as t', 'm.membershipid', '=', 't.userid')
  ->where('m.stage', '=',5)
  ->sum('payoutcash');
  $totalcash=($stageonecash+$stagetwocash+$stagethreecash+$stagefourcash+$stagefivecash)*200;

  return view('admin.accountdetails')->with(['stagezerocash'=>$stagezerocash*200,'stageonecash'=>$stageonecash*200,'stagetwocash'=>$stagetwocash*200,'stagethreecash'=>$stagethreecash*200,'stagefourcash'=>$stagefourcash*200,'stagefivecash'=>$stagefivecash*200,'totalcash'=>$totalcash]);
}

public function showchangeparent(){
  return view('admin.changeparent');
}

public function changeparent(Request $request){
 $websitecontroller=new websitecontroller();
 $newansector=$request->newansector;
 $descendant=$request->descendant;
 
 $parentid=$this->getparent($descendant);
//update number of children for old parent
$this->updateparent($parentid);

$this->graphdb->updateparentchildren($parentid);



$place=$request->place;
// $freepositionwithplace=$websitecontroller->getfreepositionwithplace($newansector,$place);

//   $realparent=$freepositionwithplace["parent"];
//   $realposition=$freepositionwithplace["position"];

$freepositionwithplace=$this->graphdb->getfreepositionwithplace($newansector,$place);

//$freepositionwithplace=$this->graphdb->getFirstChildByPosition($newansector,$place);
        $realparent=strtoupper($freepositionwithplace["parent"]);
        $realposition=$freepositionwithplace["position"];

        //dd($freepositionwithplace);

//set descendant parent to new parent
$results = DB::table('member_table')->where('membershipid',$descendant)->update(['parentid' =>$realparent]);


  $websitecontroller->setparentchildren($realparent);
  $this->graphdb->setparentchildren($realparent);

// disconnect from first parent 
// $query=DB::unprepared('DELETE a FROM treepaths AS a
//   JOIN treepaths AS d ON a.descendant = d.descendant
//   LEFT JOIN treepaths AS x
//   ON x.ancestor = d.ancestor AND x.descendant = a.ancestor
//   WHERE d.ancestor ="'.$descendant.'" AND x.ancestor IS NULL');


//connect to new parent 

// $query=DB::unprepared('INSERT INTO treepaths (ancestor, descendant, depth)
//   SELECT supertree.ancestor, subtree.descendant,
//   supertree.depth+subtree.depth+1
//   FROM treepaths AS supertree JOIN treepaths AS subtree
//   WHERE subtree.ancestor ="'.$descendant.'"
//   AND supertree.descendant ="'.$realparent.'"');

Session::flash('flash_success','You you have changed the parent of '.$descendant.' to '.$newansector."under ".$realparent);

return redirect()->back();
}

public function updateparent($parentid){
 $results = DB::table('member_table')
      ->where('membershipid', '=', $parentid)
      ->get();
      $child = 3;
      foreach ($results as $key => $v) {
        $child = $v->children;
      }
      if ($child == 2) {
            # code...
        DB::table('member_table')
        ->where('membershipid', '=', $parentid)
        ->update(['children' => 1]);
      } elseif ($child == 1) {
            # code...
        DB::table('member_table')
        ->where('membershipid', '=', $parentid)
        ->update(['children' => 0]);
      }
} 

public function getparent($membershipid){
 $results = DB::table('member_table')
      ->where('membershipid', '=', $membershipid)
      ->get();
      $child = 3;
      foreach ($results as $key => $v) {
        $parentid = $v->parentid;
      }
      return $parentid;
}

 public function changeuserpassword(Request $request)
{
  # code...
  $membershipid=$request->membershipid;
  $password=$request->password;

  $username=$this->getUsernameWithMembershipId($membershipid);


  if ($this->checkIfUserIsBannedAndReturnBack($username)){
      Session::flash('flash_danger','Your Account  has been banned please contact Administrator');
      return redirect()->back();
  }

    $newpassword=Hash::make($password);    
      DB::table('users')
    ->where('username',$username)
    ->update(['password'=>$newpassword]);


    Session::flash('flash_success','Password has been changed');
    return redirect('/showchangepassword');
   
}

public function showchangeuserpasswordpage(){
  
  return view('admin.changepassword');
}

public function calculateUsersDownline()
{
  ini_set('max_execution_time',3000);
  $downlines=DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->get();

  foreach ($downlines as  $value) {
    # code...
    $membershipid=$value->membershipid;
    $count=DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=', $membershipid)
  ->count();
       DB::table('member_table')
        ->where('membershipid', $membershipid)
        ->update(['downlines' => $count]);
  }
 
 return "calculated";
}
public function calculateUsersBonus(){
  ini_set('max_execution_time',30000);
  $downlines=DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->get();
  foreach ($downlines as  $value) {
   $membershipid=$value->membershipid;

  $stage=(new websitecontroller)->fillmatrix2($membershipid);
  }
 return "calculated";
}

public function calculateUsersBonusForId($membershipid){
 ini_set('max_execution_time',30000);
  $stage=(new websitecontroller)->fillmatrix4($membershipid); 

   return "calculated";
  }
public function cutMemberSubTree($membershipid)
{

$query=DB::unprepared('DELETE FROM treepaths
WHERE descendant IN (SELECT descendant
FROM treepaths
WHERE ancestor ="'.$membershipid.'")');
}

public function changeTransactionPassword(Request $request)
{
    $membershipid=$request->membershipid;
    $password=$request->password;
    $results = DB::table('member_table')
        ->where('membershipid', '=', $membershipid)
        ->get();
    foreach ($results as $key => $v) {
        # code...
        $username=$v->username;
    }

    DB::table('users')
        ->where('username',$username)
        ->update(['transactionpass'=>$password]);


    Session::flash('flash_success','Transaction Password has been changed');
    return redirect('/showchangetransactionpassword');
}

public function showChangeTransactionPassword()
{
    return view('admin.changetransactionpassword');
}




public function getCorrectRightLegDupliction()
{
    $rightLegDuplicatedMembers=DB::select('SELECT `membershipid` ,`parentid` ,`position`,`firstname`,`middlename`,`lastname`, COUNT( * ) c FROM member_table GROUP BY `parentid` ,`position` HAVING c >1 limit 5');
      foreach ($rightLegDuplicatedMembers as $rightLegDuplicatedMember){
        $parentid=$rightLegDuplicatedMember->parentid;

          var_dump($this->getmembershipidsWithParent($parentid));
     }
}

public function getmembershipidsWithParent($parentid)
{
 return DB::table('member_table')->select('id','parentid','membershipid')->where('parentid','=',$parentid)->orderBy('id', 'asc')->get();
}

public function closeAndOpenFoodcollection()
{

}

public function showBannedUsersPage(){
    $bannedusers=DB::table('users as u')
        ->join('member_table as m', 'u.username', '=', 'm.username')->where('u.banned',1)->get();
 return view('banned.banneduserslist')->with(['bannedusers'=>$bannedusers]);
}

public function banUser($username)
{
   // dd($username);
    $todaysdate = date("Y-m-d");
    DB::table('users')->where('username',$username)->update(['banned'=>1,'banned_date'=>$todaysdate]);
}

public function checkIfUserIsBannedAndReturnBack($username)
{
  $bannedCount=DB::table('users')->where('username',$username)->where('banned',1)->count();

  if($bannedCount>0){

      return true;
  }

  return false;
}

public function showPageToBanUsers()
{
    return view('banned.banuserpage');
}


public function banUserAccount(Request $request)
{
    $membershipid=$request->membershipid;

   $username=$this->getUsernameWithMembershipId($membershipid);

   $this->banUser($username);

    Session::flash('flash_success','The Member With Id '.$membershipid.' has been Added to the banned users List');

  return redirect('/banneduserslist');
}

public function getUsernameWithMembershipId($membershipid)
{
    $result = DB::table('member_table')
        ->where('membershipid', '=', $membershipid)
        ->first();

     return   $result->username;
}

public function blockDormantAccounts(){
    ini_set('max_execution_time',60000);
    ini_set("memory_limit", "-1");
    
    $members=DB::select("select t.user_id, t.date_created from mlm_foodcollection t inner join ( select user_id, max(date_created) as MaxDate from mlm_foodcollection group by user_id ) tm on t.user_id = tm.user_id and t.date_created = tm.MaxDate and tm.MaxDate<='2019-04-01' GROUP BY t.user_id LIMIT 10000 OFFSET 180277");

    foreach ($members as $member) {
      $membershipid=$member->user_id;
        $username=$this->getUsernameWithMembershipId($membershipid);

        $this->banUser($username);
      echo 'The Member With Id '.$membershipid.' has been Added to the banned users List';
    }
}

}
