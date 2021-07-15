<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Members;
use App\Totalreg;
use App\User;
use App\Item;
use App\Mlmlevel;
use App\Mlmrecords;

class Mlmcontroller extends Controller
{
    //
   
    public function __construct() {
        $this->middleware('auth');
        
    }    
/*----------Tree Algorithms-----------------*/
    public function gettotalchildrentree($memberid, $direction) {
    $total = 0;
    $results = DB::table('member_table')
            ->where('parentid', '=', $memberid)
            ->where('position', '=', $direction)
            ->get();

        $total = $total + DB::table('member_table')
            ->where('parentid', '=', $memberid)
            ->where('position', '=', $direction)
            ->count();      
    foreach ($results as $key => $v) {

        $next = $v->membershipid;

        $results = DB::table('member_table')
                ->where('parentid', '=', $v->membershipid)
                ->orderBy('position')
                ->get();

        $total = $total + DB::table('member_table')
                        ->where('parentid', '=', $v->membershipid)
                        ->orderBy('position')
                        ->count();

        foreach ($results as $key => $v) {

            $next = $v->membershipid;
            $results = DB::table('member_table')
                    ->where('parentid', '=', $v->membershipid)
                    ->orderBy('position')
                    ->get();

            $total = $total + DB::table('member_table')
                            ->where('parentid', '=', $v->membershipid)
                            ->orderBy('position')
                            ->count();

            foreach ($results as $key => $v) {

                $next = $v->membershipid;
                $results = DB::table('member_table')
                        ->where('parentid', '=', $v->membershipid)
                        ->orderBy('position')
                        ->get();

                $total = $total + DB::table('member_table')
                                ->where('parentid', '=', $v->membershipid)
                                ->orderBy('position')
                                ->count();

                foreach ($results as $key => $v) {

                    $next = $v->membershipid;
                    $results = DB::table('member_table')
                            ->where('parentid', '=', $v->membershipid)
                            ->orderBy('position')
                            ->get();

                    $total = $total + DB::table('member_table')
                                    ->where('parentid', '=', $v->membershipid)
                                    ->orderBy('position')
                                    ->count();

                    foreach ($results as $key => $v) {

                        $next = $v->membershipid;
                        $results = DB::table('member_table')
                                ->where('parentid', '=', $v->membershipid)
                                ->orderBy('position')
                                ->get();

                        $total = $total + DB::table('member_table')
                                        ->where('parentid', '=', $v->membershipid)
                                        ->orderBy('position')
                                        ->count();

                        foreach ($results as $key => $v) {

                            $next = $v->membershipid;

                            $results = DB::table('member_table')
                                    ->where('parentid', '=', $v->membershipid)
                                    ->orderBy('position')
                                    ->get();

                            $total = $total + DB::table('member_table')
                                            ->where('parentid', '=', $v->membershipid)
                                            ->orderBy('position')
                                            ->count();

                            foreach ($results as $key => $v) {

                                $next = $v->membershipid;
                                $results = DB::table('member_table')
                                        ->where('parentid', '=', $v->membershipid)
                                        ->orderBy('position')
                                        ->get();

                                $total = $total + DB::table('member_table')
                                                ->where('parentid', '=', $v->membershipid)
                                                ->orderBy('position')
                                                ->count();

                                foreach ($results as $key => $v) {

                                    $next = $v->membershipid;
                                     $results = DB::table('member_table')
                                        ->where('parentid', '=', $v->membershipid)
                                        ->orderBy('position')
                                        ->get();

                                $total = $total + DB::table('member_table')
                                                ->where('parentid', '=', $v->membershipid)
                                                ->orderBy('position')
                                                ->count();

                                foreach ($results as $key => $v) {

                                    $next = $v->membershipid;
                                     $results = DB::table('member_table')
                                        ->where('parentid', '=', $v->membershipid)
                                        ->orderBy('position')
                                        ->get();

                                $total = $total + DB::table('member_table')
                                                ->where('parentid', '=', $v->membershipid)
                                                ->orderBy('position')
                                                ->count();

                                foreach ($results as $key => $v) {

                                    $next = $v->membershipid;
                                     }//tenth foreach loop
                                  }//nineth foreach loop
                                }//eight foreach loop
                            }//seventh foreach loop
                        }//sixth foreach loop
                    }//fifth foreach loop
                }//fourth foreach loop
            }//third for eachloop
        }//second foreach loop
    }//first foreach loop
    return $total;
}




public function maketree2($parentid) {
    $data = "";
    
        $results = DB::table('member_table')
                ->where('parentid', '=', $parentid)
                ->orderBy('position')
                ->get();
        $data.="<ul id='ul-data'>";
        foreach ($results as $key => $v) {

            $data.="<li>" . '"name"' . ":" . $v->membershipid;
            $data.="<ul >";

            $results = DB::table('member_table')
                    ->where('parentid', '=', $v->membershipid)
                    ->orderBy('position')
                    ->get();
            foreach ($results as $key => $v) {

                $data.="<li >" . '"name"' . ":" . $v->membershipid;
                $data.="<ul >";

                $results = DB::table('member_table')
                        ->where('parentid', '=', $v->membershipid)
                        ->orderBy('position')
                        ->get();
                foreach ($results as $key => $v) {

                    $data.="<li >" . '"name"' . ":" . $v->membershipid;
                    $data.="<ul >";

                    $results = DB::table('member_table')
                            ->where('parentid', '=', $v->membershipid)
                            ->orderBy('position')
                            ->get();
                    foreach ($results as $key => $v) {

                        $data.="<li >" . '"name"' . ":" . $v->membershipid;
                        $data.="<ul >";
                        $results = DB::table('member_table')
                                ->where('parentid', '=', $v->membershipid)
                                ->orderBy('position')
                                ->get();
                        foreach ($results as $key => $v) {

                            $data.="<li >" . '"name"' . ":" . $v->membershipid;
                            $data.="<ul >";
                            $results = DB::table('member_table')
                                    ->where('parentid', '=', $v->membershipid)
                                    ->orderBy('position')
                                    ->get();
                            foreach ($results as $key => $v) {

                                $data.="<li >" . '"name"' . ":" . $v->membershipid;
                                $data.="<ul >";
                                $results = DB::table('member_table')
                                        ->where('parentid', '=', $v->membershipid)
                                        ->orderBy('position')
                                        ->get();
                                foreach ($results as $key => $v) {

                                    $data.="<li >" . '"name"' . ":" . $v->membershipid;
                                    $data.="<ul >";
                                    $results = DB::table('member_table')
                                            ->where('parentid', '=', $v->membershipid)
                                            ->orderBy('position')
                                            ->get();
                                    foreach ($results as $key => $v) {

                                        $data.="<li >" . '"name"' . ":" . $v->membershipid;
                                        $data.="<ul >";
                                        $results = DB::table('member_table')
                                                ->where('parentid', '=', $v->membershipid)
                                                ->orderBy('position')
                                                ->get();
                                        foreach ($results as $key => $v) {

                                            $data.="<li >" . '"name"' . ":" . $v->membershipid;
                                            $data.="<ul >";
                                            $results = DB::table('member_table')
                                                    ->where('parentid', '=', $v->membershipid)
                                                    ->orderBy('position')
                                                    ->get();
                                            foreach ($results as $key => $v) {

                                                $data.="<li >" . '"name"' . ":" . $v->membershipid;
                                                $data.="<ul >";
                                                //next for eachloop can come in here
                                                $data.="</ul>";
                                            } //10th for each loop       
                                            $data.="</ul>";
                                        } //nineth for each loop       
                                        $data.="</ul>";
                                    } //eight for each loop       
                                    $data.="</ul>";
                                } //seventh for each loop       
                                $data.="</ul>";
                            } //sixthfor each loop       
                            $data.="</ul>";
                        } //fifth for each loop       
                        $data.="</ul>";
                    } //fourth for each loop       
                    $data.="</ul>";
                 } //third for each loop       
                $data.="</ul>";
            } //second for each loop       
            $data.="</ul>";
        }
    
        
    return $data;   
}


/*------Tree Algorithms-----------------*/
/*
public function showdownlines() {
    $_data="";
    $data = $this->maketree3(0,$_data);

    return view('chart.downlines')->with('data', $data);
    //return view('master');
}*/
public function getfreenode(){

}





/*--------charts json-----------------------*/
    public function chartcomplete(Request $request) {
    
   $start='2016-06-13';
   $end='2016-06-14';
       // 2016-06-13
        //2016-06-14
       // $start=$request->start;
        //$end=$request->end;
    

 $results=DB::table('totalregperday')
                ->whereBetween('date', [$start,$end])
                ->orderBy('date','desc')
                ->get();       

    $data = array();
    // Build a new array with the data
    foreach ($results as $key => $v) {
        $data[]=['label'=>$v->date,'value'=>$v->totalreg];
       

}

      return response()->json($data);
    }


