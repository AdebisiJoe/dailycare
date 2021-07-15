<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Jobs\CalculateUserBonus;
use App\Http\Controllers\websitecontroller;
use App\Members;
use App\Totalreg;
use App\User;
use App\Item;
use App\Mlmlevel;
use App\Mlmrecords;
use App\matrix;
use App\matrix_type;
use App\matrix_users_left;
use App\matrix_users_right;
use App\node;
use App\Http\Controllers\accountcontroller;
//use Node;

use App\GraphDB\MySQLToGraphDB;

class UserController extends Controller {

    //


 private $graphdb;
 public function __construct() {
  $this->middleware('auth');

  $this->graphdb=new MySQLToGraphDB();
}


/* ----------------tree algorithms ------------------------ */

public function createMatrixForaUser($membershipid)
{
    (new websitecontroller)->creatematrix($membershipid,0);

    (new accountcontroller)->addtocurrentamount($membershipid,0,0);

    echo "Created Matrix for user with membershipid ".$membershipid;

}


public function createStageOneMatrixForUser($membershipid)
{
    (new websitecontroller)->creatematrix($membershipid,1);

    (new accountcontroller)->addtocurrentamount($membershipid,0,0);

    echo "Stage 1 Matrix Created for user with membershipid ".$membershipid;

}


public function runCreateMatrixUsers(){

    ini_set('max_execution_time',60000);
    $query=DB::select("SELECT * FROM members_with_no_matrix_users WHERE updated IS NULL LIMIT 100");

    foreach ($query as $value){
        $stage=$value->type_id;
        $userid=$value->ownerid;
        $getusermatrix=$value->matrix_id;

        $this->createMatrixUsers($stage,$getusermatrix,$userid);

        DB::table('members_with_no_matrix_users')->where('ownerid',$userid)->update(['updated'=>1]);


        $message="The user with membershipid ".$userid." Matrix_users has been created";

        echo $message;
    }
}

public function deleteCreateMatrixUsers(){
    ini_set('max_execution_time',60000);
    $query=DB::select("SELECT * FROM members_with_no_matrix_users");
    foreach ($query as $value) {
        $stage = $value->type_id;
        $userid = $value->ownerid;
        $getusermatrix = $value->matrix_id;
        DB::table('matrix_users')->where('matrix_id',$getusermatrix)->delete();

        $message="The user with membershipid ".$userid." Matrix_users has been deleted";

        echo $message;

    }
}

public function createMatrixUsers($stage,$getusermatrix,$userid){

    if ($stage==0) {
        # code...
        $data = array(
            array(

                'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0,'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 4, 'trchildrenp' => 'L', 'tparent' => 2, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),

            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 5, 'trchildrenp' => 'R', 'tparent' => 2, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),

            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 6, 'trchildrenp' => 'L', 'tparent' => 3, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 7, 'trchildrenp' =>'R', 'tparent' => 3, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            )
        );

        DB::table('matrix_users')->insert($data);
    } else {
        # code...

        $data = array(
            array(

                'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0,'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 4, 'trchildrenp' => 'L', 'tparent' => 2, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),

            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 5, 'trchildrenp' => 'R', 'tparent' => 2, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),

            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 6, 'trchildrenp' => 'L', 'tparent' => 4, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 7, 'trchildrenp' =>'R', 'tparent' => 4, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 8, 'trchildrenp' => 'L', 'tparent' => 5, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'L', 'place' => 0, 'trpos' => 9, 'trchildrenp' => 'R', 'tparent' => 5, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 10, 'trchildrenp' => 'L', 'tparent' => 3, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 11, 'trchildrenp' => 'R', 'tparent' => 3, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 12, 'trchildrenp' => 'L', 'tparent' =>10, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' =>13, 'trchildrenp' => 'R', 'tparent' => 10, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 14, 'trchildrenp' => 'L', 'tparent' => 11, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            ),
            array(

                'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' =>0, 'position' => 'R', 'place' => 0, 'trpos' => 15, 'trchildrenp' => 'R', 'tparent' => 11, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0
            )
        );

        DB::table('matrix_users')->insert($data);
    }

}

public function runcodeonusertochangestage($membershipid){
  $usersatgefrommatrix=$this->getUserStageFromMatrix($membershipid);

    $member=DB::table('member_table')
        ->where('membershipid',$membershipid)
        ->first();

        $stage1=$member->stage;
        
     if ($stage1 != $usersatgefrommatrix){
         DB::table('member_table')
             ->where('membershipid', $membershipid)
             ->update(['stage' => $usersatgefrommatrix]);

         $this->graphdb->setStageInGraphDB($membershipid,$usersatgefrommatrix);

     }


      (new accountcontroller)->addtocurrentamount($membershipid,0,0);

      DB::table('matrix_old')->where('ownerid',$membershipid)->update(['updated'=>1]);


   $message="The user with membershipid ".$membershipid." has been set to correct stage";
    echo $message;
}

public function setusersstagetotherightone(){

  ini_set('max_execution_time',60000);
  $query=DB::select("SELECT ownerid FROM matrix_old where type_id > 0 AND updated IS NULL AND created_at between '2018-02-13' and '2018-02-15'");

  foreach ($query as  $value) {
    # code...
    $membershipid=$value->ownerid;
    $this->runcodeonusertochangestage($membershipid);

  }
}


public function GetDownline($memberid, $direction) {

  $results = DB::table('member')
  ->where('sponsorid', '=', $memberid)
  ->where('position', '=', $direction)
  ->get();


  foreach ($results as $id) {
    $memidok = $id->memid;
  }
  return $memidok;
}


