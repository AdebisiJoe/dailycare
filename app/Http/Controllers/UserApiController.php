<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\accountcontroller;
use App\Http\Controllers\websitecontroller;
use DB;

class UserApiController extends Controller
{
    private $userController;
    private $accountcontroller;

    function __construct(){
        $this->middleware('jwt.auth');
        $this->userController=new UserController();
        $this->accountcontroller=new accountcontroller();
    }

    public function getWalletBalance(Request $request){


        try{
            $membershipid= $request->membershipid;
        ini_set('max_execution_time',3000);

        $stage=(new websitecontroller)->fillmatrix2($membershipid);
            $totalBalance= $this->accountcontroller->displaywallet($membershipid);
            $foodCash=$this->accountcontroller->getFoodCash($membershipid);
            $payoutcash=$this->accountcontroller->getPayoutCash($membershipid);
            $walletBalance=[
                'totalbalance'=>$totalBalance,
                'foodcash'=>$foodCash,
                'payoutcash'=>$payoutcash
            ];

            return Response::json([
                'data'=>$walletBalance
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);
        }

    }

    public function getTotalOrdersMade()
    {

    }

    public function getTotalNumberOfReferred(Request $request)
    {
        try{
            $membershipid= $request->membershipid;
            $results=DB::table('refferal_bonus')
                ->where('membershipid',"=",$membershipid)
                ->get();
            $reffered=null;
            $referralbonus="0";
            foreach ($results as $key => $v) {
                # code...
                $reffered=$v->noofreffered;

                $referralbonus=$v->bonus;
            }
            $refferedData=[
                'noofreffered'=>$reffered,
                'referralbonus'=>$referralbonus
            ];

            return Response::json([
                'data'=>$refferedData
            ],200);
        }catch (\Exception $e)
        {
            return response('error',400);
        }

    }


    public function getTotalNumberOfDownlines(Request $request)
    {

        try{
            $membershipid=$request->membershipid;
            $count=DB::table('member_table as m')
                ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
                ->where('t.ancestor', '=',$membershipid)
                ->count();
            DB::table('member_table')
                ->where('membershipid', $membershipid)
                ->update(['downlines' => $count]);
            $numberOfDownlines=$this->userController->countdownlines($membershipid);
            $downlinesData=[
                'numberOfDownlines'=>$numberOfDownlines
            ];

            return Response::json([
                'data'=>$downlinesData
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    public function calculateUserBonus(Request $request)
    {
        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];
            ini_set('max_execution_time',3000);

            $stage=(new websitecontroller)->fillmatrix2($membershipid);
            $accountcontroller=new accountcontroller();
            $walletbalance=$accountcontroller->displaywallet($membershipid);
            $stage1=$this->getuserstage($membershipid);
            $request->session()->forget('calculatebonus');
            return json_encode(['walletbalance'=>$walletbalance,'stage'=>$stage1]);
        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    public function calculateUserDownlines(Request $request)
    {

        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];
            $value=$request->session()->get('calculatedownlines',false);

            if ($value==false) {
                # code...
                $request->session()->put('calculatedownlines',true);

                $count=DB::table('member_table as m')
                    ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
                    ->where('t.ancestor', '=',$membershipid)
                    ->count();
                DB::table('member_table')
                    ->where('membershipid', $membershipid)
                    ->update(['downlines' => $count]);

                $downlinescount=$this->countdownlines($membershipid);
                $request->session()->forget('calculatedownlines');
                return json_encode(['downlinescount'=>$downlinescount]);
            } else {
                # code...
                $downlinescount=$this->countdownlines($membershipid);
                return json_encode(['downlinescount'=>$downlinescount]);
            }

        }catch (\Exception $e)
        {
            return response('error',400);
        }

    }





    public function getReferrals(Request $request){

        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];

            $sponsor = DB::table('member_table')->select('username', 'firstname', 'lastname','phonenumber','membershipid','stage')
                ->where('sponsorid', '=', $membershipid )->get();
            return json_encode(['referrals'=>$sponsor]);
        }catch(\Exception $e){
            return response('error',400);
        }

    }

    public function getSingleMemberRecord(Request $request){
        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];

            $memberDetails = DB::table('member_table')->select('firstname', 'lastname','phonenumber','membershipid')->where('membershipid', '=', $membershipid )->get();
            return json_encode(['memberDetails'=>$memberDetails]);
        }catch(\Exception $e){
            return response('error',400);
        }
    }

    public function getAllMembers(Request $request){
        try{
            $post = $request->all();
            $membershipid = $post['membershipid'];

            $members=DB::table('member_table as m')
                ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
                ->where('t.ancestor', '=',$membershipid)
                ->get();

            return json_encode(['members'=>$members]);
        }catch(\Exception $e){
            return response('error',400);
        }
    }


}
