<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CheckAllUserBalance extends Controller
{
  public function index(){
    ini_set('max_execution_time',60000);
    

//   	$allMembers = DB::table("member_table")->whereIn('membershipid', $ids)->get();
  	$allMembers = DB::table("member_table")->where("stage", 2)->get();

  	foreach ($allMembers as $key => $member) {
		$moneyHeShouldHave = $this->getUsersExpectedAmount($member->membershipid);
		$totalMoneyGotten = $this->getAllExpenses($member->membershipid);

  		if ($moneyHeShouldHave < $totalMoneyGotten ) {
  			echo "<b style='background-color: red'>EXCESS:  </b>" . $member->firstname . " " . $member->middlename . " " . $member->lastname . " " . $member->membershipid . ": Money Spent = " . $totalMoneyGotten . " Money Gotten = " . $moneyHeShouldHave . "<br>";
  		}
//   		else{
// 			echo $member->firstname . " " . $member->middlename . " " . $member->lastname . " " . $member->membershipid . ": Money Spent = " . $totalMoneyGotten . " Money Gotten = " . $moneyHeShouldHave . "<br>";
// 		  }
  	}
  }

  public function getAllFoodExpenses($userid)
  {
  	$totalFoodCollected = DB::table("mlm_foodcollection")->where("user_id", $userid)->get();
  	$tempTotal = 0.0;
  	foreach ($totalFoodCollected as $key => $value) {
  		$tempTotal += $value->quantity * $value->amount;
  	}
  	return $tempTotal;
  }

  public function getAllExpenses($userid)
  {
  	$incomingcash = DB::table("transactionsrecords")->where("receiverid", $userid)->sum("amount");
  	$outgoingcash = DB::table("transactionsrecords")->where("userid", $userid)->sum("amount");
  	$totalFood = $this->getAllFoodExpenses($userid);
  	$accountBalance = DB::table("tempcurrentamount")->where("userid", $userid)->first();
  	$result = $accountBalance->foodcash + $accountBalance->payoutcash;

	$realExpense = 0;

	   $realExpense = $totalFood + $result;
// 	if ($incomingcash <= 0 && $outgoingcash <= 0 ) {
// 		$realExpense = $incomingcash + $outgoingcash + $totalFood + $result;
// 	}

  	return $realExpense;
  }

  public function getUsersExpectedAmount($userid)
  {
	$userStage = DB::table('member_table')->where('membershipid', $userid)->first()->stage;

    $totalUsers = DB::table('matrix')->where('ownerid', $userid)->where('type_id', $userStage)->first()->count_users;

    $result = 0;
	$userStage = (int) $userStage;
	
    if ($userStage == 0) {
    	$result = ($totalUsers - 1) * 6.4;
    } elseif ($userStage == 1) {
    	$result = (($totalUsers - 1) * 16) + 54.4;
    } elseif ($userStage == 2) {
    	$result = (($totalUsers - 1) * 40) + 54.4 + 384;
    } elseif ($userStage == 3) {
    	$result = (($totalUsers - 1) * 50) + 54.4 + 384 + 920;
    } elseif ($userStage == 4) {
    	$result = (($totalUsers - 1) * 160) + 54.4 + 384 + 920 + 4200;
    } elseif ($userStage == 5) {
    	$result = (($totalUsers - 1) * 6000) + 54.4 + 384 + 920 + 4200 + 7240;
    }else{

	}
	
	return $result;
  }
}