public function  setAcceptTerms(Request $request){

    $membershipid=$request->membershipid;
    $results = DB::table('member_table')
        ->where('membershipid', '=',$membershipid)
        ->update(['accepttermstatus'=>1]);

        return json_encode(['successful'=>'success']);
}




public function returntodaysdate() {
    $date = new \DateTime(); //the create a new date instance for todays date note the \ in front of DateTime() is import DateTime class //// it can rather be done using     use DateTime(); where other namespaces are decleared
    $result = $date->format('m-Y-d');

    //$krr=explode("-",$result);
    //$result=implode("",$krr);
    //$myfunctions = new \App\Controllers\UserController;
    //echo ($myfunctions->generaterandomalphbet(4));

    return $result;
  }


  public function generaterandomalphbet($random_string_length) {
    $characters = 'BCDFGHJKLMNPQRSTVWXYZ';
    $string = "";
    for ($i = 0; $i < $random_string_length; $i++) {
      $string.=$characters[rand(0, strlen($characters) - 1)];
    }

    return $string;
  }
 //generate random key
  public function generateKey($length) {
    /// Random characters
    $characters = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $date = date("Y-m-d H:i:s");
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

  public function filltotalregtable() {
    $todaysdate = new \DateTime();
    $result = $todaysdate->format('Y-m-d');
    $totalreg = new Totalreg;
    $data = $totalreg::firstOrCreate(['date' => $result]);
    return $data;
  }

  public function showregister() {
    return view("auth.register");
  }


  public function appsetting(){

    return view("admin.appsetting");
  }

  public function getusernames($username,$num){
   $usernames=array();
   $num=$num+1;
   for ($i=0; $i <$num ; $i++) {

    $usernames[$i]=$username.$i;
  }
  array_shift($usernames);
  return $usernames;
}




public function getfirstchild($parentid,$direction){
 $results = DB::table('member_table')
 ->where('parentid', '=', $parentid)
 ->where('position', '=', $direction)
 ->get();

 foreach ($results as $key => $v) {

  return ["membershipid" => $v->membershipid,"stage"=>$v->stage];
}

}

public function getusercurrentleftmatrix($userid){

    //get user stage
  $stage=$this->getuserstage($userid);
    //get matrixid of user  
  $matrixid=$this->getmatrixidofuser($userid,$stage);     
  $results = DB::table('matrix_users_left')
  ->where('matrix_id', '=', $matrixid)
  ->get();
  $data= array();
  $i=0;
  foreach ($results as $key => $v) {

   $data[$i]= $v->user_id;
   $i++;
 }           

 return $data;        
}



public function  getuserstage($userid){
  $results = DB::table('member_table')
  ->where('membershipid', '=', $userid)
  ->get();

  foreach ($results as $key => $v) {

    $stage= $v->stage;
  }


  return $stage;
}

public function getmatrixidofuser($userid,$stage){
    //get matrixid of user     
  $results = DB::table('matrix')
  ->where('ownerid', '=', $userid)
  ->where('type_id', '=', $stage)
  ->get(); 
  foreach ($results as $key => $v) {

   $matrixid= $v->matrix_id;

 }
 return $matrixid;        
}





public function showlmssetting() {
   // INSERT INTO `mlm_stagebonus`(`id`, `bonus`, `stage_number`, `name`, `noofdownlines`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
  $mlmlevel= DB::table('mlm_stagebonus')
  ->join('stage_bonus', 'mlm_stagebonus.stage_number', '=', 'stage_bonus.level_number')
  ->select('mlm_stagebonus.*','stage_bonus.stage_number','stage_bonus.bonus')
  ->get();
    //$mlmlevel = Mlmlevel::all();
  $countrycurrencies=DB::table('mlm_country')
  ->select('mlm_country.*')
  ->get();        

  return view('admin.adminsetting')->with('mlmlevel', $mlmlevel)->with('countrycurrencies', $countrycurrencies);
}

public function showhome(Request $request) {
  $role=Auth::user()->role;

  //New by Emma
  $sessval = '';

  if ($role=="firstuser" || $role=="user" ) {
  # code...
    $username=Auth::user()->username;
    $member=DB::table('member_table')
    ->where('username',$username)
    ->first();
    if ($member==null) {
           # code...
    } else {
           # code...

        # code...
     $membershipid= $member->membershipid;
     $stage1=$member->stage;
     $status = $member->accepttermstatus;

//     $graphdbstage=$this->graphdb->getStageInGraphDB($membershipid);
//
//     if ($stage1>$graphdbstage){
//         $this->graphdb->setStageInGraphDB($membershipid,$stage1);
//     }

     $usersatgefrommatrix=$this->getUserStageFromMatrix($membershipid);

     if ($stage1 != $usersatgefrommatrix){
         DB::table('member_table')
             ->where('membershipid', $membershipid)
             ->update(['stage' => $usersatgefrommatrix]);

         $this->graphdb->setStageInGraphDB($membershipid,$usersatgefrommatrix);

     }


        (new accountcontroller)->addtocurrentamount($membershipid,0,0);



  // $value=$request->session()->get('calculatebonus','notset'); 
  //New by Me
  //$request->session()->put('calculatebonus','SET');
   
   // if ($value=='notset') {
     # code...
     // Store a piece of data in the session...
    // $request->session()->put('calculatebonus','set');
    //$value=$request->session()->get('calculatebonus');
    // $stage=(new websitecontroller)->fillmatrix2($membershipid);

  //New by Me
 // $request->session()->put('calculatebonus','GET');


  // $request->session()->forget('calculatebonus'); 
  //dd($request->session()->get('calculatebonus'));
  // $value=$request->session()->get('calculatebonus');
 
 // }else{
 //  dump("Else PArt of COndition");
 // }


     
     //$this->dispatch(new CalculateUserBonus($membershipid));
  //$job = (new CalculateUserBonus($membershipid))->delay(60);

  //$this->dispatch($job);
     //(new accountcontroller)->sendtocurrentamount($membershipid);

   }
 //this query gets the no of people user has reffered and their referal bonus    
    $results=DB::table('refferal_bonus')
   ->where('membershipid',"=",$membershipid)
   ->count();
   $reffered=$results;
   $referralbonus=$results*4;
   //foreach ($results as $key => $v) {
  # code...
    //$reffered=$v->noofreffered;

    //$referralbonus=$v->bonus;
  //}
//the query below counts the downlines below the user
  $downlines =$this->countdownlines($membershipid); 

  //$downlines =0; 
//the user is counted in query minus him         
//the if statment below is to differenciate if the user is a first user or not
  $accountcontroller=new accountcontroller();
  $walletbalance=$accountcontroller->displaywallet($membershipid);
  if (Auth::user()->role=='firstuser') {
  # code...
    return view('user.userdashboard')->with('membershipid',$membershipid)->with('stat',$status)->with('stage',$stage1)->with('reffered',$reffered)->with('walletbalance',$walletbalance)->with('downlines',$downlines);//->with('value',$value);
  } elseif($reffered==null) {
  # code...
     return view('user.userdashboard')->with('membershipid',$membershipid)->with('stat',$status)->with('stage',$stage1)->with('reffered',0)->with('walletbalance',0)->with('downlines',0);
  }else{
    return view('user.userdashboard')->with('membershipid',$membershipid)->with('stat',$status)->with('stage',$stage1)->with('reffered',$reffered)->with('walletbalance',$walletbalance)->with('downlines',$downlines);
  }

//return view('user.userdashboard')->with('membershipid',$membershipid)->with('stage',$stage1)->with('reffered',$reffered)->with('referralbonus',$referralbonus);


}else{
  return view('home');
}

}

    public function getUserStageFromMatrix($membershipid){
        $result=DB::table('matrix')->where('ownerid',$membershipid)->get();

        if ($result==null) {
          $websitecontroller=new websitecontroller();
          $websitecontroller->creatematrix($membershipid,0);
        }

        $result=DB::table('matrix')->where('ownerid',$membershipid)->get();

        foreach ($result as $v) {
            $userstage=$v->type_id;
        }

        return $userstage;
    }


public function showwalletdashboad(){
 //return view('user.walletdashboard')->with('membershipid',$membershipid)->with('stage',$stage1);
}
public function countdownlines($membershipid){
  /*$downlines=DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=', $membershipid)
  ->count();*/
  $downlines=DB::table('member_table as m')
  ->where('membershipid', '=', $membershipid)
  ->select('downlines')
  ->first();
  if ($downlines->downlines==null || $downlines->downlines==0) {
    # code...
    $downlines=0;
    return $downlines;
  }
  $count=$downlines->downlines-1;
  return $count;
}


/*public function returntable() {

  $results = DB::table(' mlm_levelbonus')
  ->where('sponsorid', '=', $v->memid)
  ->orderBy('position')
  ->get();

  $mlmlevel = Mlmlevel::all();
  return view('admin.adminsetting', ['mlmlevel' => $mlmlevel]);
}*/



//get the matrix of the user 
public function getusermatrix($userid){
  $results = DB::table('member_table')
  ->where('membershipid', '=',$userid)
  ->get();           
  foreach ($results as $key => $v) {
   $stage=$v->stage;  
 } 

 $results2 = DB::table('matrix')
 ->where('ownerid', '=',$userid)
 ->where('type_id', '=',$stage)
 ->get();           

 foreach ($results2 as $key => $v) {

  $matrix_id=$v->matrix_id;

}

return $matrix_id;
}







public function showdownlines(){
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
  $data.=$this->drawtree2($membershipid);



  return view('chart.downlines')->with('data',$data)->with('members', $members);                    
}


public function drawstage1tree(){
  $membershipid=$this->getuseridwithusername();
  $matrixid=$this->getusermatrix($membershipid);
  $childof12="";
  $childof13="";
  $childof24="";
  $childof25="";
  $childof36="";
  $childof37="";
  $user1=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"1")
  ->first();

  $user2=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"2")
  ->first();

  $user3=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"3")
  ->first();

  $user4=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"4")
  ->first();

  $user5=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"5")
  ->first();

  $user6=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"6")
  ->first();

  $user7=DB::table('matrix_users as m')
  ->join('member_table as mt', 'm.user_id', '=', 'mt.membershipid')
  ->where('matrix_id', '=', $matrixid)
  ->where('trpos', '=',"7")
  ->first();

   //  if ($user1==null) {
    # code...
   // $childof1=['id'=>"0",'name'=>'not filled',
