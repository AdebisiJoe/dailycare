<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    public function calculateTotalRegisteredPerDay()
    {
        //$membershipid='HW0016001';
        //$members = DB::table('member_table as m')
        //  ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
        // ->where('t.ancestor', '=', $membershipid)
        //  ->where('m.stage', '=',$stage)
        //  ->get();
        //date //totalreg


        $maxdate=DB::select('SELECT MAX(date) AS "max_date"
FROM totalregperday');
        foreach ($maxdate as $max)
        {
            $maxDateValue=$max->max_date;

        }

        $totalforeachdays=DB::select('SELECT COUNT(*) as total_number_for_days, joindate
FROM member_table 
WHERE joindate>='.$maxDateValue.'
GROUP BY joindate');

        foreach ($totalforeachdays as $totalforeachday)
        {
            DB::table('totalregperday')->insert([['date' =>$totalforeachday->joindate , 'totalreg' =>$totalforeachday->total_number_for_days]]);
        }

        return "done";
    }


}
