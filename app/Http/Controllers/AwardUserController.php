<?php

namespace App\Http\Controllers;

use App\AwardCart;
use App\AwardCategory;
use App\AwardCategoryContent;
use App\MemberAwardLog;
use App\MembersAwardsDetails;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AwardUserController extends Controller
{
    public function index()
    {
        if(request('membershipid')){
           $membershipid = request('membershipid');
        }else{
            $membershipid = (new UserController)->getuseridwithusername();
        }

        $awardcategories = null;
        if($userStage = request('userStage'))
        {
            $awardcategories = AwardCategory::where('stage', $userStage)->get();
        }
        else{
            $userStage='2';
            $awardcategories = AwardCategory::where('stage', $userStage)->get();
        }

        //echo ($awardcategories);

        $stage=5;
        return view('awarduser.viewawards')
            ->with('stage',$stage)
            ->with('awardcategories',$awardcategories)
            ->with('membershipid',$membershipid);
    }

    public function show($id)
    {
        if(request('membershipid')){
            $membershipid = request('membershipid');
        }else{
            $membershipid = (new UserController)->getuseridwithusername();
        }
        $awardcategoriescontent = AwardCategoryContent::where(['award_category_id'=>$id, 'visible'=>1])->get();
        $stage=5;


        return view('awarduser.awardDetails')
            ->with('awardcategoriescontent',$awardcategoriescontent)
            ->with('stage',$stage)
            ->with('membershipid',$membershipid);
    }

    public function requestawardformainaccount($id, $membershipid)
    {
        $awardcategory = AwardCategory::where('id', $id)->select('stage','id')->first();
        $membershipID = (new UserController)->getuseridwithusername();
        $membershipstage = (new UserController)->getuserstage($membershipid);
        if( !(new UserController)->checkifsuaccountisformain($membershipid)){
            $validator=$membershipid." is not your Feed the nations Memebership Id ):";
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        if($this->checkMemberStage($membershipid, $awardcategory->stage))
        {
            $validator="you are not entitled to this award";
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        if($this->checkMemberCollectedStatus($membershipid))
        {

            $validator="you have an existing award you haven't collected";
                return redirect()
                    ->back()
                    ->withErrors($validator);
        }

        if($this->CheckMemberAwardCompleted($membershipid,$awardcategory->stage,$awardcategory->id))
        {
            $validator="you have completed this award";
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $mla = $this->storeAwardDetails($id, $membershipid, $awardcategory->stage, $membershipstage);
        $this->updateMembersAwardlogcompleted($mla);

//
        return redirect()
            ->back()
            ->with('flash_success', "order requested successfully successfully");
    }

    private function storeAwardDetails($catid, $membershipid, $awardstage, $membershipstage)
    {
        $awardcategory = AwardCategory::select('id')->where('id', $catid)->first();
        $awardcategoriescontents = AwardCategoryContent::where(['award_category_id'=>$awardcategory->id, 'visible'=>1])->get();
        foreach($awardcategoriescontents as $awardcategoriescontent)
        {
          $oldaward = Session::has('award') ? Session::get('award') : null;
          $items = $awardcategoriescontent;
          $itemid = $awardcategoriescontent->id;
          $product=null;
          if($awardcategoriescontent->good_type=='fooditem')
          {
            $product=$awardcategoriescontent->product;
          }
          if($awardcategoriescontent->good_type=='accessories')
            {
                $product=$awardcategoriescontent->accessory;
            }

            $awardcart = new AwardCart($oldaward);
          $awardcart->add($items, $product, $itemid);

          Session::put('award', $awardcart);



        }

        $oldaward = Session::get('award');
        $awardcart = new AwardCart($oldaward);

        MembersAwardsDetails::create([
            'membership_id' => $membershipid,
            'award_category_id'=>$catid,
            'order_details'=>serialize($awardcart),
            'collected'=>0
        ]);


        if( MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$awardstage, 'award_category_id'=>$catid, 'completed'=>0])->exists())
        {
            $ml = MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$awardstage, 'award_category_id'=>$catid, 'completed'=>0])->latest()->first();

            $prevfrequency = $ml->frequency;

            $updatedfrequency = $prevfrequency + 1;

            MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$awardstage, 'award_category_id'=>$catid, 'completed'=>0])->update([
                'frequency'=>$updatedfrequency
            ]);
        }
        else{
                 MemberAwardLog::create([
                'member_id'=>$membershipid,
                'stage'=>$awardstage,
                'frequency'=>1,
                'award_category_id'=>$catid,
                'completed'=>0
            ]);
        }

        Session::forget('award');

        $MAL = MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$awardstage, 'award_category_id'=>$catid, 'completed'=>0])->latest()->first();
//        echo($ml);
        return $MAL;

    }

    private function checkMemberCollectedStatus($membershipid)
    {
        if(MembersAwardsDetails::where('membership_id', $membershipid)->exists()) {
            $membercollected = MembersAwardsDetails::where('membership_id', $membershipid)->select('collected')->latest()->first();
            if ($membercollected != null && $membercollected->collected == 0) {
                return !false;
            }
            return !true;

        }return !true;

    }

    private function checkMemberStage($membershipid, $awardcategorystage)
    {
        $membershipstage = (new UserController)->getuserstage($membershipid);

        if($membershipstage < $awardcategorystage)
        {
            return true;
        }
        return false;
    }

     private function CheckMemberAwardCompleted($membershipid,$awardcategorystage, $award_category_id)
     {
         //$membershipstage = (new UserController)->getuserstage($membershipid);

         if( MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$awardcategorystage, 'award_category_id'=>$award_category_id])->exists()) {
             $ml = MemberAwardLog::where(['member_id' => $membershipid, 'stage' => $awardcategorystage, 'award_category_id' => $award_category_id])->latest()->first();

             if($ml->completed==1)
             {
                 return true;
             }
         }
         return false;
     }

     private function updateMembersAwardlogcompleted($mla)
     {
//         echo $mla->awardcategory->month_duration." and ".$mla->frequency;
        if($mla->awardcategory->month_duration == $mla->frequency)
        {
            MemberAwardLog::where(['member_id' =>$mla->member_id,'id'=>$mla->id,'completed'=>0])->update([
                'completed'=>1
            ]);
            return;
        }

        return;
     }
}