//'title'=>"12","stage"=>"",'relationship'=>"110"];
 // } else {
    # code...
   // $childof1=['id'=>$user1->membershipid,'name'=>$user1->firstname,
//'title'=>$user1->stage,"stage"=>$user1->stage,'relationship'=>"111"];
 // }

  if ($user2==null) {
    # code...
    $childof12=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof12=['id'=>$user2->membershipid,'name'=>$user2->firstname,
    'title'=>$user2->stage,"stage"=>$user2->stage,'relationship'=>"111"];
  }
  if($user3==null) {
    # code...
    $childof13=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof13=['id'=>$user3->membershipid,'name'=>$user3->firstname,
    'title'=>$user3->stage,"stage"=>$user3->stage,'relationship'=>"111"];
  }

  if ($user4==null) {
    # code...
    $childof24=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof24=['id'=>$user4->membershipid,'name'=>$user4->firstname,
    'title'=>$user4->stage,"stage"=>$user4->stage,'relationship'=>"111"];
  }
  if ($user5==null) {
    # code...
    $childof25=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof25=['id'=>$user5->membershipid,'name'=>$user5->firstname,
    'title'=>$user5->stage,"stage"=>$user5->stage,'relationship'=>"111"];
  }
  if ($user6==null) {
    # code...
    $childof36=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof36=['id'=>$user6->membershipid,'name'=>$user6->firstname,
    'title'=>$user6->stage,"stage"=>$user6->stage,'relationship'=>"111"];
  }
  if ($user7==null) {
    # code...
    $childof37=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof37=['id'=>$user7->membershipid,'name'=>$user7->firstname,
    'title'=>$user7->stage,"stage"=>$user7->stage,'relationship'=>"111"];
  }
  //dd($childof36);
  /*dd($user6);
   print_r($user1); 
   print_r($user2); 
   print_r($user3); 
   print_r($user4); 
   print_r($user5); 
   print_r($user6);
   print_r($user7); 
   exit("printed");*/
 
  $data=[
  'id'=>$user1->membershipid,
  'name'=>$user1->firstname,
  'title'=>$user1->stage,
  'stage'=>$user1->stage,
  'relationship'=>"001",
  'children'=>[
  $childof12,
  'children'=>[
  $childof24,
  $childof25
  ],
  $childof13,
  'children'=>[
  $childof36,
  $childof37
  ]
  ]
  ];


  return json_encode($data);
 //dd($user2);
 //dd($user4);
  //dd($data);
}