     public function MakeMatrix($userid,$typeid){
       
       
     } 

 public function maketree3($parentid,$_data) {
       
         $results = DB::table('member_table')
                ->where('parentid', '=', $parentid)
                ->orderBy('position')
                ->get();
        //$data.='"children"'.":"."[";  
        $_data.="<ul id='ul-data'>";
        foreach ($results as $key => $v) {

            // $data.='{';
            // $data.='"name"' .":".$v->membershipid;
            //$data.=",".'"title"' .":". $v->position;
            // $data.=",";

            $_data.="<li >" . '"name"' . ":" . $v->membershipid."</li>";
            //next for eachloop can come in here
            $this->maketree3($v->membershipid,$_data);
            $_data.="</ul>";
            
        }

       return $_data;
  }


public function showdownlines(){

$customerusername=Auth::user()->username;
$queryleft=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.membershipid = t.descendant
WHERE m.stage >='.$stage.'
AND t.ancestor ='."'".$firstleftchildmembershipid."'".'
AND NOT EXISTS (
select user_id from matrix_users_left AS mr WHERE mr.user_id=m.membershipid AND matrix_id=1
) LIMIT 32'
);

$data=DB::select('SELECT m.*
FROM member_table AS m
WHERE m.membershipid ='. $userid.'
AND EXISTS (
select user_id from matrix_users_left AS mr WHERE mr.user_id=m.membershipid
)OR EXISTS (
select user_id from matrix_users_Right AS mr WHERE mr.user_id=m.membershipid
)'
); 

return view('chart.downlines')->with('data', $data);                    
}


        

}
