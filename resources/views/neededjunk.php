<?php



public function create(){
    //$name="joe";
   //$names=$this->getusernames($name,7);

   //$arrlength = count($names);
 //$this->showdata(1,"108BP2016BP11");  
// $this->fillmatrix("108BP2016BP11");
        //var_dump($this->drawtree("108BP2016BP11")); 
      // Node::createbinarytree();
      // Node::BFT();

   // return $this->displayusertree("108BP2016BP11");
       // var_dump($this->lefttree("108FK2016FK17",1));
      //echo   $this->getlefttree("108FK2016FK17",1);  
 //$results = DB::table('matrix_users_left')
           // ->where('matrix_id', '=',1)
           // ->get(); 
  //foreach ($results[0] as $key => $value) {
              # code...
            // echo  $results[0]->user_id;
             // echo  $results[0]->matrix_users_id+" ";
            //} 
    //$getusermatrix=$this->getusermatrix("108BP2016BP11");   
   // print_r($getusermatrix);              
  // print_r ($results[0]);        
         //foreach ($results as $key => $v) {   
 //$freeposition=$this->getfreeposition("108BP2016BP11");
// var_dump($freeposition);
//for($x = 0; $x < $arrlength; $x++) {
    //echo $names[$x];
  //  echo "<br>";
//}

}


public function showdata($stage,$userid){
    /* $queryleft=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.membershipid = t.descendant
WHERE m.stage >=?
AND t.ancestor =? AND NOT EXISTS (
select user_id from matrix_users_left AS mr where mr.user_id=m.membershipid
) ',[$stage],["'".$userid."'"]);*/

//getfirstleft child id
$firstleftchild=$this->getfirstchild($userid,"L");
$firstleftchildmembershipid=$firstleftchild['membershipid'];
$queryleft=DB::select('SELECT m.*
	FROM member_table AS m
	JOIN treepaths AS t ON m.membershipid = t.descendant
	WHERE m.stage >='.$stage.'
	AND t.ancestor ='."'".$firstleftchildmembershipid."'".'
	AND NOT EXISTS (
	select user_id from matrix_users_left AS mr WHERE mr.user_id=m.membershipid AND matrix_id=1
	) LIMIT 32'
	);

foreach ($queryleft as $key => $v) {
	echo $v->membershipid." ";

	DB::table('matrix_users_left')->insert(
		['matrix_id' =>1, 'user_id' =>$v->membershipid, 'stage' =>$stage,'matrix_number' => 0, 'parent_id' => 0]
		);

}



//getfirstright child id
$firstrightchild=$this->getfirstchild($userid,"R");
$firstrightchildmembershipid=$firstrightchild['membershipid'];
$queryright=DB::select('SELECT m.*
	FROM member_table AS m
	JOIN treepaths AS t ON m.membershipid = t.descendant
	WHERE m.stage >='.$stage.'
	AND t.ancestor ='."'".$firstrightchildmembershipid."'".'
	AND NOT EXISTS (
	select user_id from matrix_users_right AS mr WHERE mr.user_id=m.membershipid AND matrix_id=1
	) LIMIT 32'
	);

foreach ($queryright as $key => $v) {
	echo $v->membershipid." ";

	DB::table('matrix_users_right')->insert(
		['matrix_id' =>1, 'user_id' =>$v->membershipid, 'stage' =>$stage,'matrix_number' => 0, 'parent_id' => 0]
		);

}

}