public function drawtreerecursion($matrix_id,$parentid,$data=""){

  $query = DB::table('matrix_users')
  ->where('matrix_id', '=',$matrix_id)
  ->where('tparent', '=',$parentid)
  ->get();   
  foreach ($query as $key => $v) {
   $userid=$v->user_id;
   $trpos=$v->trpos;

   if ($userid=="0") {
         # code...
    $data.="<ul>
    <li id='12_empty_empty_empty'>Empty";
    } else {
         # code...

     $results = DB::table('member_table')
     ->where('membershipid', '=',$userid)
     ->get();
     foreach ($results as $key => $v) {
         # code...
       $userid=$v->membershipid;
       $username=$v->username;
       $firstname=$v->firstname;
       $lastname=$v->lastname;
       $stage=$v->stage;

     }
     $data.="<ul id=''>
     <li id='".$stage."_".$username."_".$firstname."_".$lastname."'>".$username." ".$lastname."";

     }

     $data=$this->drawtreerecursion($matrix_id,$trpos,$data);
     $data.="</li>
   </ul>";

    }//second foreachloop

    return $data;
  }

  public function drawtree2($userid){        


    $data="";
    $stage=$this->getuserstage($userid);
    $matrix_id=$this->getusermatrix($userid);

    $query =DB::table('matrix_users')
    ->where('matrix_id', '=',$matrix_id)
    ->where('trpos', '=',1)
    ->get();

    foreach ($query as $key => $v) {
         # code...
     $userid=$v->user_id;
     $trpos=$v->trpos;

     $results = DB::table('member_table')
     ->where('membershipid', '=',$userid)
     ->get();
     foreach ($results as $key => $v) {
         # code...
       $userid=$v->membershipid;
       $username=$v->username;
       $firstname=$v->firstname;
       $lastname=$v->lastname;
       $stage=$v->stage;
     } 
   }   $data.="<ul id='ul-data' style='display: none;'>
   <li id='".$stage."_".$username."_".$firstname."_".$lastname."'>".$username." ".$lastname."";


    $data=$this->drawtreerecursion($matrix_id,$trpos,$data);
    $data.="</li>
  </ul>"; 


  return $data;
}




public function showprofile(){

  $username=Auth::user()->username;
  $records = DB::table('users as u')
  ->join('member_table as m', 'u.username', '=', 'm.username')
  ->select('u.*','m.*','u.id as idforuser','m.id as idformember')
  ->where('u.username','=',$username)
  ->get(); 

  return view('user.viewprofile')->with("records",$records);  
}  


public function editprofile(){
   // return "contact admin to edit profile";
  $username=Auth::user()->username;
  $records = DB::table('users as u')
  ->join('member_table as m', 'u.username', '=', 'm.username')
  ->select('u.*','m.*','u.id as idforuser','m.id as idformember')
  ->where('u.username','=',$username)
  ->get();

  return view('user.viewprofile')->with("records",$records);
}

public function showeditbankinfo(){
  $username=Auth::user()->username;
  $records = DB::table('users as u')
  ->join('member_table as m', 'u.username', '=', 'm.username')
  ->select('u.*','m.*','u.id as idforuser','m.id as idformember')
  ->where('u.username','=',$username)
  ->get();



  return view('user.editbankdetails')->with("records",$records);
}

