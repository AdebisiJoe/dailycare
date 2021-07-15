<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Response;
use Validator;
use Illuminate\Support\Facades\DB;

class EwalletApiController extends Controller
{
    private $userController;
    private $accountcontroller;

    function __construct(){
        $this->middleware('jwt.auth');
        //$this->middleware('lock', ['except' => ['releasewalletlock']]);
        $this->userController=new UserController();
        $this->accountcontroller=new accountcontroller();
    }

    public function getWalletBalance(){


    }

    public function calculateWalletBalance()
    {

    }

    public function releaseWalletLock($transactionpassword,$mainaccountid){
        $result = DB::table('member_table')
            ->where('membershipid', '=', $mainaccountid)
            ->first();
        $username=$result->username;
        $results = DB::table('users')
            ->where('username', '=', $username)
            ->get();
        foreach ($results as $key => $v) {

            $transactionpass = $v->transactionpass;
        }

        if($transactionpass==$transactionpassword){
            return true;

        }else {
            return false;

        }
    }

    public function transferFunds(Request $request){

        $transactionpass=$request->transactionpassword;
        $receiverid=$request->receiverid;
        $senderid=$request->senderid;
        $amount=$request->amount;
        $accounttype=$request->accounttype;

        $mainaccountid=$request->mainaccountid;

        if($this->releaseWalletLock($transactionpass,$mainaccountid)) {

            $validator = Validator::make($request->all(),
                [
                    'receiverid' => 'required',
                    'accounttype' => 'required',
                    'amount' => 'required',
                    'transactionpassword' => 'required',
                    'senderid' => 'required',
                    'mainaccountid' => 'required'
                ]);
//take actions when the validation has failed
            if ($validator->fails()) {

                return Response::json([
                    'data' => [
                        'error'=>$validator->errors()->getMessages()
                    ]
                ],400);

            }

            $this->transfercashtoanotheraccount($senderid, $receiverid, $amount, $accounttype);
            return Response::json([
                'data' => [
                    'success'=>'You Have transferred '.$amount.' to '.$receiverid.' Successfully'
                ]
            ],200);
        }else{

            return Response::json([
                'data' => [
                    'error' => 'The Transaction password is Incorrect'
                ]
            ],400);

        }
    }

    public function transfercashtoanotheraccount($sourceacountid,$destinationaccountid,$amount,$accounttype){
        $check=$this->accountcontroller->checkifcashisavailable($sourceacountid,$amount,$accounttype);
        if ($check==false) {
            # code...
            $validator="you dont have up to ".$amount." in your account";

            return Response::json([
                'data' => [
                    'error'=>$validator->errors()->getMessages()
                ]
            ],400);


        }

        $check2=$this->accountcontroller->checkIfValueIsNegative($amount);
        if ($check2==false) {
            # code...
            $validator="You Cannot Enter with a Negative Value";

            return Response::json([
                'data' => [
                    'error'=>$validator->errors()->getMessages()
                ]
            ],400);

        }
        $check3=$this->accountcontroller->checkIfMembershipIdExist($destinationaccountid);
        if ($check3==false) {
            # code...
            $validator="The MembershipId you Entered is not Valid";


            return Response::json([
                'data' => [
                    'error'=>$validator->errors()->getMessages()
                ]
            ],400);

        }

        $check4=$this->accountcontroller->checkIfUserIsQualified($sourceacountid);

        if ($check4==false) {
            # code...
            $validator="The MembershipId you Entered is not Qualified to make transfers";

            return Response::json([
                'data' => [
                    'error'=>$validator->errors()->getMessages()
                ]
            ],400);

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




    }


    public function numberOfTransactions(Request $request){
        $membershipid=$request->membershipid;

        $count=DB::table('transactionsrecords')
            ->where('userid', '=', $membershipid)
            ->count();

        return Response::json([
            'data' => [
                'numberOfTransactions' => $count
            ]
        ],200);

    }

    public function getTransactions(Request $request){
        $membershipid=$request->membershipid;

        $results=DB::table('transactionsrecords')
            ->where('userid', '=', $membershipid)
            ->orderBy('created_at','desc')
            ->get();

        return Response::json([
            'data' => [
                'transactions' => $results
            ]
        ],200);


    }

    public function accountSummary(Request $request){
//Total Referral Bonus
//Total Earnings
//Total Level Bonus
//Total Stage Completion

        $membershipid=$request->membershipid;

            $walletbalance=0;
            $foodcash=0;
            $payoutcash=0;
            $totalearnings=0;
            $completionbonus=0;
            $levelbonus=0;
            $refferralbonus=0;

            $levelbonus=DB::table('singlebonuspaid')
                ->where('userid','=',$membershipid)
                ->sum('amount');

            $completionbonus=DB::table('stagecompletionbonus')
                ->where('userid','=',$membershipid)
                ->sum('amount');

            $refferralbonus=DB::table('refferal_bonus')
                ->where('membershipid','=',$membershipid)
                ->sum('bonus');



            $foodcash=$this->accountcontroller->getFoodCash($membershipid);
            $payoutcash=$this->accountcontroller->getPayoutCash($membershipid);


            $totalearnings=$completionbonus+$totalearnings+$refferralbonus;


        return Response::json([
            'data' => [
                'walletbalance'=>$walletbalance,
                'foodcash'=>$foodcash,
                'payoutcash'=>$payoutcash,
                'totalearnings'=>$totalearnings,
                'completionbonus'=>$completionbonus,
                'levelbonus'=>$levelbonus,
                'refferralbonus'=>$refferralbonus
            ]
        ],200);

    }



}
