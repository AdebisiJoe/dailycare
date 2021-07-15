<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class FixExcessFoodOrderController extends Controller
{


 public function getDuplicate(Request $request){

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

	set_time_limit(0);
	ini_set('memory_limit', '-1');


    $allMembers = DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-08-29', '2018-08-31'])->distinct()->get(['user_id']);
    
    echo "<table border='1' style='width:100%; text-align:center;'><tr><td>S/N</td><td>User ID</td><td>Stage</td><td>Money Spent</td><td>Money Gotten</td><td>Excess Amount</td></tr>";
    
    $tmpAllMembers = json_decode(json_encode($allMembers), True);

	for ($i = $request->start; $i <= $request->end; $i++) { 
        $vard = $tmpAllMembers[$i];
        
        $id = $vard["user_id"];
        $money_spent = $this->getAllExpenses($id);
        $money_gotten = $this->getUsersExpectedAmount($id);
        $downlines = $this->getDownlines($id);
        $stage = $this->getStage($id);
        $excess = 0.0;

        if ($money_spent > $money_gotten) {
            $excess = abs(round($money_spent, 2) - round($money_gotten, 2));
        }

        // DEDUCT EXCESS FROM 
        echo "<tr>";
        if($excess > 0.0){
            echo "<td><b style='color:red'>FLAG</b>" .($i) . "</td><td>" . $id . "</td><td>" . $stage . "</td><td>".$money_spent."</td><td>".$money_gotten."</td><td>" . round($excess, 2) . "</td>";
        }else{
            echo "<td>" .($i) . "</td><td>" . $id . "</td><td>" . $stage . "</td><td>".$money_spent."</td><td>".$money_gotten."</td><td>" . round($excess, 2) . "</td>";
        }
        
        echo "</tr>";
        
	}
    
  	dump("Finished");
  	echo "</table>";
  }

  public function index(){

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

	set_time_limit(0);
	ini_set('memory_limit', '-1');


    $allMembers = DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-08-08', '2018-08-09'])->distinct()->get(['user_id']);
    
    // $allMembers = DB::table('mlm_foodcollection')->whereIn('user_id', $ids)->distinct()->get(['user_id']);
    
    // $allMembers = DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-04-24', '2018-04-30'])->where("group_leader_id", 125)->distinct()->limit(500)->get(['user_id']);
    
    echo "<table border='1'><tr><td>S/N</td><td>User ID</td><td>Amount Ordered</td><td>Amount Gotten</td><td>Excess Amount</td><td></td></tr>";
    
    
  	foreach ($allMembers as $key => $member) {
        $id = $member->user_id;
        $money_spent = $this->getAllExpenses($id);
        $money_gotten = $this->getUsersExpectedAmount($id);
        $totalAmountOrdered = $this->getTotalAmountOrdered($id);
        $downlines = $this->getDownlines($id);
        $excess = 0.0;

        if ($money_spent > $money_gotten) {
            $excess = abs(round($money_spent, 2) - round($money_gotten, 2));
        }

        // DEDUCT EXCESS FROM 
        $balance = round($totalAmountOrdered, 2) - round($excess, 2); 
        echo "<tr>";
        if($excess > 0.0){
            echo "<td><b style='color:red'>FLAG</b>" .($key + 1) . "</td><td>" . $id . "</td><td>".$totalAmountOrdered."</td><td>".$money_gotten."</td><td>" . round($excess, 2) . "</td>";
        }else{
            echo "<td>" .($key + 1) . "</td><td>" . $id . "</td><td>".$totalAmountOrdered."</td><td>".$money_gotten."</td><td>" . round($excess, 2) . "</td>";
        }
        
        echo "</tr>";
  	}
  	
  	echo "</table>";
  }

  public function getDownlines($id){
      return DB::table("member_table")->where("membershipid", $id)->first()->downlines;
  }

  public function getStage($id){
      return DB::table("member_table")->where("membershipid", $id)->first()->stage;
  }
  
  
  public function getDateRegistered($id){
      return DB::table("member_table")->where("membershipid", $id)->first()->joindate;
  }
  
  public function bygroupid(Request $request){

      
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
    ini_set('max_execution_time',60000);
    
    $this->index();
    die("Done");
    
    $allMembers = DB::table('mlm_foodcollection')->whereBetween('date_created', ['2018-04-24', '2018-04-30'])->where("group_leader_id", $request->group_leader_id)->distinct()->get(['user_id']);

    $groupData = DB::table("mlm_groups")->where("id", $request->group_leader_id)->first();


    echo "GROUP NAME: " . $groupData->group_name . "<br />";
    echo "OWNER ID: " . $groupData->owner_id . "<br /><br />";

    
    echo "<table border='1' style='width:100%; text-align:center;'><tr><td>S/N</td><td>User ID</td><td>User Stage</td><td>Amount Ordered</td><td>Amount Gotten</td><td>Excess Amount</td><td>Downlines</td><td>Reg. Date</td></tr>";
    
  	foreach ($allMembers as $key => $member) {
        $id = $member->user_id;
        $money_spent = $this->getAllExpenses($id);
        $money_gotten = $this->getUsersExpectedAmount($id);
        $totalAmountOrdered = $this->getTotalAmountOrdered($id);
        $downlines = $this->getDownlines($id);
        $stage = $this->getStage($id);
        $date = $this->getDateRegistered($id);
        
        $excess = 0.0;
        
        if ($money_spent > $money_gotten) {
            $excess = abs(round($money_spent, 2) - round($money_gotten, 2));
        }

        // DEDUCT EXCESS FROM 
        $balance = round($totalAmountOrdered, 2) - round($excess, 2); 
        echo "<tr>";
        if($excess > 0.0){
            echo "<td>" .($key + 1) . "</td><td>" . $id . "</td><td>" . $stage . "</td><td>".$totalAmountOrdered."</td><td>".$money_gotten."</td><td>" . round($excess, 2) . "</td><td>" .$downlines . "</td><td>".$date."</td>";
        }else{
            echo "<td>" .($key + 1) . "</td><td>" . $id . "</td><td>" . $stage . "</td><td>".$totalAmountOrdered."</td><td>".$money_gotten."</td><td>" . round($excess, 2) . "</td><td>" .$downlines . "</td><td>".$date."</td>";
        }
        
        echo "</tr>";
  	}
  	
  	echo "</table>";
  }


  public function getAllFoodExpenses($userid)
  {
    $totalFoodCollected = DB::table("mlm_foodcollection")->where("user_id", $userid)->where('date_created', '<>', '0000-00-00')->get();
    $tempTotal = 0.0;
    foreach ($totalFoodCollected as $key => $value) {
        $tempTotal += $value->quantity * $value->amount;
    }
    return $tempTotal;
  }

  public function getAllExpenses($userid)
  {
    $outgoingcash = DB::table("transactionsrecords")->where("userid", $userid)->sum("amount");
    $totalFood = $this->getAllFoodExpenses($userid);
    $accountBalance = DB::table("tempcurrentamount")->where("userid", $userid)->first();
    $balance = round($accountBalance->foodcash, 2) + round($accountBalance->payoutcash, 2);

    $realExpense = $outgoingcash + $totalFood + $balance;

    return round($realExpense, 2);
  }

  public function getUsersExpectedAmount($userid)
  {
    $userStage = DB::table('member_table')->where('membershipid', $userid)->first()->stage;

    $totalUsers = DB::table('matrix')->where('ownerid', $userid)->where('type_id', $userStage)->first()->count_users;

    $ref_no = DB::table('refferal_bonus')->where('membershipid', $userid)->first()->noofreffered;
    
    $result = 0.0;
    $noofreffered = round(6.4 * $ref_no, 2);
    $result1 = round($noofreffered + 16.0, 2);

    if ($userStage == 0) {
    	$result = $noofreffered;
    } elseif ($userStage == 1) {
    	$result = (($totalUsers - 1) * 16) + $result1;
    } elseif ($userStage == 2) {
    	$result = (($totalUsers - 1) * 40) + $result1 + 384;
    } elseif ($userStage == 3) {
    	$result = (($totalUsers - 1) * 50) + $result1 + 384 + 920;
    } elseif ($userStage == 4) {
    	$result = (($totalUsers - 1) * 160) + $result1 + 384 + 920 + 4200;
    } elseif ($userStage == 5) {
    	$result = (($totalUsers - 1) * 6000) + $result1 + 384 + 920 + 4200 + 7240;
    }else{
        $result = 0.0;
	}
    
    $incomingcash = DB::table("transactionsrecords")->where("receiverid", $userid)->sum("amount");
    
    $realIncome = $result + $incomingcash;
    
    return round($realIncome, 2);
  }

  private function getTotalAmountOrdered($user_id)
  {
      $results = DB::table("mlm_foodcollection")->where('user_id', $user_id)->whereBetween('date_created', ['2018-07-23', '2018-07-26'])->where('date_created', '<>', '0000-00-00')->get();

      $totalAmountOrdered = 0.0;
      
      foreach ($results as $result) {
          $totalAmountOrdered += $result->quantity * $result->amount;
      }

      return round($totalAmountOrdered, 2);
  }
  
  
  public function fixUserAccount(Request $request)
  {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    ini_set('max_execution_time',60000);

    DB::beginTransaction();

    try {
        $id = $request->membershipid;
        $money_spent = $this->getAllExpenses($id);
        $money_gotten = $this->getUsersExpectedAmount($id);
        $totalAmountOrdered = $this->getTotalAmountOrdered($id);
        $excess = 0.0;

        if ($money_spent > $money_gotten) {
            $excess = abs(round($money_spent, 2) - round($money_gotten, 2));
        }

        // DEDUCT EXCESS FROM 
        $balance = round($totalAmountOrdered, 2) - round($excess, 2); 

        // UPDATE FOOD COLLECTION RECORD
        DB::table('mlm_foodcollection')
            ->whereBetween('date_created', ['2018-07-06', '2018-07-09'])
            ->where('user_id', $id)
            ->update(['date_created' => '0000-00-00']);

        DB::table('tempcurrentamount')
            ->where('userid', $id)
            ->update(['foodcash' => 'foodcash' + round($balance,2)]);

        DB::commit();

        dump($id . ": Successful  " . round($balance,2) . " has been added to foodcash.");

        // all good
    } catch (\Exception $e) {
        DB::rollback();
        dump("Something went wrong");
    }
  }
}