public function showeditpersonalinfo(){
  $username=Auth::user()->username;
  $records = DB::table('users as u')
  ->join('member_table as m', 'u.username', '=', 'm.username')
  ->select('u.*','m.*','u.id as idforuser','m.id as idformember')
  ->where('u.username','=',$username)
  ->get();


  return view('user.editpersonalinfo')->with("records",$records);
}

public function showeditpasswordinfo(){

  return view('user.editpassword');
}


public function showeditWalletinfo(){

  return view('user.editwalletpassword');
}


public function editpersonalinfo(Request $request){
    
   

   //return "Editing of Profile is not Available Contact Adminstrator";

    
//echo $request->dob;
    

 $username=Auth::user()->username;

 $result = DB::table('member_table')

 ->where('username','=',$username)

 ->first();

 $idformember=$result->id;

 $member = new members;

 $user=new User;

  

  

 $user=$user::find(Auth::user()->id);

 $user->email=$request->email;

 $user->name=$request->firstname;

 $user->save();



 $member =  $member::find($idformember);

 $mainAccountId=$member->isownedby;



 DB::table('member_table')->where('isownedby','=',$username)->where('type','=','subaccount')->update(

        [

            'firstname' =>$request->firstname,

     'middlename' => $request->middlename,

     'lastname' => $request->lastname,

     'phonenumber'=> $request->phonenumber,

     'dob'=>$request->dob,

     'state' =>$request->state,

     'city'=>$request->city,

     'country' =>$request->country,

     'address'=>$request->address,
     'email' =>$request->email

        ]

    );





 $member->firstname = $request->firstname;

 $member->middlename = $request->middlename;

 $member->lastname = $request->lastname;

 $member->phonenumber= $request->phonenumber;

 $member->dob=$request->dob;

 $member->state =$request->state;

 $member->city =$request->city;

 $member->country =$request->country;

 $member->address =$request->address;
$member->email =$request->email;


 $member->save();

 return redirect("/viewprofile");
}

public function editbankinfo(Request $request){
  // return "Editing of Profile is not Available Contact Adminstrator";

 $username=Auth::user()->username;
 $result = DB::table('member_table')
 ->where('username','=',$username)
 ->first();
 $idformember=$result->id;
 $member = new members;

 $member =  $member::find($idformember);


 $member->accountname =$request->accountname;
 $member->accountnumber = $request->accountnumber;
 $member->bankname =$request->bankname;
 $member->bankbranch =$request->bankbranch;
 $member->save();
 Session::flash('flash_success','You have edited your personal profile');
 return redirect("/viewprofile");
 
}

public function editpasswordinfo(Request $request){


  if ($this->checkifpasswordexistforuser($request->oldpassword)==false) {
      # code...
    $validator="The password you entered is  not corret";
    return redirect('/changepassword')
    ->withErrors($validator)
    ->withInput();

    }else{

     $newpassword=$request->newpassword;
     $confirmnewpassword=$request->confirmnewpassword;
     if ($newpassword==$confirmnewpassword) {
       # code...
        $userid=Auth::user()->id;
        $newpassword=Hash::make($newpassword);
        DB::table('users')
        ->where('id',$userid)
        ->update(['password'=>$newpassword]);

        Session::flash('flash_success','Password has been changed');
        return redirect('/changepassword');
        }
        else {
        Session::flash('flash_danger','The New password does not match the confirm password');
        return redirect('/changepassword');
    }

}



}


public function editWalletpasswordinfo(Request $request){


  if ($this->checkifWalletpasswordexistforuser($request->oldpassword)==false) {
      # code...
    $validator="The password you entered is  not corret";
    return redirect('/changewalletpassword')
    ->withErrors($validator)
    ->withInput();

    }else{

     $newpassword=$request->newpassword;
     $confirmnewpassword=$request->confirmnewpassword;

     if ($newpassword==$confirmnewpassword) {
       # code...
        $userid=Auth::user()->id;
        DB::table('users')
        ->where('id',$userid)
        ->update(['transactionpass'=>$newpassword]);

        Session::flash('flash_success','Password has been changed');
        return redirect('/changewalletpassword');
        }
        else {
        Session::flash('flash_danger','The password does not match the confirm password');
        return redirect('/changewalletpassword');
    }

}



}


   public function checkifWalletpasswordexistforuser($password)
   {

        $userid=Auth::user()->id;

        $exist=DB::table('users')->where('id',$userid)->first();

        if (is_null($exist->transactionpass)) {
          
          return true;
        }

        elseif ($exist->transactionpass==$password) {
          return true;
        }

        else
        {
          return false;
        }



    
   }




