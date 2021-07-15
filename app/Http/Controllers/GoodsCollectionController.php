<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GoodsCollectionController extends Controller
{
    public function getAvailableAmount(Request $request)
    {
      $username = $request->username;
      $subAccounts = self::getSubAccountDetails($username);
      $hasSubAccounts = (empty($subAccounts))?false:true;

      $results = DB::table('tempcurrentamount')
      ->join('member_table','tempcurrentamount.userid', '=', 'member_table.membershipid')
      ->select('foodcash','payoutcash', 'regpack','firstname','lastname', 'middlename','stage', 'userid','joindate','username')
      ->where('tempcurrentamount.userid', '=', $username)
      ->get();

      if(!count($results) > 0){
        return 'false';
      }

      foreach ($results as $value) {
        $foodcash = $value->foodcash * 200;
        $paycash = $value->payoutcash * 200;
        $dateDiff = date_diff(date_create($value->joindate), date_create(date('Y-m-d')))->days;
      }
      
      return json_encode([['hasSubAccounts' => $hasSubAccounts], ['subAccounts'=>$subAccounts], ['results' => $results], ['foodcash' => $foodcash], ['dateDiff'=> $dateDiff], ['paycash' => $paycash]]);
    }

    private function getSubAccountDetails($parent_id)
    {
      return DB::table('member_table')
      ->join('tempcurrentamount','member_table.membershipid','=','tempcurrentamount.userid')
      ->select(DB::raw('tempcurrentamount.userid, tempcurrentamount.regpack, tempcurrentamount.foodcash * 200 as foodcash, member_table.joindate, member_table.stage, tempcurrentamount.payoutcash * 200 as paycash'))
      // ->select('tempcurrentamount.userid', 'tempcurrentamount.regpack', 'tempcurrentamount.foodcash', 'member_table.joindate', 'member_table.stage')
      ->where('isownedby', '=', $parent_id)
      ->where('type', '=', 'subaccount')
      ->orderBy('tempcurrentamount.regpack', 'desc')
      ->get();
    }

    public function setNewAmount(Request $request)
    {
      $username = $request->username;
      $amount = $request->amount;

      $collectedRegPack = $request->collectedRegPack;

      $amount = $amount / 200;

      $oldAmount = self::getOldFoodCash($username);

      $oldPayCashAmount = self::getOldPayCash($username);

      $prev_amount = $oldAmount->foodcash;

      if(count($collectedRegPack) > 0){
        foreach ($collectedRegPack as $userID) {
          DB::table('tempcurrentamount')
                      ->where('userid', $userID)
                      ->update(['regpack'=> 1]);
          self::feedLog($username, 0, 0, 'Collected 1 reg pack for '.$userID.' on '. date('Y-m-d h:i:s'));
        }
      }

      //Check If Amount is greater than foodcash
      $deductFromPayCash = 0;

      if($amount > $prev_amount){
        $deductFromPayCash = $amount- $prev_amount;
      }

      // return  'Deduct From Payout: ' . $deductFromPayCash * 200 . ' Amt to deduct: ' . $amount * 200 . ' old food balance ' . $prev_amount * 200;

      // dd();
      //Perform Deduction
      if($deductFromPayCash > 0 && $oldPayCashAmount > 0){
        $results = DB::table('tempcurrentamount')
        ->where('userid', '=', $username)
        ->decrement('foodcash', $prev_amount);

        self::feedLog($username, $prev_amount, $amount, date('Y-m-d h:i:s'));

        DB::table('tempcurrentamount')
          ->where('userid', '=', $username)
          ->decrement('payoutcash', $deductFromPayCash);

      }else{
        $results = DB::table('tempcurrentamount')
          ->where('userid', '=', $username)
          ->decrement('foodcash', $amount);

        self::feedLog($username, $prev_amount, $amount, date('Y-m-d h:i:s'));

      }

      return json_encode($results);
    }

    private function getOldFoodCash($user_id)
    {
      return DB::table('tempcurrentamount')->select('foodcash')->where('userid', '=', $user_id)->first();
    }

    private function getOldPayCash($user_id)
    {
      return DB::table('tempcurrentamount')->select('payoutcash')->where('userid', '=', $user_id)->first()->payoutcash;
    }

    private function feedLog($user_id, $prev_amount, $amount_deducted, $date)
    {
      DB::table('mlm_goodscollectionlog')
        ->insert(
            [
              'user_id' => $user_id,
              'prev_amount' => $prev_amount,
              'amount_deducted' => $amount_deducted,
              'trans_date' => $date
            ]
          );
    }

    public function getUserLog(Request $request)
    {
      return DB::table('mlm_goodscollectionlog')->where('user_id', $request->userid)->orderBy('trans_date', 'desc')->get();
      
    }
}
