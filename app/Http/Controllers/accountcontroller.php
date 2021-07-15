<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use App\Members;
use App\Totalreg;
use App\User;
use App\Item;
use App\Mlmlevel;
use App\Mlmrecords;
use App\payoutcash;
use App\transferedcash;
use App\personalcash;
use App\foodcash;
use App\fundedaccount;
use App\currentaccount;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class accountcontroller extends Controller
{
 public function __construct() {
  $this->middleware('auth');
}


public function showlock(Request $request){
  if(\Auth::check()){

    $value = $request->session()->get('locked');
    if($value==true){
     return redirect()->intended('/accountdashboard');
   }else{

    return view('account.lock');
  }

}
}



public function transfermoney(Request $request){

return redirect()->back();



  $receiverid=$request->receiverid;
  $amount=$request->amount;
  $accounttype=$request->accounttype;

  $username=Auth::User()->username;

  $validator=Validator::make($request->all(),
    [
    'receiverid'=>'required',
    'accounttype'=>'required',
    'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
    ]);
//take actions when the validation has failed
  if ($validator->fails()){
    return redirect()
    ->back()
    ->withErrors($validator)
    ->withInput();
  }
  $results=DB::table('member_table')
  ->where('username','=',$username)
  ->get();
  foreach ($results as $key => $v) {
      # code...
    $membershipid=$v->membershipid;

  }

  //(new accountcontroller)->transfercashtoanotheraccount($membershipid,$receiverid,$amount,$accounttype);

  (new accountcontroller)->transferToanotherAccounttypeWithPercentagecut($membershipid,$amount,$accountFrom,$accountTo,$percentage);

  return redirect()->back();
}
public function viewtransfermoney(){
  return view('account.transfermoney');
}
public function showdashboard(){

	return view('account.accountmaster'); 
}
public function viewfundaccount(){
  return view('account.fundaccount'); 
}

public function showTransferFromPayoutToFood()
{
  return view('account.payouttofood');
}

public function transferFromPayoutToFood(Request $request)
{
	return redirect()->back();


	
  $amount=$request->amount;
 
  $username=Auth::User()->username;

  $check2=$this->checkIfValueIsNegative($amount);
    if ($check2==false) {
        # code...
        $validator="You Cannot Enter  a Negative Value";
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();

    }

  $validator=Validator::make($request->all(),
    [
    'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
    ]);
//take actions when the validation has failed
  if ($validator->fails()){
    return redirect()
    ->back()
    ->withErrors($validator)
    ->withInput();
  }
  $results=DB::table('member_table')
  ->where('username','=',$username)
  ->get();
  foreach ($results as $key => $v) {
      # code...
    $membershipid=$v->membershipid;

  }
 $percentage=1;
 $accountFrom='payoutcash';
 $accountTo='foodcash';
  (new accountcontroller)->transferToanotherAccounttypeWithPercentagecut($membershipid,$amount,$accountFrom,$accountTo,$percentage);

  return redirect('/home');
}
public function viewpayout(){
  return view('account.paycashout'); 
}
public function viewtansactions(){

 $userid=(new UserController)->getuseridwithusername();
 $records=DB::table('transactionsrecords')
 ->where('userid',$userid)
 ->orwhere('receiverid',$userid)
 ->get();
 return view('account.transactionrecords')->with(['records'=>$records]);
}
public function showaccountdetails(){
  $walletbalance=0;
  $foodcash=0;
  $payoutcash=0;
  $totalearnings=0;
  $completionbonus=0;
  $levelbonus=0;
  $refferralbonus=0;
  $username=Auth::user()->username;
  $result=DB::table('member_table')
  ->where('username','=',$username)
  ->get();
  foreach ($result as $key => $v) {
  # code...
    $membershipid=$v->membershipid;
  }
  $levelbonus=DB::table('singlebonuspaid')
  ->where('userid','=',$membershipid)
  ->sum('amount');

  $completionbonus=DB::table('stagecompletionbonus')
  ->where('userid','=',$membershipid)
  ->sum('amount');

  $refferralbonus=DB::table('refferal_bonus')
  ->where('membershipid','=',$membershipid)
  ->sum('bonus');



    $foodcash=$this->getFoodCash($membershipid);
    $payoutcash=$this->getPayoutCash($membershipid);


  $totalearnings=$completionbonus+$totalearnings+$refferralbonus;
  return view('account.showaccountdetails')->with(['walletbalance'=>$walletbalance,'foodcash'=>$foodcash,'payoutcash'=>$payoutcash,'totalearnings'=>$totalearnings,'completionbonus'=>$completionbonus,'levelbonus'=>$levelbonus,'refferralbonus'=>$refferralbonus]);

}

public function getPayoutCash($membershipid)
{
    $results=DB::table('tempcurrentamount')
        ->where('userid','=',$membershipid)
        ->get();

    foreach ($results as $key => $v) {
        # code...
        $foodcash=$v->foodcash;
        $payoutcash=$v->payoutcash;
    }

    return $payoutcash;
}

public function getFoodCash($membershipid)
{
    $results=DB::table('tempcurrentamount')
        ->where('userid','=',$membershipid)
        ->get();

    foreach ($results as $key => $v) {
        # code...
        $foodcash=$v->foodcash;
        $payoutcash=$v->payoutcash;
    }
    return $foodcash;
}

public function dividecomission($money){

}
public function paycomission(){

}
public function withdrawcash(){

}
public function fundaccount(){

}
public function calculate(){

}
public function displaywallet($userid){

 $results = DB::table('tempcurrentamount')
 ->where('userid', '=',$userid)
 ->get();
 
 /*if ($results==null||$results==0) {
      # code...

   $refferalbonusamount=0;
   $refferalbonus=DB::table('refferal_bonus')
   ->where('membershipid','=',$userid)
   ->get();
   foreach ($refferalbonus as $key => $v) {
  # code...
     $refferalbonusamount=$v->bonus;
   }

   $stagecompletionbonus=DB::table('stagecompletionbonus')
   ->where('userid','=',$userid)
   ->sum('amount');

   $singlebonuspaid=DB::table('singlebonuspaid')
   ->where('userid','=',$userid)
   ->sum('amount');
   $amount=$stagecompletionbonus+$singlebonuspaid+$refferalbonusamount;
   return  $amount;
 } else {
      # code...
  foreach ($results as $key => $v) {
    $amount=$v->amount;
    $foodcash=$v->foodcash;
    $payoutcash=$v->payoutcash;
    $paid=$v->paid;
    $total=$foodcash+$payoutcash;
  }
  $balance=$total-$paid;

  return $balance;
}*/
foreach ($results as $key => $v) {
  $amount=$v->amount;
  $foodcash=$v->foodcash;
  $payoutcash=$v->payoutcash;
  $paid=$v->paid;

}
$total=$foodcash+$payoutcash;


return $total;
}

public function  payforreferral($refferer){

  $member_table=DB::table('member_table')
  ->where('membershipid', '=',$refferer)
  ->first();
  $stage=$member_table->stage;
  $amount=DB::table('referralamount')
  ->where('id', '=',1)
  ->first(); 

  $results=DB::table('refferal_bonus')
  ->where('membershipid', '=',$refferer)
  ->count(); 
  $date=date('Y-m-d');

  DB::table('refferal_bonus')->insert( ['membershipid' =>$refferer, 'bonus' =>$amount->amount,'noofreffered'=>1,'date_paid'=>$date]);
   $this->addtocurrentamount($refferer,$amount->amount,$stage);
  
  # code...
  //  DB::transaction(function() use ($refferer,$amount) {
  //   DB::table('refferal_bonus')
  //   ->where('membershipid',"=",$refferer)
  //   ->increment('bonus',$amount->amount);

  //   DB::table('refferal_bonus')
  //   ->where('membershipid',"=",$refferer)
  //   ->increment('noofreffered',1);
  // });
}

    /**
     * @param $userid
     */
    public function matrixcompletebonus($userid){
// $stage = (new UserController)->getuserstage($userid);
//INSERT INTO `matrixbonus`(`id`, `userid`, `matrixid`, `amount`, `datepaid`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5]) 
     $stage = (new UserController)->getuserstage($userid);    
     $results = DB::table('matrix')
     ->where('type_id', '=',$stage)
     ->where('ownerid','=',$userid)
     ->get();
     foreach ($results as $key => $v) {
      $type_id=$v->type_id;
      $matrixid=$v->matrix_id;
    }      
    $results = DB::table('stagecompletionamount')
    ->where('stage', '=',$stage)
    ->get();
    foreach ($results as $key => $v) {
      $amount=$v->amount; 
    }  

    $date=date('Y-m-d');

    DB::table('stagecompletionbonus')->insert(['userid' =>$userid, 'matrixid' =>$matrixid,'stage'=>$stage,'amount' =>$amount,'datepaid' =>$date]); 
    $this->addtocurrentamount($userid,$amount,$stage);     

  }


    /**
     * @param $userid
     */
    public function matrixcompletebonusfiftypercent($userid){
// $stage = (new UserController)->getuserstage($userid);
//INSERT INTO `matrixbonus`(`id`, `userid`, `matrixid`, `amount`, `datepaid`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5]) 
     $stage = (new UserController)->getuserstage($userid);    
     $results = DB::table('matrix')
     ->where('type_id', '=',$stage)
     ->where('ownerid','=',$userid)
     ->get();
     foreach ($results as $key => $v) {
      $type_id=$v->type_id;
      $matrixid=$v->matrix_id;
    }      
    $results = DB::table('stagecompletionamount')
    ->where('stage', '=',$stage)
    ->get();
    $amount=0;
    foreach ($results as $key => $v) {
      $amount=$v->amount; 
    }  
    $amount=(50/100)*$amount;
    $date=date('Y-m-d');

    DB::table('stagecompletionbonus')->insert(['userid' =>$userid, 'matrixid' =>$matrixid,'stage'=>$stage,'amount' =>$amount,'datepaid' =>$date]); 
    $this->addtocurrentamount($userid,$amount,$stage);     

  }

  public function singledropbonus($userid){
   $stage = (new UserController)->getuserstage($userid);    
   $results = DB::table('matrix')
   ->where('type_id', '=',$stage)
   ->where('ownerid','=',$userid)
   ->get();
   foreach ($results as $key => $v) {
    $type_id=$v->type_id;
    $matrixid=$v->matrix_id;
  }  

  $results = DB::table('singledropamount')
  ->where('stage', '=',$stage)
  ->get();
  
  foreach ($results as $key => $v) {
    $amount=$v->amount; 
  }
//INSERT INTO `singlebonuspaid`(`id`, `userid`, `matrixid`, `stage`, `amount`, `datepaid`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])      
  $date=date('Y-m-d');  
//DB::table('singlebonuspaid')->insert(['userid' =>$userid, 'matrixid' =>$matrixid,'stage'=>$stage,'amount' =>$amount,'datepaid' =>$date]);
  $results1 = DB::table('singlebonuspaid')
  ->where('stage', '=',$stage)
  ->where('userid', '=',$userid)
  ->count();
  if (is_null( $results1)||$results1<=0) {
        # code...

    DB::table('singlebonuspaid')->insert(['userid' =>$userid, 'matrixid' =>$matrixid,'stage'=>$stage,'amount' =>$amount,'datepaid' =>$date]); 

    $this->addtocurrentamount($userid,$amount,$stage);

  } else {
        # code...
   DB::table('singlebonuspaid')
   ->where('userid', '=',$userid)
   ->where('stage', '=',$stage)
   ->increment('amount',$amount);
   $this->addtocurrentamount($userid,$amount,$stage);
 }

}

  public function singledropbonusfiftypercent($userid){
   $stage = (new UserController)->getuserstage($userid);    
   $results = DB::table('matrix')
   ->where('type_id', '=',$stage)
   ->where('ownerid','=',$userid)
   ->get();
   foreach ($results as $key => $v) {
    $type_id=$v->type_id;
    $matrixid=$v->matrix_id;
  }  
  $results = DB::table('singledropamount')
  ->where('stage', '=',$stage)
  ->get();
  $amount=0;
  foreach ($results as $key => $v) {
    $amount=$v->amount; 
  }
  //remove percentage
  $amount=(50/100)*$amount;
  
//INSERT INTO `singlebonuspaid`(`id`, `userid`, `matrixid`, `stage`, `amount`, `datepaid`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])      
  $date=date('Y-m-d');  
//DB::table('singlebonuspaid')->insert(['userid' =>$userid, 'matrixid' =>$matrixid,'stage'=>$stage,'amount' =>$amount,'datepaid' =>$date]);
  $results1 = DB::table('singlebonuspaid')
  ->where('stage', '=',$stage)
  ->where('userid', '=',$userid)
  ->count();
  if (is_null( $results1)||$results1<=0) {
        # code...

    DB::table('singlebonuspaid')->insert(['userid' =>$userid, 'matrixid' =>$matrixid,'stage'=>$stage,'amount' =>$amount,'datepaid' =>$date]); 

    $this->addtocurrentamount($userid,$amount,$stage);

  } else {
        # code...
   DB::table('singlebonuspaid')
   ->where('userid', '=',$userid)
   ->where('stage', '=',$stage)
   ->increment('amount',$amount);
   $this->addtocurrentamount($userid,$amount,$stage);
 }

}

public function addtocurrentamount($userid,$amount,$stage){
  $results2 = DB::table('tempcurrentamount')
  ->where('userid', '=',$userid)
  ->count();

  if (is_null( $results2)||$results2<=0) {
    if ($stage==0 || $stage==1) {
      # code...

      DB::table('tempcurrentamount')->insert(['userid' =>$userid,'foodcash' =>$amount,'payoutcash' =>0]);    
    } else {
      # code...
      $foodcash=(40/100)*$amount;
      $payoutcash=(60/100)*$amount;
      $totalamount=$foodcash+$payoutcash;
      DB::table('tempcurrentamount')->insert(['userid' =>$userid,'foodcash' =>$totalamount,'payoutcash' =>0]);
    }

  }else{

   if ($stage==0 || $stage==1) {
      # code...
    DB::transaction(function() use  ($userid,$amount) {
      DB::table('tempcurrentamount')
      ->where('userid', '=',$userid)
      ->increment('foodcash',$amount);
    });   
  } else {
      # code...
    $foodcash=(40/100)*$amount;
    $payoutcash=(60/100)*$amount;
    $totalamount=$foodcash+$payoutcash;
    DB::transaction(function() use  ($userid,$foodcash,$payoutcash,$totalamount) {
      DB::table('tempcurrentamount')
      ->where('userid', '=',$userid)
      ->increment('foodcash',$totalamount);

     
    });

  }

}

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
public function scripttoaddtotheusers(){

 $results=DB::table('member_table')
 ->where('stage','=',1)
 ->get();
 foreach ($results as $key => $v) {
       # code...
      //INSERT INTO `matrix`(`matrix_id`, `type_id`, `ownerid`, `count_users`, `users_list`, `filled`, `alias_id`, `created_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
  $membershipid=$v->membershipid;
  $results = DB::table('matrix')
  ->where('type_id', '=',0)
  ->where('ownerid','=',$membershipid)
  ->get();
  foreach ($results as $key => $v) {
    $type_id=$v->type_id;
    $matrixid=$v->matrix_id;
  }      
  $results = DB::table('stagecompletionamount')
  ->where('stage', '=',0)
  ->get();
  foreach ($results as $key => $v) {
    $amount=$v->amount; 
  }  

  $date=date('Y-m-d');

  DB::table('stagecompletionbonus')->insert(['userid' =>$membershipid, 'matrixid' =>$matrixid,'stage'=>0,'amount' =>$amount,'datepaid' =>$date]);
}

}

public function sendtocurrentamount($userid){


  $result=DB::table('stagecompletionbonus')
  ->where('userid','=',$userid)
  ->get();
  foreach ($result as $key => $v) {
        # code...
   $stage=$v->stage;
   if ($stage==0 || $stage==1) {
          # code...
    $amount=$v->amount;
    $amounttoinsert=$amount-($v->paid);
    $date=date('Y-m-d');
    $count=DB::table('current_amount_in_account')
    ->where('userid','=',$userid)
    ->count();
      //check availablity of user record
    if (is_null($count)||$count<=0) {
        # code...
      DB::table('current_amount_in_account')->insert(['userid' =>$userid, 'amount' =>$amounttoinsert,'foodcash'=>$amounttoinsert,'payout' =>0]); 
    } else {
        # code...
     DB::table('current_amount_in_account')
     ->where('userid','=',$userid)
     ->increment('amount',$amounttoinsert );

     DB::table('current_amount_in_account')
     ->where('userid','=',$userid)
     ->increment('foodcash',$amounttoinsert);

     DB::table('current_amount_in_account')
     ->where('userid','=',$userid)
     ->increment('payout',0);

   }

   DB::table('stagecompletionbonus')
   ->where('userid','=',$userid)
   ->where('stage','=',$stage)
   ->increment('paid',$amounttoinsert); 
 } else {
          # code...
  $amount=$v->amount;
  $amounttoinsert=$amount-($v->paid);
  $foodcash=$amounttoinsert*(40/100);
  $payout=$amounttoinsert*(60/100);
  $date=date('Y-m-d');
  $count=DB::table('current_amount_in_account')
  ->where('userid','=',$userid)
  ->count();
      //check availablity of user record
  if (is_null($count)||$count<=0) {
        # code...
   DB::table('current_amount_in_account')->insert(['userid' =>$userid, 'amount' =>$amounttoinsert,'foodcash'=>$foodcash,'payout' =>$payout]); 
 } else {
        # code...
   DB::table('current_amount_in_account')
   ->where('userid','=',$userid)
   ->increment('amount',$amounttoinsert );
   DB::table('current_amount_in_account')
   ->where('userid','=',$userid)
   ->increment('foodcash',$foodcash);
   DB::table('current_amount_in_account')
   ->where('userid','=',$userid)
   ->increment('payout',$payout);

 }

 DB::table('stagecompletionbonus')
 ->where('userid','=',$userid)
 ->where('stage','=',$stage)
 ->increment('paid',$amounttoinsert); 

}   

}
//get the persons record in the single drop table and send to cuurent amount table if the user record is not avaialable before insert if available update.


$result1=DB::table('singlebonuspaid')
->where('userid','=',$userid)
->get();
foreach ($result1 as $key => $v) {
        # code...
  $stage=$v->stage;
  if ($stage==0 || $stage==1) {
          # code...
    $amount=$v->amount;
    $amounttoinsert=$amount-($v->paid);
    $date=date('Y-m-d');
    $count=DB::table('current_amount_in_account')
    ->where('userid','=',$userid)
    ->count();
      //check availablity of user record
    if (is_null($count)||$count<=0) {
        # code...
     DB::table('current_amount_in_account')->insert(['userid' =>$userid, 'amount' =>$amounttoinsert,'foodcash'=>$amounttoinsert,'payout' =>0]); 
   } else {
        # code...
     DB::table('current_amount_in_account')
     ->where('userid','=',$userid)
     ->increment('amount',$amounttoinsert );
     DB::table('current_amount_in_account')
     ->where('userid','=',$userid)
     ->increment('foodcash',$amounttoinsert);
     DB::table('current_amount_in_account')
     ->where('userid','=',$userid)
     ->increment('payout',0);

   }

   DB::table('singlebonuspaid')
   ->where('userid','=',$userid)
   ->where('stage','=',$stage)
   ->increment('paid',$amounttoinsert); 
 } else {
          # code...
  $amount=$v->amount;
  $amounttoinsert=$amount-($v->paid);
  $foodcash=$amounttoinsert*(40/100);
  $payout=$amounttoinsert*(60/100);
  $date=date('Y-m-d');
  $count=DB::table('current_amount_in_account')
  ->where('userid','=',$userid)
  ->count();
      //check availablity of user record
  if (is_null($count)||$count<=0) {
        # code...
   DB::table('current_amount_in_account')->insert(['userid' =>$userid, 'amount' =>$amounttoinsert,'foodcash'=>$foodcash,'payout' =>$payout]); 
 } else {
        # code...
   DB::table('current_amount_in_account')
   ->where('userid','=',$userid)
   ->increment('amount',$amounttoinsert );
   DB::table('current_amount_in_account')
   ->where('userid','=',$userid)
   ->increment('foodcash',$foodcash);
   DB::table('current_amount_in_account')
   ->where('userid','=',$userid)
   ->increment('payout',$payout);

 }

 DB::table('singlebonuspaid')
 ->where('userid','=',$userid)
 ->where('stage','=',$stage)
 ->increment('paid',$amounttoinsert); 

}

}



}


/*public function calculatestagecompletionbonus($userid){
  $results= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->get();

  foreach ($results as $key => $v) {
      # code...
   $membershipid=$v->membershipid;
   $matrixusercount=DB::table('matrix')
   ->where('ownerid',$membershipid)
   ->where('type_id','0')
   ->where('filled','1')
   ->count();

   if ($matrixusercount==0||$matrixusercount==null) {
     # code...

   } else {
     # code...
     $amount=$this->getstagebonus('0');
   //INSERT INTO `stagecompletionbonus`(`id`, `userid`, `matrixid`, `stage`, `amount`, `paid`, `sum`, `datepaid`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
     $comcount=DB::table('stagecompletionbonus')
     ->where('userid',$membershipid)
     ->count(); 
     if ($comcount==0||$comcount==null){
     # code...
      DB::table('stagecompletionbonus')
      ->insert(['userid' =>$membershipid, 'amount' =>$amount]); 

    } else {
     # code...
      DB::table('stagecompletionbonus')
      ->where('userid',$membershipid)
      ->increment('amount' =$amount]);
    }

  }


}  
}*/

public function singledroppayment(){
 $results= DB::table('member_table as m')
 ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
 ->where('t.ancestor', '=','HW00016001')
 ->get();

 foreach ($results as $key => $v) {
    # code...
  $membershipid=$v->membershipid;

}
}


public function getstagebonus($stage){
  $result=DB::table('stagecompletionamount')
  ->where('stage',$stage)
  ->get();
  foreach ($result as $key => $v) {
  # code...
      $amount=$v->amount;
 }
 return $amount;
}

public function getsingledropbonus($stage){
  $result=DB::table('singledropamount')
  ->where('stage',$stage)
  ->get();
  foreach ($result as $key => $v) {
  # code...
   $amount=$v->amount;
 }
 return $amount;
}
/*public function getmatrixid($userid,$stage){
  $results=DB::table('matrix')
   ->where('ownerid',$membershipid)
   ->where('type_id','0')
   ->get();
   foreach ($results as $key => $v) {
     # code...
    return 
   }
 }*/
 public function sumandaddtoaccount($userid){
  $refferalbonusamount=0;
  $refferalbonus=DB::table('refferal_bonus')
  ->where('membershipid','=',$userid)
  ->get();
  foreach ($refferalbonus as $key => $v) {
  # code...
   $refferalbonusamount=$v->bonus;
 }


 $singlebonus=DB::table('singlebonuspaid')
 ->where('userid',$userid)
 ->sum('amount');
 $stagecompletion=DB::table('stagecompletionbonus')
 ->where('userid',$userid)
 ->sum('amount');
 $amount=$refferalbonusamount+$singlebonus+$stagecompletion;

 $results = DB::table('tempcurrentamount')
 ->where('userid', '=',$userid)
 ->get();
 
 if ($results==null||$results==0) {
      # code...
   DB::table('tempcurrentamount')
   ->insert(['userid'=>$userid,'amount'=>$amount]);
   //->insert(['userid'=>$userid,'amount'=>$amount,'foodcash'=>$foodcash]);
 }else{
   DB::table('tempcurrentamount')
   ->where('userid',$userid)
   ->update(['amount'=>$amount]);
   //foreach ($results as $key => $v) {
     # code...
   // $foodcash=$v->foodcash;
   //}
 } 

}

public function getallmembers(){

  $members= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->get(); 
  foreach ($members as $key => $v) {
      # code...
    $membershipid=$v->membershipid;
    $this->sumandaddtoaccount($membershipid);
  }
  Session::flash('flash_success','You just Calculated EveryBodys Bonus');
  return redirect()->back();
}


public function deductfromuseraccount(Request $request){
 $membershipid=$request->membershipid;
 $amount=$request->amount;
// $registrationpack=$request->registrationpack;
 //$amount=$amount/200;
$userid=Auth::user()->id;
 try{
//31/october/2016   id  membershipid  amount  adminid date_deducted

if ($request->action=="1") {

  DB::table('tempcurrentamount')
 ->where('userid',$membershipid)
 ->increment('foodcash',$amount);

  DB::table('mlm_accountdeduction_log')
 ->insert(['membershipid'=>$membershipid,'amount'=>$amount,'adminid'=>$userid,'action'=>'increment']);

 Session::flash('flash_success','You just added '.$amount.' to '.$membershipid);

} else {

  DB::table('tempcurrentamount')
 ->where('userid',$membershipid)
 ->decrement('foodcash',$amount);

 $amount=0-($amount);
  DB::table('mlm_accountdeduction_log')
 ->insert(['membershipid'=>$membershipid,'amount'=>$amount,'adminid'=>$userid,'action'=>'decrement']);

 Session::flash('flash_success','You just deducted '.$amount.' from '.$membershipid);

}

 return redirect()->back();
}
catch(\PDOException $exception){
  Session::flash('flash_error','user does not exist');
  return redirect()->back();
}

}

public function paycomissiontotable(){
  $members= DB::table('member_table as m')
  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
  ->where('t.ancestor', '=','HW00016001')
  ->get(); 
  foreach ($members as $key => $v) {
      # code...
    $membershipid=$v->membershipid;
    //$this->sumandaddtoaccount($membershipid);

    $this->setfoodcash($membershipid);
  }
  Session::flash('flash_success','You just Calculated EveryBodys Bonus');
  return redirect()->back();
}

public function setfoodcash($userid){
  $members= DB::table('tempcurrentamount')
  ->where('userid', '=',$userid)
  ->get(); 
  foreach ($members as $key => $v) {
    # code...
    $amount=$v->amount;
    $paid=$v->paid;
    $foodcash=$amount-$paid;
    
    DB::table('tempcurrentamount')
    ->where('userid',$userid)
    ->update(['foodcash'=>$foodcash]);
  }
}


public function transfercashtoanotheraccount($sourceacountid,$destinationaccountid,$amount,$accounttype){
    
    return redirect()->back();
 $check=$this->checkifcashisavailable($sourceacountid,$amount,$accounttype);
 if ($check==false) {
      # code...
  $validator="you dont have up to ".$amount." in your account";
  return redirect()
  ->back()    
  ->withErrors($validator)
  ->withInput();

}

    $check2=$this->checkIfValueIsNegative($amount);
    if ($check2==false) {
        # code...
        $validator="You Cannot Enter  a Negative Value";
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();

    }
    $check3=$this->checkIfMembershipIdExist($destinationaccountid);
    if ($check3==false) {
        # code...
        $validator="The MembershipId you Entered is not Valid";
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();

    }

    $check4=$this->checkIfUserIsQualified($sourceacountid);
    if ($check4==false) {
        # code...
        $validator="The MembershipId you Entered is not Qualified to make transfers";
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();

    }

$todaysdate = date("Y-m-d");
DB::table('transactionsrecords')->insert(['userid' =>$sourceacountid, 'type' =>'transfer','receiverid' =>$destinationaccountid,'amount' =>$amount,'created_at' =>$todaysdate ]);

if ($accounttype=='foodcash') {
      # code...
  DB::table('tempcurrentamount')
  ->where('userid',$sourceacountid)
  ->decrement('foodcash',$amount); 

  DB::table('tempcurrentamount')
  ->where('userid',$destinationaccountid)
  ->increment('foodcash',$amount);
} else {
      # code...
  DB::table('tempcurrentamount')
  ->where('userid',$sourceacountid)
  ->decrement('payoutcash',$amount); 

  DB::table('tempcurrentamount')
  ->where('userid',$destinationaccountid)
  ->increment('payoutcash',$amount);
}
Session::flash('flash_success','You Have transffered '.$amount.' to '.$destinationaccountid.'Successfully');

}


public function transfercashtoanotheraccountwithpercentagecut($sourceacountid,$destinationaccountid,$amount,$accounttype,$percentage){
    
    return redirect()->back();
    
    
 $check=$this->checkifcashisavailable($sourceacountid,$amount,$accounttype);
 if ($check==false) {
      # code...
  $validator="you dont have up to ".$amount." in your account";
  return redirect()
  ->back()    
  ->withErrors($validator)
  ->withInput();

}

$todaysdate = date("Y-m-d");
DB::table('transactionsrecords')->insert(['userid' =>$sourceacountid, 'type' =>'transfer','receiverid' =>$destinationaccountid,'amount' =>$amount,'created_at' =>$todaysdate ]);
$amountpercent=$amount*($percentage/100);
$amount=$amount-$amountpercent;
if ($accounttype=='foodcash') {
      # code...
  DB::table('tempcurrentamount')
  ->where('userid',$sourceacountid)
  ->decrement('foodcash',$amount); 

  DB::table('tempcurrentamount')
  ->where('userid',$destinationaccountid)
  ->increment('foodcash',$amount);
} else {
      # code...
  DB::table('tempcurrentamount')
  ->where('userid',$sourceacountid)
  ->decrement('payoutcash',$amount); 

  DB::table('tempcurrentamount')
  ->where('userid',$destinationaccountid)
  ->increment('payoutcash',$amount);
}

}


public function transferToanotherAccounttypeWithPercentagecut($membershipid,$amount,$accountFrom,$accountTo,$percentage){
    
    return redirect()->back();
    
    
  $check=$this->checkifcashisavailable($membershipid,$amount,$accountFrom);
 if ($check==false) {
      # code...
  $validator="you dont have up to ".$amount." in your account";
  return redirect()
  ->back()    
  ->withErrors($validator)
  ->withInput();
}
if ($percentage=0) {
  # code...
$amount2=$amount; 
}else{
 $amountpercent=$amount*($percentage/100);
$amount2=$amount-$amountpercent;
}
  
$todaysdate = date("Y-m-d");
DB::table('transactionsrecords')->insert(['userid' =>$membershipid,'type' =>'transfer','receiverid' =>$membershipid,'amount' =>$amount,'created_at' =>$todaysdate ]);
  DB::table('tempcurrentamount')
  ->where('userid',$membershipid)
  ->decrement($accountFrom,$amount); 

  DB::table('tempcurrentamount')
  ->where('userid',$membershipid)
  ->increment($accountTo,$amount2);
Session::flash('flash_success','You Transferred '.$amount.' to your food cash');
}


public function checkifcashisavailable($sourceacountid,$amount,$accounttype){

  $useramount=DB::table('tempcurrentamount')
  ->where('userid',$sourceacountid)
  ->first();
  if ($accounttype=='foodcash') {
    # code...
    $foodcash=$useramount->foodcash;
    if ($amount<=$foodcash) {
      # code...
      return true;
    } else {
      # code...
      return false;
    }
    
  } else {
    # code...
    $payoutcash=$useramount->payoutcash;
    if ($amount<=$payoutcash) {
      # code...
      return true;
    } else {
      # code...
      return false;
    }
  }

}




public function payoutcash(Request $request){
$amount=$request->amount;

    $validator=Validator::make($request->all(),
        [
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',

        ]);
//take actions when the validation has failed
    if ($validator->fails()){
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

$userid=(new UserController)->getuseridwithusername();
 $check=$this->checkifcashisavailable($userid,$amount,'foodcash');
  if ($check==false) {
      # code...
  $validator="you dont have up to ".$amount." in your account";
  return redirect()
  ->back()    
  ->withErrors($validator)
  ->withInput();

}

$check2=$this->checkIfValueIsNegative($amount);
    if ($check2==false) {
        # code...
        $validator="You Cannot Enter  a Negative Value";
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();

    }

$todaysdate = date("Y-m-d");

DB::table('payoutcash')->insert(['userid' =>$userid, 'status' =>'pending','amount' =>$amount,'created' =>$todaysdate ]);
DB::table('tempcurrentamount')
->where('userid',$userid)
->decrement('foodcash',$amount);
Session::flash('flash_success','You Have Requested '.$amount.'For Payout Successfully');
  return redirect()->back();
}


public function getallbalance(){
   $balance=DB::table('tempcurrentamount')
  ->sum(); 
  
}

public function checkIfMembershipIdExist($membershipId)
{
    $count=DB::table('member_table')->where('membershipid',$membershipId)->count();


    if($count==0){
        return false;
    }

    return true;
}

public function checkIfValueIsNegative($amount)
{
    if ($amount<0){
        return false;
    }

    return true;
}

    public function checkIfUserIsQualified($membershipId)
    {
        $result=DB::table('member_table')->where('membershipid',$membershipId)->first();
        if ($result->stage==0){
            return false;
        }

        return true;
    }

    public function returnMoneyWithPercentgeCut(){

       $allMembers = DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-12-13', '2018-12-15'])->distinct()->get(['user_id']);
      foreach ($allMembers as $key => $member) {
        $userid=$member->user_id;
        $order_amount_in_system_rate= DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-12-13', '2018-12-15'])->where('user_id',$userid)->sum('amount');

      
        //remove percentage
            $percentageAmount=(1/100)*$order_amount_in_system_rate;
           
        //add to food cash  
        DB::transaction(function() use  ($userid,$percentageAmount) {
      DB::table('tempcurrentamount')
      ->where('userid', '=',$userid)
      ->increment('foodcash',$percentageAmount);
    }); 
      echo $percentageAmount.' money for '.$userid.' returned';
      }  
    }




}

