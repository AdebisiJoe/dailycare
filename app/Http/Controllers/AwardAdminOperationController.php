<?php

namespace App\Http\Controllers;

use App\AwardCategory;
use App\MemberAwardLog;
use App\MembersAwardsDetails;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AwardAdminOperationController extends Controller
{
    public function index()
    {
        $awardcategories = AwardCategory::all();
        return view('awardadminoperation.index')
            ->with('awardcategories', $awardcategories);
    }

    /**
     * @return string
     */
    public function show()
    {
        $membershipid = request('user_id');

        if(!MembersAwardsDetails::where(['membership_id' => $membershipid, 'collected' => 0])->exists())
        {
            return redirect('/award/admin/operation')->with('flash_danger', 'No Order for This Customer Now');
        }

        $memberawardorder = MembersAwardsDetails::where(['membership_id' => $membershipid, 'collected' => 0])->latest()->get();

        $memberawardorder->transform(function ($memberorder, $key) {
            $memberorder->order_details = unserialize($memberorder->order_details);
            return $memberorder;
        });

//        echo $memberawardorder;
        return view('awardadminoperation.index')->with('memberawardorder', $memberawardorder);

    }


    public function issueUserAward()
    {
        $membershipid = request('membership_id');
        $id = request('id');

        $memberawardorder = MembersAwardsDetails::where(['membership_id' => $membershipid, 'collected' => 0, 'id'=>$id])->update([
            'collected'=>1
        ]);

        return redirect('/award/admin/operation')->with('flash_success', "Your Product has Successfully been issued");

//        echo $id." and ".$membershipid;
    }

    public function getAllStageAward()
    {
        $awardcategoryid = request('award_category_id');

        if(!MembersAwardsDetails::where(['award_category_id' => $awardcategoryid, 'collected' => 0])->exists())
        {
            return redirect('/award/admin/operation')->with('flash_danger', 'No Order for This Particular Stage Now');
        }

        $allmembersawardorder = MembersAwardsDetails::where(['award_category_id' => $awardcategoryid, 'collected' => 0])->latest()->get();

        $allmembersawardorder->transform(function ($memberorder, $key) {
            $memberorder->order_details = unserialize($memberorder->order_details);
            return $memberorder;
        });

        $total = $this->getTotalForEachProduct($allmembersawardorder);
        $awardcategories = AwardCategory::all();

        return view('awardadminoperation.index')
            ->with('allmembersawardorder', $allmembersawardorder)
            ->with('awardcategories', $awardcategories)
            ->with('totalforeachproduct', $total);

    }

    public function getTotalForEachProduct($allmembersawardorder){
        $total= null;

        foreach($allmembersawardorder as $amao){
            foreach ($amao->order_details->items as $item) {
                if ($item['item']['good_type'] == 'fooditem'){
                    $temporary = ['name'=>$item['product']['item_name'], 'qty'=>$item['item']['quantity']];
                    if($total) {
                        if (array_key_exists($item['product']['id'], $total)) {

                            $id =$item['product']['id'];
//                            echo "old ".$total[$id]['name']."---".$total[$id]['qty']."<br>";
                            $tmpQty = $temporary['qty'] +  $total[$id]['qty'];
                            $temporary['qty']=$tmpQty;
//                            echo "newest ".$total[$id]['name']."---".$tmpQty."<br>";
                            $total[$id]=$temporary;
                        }else{
                            $id =$item['product']['id'];
                            $total[$id]=$temporary;
                        }
                   }else {

                    $id =$item['product']['id'];
                    $total[$id] = $temporary;

                    }
                }
                if ($item['item']['good_type'] == 'accessories'){
                    $temporary = ['name'=>$item['product']['name'], 'qty'=>$item['item']['quantity']];
                    if($total) {
                        if (array_key_exists($item['product']['id'], $total)) {

                            $id =$item['product']['id'];
//                            echo "old ".$total[$id]['name']."---".$total[$id]['qty']."<br>";
                            $tmpQty = $temporary['qty'] +  $total[$id]['qty'];
                            $temporary['qty']=$tmpQty;
//                            echo "newest ".$total[$id]['name']."---".$tmpQty."<br>";
                            $total[$id]=$temporary;
                        }else{
                            $id =$item['product']['id'];
                            $total[$id]=$temporary;
                        }
                    }else {

                        $id =$item['product']['id'];
                        $total[$id] = $temporary;

                    }
                }
            }
        }


//        foreach ($total as $t){
//            echo $t['name']."---".$t['qty'];
//        }

        return $total;
    }

    public function saveUserAwardLog(Request $request){
        $this->validate($request,[
            'membershipid'=>'required',
            'optradio'=>'required',
            'awardCategory'=>'required'
        ]);
        $membershipid = request('membershipid');
        $frequency = request('optradio');
        $award_id = request('awardCategory');

        $award=AwardCategory::where(['id'=>$award_id])->first();

        if($frequency<12){
            if( MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$award->stage, 'award_category_id'=>$award_id])->exists()){
                $validator="This Log already exist";
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }


            MemberAwardLog::create([
                'member_id'=>$membershipid,
                'stage'=>$award->stage,
                'frequency'=>$frequency,
                'award_category_id'=>$award_id,
                'completed'=>0
            ]);

            return redirect()
                ->back()
                ->with('flash_success', "order successfully");
        }


        if( MemberAwardLog::where(['member_id'=>$membershipid, 'stage'=>$award->stage, 'award_category_id'=>$award_id])->exists()){
            $validator="This Log already exist";
            return redirect()
                ->back()
                ->withErrors($validator);
        }


            MemberAwardLog::create([
            'member_id'=>$membershipid,
            'stage'=>$award->stage,
            'frequency'=>$frequency,
            'award_category_id'=>$award_id,
            'completed'=>1
        ]);

        return redirect()
            ->back()
            ->with('flash_success', "order successfully");

    }

    public function saveUserAwardLogForMonthLessThan12($membershipid, $frequency,$award_id){

    }
}