public function fillmatrix2($userid){


}
public function getmatrixusersfreeposition($matrix_id,$id){

}
public function getleftchild($matrix_id,$place){
  //$user = DB::table('matrix_users')->where('name', 'John')->first();
  //$leftchild=$user->name;
	$query=DB::select('SELECT m.*
		FROM matrix_users AS m
		WHERE m.matrix_id =? AND m.place=?',[$matrix_id],[$place]);
	if ($query==null) {
    # code...
		return ["parent" =>0,"position" =>0];
	} else {
    # code...

		foreach ($query as $key => $v) {

			if($v->children==0){
				return ["parent" => "$v->user_id","position" =>"L"];
				break;
			}
			elseif($v->children==1){

				return ["parent" =>"$v->user_id","position" =>"R"];

				break;
			}
			else{
				continue;
			}
		}

	}


}
//get free position to fill the left  matrix
public function getmatrixleftfreeposition($matrix_id){

	$query=DB::select('SELECT m.*
		FROM matrix_users_left AS m
		WHERE m.matrix_id =?',[$matrix_id]);
	if ($query==null) {
           # code...
		return ["parent" =>0,"position" =>0];
	} else {
           # code...
		foreach ($query as $key => $v) {

			if($v->children==0){
				return ["parent" => "$v->user_id","position" =>"L"];
				break;
			}
			elseif($v->children==1){

				return ["parent" =>"$v->user_id","position" =>"R"];

				break;
			}
			else{
				continue;
			}
		}
	}




}


//get free position to fill the right matrix 
public function getmatrixrightfreeposition($matrix_id){

	$query=DB::select('SELECT m.*
		FROM matrix_users_right AS m
		WHERE m.matrix_id =?',[$matrix_id]);

	if ($query==null) {
  # code...
		return ["parent" =>0,"position" =>0];
	} else {
  # code...
		foreach ($query as $key => $v) {

			if($v->children==0){
				return ["parent" => "$v->user_id","position" =>"L"];
				break;
			}
			elseif($v->children==1){

				return ["parent" =>"$v->user_id","position" =>"R"];

				break;
			}
			else{
				continue;
			}
		}

	}


//set parent left matrix
	public function setparentleftmatrixchildren($parent,$matrix_id){

		$results = DB::table('matrix_users_left')
		->where('user_id', '=',$parent)
		->where('matrix_id', '=',$matrix_id)
		->get();
		$child=3;    
		foreach ($results as $key => $v) {
			$child=$v->children; 
		}  
		if ( $child==0) {
    # code...
			DB::table('matrix_users_left')
			->where('user_id', '=',$parent)
			->where('matrix_id', '=',$matrix_id)
			->update(['children' => 1]);
		} elseif ($child==1) {
    # code...
			DB::table('matrix_users_left')
			->where('user_id', '=',$parent)
			->where('matrix_id', '=',$matrix_id)
			->update(['children' =>2]);
		}

	}

 //set parent right matrix
	public function setparentrightmatrixchildren($parent,$matrix_id){

		$results = DB::table('matrix_users_right')
		->where('user_id', '=',$parent)
		->where('matrix_id', '=',$matrix_id)
		->get();
		$child=3;    
		foreach ($results as $key => $v) {
			$child=$v->children; 
		}  
		if ( $child==0) {
    # code...
			DB::table('matrix_users_right')
			->where('user_id', '=',$parent)
			->where('matrix_id', '=',$matrix_id)
			->update(['children' => 1]);
		} elseif ($child==1) {
    # code...
			DB::table('matrix_users_right')
			->where('user_id', '=',$parent)
			->where('matrix_id', '=',$matrix_id)
			->update(['children' =>2]);
		}

	}  

	public function returndownlines($id) {


  $results = DB::table('member_table')
  ->where('uniqueid', '=', $id)
  ->get();
  $data.='{';
  $data.='"name"' . ":" . $v->firstname;
  $data.="," . '"title"' . ":" . $v->lastname;
  $data.=",";


  $results = DB::table('member_table')
  ->where('reffererid', '=', $id)
  ->get();
  $nums = count($results);
  while ($nums > 0) {
            //level2
    $data.='"children"' . ":" . "[";
    foreach ($results as $key => $v) {
      $data.='"name"' . ":" . $v->firstname;
      $nums--;
    }
    $data.="]";
    $results = DB::table('member_table')
    ->where('reffererid', '=', $v->reffererid)
    ->get();
    $nums = count($results);
    while ($nums > 0) {
                //level3
      $data.='"children"' . ":" . "[";
      foreach ($results as $key => $v) {
        $data.='"name"' . ":" . $v->firstname;
        $nums--;
      }
      $data.="]";
      $results = DB::table('member_table')
      ->where('reffererid', '=', $v->reffererid)
      ->get();
      $nums = count($results);
      while ($nums > 0) {
                    //level3
        $data.='"children"' . ":" . "[";
        foreach ($results as $key => $v) {
          $data.='"name"' . ":" . $v->firstname;
          $nums--;
        }
        $data.="]";
        $results = DB::table('member_table')
        ->where('reffererid', '=', $v->reffererid)
        ->get();
        $nums = count($results);
        while ($nums > 0) {
                        //level4
          $data.='"children"' . ":" . "[";
          foreach ($results as $key => $v) {
            $data.='"name"' . ":" . $v->firstname;
            $nums--;
          }
          $data.="]";
        }
      }
    }
  }
}


public function showchildren() {
  $total = $this->gettotalchildrentree(1, "R");
  return $total;
}

public function getalllevelchildren($memberid, $total) {

}


public function parent(){
  $results = DB::table('member')
  ->where('memid', '=', $memberid)
  ->get();
  foreach ($results as $key => $v) {

    $data.='{';
    $data.='"name"' . ":" . $v->memid;
    $data.="," . '"title"' . ":" . $v->position;
    $data.=",";
  }
}

public function getuniqueid() {
  $todaysdate = new \DateTime();
  $result = $todaysdate->format('Y-m-d');
  $date = $this->returntodaysdate();
  $uniqueid = "";
  $data = $this->filltotalregtable();
  $val = Totalreg::select('totalreg')->where('date', $result)->first();

  $total = $val->totalreg;

  $total = $total + 1;
  $uid = explode("-", $date);
  $uniqueid = implode($this->generaterandomalphbet(2), $uid);
    //$max_id=User::all()->max('id'); //to get max id so far in a table
  return $total . $uniqueid;
}



//the closed matrix 
public function closematrix($userid,$matrixid){

  $leftmatrixnumber=$this->countusercurrentleftmatrix($userid);
  $rightmatrixnumber=$this->countusercurrentrightmatrix($userid);
  $expectednumberformatrix=$this->getmatrixusersexpectedcount($userid);
  if ($leftmatrixnumber==$expectednumberformatrix && $rightmatrixnumber==$expectednumberformatrix){
   $this->createnewmatrix($userid,$matrixid);
   $nextid=$this->getnextmatrix($matrixid);
   DB::table('member_table')
   ->where('membershipid',$userid)
   ->update(['stage' =>$nextid]);
 }
 else{

 }
}

//create the matrix of a user based on user id
public function creatematrix($userid,$type_id){
 $matrix=new matrix;
 $todaysdate = new \DateTime();
 $result = $todaysdate->format('Y-m-d');
 $matrix->type_id=$type_id;
 $matrix->count_users=1;
 $matrix->ownerid=$userid;
 $matrix->filled=0;
 $matrix->created_at=$result;
 $matrix->save();  
}

//create new matrix if the old matrix is filled   
public function createnewmatrix($userid,$formermatrixid){
 $nextid=$this->getnextmatrix($formermatrixid);
 $this->creatematrix($userid,$nextid);

}
//get next matrix after the matrix
public function getnextmatrix($formermatrixid){
  $results = DB::table('matrix_type')
  ->where('stage', '=',$formermatrixid)
  ->get();
  foreach ($results as $key => $v) {
    $matrixid=$v->stage; 
  }  

  return $matrixid+1;         
}

//
public function getmatrixusersexpectedcount($userid){
//INSERT INTO `matrix_type`(`type_id`, `name`, `completion_bonus`, `price_to_enter`, `levels`, `views`, `expected_downlines`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6]ss,[value-7],[value-8],[value-9])
//get user stage
 $stage=$this->getuserstage($userid);
 $results = DB::table('matrix_type')
 ->where('stage', '=',$stage)
 ->get();
 foreach ($results as $key => $v) {

   $stage_numbercount=$v->expected_downlines; 
 }            
 $stage_numbercount1=$stage_numbercount/2;


 return $stage_numbercount1;
}





public function getusercurrentrightmatrix($userid){
    //get user stage
  $stage=$this->getuserstage($userid);
    //get matrixid of user  
  $matrixid=$this->getmatrixidofuser($userid,$stage); 

  $results = DB::table('matrix_users_right')
  ->where('matrix_id', '=', $matrixid)
  ->get();
  $data= array();
  $i=0;
  foreach ($results as $key => $v) {

   $data[$i]= $v->user_id;
   $i++;
 }           

 return $data;         
}

//count users in current left matrix
public function countusercurrentleftmatrix($userid){
    //get user stage
  $stage=$this->getuserstage($userid);
    //get matrixid of user  
  $matrixid=$this->getmatrixidofuser($userid,$stage); 

  
  $leftcount = DB::table('matrix_users_left')
  ->where('matrix_id', '=', $matrixid)
  ->count();

  return $leftcount;
}

//count users in current left matrix
public function countusercurrentrightmatrix($userid){
    //get user stage
  $stage=$this->getuserstage($userid);
    //get matrixid of user  
  $matrixid=$this->getmatrixidofuser($userid,$stage); 

  $rightcount = DB::table('matrix_users_right')
  ->where('matrix_id', '=', $matrixid)
  ->count();

  return $rightcount;
} 





public function showdownlines(){
  $customerusername=Auth::user()->username;
  $results = DB::table('member_table')
  ->where('username', '=', $customerusername)
  ->get();  
  foreach ($results as $key => $v) {
   # code...
    $membershipid=$v->membershipid;
    $stage=$v->stage;
  }
//$usercurrentmatrix=$this->getusermatrix("'".$membershipid."'");
 /* $members=DB::select('SELECT m.*
    FROM member_table AS m
    JOIN treepaths AS t ON m.membershipid = t.descendant
    WHERE m.stage >='.$stage.' 
    AND t.ancestor ='."'".$membershipid."'"
    );*/

    $members = DB::table('member_table as m')
    ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
    ->where('t.ancestor', '=', $membershipid)
    ->where('m.stage', '=',$stage)
    ->get();

/* .'
AND  EXISTS (
select user_id from matrix_users_left AS mr WHERE mr.user_id=m.membershipid AND matrix_id=1
)AND  EXISTS (
select user_id from matrix_users_right AS mr WHERE mr.user_id=m.membershipid AND matrix_id=1
) '*/
 //Node::createbinarytree();
 //Node::BFT();

//var_dump($this->drawusertree($membershipid));
//print_r($this->drawusertree($membershipid));
$data="";
$data.=$this->drawtree2($membershipid);


//print_r($data);
//var_dump($data);
return view('chart.downlines')->with('members', $members)->with('data',$data);                    
}



public function drawusertree1(){
  
  $data=$this->drawtree2('HW00016002');

  $query = DB::table('matrix_users')
  ->where('matrix_id', '=',2)
  ->where('tparent', '=',1)
  ->get();
  
  var_dump($query);
  var_dump($data);
}



public function unsubscribe(){
 $customerusername=Auth::user()->username;

 DB::table('users')->where('username','=',$customerusername)->delete();
 return view('website.unsubscribe');
}
public function showunsubscribe(){
 $customerusername=Auth::user()->username;
   //$customerusername=Auth::user()->username;
 $results = DB::table('member_table')
 ->where('username', '=', $customerusername)
 ->get();  
 foreach ($results as $key => $v) {
   # code...
  $membershipid=$v->membershipid;
  $stage=$v->stage;
}
//$usercurrentmatrix=$this->getusermatrix("'".$membershipid."'");
$members=DB::select('SELECT m.*
  FROM member_table AS m
  WHERE m.membershipid ='."'".$membershipid."'".''
  );

return view('chart.subscribe')->with('members', $members);
}

 <link rel="stylesheet" href="{{asset('chart_dist/css/jquery.orgchart.css')}}">
    <link rel="stylesheet" href="{{asset('chart_dist/css/style.css')}}">

     <!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>


    @section('scripts')

<script type="text/javascript" src="{{ asset('chart_dist/js/html2canvas.min.js') }}"></script> 
<script type="text/javascript">
 $.noConflict(); 
</script>  


<script type="text/javascript" src="{{ asset('assets/js/jquery.orgchart.js') }}"></script>   



@endsection





@section('stylesheet')
<!-- DataTables CSS -->
<link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/jquery.orgchart.css') }}" rel="stylesheet">
<style type="text/css">
  .chart-container {
    float: left;
    position: relative;
    display: inline-block;
    top: 10px;
    left: 0px;
    height: 1100px;
    width: 50%;
    overflow: hidden;
    text-align: center;
  }

  .orgchart {
    background: #fff;
    border: 0;
    padding: 0;
  }

  .orgchart>.spinner {
    color: rgba(255, 255, 0, 0.75);
  }

  .orgchart .node .title {
    background-color: #fff;
    color: #000;
    height: 20px;
    border-radius: 0;
  }

  .orgchart.r2l .node .title {
    transform: rotate(-90deg) translate(60px, 60px);
    -ms-transform: rotate(-90deg) translate(60px, 60px);
    -moz-transform: rotate(-90deg) translate(60px, 60px);
    -webkit-transform: rotate(-90deg) translate(60px, 60px);
  }

  .orgchart.l2r .node .title {
    transform: rotate(-90deg) translate(60px, 60px) rotateY(180deg);
    -ms-transform: rotate(-90deg) translate(60px, 60px) rotateY(180deg);
    -moz-transform: rotate(-90deg) translate(60px, 60px) rotateY(180deg);
    -webkit-transform: rotate(-90deg) translate(60px, 60px) rotateY(180deg);
  }

  .orgchart .node .content {
    border: 0;
    background-color: #b80036;
    color: #fff;
    font-weight: bold;
    font-size: 1.2em;
  }

  .orgchart.r2l .node .content,
  .orgchart.l2r .node .content {
    position: absolute;
    bottom: 138px;
    right: 78px;
    width: 20px;
    border-radius: 0px;
  }

  .orgchart .node>.spinner {
    color: rgba(184, 0, 54, 0.75);
  }

  .orgchart.r2l .node,
  .orgchart.l2r .node {
    width: 130px;
  }

  .orgchart .node:hover {
    background-color: rgba(255, 255, 0, 0.6);
  }

  .orgchart .node.focused {
    background-color: rgba(255, 255, 0, 0.6);
  }

  .orgchart .node .edge {
    color: rgba(0, 0, 0, 0.6);
  }

  .orgchart .edge:hover {
    color: #000;
  }

  .orgchart td.left,
  .orgchart td.top,
  .orgchart td.right {
    border-color: #999;
  }

  .orgchart td>.down {
    background-color: #999;
  }
  .content {
    min-height:20px;
    padding: 15px;

  }
</style>
@endsection



$data=[
    'id'=>$user->membershipid,
    'name'=>$user->firstname,
    'title'=>$user->stage,
    'relationship'=>"001",
    'children'=>[
     ['id'=>$child1->membershipid,'name'=>$child1->firstname,
'title'=>$child1->stage,'relationship'=>"111"],
     ['id'=>$child2->membershipid,'name'=>$child2->firstname,
'title'=>$child2->stage,'relationship'=>"111"]
    ]
   ];


   $data=['children'=>[
     ['id'=>$child1->membershipid,'name'=>$child1->firstname,
'title'=>$child1->stage,'relationship'=>'111'],
     ['id'=>$child2->membershipid,'name'=>$child2->firstname,
'title'=>$child2->stage,'relationship'=>'111']
    ]];




    
          <!-- <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
    
     @foreach($members as $member)
         <tr>
           
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->firstname!!}</td>
           <td>{!!$member->lastname!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>

<h1>members to the right leg</h1>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
    
     @foreach($firstrightchildmembers as $member)
         <tr>
           
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->firstname!!}</td>
           <td>{!!$member->lastname!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>
                

<h1>members on the left leg</h1>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
    
     @foreach($firstleftchildmembers  as $member)
         <tr>
           
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->firstname!!}</td>
           <td>{!!$member->lastname!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>-->  