public function updateprofile(Request $request){
    
    
    //return "Editing of Profile is not Available Contact Adminstrator";
 
    
  $member = new members;
  $user = new User;
  $mlmusersrecords = new Mlmrecords;
  $matrix_type=new matrix_type;
  $matrix=new matrix;
  $matrix_users_left=new matrix_users_left;
  $matrix_users_right=new matrix_users_right;
  $todaysdate = date("Y-m-d");
  if ($this->checkiftranspasswordexist($request->oldtransactionpass)==false) {
       # code...
    $validator="The Transaction password you entered is  not corret";
    return redirect('/editprofile')
    ->withErrors($validator)
    ->withInput();
  }

  if ($this->checkifpasswordexistforuser($request->oldpassword)==false) {
      # code...
    $validator="The password you entered is  not corret";
    return redirect('/editprofile')
    ->withErrors($validator)
    ->withInput();

  }
  $member =  $member::find($request->idformember);
  $user = $user::find($request->idforuser);



  $member->firstname = $request->firstname;
  $member->middlename = $request->middlename;
  $member->lastname = $request->lastname;
  $member->phonenumber= $request->phonenumber;
  //$member->sex = $request->sex;
  //$member->dob = $request->dob;
  //$member->country =$request->country;
  $member->state =$request->state;
  $member->city =$request->city;
  $member->address =$request->address;
  $member->accountname =$request->accountname;
  $member->accountnumber = $request->accountnumber;
  $member->bankname =$request->bankname;
  $member->bankbranch =$request->bankbranch;
  $member->save();

  $user->name = $request->firstname;
  $user->email =$request->email;
  $user->password = \Hash::make($request->password);
  $user->transactionpass = $request->transactionpass;
  $user->save();
  $username=Auth::user()->username;
  // $records3 = DB::table('member_table')
  // ->where('baseusername','=',$username)
  // ->get(); 
  // foreach ($records3 as $key => $v) {
  //   # code...
  //   $result = DB::table('member_table')
  //   ->where('username','=',$v->username)
  //   ->first();
  //   $theid=$result->id;
  //   $member =  $member::find($theid);

  //   $member->firstname = $request->firstname;
  //   $member->middlename = $request->middlename;
  //   $member->lastname = $request->lastname;
  //   $member->phonenumber= $request->phonenumber;
  // //$member->sex = $request->sex;
  // //$member->dob = $request->dob;
  // //$member->country =$request->country;
  //   $member->state =$request->state;
  //   $member->city =$request->city;
  //   $member->address =$request->address;
  //   $member->accountname =$request->accountname;
  //   $member->accountnumber = $request->accountnumber;
  //   $member->bankname =$request->bankname;
  //   $member->bankbranch =$request->bankbranch;
  //   $member->save();

  // }
  $username=Auth::user()->username;
  $records = DB::table('users as u')
  ->join('member_table as m', 'u.username', '=', 'm.username')
  ->select('u.*','m.*','u.id as idforuser','m.id as idformember')
  ->where('u.username','=',$username)
  ->get();
  return view('user.editprofile')->with("records",$records); 
}
public function checkifpasswordexistforuser($password){


  return Hash::check($password,Auth::user()->password);
}
public function checkiftranspasswordexist($transactionpass){
 $pass=Auth::user()->transactionpass;
 if ($pass==$transactionpass) {
     # code...
  return true;
} else {
     # code...
  return false;
}

}
public function showreferrallink(){

  $username=Auth::user()->username;
  return view('marketing.referrallink')->with('username',$username);
}

public function showaddaccount(Request $request){
  return view('user.addaccount');
}

public function getsubaccounts(){
  $membershipid=$this->getuseridwithusername();

  $results=DB::table('member_table')->where('isownedby','=',$membershipid)->where('type','=','subaccount')->get();

  return view('user.showsubaccounts')->with('results',$results);
}

public function getuseridwithusername(){
 $username=Auth::user()->username;
 $user=DB::table('member_table')->where('username','=',$username)->first();

 return $membershipid=$user->membershipid;

}

public function checkifsuaccountisformain($membershipid)
{
  # code...
  $parent=$this->getuseridwithusername();
  $query=DB::table('member_table')
  ->where('membershipid',$membershipid)
  ->where('isownedby',$parent)
  ->count();

  if (is_null($query)||$query==0) {
    # code...
    return false;
  } else {
    # code...
    return true;
  }
  

}

public function showpaidpayoutforusers (){
 $userid=$this->getuseridwithusername();
 $payouts=DB::table('payoutcash')
 ->where('status','paid')
 ->where('userid',$userid)
 ->paginate(10);
 return view('user.showpaidpayout')->with(['payouts'=>$payouts]);
}

public function showpendingpayoutforusers(){
 $userid=$this->getuseridwithusername();
 $pendpayouts=DB::table('payoutcash')
 ->where('status','pending')
 ->where('userid',$userid)
 ->paginate(10);
 return view('user.showpendingpayout')->with(['payouts'=>$pendpayouts]);
}

public function showmembertreepage(){

  $membershipid=$this->getuseridwithusername();
//$data=$this->sendusermemberstreeinitialdata();
//dd($data);
//return view('user.viewmembers')->with(['membershipid'=>$membershipid,'data'=>$data]);
  return view('user.viewmembers')->with(['membershipid'=>$membershipid]);
}

public function sendusermemberstreeinitialdata(){
 $membershipid=$this->getuseridwithusername();
 $user=DB::table('member_table')->where('membershipid','=',$membershipid)->first();
 $child1=DB::table('member_table')->where('parentid','=',$membershipid)->where('position','=','L')->first(); 
 $child2=DB::table('member_table')->where('parentid','=',$membershipid)->where('position','=','R')->first();
  //header('Content-Type: application/json');

 if ($child1==null) {
    # code...
  $childof1=['id'=>"0",'name'=>'not filled',
  'title'=>"12","stage"=>"",'relationship'=>"110"];
} else {
    # code...
  $childof1=['id'=>$child1->membershipid,'name'=>$child1->firstname,
  'title'=>$child1->stage,"stage"=>$child1->stage,'username'=>$child1->username,'relationship'=>"111"];
}

if ($child2==null) {
    # code...
  $childof2=['id'=>"0",'name'=>'not filled',
  'title'=>"12","stage"=>"",'relationship'=>"110"];
} else {
    # code...
  $childof2=['id'=>$child2->membershipid,'name'=>$child2->firstname,
  'title'=>$child2->stage,"stage"=>$child2->stage,'username'=>$child2->username,'relationship'=>"111"];
}


$data=[
'id'=>$user->membershipid,
'name'=>$user->firstname,
'title'=>$user->stage,
'stage'=>$user->stage,
'username'=>$user->username,
'relationship'=>"001",
'children'=>[
$childof1,
$childof2
]
];


return $data=json_encode($data);
}

