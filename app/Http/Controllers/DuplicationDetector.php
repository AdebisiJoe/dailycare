<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Session;

class DuplicationDetector extends Controller
{
    
    public function detectDuplication($stage)
    { 
    ini_set('max_execution_time',60000);    
       $temp = [];

       if ($stage==0) {
       // For Stage 0 Users Only
       $result = DB::select('select * from matrix where type_id = 0 order by matrix_id');
       }elseif ($stage==1) {
       	// For Stage 1 Users Only
       //$result = DB::select('select * from matrix where type_id = 1 and filled=1 and matrix_id = 2515 order by matrix_id');
       $result = DB::select('select * from matrix where type_id = 1 order by matrix_id');
       }elseif ($stage==2) {
       	// For Stage 2 Users Only
       $result = DB::select('select * from matrix where type_id = 2 order by matrix_id');
       }elseif ($stage==3) {
       	// For Stage 3 Users Only
       $result = DB::select('select * from matrix where type_id = 3 order by matrix_id');
       }
       
     foreach ($result as $key) {
     	# code...
       
      $result2 = DB::select('SELECT matrix_users_id, user_id, COUNT(*) AS times, IF (COUNT(*)>1,"duplicated", "-") AS duplicated FROM matrix_users WHERE matrix_id =  '.$key->matrix_id.' AND  user_id !=  "0" GROUP BY user_id');
      foreach ($result2 as $key2) {
      	# code...
      	if($key2->times > 1){
        array_push($temp, array("matrix_users_id" =>$key2->matrix_users_id,"matrix_id" =>$key->matrix_id,"times" =>$key2->times, "user_id" =>$key2->user_id));
      	}
      }

     }
    return $temp;
    }


    public function process($list)
    {

     foreach ($list as $key => $list)
     {
       $res = DB::select('select * from matrix_users where user_id = "'.$list['user_id'].'" and matrix_id = '.$list['matrix_id'].'');
       
       $owner_id =$this->getOwnerID($list['matrix_id']);

         //-----for people already in stage 2---//
        //$this->forPeopleAlreadyInStage2($owner_id);

         //-----for people already in stage 2---//

       
       $count =DB::table('matrix_users')
       ->where('user_id','=',$list['user_id'])
       ->where('matrix_id','=',$list['matrix_id'])
       ->count();


       echo "matrix with duplicate issues is ".$list['matrix_id']."owned by".$list['user_id']."<br/>";
       
       // $arr = [];
       
       // foreach ($res as $key => $value) {
       // 	# code...
       // 	array_push($arr,array("matrix_users_id" => $value->matrix_users_id, "user_id" => $value->user_id,"matrix_id"=>$value->matrix_id));
       // }



        // for ($i=0; $i < $count - 1; $i++) { 

          
        //    $matrix_id=$arr[$i]["matrix_id"];
       
        //    $thematrix=DB::table('matrix')
        //    ->where('matrix_id','=',$matrix_id)
        //    ->first();
       
        //    DB::table('matrix')
        //    ->where('matrix_id','=',$matrix_id)
        //    ->decrement('count_users',1);

        //    $stage=$thematrix->type_id;
        //    $theownerid=$thematrix->ownerid;



        //    //-----for people already in stage 2---//
        //   // $this->forPeopleAlreadyInStage2($owner_id);

        //    //-----for people already in stage 2---//



        //    $results = DB::table('singledropamount')
        //    ->where('stage', '=',$stage)
        //    ->get();
        //    foreach ($results as $key => $v) {
        //    $amount=$v->amount; 
        //    }
        //     //Remove Duplicates
        //     //$qry =DB::statement('update matrix_users set user_id = 0 where matrix_users_id = '.$arr[$i]["matrix_users_id"]);

        //     //$affected = DB::update('update users set votes = 100 where name = ?', ['John']);
        //     // $matrix_users_id=$arr[$i]["matrix_users_id"];
        //     // $qry =DB::update('update matrix_users set user_id = 0 where matrix_users_id = ?',[$matrix_users_id]);
        //     if($qry !=0 || $qry != null){
                
        //         //Remove Excess paid cash
            
        //         // $deleteCash=$this->deleteCash($amount,$owner_id);
                
        //         // if($deleteCash!=0 || $deleteCash!=null){
        //         //     echo '#' . $amount . ' Has been deducted from the account of the User with Membership ID '. $owner_id .'<br>';                    
        //         // }else{
        //         //     echo "<b>Something went wrong with the delete cash operation for ".$arr[$i]["user_id"] ."</b><br>";
        //         // }

        //         // echo 'User with ID #'.$arr[$i]["matrix_users_id"] .' and Membership ID '.$arr[$i]["user_id"] .' has been corrected<br><br>';



        //     }else{
        //         echo 'User with ID #'.$arr[$i]["matrix_users_id"] .' and Membership ID '.$arr[$i]["user_id"] .' has <b>NOT</b> been corrected<br><br>';
        //     }
        // }
     }
    }

