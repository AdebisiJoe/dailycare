<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class SustainabilityController extends Controller
{
   

   public function fillAllStageTwoLog()
   {
   	ini_set('max_execution_time',60000);   
     // $res = DB::select('select * from matrix m where m.type_id >=3 and m.created_at <="2017-12-31"');
     
     $res = DB::select('select * from matrix m where m.type_id >=3 and m.created_at BETWEEN  "2018-02-01" AND "2018-02-28"');

      foreach ($res as $value) {
       $membershipid=$value->ownerid;
      	$count=DB::table('members_award_log')->where('member_id',$membershipid)->count();

      	if($count<=0){
      	
      	DB::table('members_award_log')->insert(['member_id'=>$membershipid,'frequency'=>1,'stage'=>2,'completed'=>0,'award_category_id'=>1]);

      	echo "members_award_log has been update with the record of ".$membershipid."<br/>";	
      	}
      

    
      }
   }

}