public function sendchildrenchildrendata($membershipid){

  $child1=DB::table('member_table')->where('parentid','=',$membershipid)->where('position','=','L')->first(); 
  $child2=DB::table('member_table')->where('parentid','=',$membershipid)->where('position','=','R')->first();



  if ($child1==null) {
    # code...
    $childof1=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof1=['id'=>$child1->membershipid,'name'=>$child1->firstname,
    'title'=>$child1->stage,"stage"=>$child1->stage,'username'=>$child1->username,'relationship'=>"111"];
  }

  if ($child2==null) {
    # code...
    $childof2=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof2=['id'=>$child2->membershipid,'name'=>$child2->firstname,
    'title'=>$child2->stage,"stage"=>$child2->stage,'username'=>$child2->username,'relationship'=>"111"];
  }

  $data=['children'=>[
  $childof1,
  $childof2
  ]];


  return $data=json_encode($data);
}

public function searchifuserisdownline($downlinemembershipid1){

  $membershipid=$this->getuseridwithusername();

  $downlines=DB::table('member_table as m')
  ->select('membershipid')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=', $membershipid)
  ->whereIn('t.descendant', [$downlinemembershipid1])
  ->first();
  //$downlinemembershipid=$downlines->$membershipid;

   if(empty($downlines->membershipid)){
    
   

    $data=[
  'id'=>'empty',
  'name'=>'empty',
  'title'=>'empty',
  'stage'=>'empty',
  'relationship'=>'empty'];

return json_encode($data);

   }else{
    $downlinemembershipid=$downlines->membershipid;
   $user=DB::table('member_table')->where('membershipid','=',$downlinemembershipid)->first();
   $child1=DB::table('member_table')->where('parentid','=',$downlinemembershipid)->where('position','=','L')->first(); 
   $child2=DB::table('member_table')->where('parentid','=',$downlinemembershipid)->where('position','=','R')->first();

   if ($child1==null) {
    # code...
    $childof1=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof1=['id'=>$child1->membershipid,'name'=>$child1->firstname,
    'title'=>$child1->stage,"stage"=>$child1->stage,'relationship'=>"111"];
  }

  if ($child2==null) {
    # code...
    $childof2=['id'=>"0",'name'=>'not filled',
    'title'=>"12","stage"=>"",'relationship'=>"110"];
  } else {
    # code...
    $childof2=['id'=>$child2->membershipid,'name'=>$child2->firstname,
    'title'=>$child2->stage,"stage"=>$child2->stage,'relationship'=>"111"];
  }
  

  $data=[
  'id'=>$user->membershipid,
  'name'=>$user->firstname,
  'title'=>$user->stage,
  'stage'=>$user->stage,
  'relationship'=>"001",
  'children'=>[
  $childof1,
  $childof2
  ]
  ];
  return $data=json_encode($data);
}


}
public function updateUserDownlinesField($membershipid)
{

}

public function countUserDownlineswithAjax(Request $request)
{
  $post = $request->all();
  $membershipid = strtoupper($post['membershipid']);

$value=$request->session()->get('calculatedownlines',false);

if ($value==false) {
    # code...
  $request->session()->put('calculatedownlines',true);
  
  // $count=DB::table('member_table as m')
  // ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  // ->where('t.ancestor', '=',$membershipid)
  // ->count();

   $count =$this->graphdb->countdownlines($membershipid);
   $downlinescount=$count["numberofdownlines"];

   
  DB::table('member_table')
  ->where('membershipid', $membershipid)
  ->update(['downlines' => $downlinescount]);

  $downlinescount=$this->countdownlines($membershipid);
$request->session()->forget('calculatedownlines');
  return json_encode(['downlinescount'=>$downlinescount]);
  } else {
    # code...
    $downlinescount=$this->countdownlines($membershipid);
    return json_encode(['downlinescount'=>$downlinescount]);
  }
  
}

public function CalculateUserBonusWithAjax(Request $request)
{
$post = $request->all();
$membershipid = strtoupper($post['membershipid']);
ini_set('max_execution_time',3000);
 
$stage=(new websitecontroller)->fillmatrix2($membershipid);
$accountcontroller=new accountcontroller();
$walletbalance=$accountcontroller->displaywallet($membershipid);
$stage1=$this->getuserstage($membershipid);
$request->session()->forget('calculatebonus'); 
return json_encode(['walletbalance'=>$walletbalance,'stage'=>$stage1]);
}
public function showUserDownlines($membershipid="HW00016412")
{
  $results=DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=',$membershipid)
  ->get();
  dd($results);
}

public function buttonCalculateUserBonus()
{
  $username=Auth::user()->username;
    $member=DB::table('member_table')
    ->where('username',$username)
    ->first();
}

public function buttonCalculateUserDownlines()
{

}