    public function getOwnerID($matrix_id)
    {
     $res =  DB::select('select ownerid from matrix where matrix_id = ' . $matrix_id);
     foreach ($res as $key => $value) {
     	# code...
     	return $value->ownerid;
     }

    }

    public function deleteCash($amount,$user_id)
    {
   
   return DB::update('UPDATE tempcurrentamount SET foodcash = foodcash - '.$amount .' where userid = ?',[$user_id]);
    }
   
   public function getandDeleteDuplicate()
   {
    ini_set('max_execution_time',60000);
    header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
   	$list=$this->detectDuplication(2);
   	$this->process($list);
   }
   public function showList()
   {
    ini_set('max_execution_time',60000);
    ini_set('memory_limit',24220928);
   	$list=$this->detectDuplication(1);
   	echo '<table border="1">';
   	foreach ($list as $key => $value) {
   		# code...
   		echo "<tr><td><b>".$value['matrix_id']."</b></td><td>" .$value['matrix_users_id']."</td><td>" .$value['user_id']."</td><td>".$value['times']."</td><td>duplicated</td></tr>";

   	}
   	echo '</table>';
   	//dd($list);
   }

   public function forPeopleAlreadyInStage2(Request $request)
   {
    $theownerid=$request->membershipid;
           //get stage 2 matrix
           $stage2matrix=DB::table('matrix')
           ->where('ownerid','=',$theownerid)
           ->where('type_id','=',2)
           ->first();

           //delete stage 2 matrix
           DB::table('matrix')->where('matrix_id','=', $stage2matrix->matrix_id)->delete();

           //count users in stage 2 matrix
            $stage2count=DB::table('matrix_users')
            ->where('matrix_id','=',$stage2matrix->matrix_id)
            ->where('user_id','=','0')
            ->count();

            $numberofstage2users=14-$stage2count;

           //remove the money stage completion,and stage 2 level bonuses 
            DB::table('tempcurrentamount')
            ->where('userid','=',$theownerid)
            ->decrement('foodcash',160);
            $stage2amount=$numberofstage2users*16;
            $foodcash=$stage2amount*0.4;
            $payoutcash=$stage2amount*0.6;

            //remove food cash
            DB::table('tempcurrentamount')
            ->where('userid','=',$theownerid)
            ->decrement('foodcash',$foodcash);

            //remove payout cash
            DB::table('tempcurrentamount')
            ->where('userid','=',$theownerid)
            ->decrement('payoutcash',$payoutcash);

            //delete the stage 2 matrix users record
           DB::table('matrix_users')->where('matrix_id','=',$stage2matrix->matrix_id)->delete();

           DB::table('member_table')
           ->where('membershipid','=',$theownerid)
           ->update(['stage' =>1]);
Session::flash('flash_success','The Stage 2 Duplicate Removed successfully');
     return redirect()->back();      
   }

