<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class IncorrectBalanceFixer extends Controller
{
  // FOR FARM STAGE CORRECTION
  // public function index()
  // {
  //   die();
  //   ini_set('max_execution_time',60000);
    
  //   $result = $this->getTempCurrentAmount();

  //   foreach ($result as $key => $value) {

  //     $userid = $value->ownerid;

  //     $userStage = $this->getUserStage($userid);
    
  //     if($userStage == 1){
  //       $foodcash = 54.4;
  //       $this->updateUserAmount($userid, $foodcash);
  //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED <br />";
  //     }    
  //     if($userStage == 1){
  //       $foodcash = 54.4;
  //       $this->updateUserAmount($userid, $foodcash);
  //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED <br />";
  //     }    
  //     if($userStage == 1){
  //       $foodcash = 54.4;
  //       $this->updateUserAmount($userid, $foodcash);
  //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED <br />";
  //     }    
  //     if($userStage == 1){
  //       $foodcash = 54.4;
  //       $this->updateUserAmount($userid, $foodcash);
  //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED <br />";
  //     }    
  //     if($userStage == 1){
  //       $foodcash = 54.4;
  //       $this->updateUserAmount($userid, $foodcash);
  //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED <br />";
  //     }    
  //     if($userStage == 1){
  //       $foodcash = 54.4;
  //       $this->updateUserAmount($userid, $foodcash);
  //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED <br />";
  //     }
  //   }
  // }

  // FOR STAGE 1 CORRECTION
  public function index(){
    // ini_set('max_execution_time',60000);
    
    // $result = $this->getTempCurrentAmount();

    // foreach ($result as $key => $value) {

    //   $userid = $value->membershipid;

    //   // if($this->hasUserOrderedFood($userid) == 0 && $this->hasUserTransferedCash($userid) == 0 && $this->hasUserOrderedFood2($userid) == 0){
    
    //     $userStage = $this->getUserStage($userid);
    
    //     if($userStage == 8){
    //       $foodcash = 54.4;
    //       $this->updateUserAmount($userid, $foodcash);
    //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED TO 54.4 <br />";
    //     }
    //     if($userStage == 9){
    //       // 70.4
    //       $foodcash = 70.4;
    //       $this->updateUserAmount($userid, $foodcash);
    //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED TO 70.4 <br />";
    //     }
    //     if($userStage == 10){
    //       // 86.4
    //       $foodcash = 86.4;
    //       $this->updateUserAmount($userid, $foodcash);
    //       echo "USER ".$userid." BALANCE HAS BEEN UPDATED TO 86.4 <br />";
    //     }
    //     // if($userStage == 11){
    //     //   // 102.4
    //     //   echo "USER ".$userid." BALANCE NEEDS TO BE UPDATED TO 102.4 <br />";
    //     // }    
    //   // }
    //   // else{
    //   //   echo "USER ".$userid." ALREADY HAS TRANSACTION RECORD <br />";
    //   // }
    // }
  }

  public function getTempCurrentAmount(){
    // NOTE FOR ONLY STAGE 1 WHOSE BALANCE IS LESS THAN 54.4
    // $result = DB::select('select m.membershipid from tempcurrentamount t inner join member_table m on m.membershipid = t.userid left JOIN mlm_goodscollectionlog g on g.user_id = t.userid where m.stage = 1 and g.user_id IS NULL and t.foodcash < 54.4 order by m.id desc limit 100');
    // $result = DB::select('select m.membershipid from tempcurrentamount t inner join member_table m on m.membershipid = t.userid  where m.stage = 1 and t.foodcash < 54.4 and m.membershipid not in (select DISTINCT user_id from mlm_goodscollectionlog) limit 200');

    // FOR STAGE 1 CORRECTION
    $result = DB::select('select m.membershipid from tempcurrentamount t inner join member_table m on m.membershipid = t.userid  where m.stage = 1 and t.foodcash < 54.4 and m.membershipid not in (select DISTINCT user_id from mlm_goodscollectionlog) and m.membershipid not in (select DISTINCT userid from transactionsrecords) limit 100');

    // FOR FARM STAGE CORRECTTION
    // $result = DB::select('select mx.ownerid from matrix mx inner join tempcurrentamount t on mx.ownerid = t.userid where mx.type_id = 0 and mx.count_users < 7 and t.foodcash <> ROUND(6.4 * (mx.count_users - 1),2) limit 100');



    // $result = DB::select('select m.membershipid from tempcurrentamount t inner join member_table m on m.membershipid = t.userid where m.stage = 1 and t.foodcash < 54.4 order by rand() limit 200');
    return $result;
  }

  public function hasUserTransferedCash($userid){
    $count = DB::table('transactionsrecords')
              ->where('userid','=',$userid)
              ->orWhere('receiverid','=',$userid)
              ->count();
    return $count;
  }

  public function hasUserOrderedFood($userid){
    $count = DB::table('mlm_foodcollection')
              ->where('user_id','=',$userid)
              ->count();
    return $count;
  }

  public function hasUserOrderedFood2($userid){
    $count = DB::table('mlm_goodscollectionlog')
              ->where('user_id','=',$userid)
              ->count();
    return $count;
  }

  public function getUserStage($userid)
  {
    $total = DB::table('matrix')->where('ownerid', $userid)->sum('count_users');
    return (int)$total;
  }

  public function updateUserAmount($user_id, $foodcash)
  {
    return DB::update('UPDATE tempcurrentamount SET foodcash = '.$foodcash .' where userid = ?',[$user_id]);
  }
}
