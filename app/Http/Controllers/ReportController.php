<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ReportController extends Controller
{

    public function getInfoByID(Request $request)
    {

        //This function filters the user input
        $membership_id = str_replace(' ', '', $request->user_id);

        if(strpos($membership_id, '-') !== false){
            $userIDs = explode('-', $membership_id);
            return self::getAllRequest($request, $userIDs, true);

        }elseif (strpos($membership_id, ',') !== false) {
            $userIDs = explode(',', $membership_id);
            return self::getAllRequest($request, $userIDs, false);

        }else{

            return self::getAllRequest($request);
        }
    }


    private function getAllRequest($request, $userIDs = '', $range = false)
    {
        $membership_id = $request->user_id;
        
        $searchdate[0] = $request->date_from;
        $searchdate[1] = $request->date_to;


        $query = DB::table('member_table');

        $query->join('tempcurrentamount', 'tempcurrentamount.userid', '=', 'member_table.membershipid');

        if(!empty($membership_id) && $range == true && !empty($userIDs)){

                $query->whereBetween('membershipid', [$userIDs[0], $userIDs[1]]);

        }elseif (!empty($membership_id) && $range == false && !empty($userIDs)) {

                $query->whereBetween('membershipid', [$userIDs[0], $userIDs[1]]);
        
        }elseif(!empty($membership_id) && $range == false && empty($userIDs)){

                $query->where('membershipid','=', $request->user_id);
        
        }


        if(!empty($request->cus_fname)){
            $query->where('firstname', 'like', '%'.$request->cus_fname.'%');
        }

        if(!empty($request->cus_mname)){
            $query->where('middlename', 'like', '%'.$request->cus_mname.'%');
        }

        if(!empty($request->cus_lname)){
            $query->where('lastname', 'like', '%'.$request->cus_lname.'%');
        }
        
        if(!empty($request->cus_accttype)){
            $query->where('type', 'like', '%'.$request->cus_accttype.'%');
        }

        if(!empty($request->cus_bankname)){
            $query->where('bankname', 'like', '%'.$request->cus_bankname.'%');
        }

        if(!empty($request->cus_country)){
            $query->where('country', 'like', '%'.$request->cus_country.'%');
        }

        if(!empty($request->cus_state)){
            $query->where('state', 'like', '%'.$request->cus_state.'%');
        }
        
        if(!empty($request->cus_gender)){
            $query->where('sex', '=', $request->cus_gender);
        }
        
        if(!empty($request->cus_stage)){
            $query->where('stage', '=', $request->cus_stage);
        }
        
        if(!empty($searchdate[0]) && !empty($searchdate[1])){
            $query->whereBetween('joindate', [$searchdate]);
        }
        
        $results = $query->paginate(20)->appends($request->all());
        switch ($request->result_mg) {
            case 0:
                return view('report.personalInfo', compact('results'));
                break;
            case 1:
                return view('report.businessInfo', compact('results'));
                break;
            case 2:
                return view('report.financialInfo', compact('results'));
                break;
        }

    }

}

            // ->join('refferal_bonus', 'refferal_bonus.membershipid', '=', 'member_table.membershipid')
            // ->join('tempcurrentamount', 'tempcurrentamount.userid', '=', 'member_table.membershipid')
            // ->join('users','users.username', '=', 'member_table.username')
            // ->select(
            //  'users.name','users.email',
            //  'member_table.*',
            //  'refferal_bonus.membershipid', 'refferal_bonus.bonus', 'refferal_bonus.noofreffered',
            //  'tempcurrentamount.foodcash', 'tempcurrentamount.payoutcash'
            //  )