public function showmemberstablepagegraph(Request $request){
    $customerusername=Auth::user()->username;
  $results = DB::table('member_table')
  ->where('username', '=', $customerusername)
  ->get();  
  foreach ($results as $key => $v) {
    $membershipid=$v->membershipid;
    $stage=$v->stage;
  }
    
    
  if($request->take < 2){
    $take = 0;
  }else{
      $take = $request->limit * ($request->take - 1);
  }

  $members = $this->graphdb->showmemberstablepage($membershipid, $take, $request->limit);
  
  $firstrightchildmembers = json_decode (json_encode ($members["leftmembers"]), FALSE);

  $firstleftchildmembers =json_decode (json_encode ($members["rightmembers"]), FALSE);


    return view('user.graphmembertable')->with('firstrightchildmembers',json_decode (json_encode ($members["leftmembers"]), FALSE))->with('firstleftchildmembers',json_decode (json_encode ($members["rightmembers"]), FALSE))->with('take',$request->take)->with('limit',$members["take"]);
}

public function showmemberstablepage(){

 $customerusername=Auth::user()->username;
  $results = DB::table('member_table')
  ->where('username', '=', $customerusername)
  ->get();  
  foreach ($results as $key => $v) {
   # code...
    $membershipid=$v->membershipid;
    $stage=$v->stage;
  }
  
  $firstleftchild =$this->getfirstchild($membershipid,"L");
  $firstleftchildmembershipid = $firstleftchild['membershipid'];


  // $firstleftchildmembers = DB::table('member_table as m')
  // ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  // ->where('t.ancestor', '=', $firstleftchildmembershipid)
  // ->paginate(10);


  $firstleftchildmembers= DB::table('member_table as m1')
  ->join('member_table as m2', 'm2.parentid', '=', 'm1.membershipid','left outer')
  ->join('member_table as m3',  'm3.parentid', '=', 'm2.membershipid','left outer')
  ->join('member_table as m4', 'm4.parentid', '=', 'm3.membershipid','left outer')
  ->join('member_table as m5', 'm5.parentid', '=', 'm4.membershipid','left outer')
  ->join('member_table as m6', 'm6.parentid', '=', 'm5.membershipid','left outer')
  //->join('member_table as m7', 'm7.parentid', '=', 'm6.membershipid','left outer')

  ->where('m1.membershipid', '=', $firstleftchildmembershipid)
  ->paginate(10);


  $firstrightchild = $this->getfirstchild($membershipid, "R");
  $firstrightchildmembershipid = $firstrightchild['membershipid'];

  // $firstrightchildmembers = DB::table('member_table as m')
  // ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  // ->where('t.ancestor', '=', $firstrightchildmembershipid)
  // ->paginate(10);


  $firstrightchildmembers= DB::table('member_table as m1')
  ->join('member_table as m2', 'm2.parentid', '=', 'm1.membershipid','left outer')
  ->join('member_table as m3',  'm3.parentid', '=', 'm2.membershipid','left outer')
  ->join('member_table as m4', 'm4.parentid', '=', 'm3.membershipid','left outer')
  ->join('member_table as m5', 'm5.parentid', '=', 'm4.membershipid','left outer')
  ->join('member_table as m6', 'm6.parentid', '=', 'm5.membershipid','left outer')
  //->join('member_table as m7', 'm7.parentid', '=', 'm6.membershipid','left outer')
 
  ->where('m1.membershipid', '=', $firstrightchildmembershipid)
  ->paginate(10);

   return view('user.membertablepage')->with('firstrightchildmembers',$firstrightchildmembers)->with('firstleftchildmembers',$firstleftchildmembers);
  // $members=$this->graphdb->showmemberstablepage($membershipid);
  
  // $firstrightchildmembers = json_decode (json_encode ($members["leftmembers"]), FALSE);

  // $firstleftchildmembers =json_decode (json_encode ($members["rightmembers"]), FALSE);


  //   return view('user.graphmembertable')->with('firstrightchildmembers',json_decode (json_encode ($members["leftmembers"]), FALSE))->with('firstleftchildmembers',json_decode (json_encode ($members["rightmembers"]), FALSE));
}

public function getJoinDate()
{


    return date('F d, Y', strtotime(Auth::user()->created_at));


}

public function  showreferred(){
    $membershipid=$this->getuseridwithusername();
    $sponsor = DB::table('member_table')->select('username', 'firstname', 'lastname')->where('sponsorid', '=', $membershipid )->get();


    return view('user.showreferred', compact('sponsor'));
}

public function downloadForm(){
   $file= public_path(). "/2018-awardform.docx";
$headers = [
              'Content-Type' => 'application/octet-stream',
              
           ];

return response()->download($file, '2018-awardform.docx', $headers);
}

public function calculateDownlinesCron(Request $request){
ini_set('max_execution_time',60000);
   $allMembers = DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-04-24', '2018-04-30'])->where("group_leader_id", $request->group_leader_id)->distinct()->get(['user_id']);

   foreach ($allMembers as $value) {
     # code...
    $userid=$value->user_id;

    $count =$this->graphdb->countdownlines($userid);
   $downlinescount=$count["numberofdownlines"];

   
  DB::table('member_table')
  ->where('membershipid', $userid)
  ->update(['downlines' => $downlinescount]);

  echo "calculate downlines for ".$userid." downlines: ".$downlinescount;
   }
}

public function getmembersfornewstagefour(Request $request){
  $membershipid=$request->membershipid;
  $data=$this->graphdb->getMemberInstagefourDownlines($membershipid);

  
  
  $userdata = json_decode (json_encode ($data["userdata"]), FALSE);

  return view('user.membersfornewstagefour')->with(['members'=>$userdata,'membershipid'=>$membershipid]);


    //return view('user.stagefourmembertable')->with('firstrightchildmembers',json_decode (json_encode ($members["leftmembers"]), FALSE));

}

}
