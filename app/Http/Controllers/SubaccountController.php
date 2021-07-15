<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
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

class SubaccountController extends Controller
{
    //
	public function __construct() {
		$this->middleware('auth');
	}

	public function showsubaccountdownlines(Request $request){
		$userid=$request->membershipid;

		$checkifsub=(new UserController)->checkifsuaccountisformain($userid);
		if ($checkifsub==false) {
      # code...
			$validator=$userid." is not a sub account under you";
			return redirect()
			->back()    
			->withErrors($validator);

		}

		//(new websitecontroller)->fillmatrix2($userid); 
    //(new accountcontroller)->sendtocurrentamount($userid); 
		$downlines=(new UserController)->countdownlines($userid);
		$accountcontroller=new accountcontroller();
		$walletbalance=$accountcontroller->displaywallet($userid);

		$results = DB::table('member_table')
		->where('membershipid', '=', $userid)
		->get();  
		foreach ($results as $key => $v) {
   # code...
			$membershipid=$v->membershipid;
			$stage=$v->stage;
		}

		/*$members = DB::table('member_table as m')
		->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
		->where('t.ancestor', '=', $userid)
		->where('m.stage', '=',$stage)
		->get();*/

		$treedata="";
		$treedata.=(new UserController)->drawtree2($userid);

		$results=DB::table('refferal_bonus')
		->where('membershipid',"=",$userid)
		->get();
		$reffered=null;
		$referralbonus="0";
		foreach ($results as $key => $v) {
  # code...
			$reffered=$v->noofreffered;

			$referralbonus=$v->bonus;
		}

		return view('user.subaccountinfo')->with('membershipid',$userid)->with('treedata',$treedata)/*->with('members', $members)*/->with('walletbalance',$walletbalance)->with('downlines',$downlines)->with('reffered',$reffered)->with('referralbonus',$referralbonus)->with('stage',$stage);
	}


	public function Showsubaccountwalletdetails(Request $request){
		$walletbalance=0;
		$foodcash=0;
		$payoutcash=0;
		$totalearnings=0;
		$completionbonus=0;
		$levelbonus=0;
		$refferralbonus=0;


		$membershipid=$request->membershipid;
		$checkifsub=(new UserController)->checkifsuaccountisformain($membershipid);
		if ($checkifsub==false) {
      # code...
			$validator=$membershipid." is not a sub account under you";
			return redirect()
			->back()    
			->withErrors($validator);

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

		$results=DB::table('tempcurrentamount')
		->where('userid','=',$membershipid)
		->get();

		foreach ($results as $key => $v) {
    # code...
			$foodcash=$v->foodcash;
			$payoutcash=$v->payoutcash;
		}
		$walletbalance=$foodcash+$payoutcash;
		$totalearnings=$completionbonus+$levelbonus+$refferralbonus;
		return view('account.showsubaccountaccountdetails')->with(['walletbalance'=>$walletbalance,'foodcash'=>$foodcash,'payoutcash'=>$payoutcash,'totalearnings'=>$totalearnings,'completionbonus'=>$completionbonus,'levelbonus'=>$levelbonus,'refferralbonus'=>$refferralbonus,'membershipid'=>$membershipid]);
	}

	public function showsubaccountcashtransfer(Request $request){
		$membershipid=$request->membershipid;
		$checkifsub=(new UserController)->checkifsuaccountisformain($membershipid);
		if ($checkifsub==false) {
      # code...
			$validator=$membershipid." is not a sub account under you";
			return redirect()
			->back()    
			->withErrors($validator);

		}
		return view('account.transfersubaccountcash')->with(['membershipid'=>$membershipid]);
	}

	public function transfertomainaccount(Request $request){
		$subaccountmembershipid=$request->subaccountmembershipid;
		$amount=$request->amount;
		$accounttype=$request->accounttype;

		$username=Auth::User()->username;

		$validator=Validator::make($request->all(),
			[
			'accounttype'=>'required',
			'amount'=>'required',
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

		(new accountcontroller)->transfercashtoanotheraccount($subaccountmembershipid,$membershipid,$amount,$accounttype);

		return redirect()->back();
	}
    public function showSubAccountTranfertoFoodcash(Request $request)
    {
    	$membershipid=$request->membershipid;
       $checkifsub=(new UserController)->checkifsuaccountisformain($membershipid);
		if ($checkifsub==false) {
      # code...
			$validator=$membershipid." is not a sub account under you";
			return redirect()
			->back()    
			->withErrors($validator);
		}

       return view('account.subaccounttransfertofoodcash')->with(['membershipid'=>$membershipid]);
    }
    
    public function SubAccountTranfertoFoodcash(Request $request)
    {
    $amount=$request->amount;
    $membershipid=$request->membershipid;
    $validator=Validator::make($request->all(),
    [
    'amount'=>'required',
    ]);
//take actions when the validation has failed
  if ($validator->fails()){
    return redirect()
    ->back()
    ->withErrors($validator)
    ->withInput();
  }	
  $percentage=0;
 $accountFrom='payoutcash';
 $accountTo='foodcash';
  (new accountcontroller)->transferToanotherAccounttypeWithPercentagecut($membershipid,$amount,$accountFrom,$accountTo,$percentage);
  return redirect()->back();
  }
	
   public function showSubAccountDownlinesInTable($subaccountmembershipid)
  {
      $membershipid=$subaccountmembershipid;
      $checkifsub=(new UserController)->checkifsuaccountisformain($membershipid);
      if ($checkifsub==false) {
          # code...
          $validator=$membershipid." is not a sub account under you";
          return redirect()
              ->back()
              ->withErrors($validator);
      }

      $userController=new UserController();

      $firstleftchild =$userController->getfirstchild($membershipid,"L");
      $firstleftchildmembershipid = $firstleftchild['membershipid'];
      $firstleftchildmembers = DB::table('member_table as m')
          ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
          ->where('t.ancestor', '=', $firstleftchildmembershipid)
          ->paginate(10);


      $firstrightchild = $userController->getfirstchild($membershipid, "R");
      $firstrightchildmembershipid = $firstrightchild['membershipid'];
      $firstrightchildmembers = DB::table('member_table as m')
          ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
          ->where('t.ancestor', '=', $firstrightchildmembershipid)
          ->paginate(10);

      return view('user.subaccountviewmembersintable')->with('firstrightchildmembers',$firstrightchildmembers)->with('firstleftchildmembers',$firstleftchildmembers);
  }
 
    
}