   public function checkDuplicationinMatrix(){

     //DB::select('SELECT type_id,ownerid, COUNT(*) AS times, IF (COUNT(*)>1,"duplicated", "-") AS duplicated FROM matrix WHERE type_id =  '.$stage.' GROUP BY user_id'); 

$query=DB::select('SELECT m1.membershipid, m2.membershipid, m3.membershipid, m4.membershipid
FROM member_table m1 -- 1st level
LEFT OUTER JOIN member_table m2
ON m2.parentid = m1.membershipid -- 2nd level
LEFT OUTER JOIN member_table m3
ON m3.parentid = m2.membershipid -- 3rd level
LEFT OUTER JOIN member_table m4
ON m4.membershipid = m3.membershipid WHERE m1.membershipid="HW00016053"');
dd($query);
        
   }

   public function showstagetwoduplictepage()
   {
   return view('admin.removeduplicate');

   }
   public function showstageoneduplicatepage()
   {
    return view('admin.removeduplicateone');
   }
   public function removeStageOneDuplicate()
   {
    
   }


   public function removeExtraReferralMoney(){
     ini_set('max_execution_time',60000);
    $query=DB::select('select * from refferal_bonus as re where re.noofreffered > ( select count(me.sponsorid) from member_table as me where re.membershipid = me.sponsorid)');

    foreach ($query as  $value) {
      # code...
       $membershipid=$value->membershipid;
       $bonus=$value->bonus;
       $noofreffered=$value->noofreffered;
       $realcount=DB::table('member_table')->where('sponsorid',$membershipid)->count();
        
          $realamount=$realcount*6.4;
          $extraCash=$bonus-$realamount;
          DB::table('refferal_bonus')->where('membershipid',$membershipid)->update(['bonus'=>$realamount,'noofreffered'=>$realcount]);
          DB::table('tempcurrentamount')->where('userid',$membershipid)->decrement('foodcash',$extraCash);

      

        
   echo $extraCash." was deducted from" .$membershipid ."and referral count was set to". $realcount ."<br>";
    }


   }

 
 public function getMembers(){

 }

 public function calculateMemberTotalEarnings($membershipid,$stage){
$totalearning=0;
  if($stage==1){
  DB::select('SELECT matrix_users_id, user_id, COUNT(*) AS times, IF (COUNT(*)>1,"duplicated", "-") AS duplicated FROM matrix_users WHERE matrix_id =  '.$key->matrix_id.' AND  user_id !=  "0" GROUP BY user_id');   

  }elseif ($stage==2) {
    # code...
  }elseif ($stage==3) {
    # code...
  }elseif ($stage==4) {
    # code...
  }
  elseif ($stage==4) {
    # code...
  }
 

 }

 public function calculateMembersTotalIncominTransfer(){

 }

 public function calculteTotalfoodOrder(){

 }

public function calculateMoneyInGroup(){
ini_set('max_execution_time',60000);
  $grouparray = array("HW00909501", "HW01121383", "HW01121384", "HW01121385", "HW01121386", "HW01121387", "HW01121388", "HW01121389", "HW01121390", "HW01121391", "HW01121392", "HW01121393", "HW01121394", "HW01121395", "HW01121396", "HW01121397", "HW01121398", "HW01121399", "HW01121400", "HW01121401", "HW01121402", "HW01121403", "HW01121404", "HW01131156", "HW01131157", "HW01131158", "HW01131159", "HW01131160", "HW01131161", "HW01131162", "HW01131163", "HW01131164", "HW01131165", "HW01131166", "HW01131167", "HW01131168", "HW01131169", "HW01131170", "HW01131171", "HW01131172", "HW01131173", "HW01131174", "HW01131175", "HW01131176", "HW01131177", "HW01131178", "HW01131179", "HW01121405", "HW01128052", "HW01128053", "HW01128054", "HW01128055", "HW01128004", "HW01128005", "HW01128006", "HW01128007", "HW01128008", "HW01128009", "HW01128010", "HW01128011", "HW01128012", "HW01128013", "HW01128014", "HW01128015", "HW01128056", "HW01128057", "HW01128058", "HW01128059", "HW01128060", "HW01128061", "HW01128062", "HW01128063", "HW01128064", "HW01128065", "HW01128066", "HW01128067", "HW01128068", "HW01128069", "HW01128070", "HW01128071", "HW01128072", "HW01128073", "HW01128074", "HW01128075", "HW01121406", "HW01128136", "HW01128137", "HW01128138", "HW01128139", "HW01128140", "HW01128141", "HW01128142", "HW01128143", "HW01128144", "HW01128145", "HW01128146", "HW01128147", "HW01128148", "HW01128149", "HW01128150", "HW01128151", "HW01128152", "HW01128153", "HW01128154", "HW01128155", "HW01128160", "HW01128161", "HW01128162", "HW01128163", "HW01128164", "HW01128165", "HW01128166", "HW01128167", "HW01128168", "HW01128169", "HW01128170", "HW01128171", "HW01128172", "HW01128173", "HW01128174", "HW01128175", "HW01122956", "HW01128100", "HW01128101", "HW01128102", "HW01128103", "HW01128104", "HW01128105", "HW01128106", "HW01128107", "HW01128108", "HW01128109", "HW01128110", "HW01128111", "HW01128112", "HW01128113", "HW01128114", "HW01128115", "HW01128116", "HW01128117", "HW01128118", "HW01128119", "HW01128120", "HW01128121", "HW01128122", "HW01128123", "HW01128124", "HW01128125", "HW01128126", "HW01128127", "HW01128128", "HW01128129", "HW01128130", "HW01128131", "HW01128132", "HW01128133", "HW01128134", "HW01128135", "HW01122957", "HW01127992", "HW01127993", "HW01127994", "HW01127995", "HW01127996", "HW01127997", "HW01127998", "HW01127999", "HW01128000", "HW01128001", "HW01128002", "HW01128003", "HW01128076", "HW01128077", "HW01128078", "HW01128079", "HW01128080", "HW01128081", "HW01128082", "HW01128083", "HW01128084", "HW01128085", "HW01128086", "HW01128087", "HW01128088", "HW01128089", "HW01128090", "HW01128091", "HW01128092", "HW01128093", "HW01128094", "HW01128095", "HW01128096", "HW01128097", "HW01128098", "HW01128099", "HW01122958", "HW01122959", "HW01122960", "HW01122961", "HW01122962", "HW01122963", "HW01122964", "HW01122965", "HW01122966", "HW01122967", "HW01122968", "HW01122969", "HW01122970", "HW01122971", "HW01122972", "HW01122973", "HW01122974", "HW01122975", "HW01121260", "HW01121261", "HW01121262", "HW01121263", "HW01121264", "HW01121265", "HW01121266", "HW01121504", "HW01121505", "HW01121506", "HW01123016", "HW01123017", "HW01123018", "HW01123019", "HW01123020", "HW01123021", "HW01131276", "HW01131277", "HW01131278", "HW01131279", "HW01131280", "HW01131281", "HW01131282", "HW01131283", "HW01131284", "HW01131285", "HW01131286", "HW01131287", "HW01127956", "HW01127957", "HW01127958", "HW01127959", "HW01127960", "HW01127961", "HW01127962", "HW01127963", "HW01127964", "HW01127965", "HW01127966", "HW01127967", "HW01127968", "HW01127969", "HW01127970", "HW01127971", "HW01127972", "HW01127973", "HW01127974", "HW01127975", "HW01127976", "HW01127977", "HW01127978", "HW01127979", "HW01127980", "HW01127981", "HW01127982", "HW01127983", "HW01127984", "HW01127985", "HW01127986", "HW01127987", "HW01127988", "HW01127989", "HW01127990", "HW01127991", "HW00909502", "HW01108538", "HW01108539", "HW01108540", "HW01108541", "HW01108542", "HW01108543", "HW01108544", "HW01108545", "HW01108546", "HW01108547", "HW01108548", "HW01108549", "HW01108550", "HW01108551", "HW01108552", "HW01108553", "HW01108554", "HW01108555", "HW01108556", "HW01108557", "HW01108558", "HW01121435", "HW01121436", "HW01121437", "HW01121438", "HW01121439", "HW01121440", "HW01121441", "HW01121442", "HW01121443", "HW01121444", "HW01121445", "HW01121446", "HW01121447", "HW01121448", "HW01121449", "HW01121450", "HW01121451", "HW01121452", "HW01121453", "HW01121454", "HW01121455", "HW01121456", "HW01121457", "HW01121458", "HW01121459", "HW01121460", "HW01121461", "HW01121462", "HW01121463", "HW01121464", "HW01121465", "HW01121466", "HW01121255", "HW01121256", "HW01121257", "HW01121258", "HW01121259", "HW01108559", "HW01121303", "HW01121304", "HW01121305", "HW01121306", "HW01121307", "HW01121308", "HW01121309", "HW01121310", "HW01121311", "HW01121312", "HW01121313", "HW01121314", "HW01121479", "HW01121480", "HW01121481", "HW01121482", "HW01121483", "HW01121484", "HW01121485", "HW01121486", "HW01121487", "HW01121488", "HW01121489", "HW01121490", "HW01121491", "HW01121492", "HW01121493", "HW01121494", "HW01121495", "HW01121496", "HW01121497", "HW01121498", "HW01121499", "HW01121500", "HW01121501", "HW01121502", "HW01108560", "HW01121339", "HW01121340", "HW01121341", "HW01121342", "HW01121343", "HW01121344", "HW01121345", "HW01121346", "HW01121407", "HW01121408", "HW01121409", "HW01121410", "HW01121411", "HW01121412", "HW01121413", "HW01121414", "HW01121415", "HW01121416", "HW01121417", "HW01121418", "HW01121419", "HW01121420", "HW01121421", "HW01121422", "HW01121423", "HW01121424", "HW01121425", "HW01121426", "HW01121427", "HW01121428", "HW01121429", "HW01121430", "HW01121431", "HW01121432", "HW01121433", "HW01121434", "HW01108561", "HW01121347", "HW01121348", "HW01121349", "HW01121350", "HW01121351", "HW01121352", "HW01121353", "HW01121354", "HW01121355", "HW01121356", "HW01121357", "HW01121358", "HW01121359", "HW01121360", "HW01121361", "HW01121362", "HW01121363", "HW01121364", "HW01121365", "HW01121366", "HW01121367", "HW01121368", "HW01121369", "HW01121370", "HW01121371", "HW01121372", "HW01121373", "HW01121374", "HW01121375", "HW01121376", "HW01121377", "HW01121378", "HW01121379", "HW01121380", "HW01121381", "HW01121382", "HW01108562", "HW01121267", "HW01121268", "HW01121269", "HW01121270", "HW01121271", "HW01121272", "HW01121273", "HW01121274", "HW01121275", "HW01121276", "HW01121277", "HW01121278", "HW01121279", "HW01121280", "HW01121281", "HW01121282", "HW01121283", "HW01121284", "HW01121285", "HW01121286", "HW01121287", "HW01121288", "HW01121289", "HW01121290", "HW01121291", "HW01121292", "HW01121293", "HW01121294", "HW01121295", "HW01121296", "HW01121297", "HW01121298", "HW01121299", "HW01121300", "HW01121301", "HW01121302", "HW01121207", "HW01121219", "HW01121220", "HW01121221", "HW01121222", "HW01121223", "HW01121224", "HW01121225", "HW01121226", "HW01121227", "HW01121228", "HW01121229", "HW01121230", "HW01121231", "HW01121232", "HW01121233", "HW01121234", "HW01121235", "HW01121236", "HW01121237", "HW01121238", "HW01121239", "HW01121240", "HW01121241", "HW01121242", "HW01121243", "HW01121244", "HW01121245", "HW01121246", "HW01121247", "HW01121248", "HW01121249", "HW01121250", "HW01121251", "HW01121252", "HW01121253", "HW01121254", "HW01121208", "HW01121183", "HW01121184", "HW01121185", "HW01121186", "HW01121187", "HW01121188", "HW01121189", "HW01121190", "HW01121191", "HW01121192", "HW01121193", "HW01121194", "HW01121195", "HW01121196", "HW01121197", "HW01121198", "HW01121199", "HW01121200", "HW01121201", "HW01121202", "HW01121203", "HW01121204", "HW01121205", "HW01121206", "HW01121327", "HW01121328", "HW01121329", "HW01121330", "HW01121331", "HW01121332", "HW01121333", "HW01121334", "HW01121335", "HW01121336", "HW01121337", "HW01121338", "HW01121468", "HW01121209", "HW01121210", "HW01121211", "HW01121212", "HW01121213", "HW01121214", "HW01121215", "HW01121216", "HW01121217", "HW01121218", "HW00909503", "HW01034203", "HW01034204", "HW01034205", "HW01034206", "HW01034207", "HW01034208", "HW01034209", "HW01034210", "HW01034211", "HW01034212", "HW01034213", "HW01034214", "HW01034215", "HW01034216", "HW01034217", "HW01034218", "HW01034219", "HW01034220", "HW01034221", "HW01034222", "HW01034223", "HW01121147", "HW01121148", "HW01121149", "HW01121150", "HW01121151", "HW01121152", "HW01121153", "HW01121154", "HW01121155", "HW01121156", "HW01121157", "HW01121158", "HW01121159", "HW01121160", "HW01121161", "HW01121162", "HW01121163", "HW01121164", "HW01121165", "HW01121166", "HW01121167", "HW01121168", "HW01121169", "HW01121170", "HW01121171", "HW01121172", "HW01121173", "HW01121174", "HW01121175", "HW01121176", "HW01121177", "HW01121178", "HW01121179", "HW01121180", "HW01121181", "HW01121182", "HW01034224", "HW01071515", "HW01071516", "HW01071517", "HW01071518", "HW01071519", "HW01071520", "HW01071521", "HW01071522", "HW01071523", "HW01071524", "HW01071525", "HW01071526", "HW01071527", "HW01071528", "HW01071529", "HW01071530", "HW01071531", "HW01071532", "HW01071533", "HW01071534", "HW01071535", "HW01071536", "HW01071537", "HW01071538", "HW01071539", "HW01034225", "HW01108684", "HW01108685", "HW01108686", "HW01108687", "HW01108688", "HW01108691", "HW01108692", "HW01108693", "HW01108694", "HW01108695", "HW01108696", "HW01108697", "HW01108698", "HW01121315", "HW01121316", "HW01121317", "HW01121318", "HW01121319", "HW01121320", "HW01121321", "HW01121322", "HW01121323", "HW01121324", "HW01121325", "HW01121326", "HW01121467", "HW01121469", "HW01121470", "HW01121471", "HW01121472", "HW01121473", "HW01121474", "HW01121475", "HW01121476", "HW01121477", "HW01121478", "HW01034226", "HW01108631", "HW01108632", "HW01108633", "HW01108634", "HW01108635", "HW01108636", "HW01108637", "HW01108638", "HW01108639", "HW01108640", "HW01108641", "HW01108642", "HW01108643", "HW01108644", "HW01108645", "HW01108646", "HW01108647", "HW01108648", "HW01108689", "HW01108690", "HW01108699", "HW01108700", "HW01108701", "HW01108702", "HW01108703", "HW01108704", "HW01108705", "HW01108706", "HW01108707", "HW01108708", "HW01109739", "HW01109740", "HW01109741", "HW01109742", "HW01109743", "HW01109744", "HW01109745", "HW01109746", "HW01109747", "HW01071512", "HW01071513", "HW01071514", "HW01034227", "HW01108649", "HW01108651", "HW01108652", "HW01108653", "HW01108654", "HW01108655", "HW01108656", "HW01108657", "HW01108658", "HW01108659", "HW01108660", "HW01108661", "HW01108662", "HW01108663", "HW01108664", "HW01108665", "HW01108666", "HW01108667", "HW01108668", "HW01108669", "HW01108670", "HW01108671", "HW01108672", "HW01108673", "HW01108674", "HW01108675", "HW01108676", "HW01108677", "HW01108678", "HW01108679", "HW01108680", "HW01108681", "HW01108682", "HW01108683", "HW01108650", "HW01034228", "HW01045287", "HW01045288", "HW01045289", "HW01045290", "HW01045291", "HW01045292", "HW01108567", "HW01108568", "HW01108569", "HW01108570", "HW01108571", "HW01108572", "HW01108573", "HW01108574", "HW01108575", "HW01108576", "HW01108577", "HW01108578", "HW01108579", "HW01108580", "HW01108581", "HW01108582", "HW01108583", "HW01108584", "HW01108585", "HW01108586", "HW01108587", "HW01108588", "HW01108589", "HW01108590", "HW01108591", "HW01108592", "HW01108593", "HW01108594", "HW01108595", "HW01108596", "HW01108597", "HW01108598", "HW01108599", "HW01108600", "HW01108601", "HW01108602", "HW01108603", "HW01108604", "HW01108605", "HW01108606", "HW01108607", "HW01108608", "HW01034229", "HW01034241", "HW01034242", "HW01034243", "HW01034244", "HW01034245", "HW01045283", "HW01045284", "HW01045285", "HW01045286", "HW01045293", "HW01045294", "HW01045295", "HW01045296", "HW01045297", "HW01108609", "HW01108610", "HW01108611", "HW01108612", "HW01108613", "HW01108614", "HW01108615", "HW01108616", "HW01108617", "HW01108618", "HW01108619", "HW01108620", "HW01108621", "HW01108622", "HW01108623", "HW01108624", "HW01108625", "HW01108626", "HW01108627", "HW01108628", "HW01108629", "HW01108630", "HW01034230", "HW01034231", "HW01034232", "HW01034233", "HW01034234", "HW01034235", "HW01034236", "HW01034237", "HW01034238", "HW01034239", "HW01108709", "HW01108710", "HW01108711", "HW01108712", "HW01108713", "HW01108714", "HW01108715", "HW01108716", "HW01108717", "HW01108718", "HW01108719", "HW01108720", "HW01108721", "HW01108722", "HW01108723", "HW01108724", "HW01108725", "HW01108726", "HW01108727", "HW01108728", "HW01108563", "HW01108564", "HW01108565", "HW01108566", "HW00909504", "HW01090069", "HW01090070", "HW01090071", "HW01090072", "HW01090073", "HW01090074", "HW01090075", "HW01090076", "HW01090077", "HW01090078", "HW01090199", "HW01090200", "HW01090201", "HW01090202", "HW01090203", "HW01090204", "HW01090205", "HW01090206", "HW01090207", "HW01090208", "HW01090209", "HW01090225", "HW01090226", "HW01090227", "HW01090228", "HW01090229", "HW01090230", "HW01090231", "HW01090232", "HW01090233", "HW01090234", "HW01090235", "HW01090236", "HW01090237", "HW01090238", "HW01090239", "HW01090240", "HW01090241", "HW01090242", "HW01090243", "HW01090244", "HW01090245", "HW01090246", "HW01090247", "HW01090248", "HW01090249", "HW01090250", "HW01090251", "HW01090252", "HW01090253", "HW01090254", "HW01090210", "HW01090153", "HW01090154", "HW01090155", "HW01090156", "HW01090157", "HW01090158", "HW01090159", "HW01090160", "HW01090161", "HW01090162", "HW01090163", "HW01090164", "HW01090165", "HW01090166", "HW01090167", "HW01090168", "HW01090169", "HW01090170", "HW01090171", "HW01090172", "HW01090173", "HW01090174", "HW01090175", "HW01090176", "HW01090177", "HW01090178", "HW01090179", "HW01090180", "HW01090181", "HW01090182", "HW01090211", "HW01090183", "HW01090184", "HW01090185", "HW01090186", "HW01090187", "HW01090188", "HW01090189", "HW01090190", "HW01090191", "HW01090192", "HW01090193", "HW01090194", "HW01090212", "HW01090255", "HW01090256", "HW01090257", "HW01090258", "HW01090195", "HW01090196", "HW01090197", "HW01090198", "HW01008194", "HW01008195", "HW01008196", "HW01008197", "HW01090213", "HW01090214", "HW01090215", "HW01090216", "HW01090217", "HW01090218", "HW01090219", "HW01090220", "HW01090221", "HW01090222", "HW01090223", "HW01090224", "HW01087748", "HW01087749", "HW01087750", "HW01087751", "HW01087752", "HW01087753", "HW01087754", "HW01087755", "HW01087756", "HW01087757", "HW01087758", "HW01090259", "HW01090260", "HW01090261", "HW01090262", "HW01090263", "HW01090264", "HW01090265", "HW01090266", "HW01090267", "HW01090268", "HW01106253", "HW01106254", "HW01106255", "HW01106256", "HW01106257", "HW01106258", "HW01108529", "HW01108530", "HW01108531", "HW01108532", "HW01108533", "HW01108534", "HW01108535", "HW01108536", "HW01108537", "HW01034167", "HW01034168", "HW01034169", "HW01034170", "HW01034171", "HW01034172", "HW01034173", "HW01034174", "HW01034175", "HW01034176", "HW01034177", "HW01034178", "HW01034179", "HW01034180", "HW01034181", "HW01034182", "HW01034183", "HW01034184", "HW01034185", "HW01034186", "HW01034187", "HW01034188", "HW01034189", "HW01034190", "HW01034191", "HW01034192", "HW01034193", "HW01034194", "HW01034195", "HW01034196", "HW01034197", "HW01034198", "HW01034199", "HW01034200", "HW01034201", "HW01034202", "HW01045298", "HW01045299", "HW01045300", "HW01045301", "HW01045302", "HW01070320", "HW01070321", "HW01070322", "HW01087719", "HW01087720", "HW01087721", "HW01087722", "HW01087723", "HW01087724", "HW01087725", "HW01087726", "HW01087727", "HW01087728", "HW01087729", "HW01087730", "HW01087731", "HW01087732", "HW01087733", "HW01087734", "HW01087735", "HW01087736", "HW01087737", "HW01087738", "HW01087739", "HW01087740", "HW01087741", "HW01087742", "HW01087743", "HW01087744", "HW01087745", "HW01087746", "HW01087747", "HW00909505", "HW01087609", "HW01087610", "HW01087611", "HW01087612", "HW01087613", "HW01087614", "HW01087615", "HW01087616", "HW01087617", "HW01087618", "HW01087619", "HW01087620", "HW01087621", "HW01087622", "HW01087623", "HW01087624", "HW01087625", "HW01087626", "HW01087627", "HW01087628", "HW01087629", "HW01087630", "HW01087631", "HW01087632", "HW00909506", "HW01089979", "HW01089980", "HW01089981", "HW01089982", "HW01089983", "HW01089984", "HW01089985", "HW01089986", "HW01089987", "HW01089988", "HW01089989", "HW01089990", "HW01089991", "HW01089992", "HW01089993", "HW01089994", "HW01089995", "HW01089996", "HW01089997", "HW01089998", "HW01089999", "HW01090000", "HW01090001", "HW01090002", "HW01090003", "HW01090004", "HW01090005", "HW01090006", "HW01090007", "HW01090008", "HW00909507", "HW01087633", "HW01087634", "HW01087635", "HW01087636", "HW01087637", "HW01087638", "HW01087639", "HW01087640", "HW01087641", "HW01087642", "HW01087643", "HW01087644", "HW01087645", "HW01087646", "HW01087647", "HW01087648", "HW01087649", "HW01087650", "HW01087651", "HW01087652", "HW01087653", "HW01087654", "HW01087655", "HW01087656", "HW01087657", "HW01087658", "HW01087659", "HW01087660", "HW01087661", "HW01087662", "HW00909508", "HW01090009", "HW01090010", "HW01090011", "HW01090012", "HW01090013", "HW01090014", "HW01090015", "HW01090016", "HW01090017", "HW01090018", "HW01090019", "HW01090020", "HW01090021", "HW01090022", "HW01090023", "HW01090024", "HW01090025", "HW01090026", "HW01090027", "HW01090028", "HW01090029", "HW01090030", "HW01090031", "HW01090032", "HW01090033", "HW01090034", "HW01090035", "HW01090036", "HW01090037", "HW01090038", "HW00909509", "HW01087663", "HW01087664", "HW01087665", "HW01087666", "HW01087667", "HW01087668", "HW01087669", "HW01087670", "HW01087671", "HW01087672", "HW01087673", "HW01087674", "HW01087675", "HW01087676", "HW01087677", "HW01087678", "HW01090079", "HW01090080", "HW01090081", "HW01090082", "HW01090083", "HW01090084", "HW01090085", "HW01090086", "HW01090087", "HW01090088", "HW01090089", "HW01090090", "HW01090091", "HW01090092", "HW00909510", "HW01090093", "HW01090094", "HW01090095", "HW01090096", "HW01090097", "HW01090098", "HW01090099", "HW01090100", "HW01090101", "HW01090102", "HW01090103", "HW01090104", "HW01090105", "HW01090106", "HW01090107", "HW01090108", "HW01090109", "HW01090110", "HW01090111", "HW01090112", "HW01090113", "HW01090114", "HW01090115", "HW01090116", "HW01090117", "HW01090118", "HW01090119", "HW01090120", "HW01090121", "HW01090122", "HW00909511", "HW01090039", "HW01090040", "HW01090041", "HW01090042", "HW01090043", "HW01090044", "HW01090045", "HW01090046", "HW01090047", "HW01090048", "HW01090049", "HW01090050", "HW01090051", "HW01090052", "HW01090053", "HW01090054", "HW01090055", "HW01090056", "HW01090057", "HW01090058", "HW01090059", "HW01090060", "HW01090061", "HW01090062", "HW01090063", "HW01090064", "HW01090065", "HW01090066", "HW01090067", "HW01090068", "HW00909512", "HW00909513", "HW00909514", "HW00909515", "HW00909516", "HW00909517", "HW00909518");

     $arrlength = count($grouparray);

     $foodcash=0;

for($x = 0; $x < $arrlength; $x++) {
    echo $grouparray[$x];

    
   
  $result=DB::table('tempcurrentamount')->where('userid',$grouparray[$x])->first();

  $foodcash=+$result->foodcash;
  
}


return $foodcash;

}

}
