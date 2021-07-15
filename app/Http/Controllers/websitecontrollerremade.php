<?php

//namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Members;
use App\Totalreg;
use App\User;
use App\Item;
use App\Mlmlevel;
use App\Mlmrecords;
use App\matrix_users;
use App\matrix;
use App\matrix_type;
use App\matrix_users_left;
use App\matrix_users_right;
use App\node;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Validator;

class websitecontrollerremade extends Controller
{
    //


    /*public class uploadpic(){
  $ds = DIRECTORY_SEPARATOR;
  $storeFolder = "slider-images/";
  $sliderimages=new sliderimages;
  INSERT INTO `slider_images`(`id`, `file_name`, `file_size`, `file_mime`, `file_path`, `caption`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])

         $sliderimages->file_name=$request->file_name;
         $sliderimages->file_size=$request->file_size;
         $sliderimages->file_mime=$request->file_mime;
         $sliderimages->file_path=$request->file_path;
         $sliderimages->caption=$request->caption;
         $sliderimages->save();


  if (!empty($_FILES)) {
      $fileupload = basename( $_FILES['file']['name']);
      $fileType = $_FILES['file']['type'];
      $fileSize = $_FILES['file']['size'];
      $gallery_id=$_POST['gallery_id'];

      $tempFile = $_FILES['file']['tmp_name'];
      $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
      $targetFile =  $targetPath. $fileupload;
      $filepath="slider-images/".$fileupload;
      move_uploaded_file($tempFile,$targetFile);
      $uploadsql = "INSERT INTO slider_images (file_name,file_mime,file_path)
                    VALUES ('$fileupload','$fileType','$filepath')";
      mysql_query($uploadsql);
          echo"<script>

  window.open('slider_images.php','_self')
      </script>";

  }


          $results = DB::table('slider_images')
              ->where('memid', '=', $memberid)
              ->get();
      foreach ($results as $key => $v) {

          $data.='{';
          $data.='"name"' . ":" . $v->memid;
          $data.="," . '"title"' . ":" . $v->position;
          $data.=",";
      }
    }*/


    public function returnavailableusername(Request $request)
    {
      $username = $request->username;

      $total = DB::table('member_table')
      ->where('username', '=', $username)
      ->count();
      $data = "";
      if ($total > 0) {
            // $data.="<img src='{{asset('images/availableimg/not-available.png') }}'/>";
        return response()->json(["availability" => "not-available"]);

      } else {
            // $data.="<img src='{{asset('images/availableimg/available.png') }}'/>";
        return response()->json(["availability" => "available"]);
      }
        //return $data;
        //return response()->$data;

    }

    public function returnmembershipid(Request $request)
    {
      $username = $request->username;

      $total = DB::table('member_table')
      ->where('membershipid', '=', $username)
      ->count();
      $results = DB::table('member_table')
      ->where('membershipid', '=', $username)
      ->get();
      $data = "";
      if ($total > 0) {
            // $data.="<img src='{{asset('images/availableimg/not-available.png') }}'/>";
        foreach ($results as $key => $value) {
          $memberid = $value->membershipid;
          $firstname = $value->firstname;
          $lastname = $value->lastname;
        }

        return response()->json(["availability" => "available", "firstname" => $firstname, "lastname" => $lastname]);

      } else {
            // $data.="<img src='{{asset('images/availableimg/available.png') }}'/>";
        return response()->json(["availability" => "not-available"]);
      }
        //return $data;
        //return response()->$data;

    }

    public function getStatus(Request $request, $mertid, $order_id)
    {
        // $request = 'mertid='.$mertid.'&transref='.$transref.'&respformat='.$type.'&signature='.$sign; //initialize the request variables
        //$request='transaction_ref&order_ID&amount &payment_gate&response_code&currency_code& merchant_ID &date_time';
      $request = "";
      $curl = curl_init("https://fidelitypaygate.fidelitybankplc.com/cipg/MerchantServices/UpayTransactionStatus.ashx?MERCHANT_ID=05062&ORDER_ID=$order_id");

      curl_setopt($curl, CURLOPT_VERBOSE, FALSE);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($curl, CURLOPT_POST, TRUE);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_HEADER, FALSE);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
      curl_setopt($curl, CURLOPT_TIMEOUT, 0);
      $response = curl_exec($curl);
//echo htmlspecialchars($response);
//echo "<pre>"; print_r($response); echo "</pre>";
      curl_close($curl);

      $result = simplexml_load_string($response);

//echo $arr_result->StatusCode;


      return $result;

//$xml = simplexml_load_string($data);
//print_r($xml);
//$arr_result = (array)simplexml_load_string($data);
//return json_decode(json_encode($arr_result));

    }

    public function callback($merchantid, $sale_id)
    {
      $response = getStatus($merchantid, $sale_id);
      $status_code = $response->StatusCode;
      $status_message = $response->Status;
      $transref = $response->TransactionRef;

    }


//function that checks the availability of usernames
    public function checkusernameavailability($username)
    {
      $availability = "";

      $total = DB::table('member_table')
      ->where('username', '=', $username)
      ->count();
      if ($total > 0) {
            # code...
        $availability = "available";
        return $availability;
      } else {
            # code...
        $availability = "notavailable";
        return $availability;
      }

    }

    public function checkparentidavailability($parentid)
    {
      $availability = "";

      $total = DB::table('member_table')
      ->where('membershipid', '=', $parentid)
      ->count();
      if ($total > 0) {
            # code...
        $availability = "available";
        return $availability;
      } else {
            # code...
        $availability = "notavailable";
        return $availability;
      }

    }

    public function checkreferreridavailability($refferid)
    {
      $availability = "";

      $total = DB::table('member_table')
      ->where('membershipid', '=', $refferid)
      ->count();
      if ($total > 0) {
            # code...
        $availability = "available";
        return $availability;
      } else {
            # code...
        $availability = "notavailable";
        return $availability;
      }

    }

//function to set the parent of children
    public function setparentchildren($parentid)
    {
      $results = DB::table('member_table')
      ->where('membershipid', '=', $parentid)
      ->get();
      $child = 3;
      foreach ($results as $key => $v) {
        $child = $v->children;
      }
      if ($child == 0) {
            # code...
        DB::table('member_table')
        ->where('membershipid', '=', $parentid)
        ->update(['children' => 1]);
      } elseif ($child == 1) {
            # code...
        DB::table('member_table')
        ->where('membershipid', '=', $parentid)
        ->update(['children' => 2]);
      }


    }

//get id of a user based on his username
    public function getid($username)
    {
      $results = DB::table('member_table')
      ->where('username', '=', $username)
      ->get();
      foreach ($results as $key => $v) {
        $id = $v->membershipid;
      }
      if ($results == null) {
            # code...
        return "not-available";
      } else {
            # code...
        return $id;
      }


    }

//create the matrix of a user based on user id and fill the matrix with data
    public function creatematrix($userid, $type_id)
    {
      ini_set('max_execution_time',3000);
      $matrix = new matrix;
      $todaysdate = new \DateTime();
      $result = $todaysdate->format('Y-m-d');
      $matrix->type_id = $type_id;
      $matrix->count_users = 1;
      $matrix->ownerid = $userid;
      $matrix->filled = 0;
      $matrix->created_at = $result;
      $matrix->save();
        //INSERT INTO `mlm_stagebonus`(`id`, `bonus`, `stage_number`, `name`, `noofdownlines`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])
        //fill the matrix_users table with data to be updated when filling the matrix
        /* $results = DB::table('mlm_stagebonus')
                ->where('stage_number', '=',$type_id)
                ->get();
          foreach ($results as $key => $v) {
           $numberofdownlines=$v->noofdownlines;
         }*/

         $results = DB::table('matrix_type')
         ->where('stage', '=', $type_id)
         ->get();
         foreach ($results as $key => $v) {

          $numberofdownlines = $v->expected_downlines;
        }


        $numberofdownlines2 = $numberofdownlines + 1;
        $leftplace = $numberofdownlines / 2;
        $rightplace = $numberofdownlines / 2;

        $getusermatrix = $this->getusermatrix($userid);
        //INSERT INTO `matrix_users`(`matrix_users_id`, `matrix_id`, `user_id`, `parentid`, `position`, `place`, `trpos`, `trchildrenp`, `tparent`, `children`, `stage`, `level`, `matrix_number`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
        //parent
        DB::table('matrix_users')->insert(
          ['matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0, 'place' => 0, 'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,]);

        //first left child
        DB::table('matrix_users')->insert(
          ['matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,]);

        //second left child
        DB::table('matrix_users')->insert(
          ['matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,]);

        $leftplace2 = $leftplace - 1;
        $rightplace2 = $rightplace - 1;
        while ($leftplace2 > 0) {
            # code...

          $parenttrpos1 = $this->getparenttrpos($getusermatrix, "L");

          $parenttrpos = $parenttrpos1["parent"];
          $realposition = $parenttrpos1["position"];
          $parentid = $parenttrpos1["parentid"];
          $trpos1 = $this->getlastnum($getusermatrix);
          $trpos = $trpos1 + 1;
          DB::table('matrix_users')->insert(
            ['matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => $trpos, 'trchildrenp' => $realposition, 'tparent' => $parenttrpos, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,]);
          $this->setmatrixuserschildren($getusermatrix, $parenttrpos);
          $leftplace2--;
        }
        while ($rightplace2 > 0) {
            # code...
          $parenttrpos1 = $this->getparenttrpos($getusermatrix, "R");

          $parenttrpos = $parenttrpos1["parent"];
          $realposition = $parenttrpos1["position"];
          $parentid = $parenttrpos1["parentid"];
          $trpos1 = $this->getlastnum($getusermatrix);
          $trpos = $trpos1 + 1;
          DB::table('matrix_users')->insert(
            ['matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => $trpos, 'trchildrenp' => $realposition, 'tparent' => $parenttrpos, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,]);
          $this->setmatrixuserschildren($getusermatrix, $parenttrpos);
          $rightplace2--;
        }

      }

      public function matrixfiller()
      {
        $loop = 62;
        /*while ($loop>0) {
         DB::table('matrix_users')->insert(['matrix_id' =>1,'user_id'=>0,'parentid'=>0,'position'=>'R','place'=>0,'trpos'=>9,'trchildrenp'=>9,'tparent'=>9,'children'=>0,'stage'=>1,'level'=>1,'matrix_number' => 0,]);

        $loop--;
      }*/
        //$key=$this->generatepins();
        //echo $key;

        /*$results = DB::table('member_table')
                 ->where('membershipid','109TT2016TT12')
                 ->get();
         var_dump($results);
          */
         //$query=$this->getadjacencylist('201609281710ZS53');
        // var_dump($query
         //$this->fillmatrix2("HW00016002");
         $UserController=new UserController();
         $hisstage=$UserController->getuserstage("HW00016025");
         echo $hisstage;
       }

       
       public function fillmatrix2($userid)
       {

        ini_set('max_execution_time',3000);
        $UserController=new UserController();
        $accountcontroller=new accountcontroller();
        $results = DB::table('member_table')
        ->where('membershipid', $userid)
        ->get();
        // var_dump($results);
        foreach ($results as $key => $v) {
          $usermatrixtype = $v->stage;
        }
        
        $results = DB::table('matrix_type')
        ->where('stage', '=', $usermatrixtype)
        ->get();
        foreach ($results as $key => $v) {

          $numberofdownlines = $v->expected_downlines;
        }


        /*$results = DB::table('mlm_stagebonus')
               ->where('stage_number', '=',$usermatrixtype)
               ->get();
         foreach ($results as $key => $v) {
          $numberofdownlines=$v->noofdownlines;
        } */
        $numberofdownlines2 = $numberofdownlines + 1;
        $leftplace = $numberofdownlines / 2;
        $rightplace = $numberofdownlines / 2;
        $getusermatrix = $this->getusermatrix($userid);
        $hisstage=$UserController->getuserstage($userid);
        if ($hisstage==0) {
           # code...
          $this->fillstagezeromatrix($userid);
        } else {
           # code...
          $firstleftchild = (new UserController)->getfirstchild($userid, "L");
          $firstleftchildmembershipid = $firstleftchild['membershipid'];
////THE LEFT LEG        

//count spaces not set in db for matrix users
          $results = DB::table('matrix_users')
          ->where('matrix_id', '=', $getusermatrix)
          ->where('user_id', '=', "0")
          ->where('position', '=', "L")
          ->count();
//extra that space(s) from db
/*$query = DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            WHERE m.stage >=' . $usermatrixtype . '
            AND t.ancestor =' . "'" . $firstleftchildmembershipid . "'" . '
            AND NOT EXISTS (
            select user_id from matrix_users AS mr WHERE mr.user_id=m.membershipid AND matrix_id=' . $getusermatrix . '
            ) LIMIT ' . $results
            );
        $query = DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            AND m.stage >='.$usermatrixtype.'
            AND t.ancestor ='."'".$firstleftchildmembershipid."'".'
            LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id='.$getusermatrix. ' AND mr.user_id IS NULL '.'LIMIT    '.$results );*/
           // DB::select('SELECT m.* FROM member_table AS m
           // LEFT JOIN matrix AS mr ON mr.ownerid=m.membershipid AND mr.type_id=3 AND m.stage=3 AND mr.ownerid IS NULL
           // SELECT m.* FROM member_table AS m WHERE m.stage=1 AND NOT EXISTS ( select * from matrix AS mr WHERE mr.ownerid=m.membershipid AND type_id=1)');
      $depth=0;
      if ($usermatrixtype==1) {
        # code...
        $depth=8;
      }elseif ($usermatrixtype==2) {
        # code...
        $depth=7;
      }elseif ($usermatrixtype==3) {
        # code...
        $depth=6;
      }elseif ($usermatrixtype==4) {
        # code...
        $depth=6;

      }elseif ($usermatrixtype==5) {
        # code...
        $depth=6;

      }
   
     $query = DB::select('SELECT m.* FROM member_table AS m JOIN treepaths AS t ON m.membershipid = t.descendant WHERE m.stage >='.$usermatrixtype.' AND t.ancestor ="'.$firstleftchildmembershipid.'"AND t.depth < '.$depth.' LIMIT  7');

    /* $query = DB::select('SELECT m.membershipid FROM member_table AS m LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id=' . $getusermatrix . ' WHERE m.sponsorid=' . "'" . $userid . "'" . ' AND mr.user_id IS NULL LIMIT '.$results);*/

              /* $query = DB::select('SELECT m.membershipid
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            WHERE m.stage >=' . $usermatrixtype . '
            AND t.ancestor =' . "'" . $firstleftchildmembershipid . "'" .'
            LEFT OUTER JOIN matrix_users AS mu ON mu.user_id =m.membershipid AND
           matrix_id=' . $getusermatrix . ' AND
           WHERE mu.userid IS NULL
             LIMIT ' . $results);*/


//fill the spaces
//set matrix with values from member_table  if the value is not set
//set matrix with values from member_table  if the value is not set

          foreach ($query as $key => $v) {

  $place = $this->getupdateposition($getusermatrix, "L");
           
            $usercount=DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('user_id',$v->membershipid)
            ->count();
            $filledup=DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('user_id',"<>","0")
            ->where('position',"=","L")
            ->count();
            if ($filledup==7) {
              # code...
              break;
            }
            if ($usercount==null||$usercount<1 && $filledup!=7) {
              # code...
            $inserted=DB::update('UPDATE matrix_users SET user_id ="'.
              $v->membershipid.'" where matrix_id = ? AND trpos=?',[$getusermatrix,$place]);

            /*DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('trpos', $place)
            ->update(['user_id' => $v->membershipid]);*/
           if($inserted!=0 || $inserted!=null){
            $accountcontroller->singledropbonus($userid);
            DB::table('matrix')
            ->where('matrix_id','=',$getusermatrix)
            ->increment('count_users',1);
           }
            
             }else{
  
             }
          }


////THE RIGHT LEG
          $firstrightchild = (new UserController)->getfirstchild($userid, "R");
          $firstrightchildmembershipid = $firstrightchild['membershipid'];
//count spaces not set in db for matrix users
          $results = DB::table('matrix_users')
          ->where('matrix_id', '=', $getusermatrix)
          ->where('user_id', '=', "0")
          ->where('position', '=', "R")
          ->count();
//extra that space(s) from db
      //SELECT mu.matrix_id ,COUNT(matrix_id) c,ma.ownerid FROM matrix_users AS mu join matrix as ma on ma.matrix_id=mu.matrix_id where ma.type_id=1 GROUP BY `matrix_id` HAVING c<7

      //SELECT m.*
          //  FROM member_table AS m
           // JOIN treepaths AS t ON m.membershipid = t.descendant  
         /*$query = DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            WHERE m.stage >=' . $usermatrixtype . '
            AND t.ancestor =' . "'" . $firstrightchildmembershipid . "'" . '
            AND NOT EXISTS (
            select user_id from matrix_users AS mr WHERE mr.user_id=m.membershipid AND matrix_id=' . $getusermatrix . '
            ) LIMIT ' . $results
            );*/
          /*$query = DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            WHERE m.stage >=' . $usermatrixtype . '
            AND t.ancestor =' . "'" . $firstrightchildmembershipid . "'" . '
            AND m.membershipid NOT IN (
            select user_id from matrix_users AS mr WHERE mr.user_id=m.membershipid AND matrix_id=' . $getusermatrix . '
            ) LIMIT ' . $results
            );*/
    /*$query =DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            AND m.stage >='.$usermatrixtype.'
            AND t.ancestor ='."'".$firstrightchildmembershipid."'".'
            LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id='.$getusermatrix.' AND mr.user_id IS NULL '.' LIMIT    '.$results);*/

    /*$query =DB::select('SELECT m.* FROM member_table AS m JOIN treepaths AS t ON m.membershipid = t.descendant AND m.stage >='.$usermatrixtype.' AND t.ancestor ='."'".$firstrightchildmembershipid."'".'LIMIT  7');*/

      $depth=0;
      if ($usermatrixtype==1) {
        # code...
        $depth=8;
      }elseif ($usermatrixtype==2) {
        # code...
        $depth=7;
      }elseif ($usermatrixtype==3) {
        # code...
        $depth=6;
      }elseif ($usermatrixtype==4) {
        # code...
        $depth=6;

      }elseif ($usermatrixtype==5) {
        # code...
        $depth=6;

      }

     $query =DB::select('SELECT m.* FROM member_table AS m JOIN treepaths AS t ON m.membershipid = t.descendant WHERE m.stage >='.$usermatrixtype.' AND t.ancestor ="'.$firstrightchildmembershipid.'"AND t.depth < '.$depth.' LIMIT  7');

    
//fill the spaces
//set matrix with values from member_table  if the value is not set


          foreach ($query as $key => $v) {
  $place = $this->getupdateposition($getusermatrix, "R");
           
            $usercount=DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('user_id',$v->membershipid)
            ->count();
            $filledup=DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('user_id',"<>","0")
            ->where('position',"=","R")
            ->count();
             if ($filledup==7) {
              # code...
              break;
            }
            if ($usercount==null||$usercount<1 && $filledup!=7) {
            $inserted=DB::update('UPDATE matrix_users SET user_id ="'.
              $v->membershipid.'" where matrix_id = ? AND trpos=?',[$getusermatrix,$place]);

            /*DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('trpos', $place)
            ->update(['user_id' => $v->membershipid]);*/
           if($inserted!=0 || $inserted!=null){
            $accountcontroller->singledropbonus($userid);
            DB::table('matrix')
            ->where('matrix_id','=',$getusermatrix)
            ->increment('count_users',1);
           }
            
           
            }else{

            }
              # code...         
              
           
              
          }

        $this->closematrix2($userid, $getusermatrix);
        }
      }
//this function gets the place to be updated in the matrix_users table based on legs i.e 
//position 
      public function getupdateposition($getusermatrix, $position)
      {
        $query = DB::table('matrix_users')
        ->where('matrix_id', $getusermatrix)
        ->where('position', $position)
        ->get();
        foreach ($query as $key => $v) {

          if ($v->user_id =="0") {
            $place = $v->trpos;
            return $place;
            break;
          } elseif ($v->user_id =="1") {

            $place = $v->trpos;
            return $place;
            break;
          } else {
            continue;
          }
        }
      }

//the closed matrix
      public function closematrix2($userid, $matrixid)
      {
       $UserController=new UserController();
       $hisstage=$UserController->getuserstage($userid);
       $accountcontroller =new accountcontroller();
       $matrixnumber = $this->getusersinmatrixcount($matrixid);
       $expectednumberformatrix = $this->getmatrixexpectedcount($userid);
       $expectednumberformatrix=$expectednumberformatrix+1;
       if ($matrixnumber == $expectednumberformatrix) {
        $accountcontroller->matrixcompletebonus($userid);
        $nextid = $this->getnextmatrix($matrixid);



        DB::table('matrix')
        ->where('ownerid', $userid)
        ->where('type_id',$hisstage)
        ->update(['filled' =>'1']);


        DB::table('member_table')
        ->where('membershipid', $userid)
        ->update(['stage' => $nextid]);

        $this->createnewmatrix($userid, $matrixid); 

      } else {

      }
    }
    public function fillstagezeromatrix($userid){
      
     $accountcontroller=new accountcontroller();
     $results = DB::table('member_table')
     ->where('membershipid', $userid)
     ->get();
        //var_dump($results);
     foreach ($results as $key => $v) {
      $usermatrixtype = $v->stage;
    }
    $results = DB::table('matrix_type')
    ->where('stage', '=', $usermatrixtype)
    ->get();
    foreach ($results as $key => $v) {

      $numberofdownlines = $v->expected_downlines;
    }


        /*$results = DB::table('mlm_stagebonus')
               ->where('stage_number', '=',$usermatrixtype)
               ->get();
         foreach ($results as $key => $v) {
          $numberofdownlines=$v->noofdownlines;
        } */
        $numberofdownlines2 = $numberofdownlines + 1;
        $leftplace = $numberofdownlines / 2;
        $rightplace = $numberofdownlines / 2;
      $getusermatrix = $this->getusermatrix($userid);

        $firstleftchild = (new UserController)->getfirstchild($userid, "L");
        $firstleftchildmembershipid = $firstleftchild['membershipid'];
////THE LEFT LEG        

//count spaces not set in db for matrix users
        $results = DB::table('matrix_users')
        ->where('matrix_id', '=', $getusermatrix)
        ->where('user_id', '=', "0")
        ->where('position', '=', "L")
        ->count();
        if (is_null($results)) {
          # code...
          $results=0;
        }
        
        if ($results<=3) {
          # code...
          //extra that space(s) from db

            # code...

          /*$query = DB::select('SELECT m.*
            FROM member_table AS m
            WHERE m.sponsorid =' . "'" . $userid . "'" . '
            AND m.membershipid NOT IN (
            select user_id from matrix_users AS mr WHERE mr.user_id=m.membershipid AND matrix_id=' . $getusermatrix . '
            ) LIMIT ' . $results
            );*/

              $query = DB::select('SELECT m.membershipid FROM member_table AS m LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id=' . $getusermatrix . ' WHERE m.sponsorid='."'" .$userid ."'".' AND mr.user_id IS NULL LIMIT '.$results);


          

//fill the spaces
//set matrix with values from member_table  if the value is not set
//set matrix with values from member_table  if the value is not set

          foreach ($query as $key => $v) {

            $place = $this->getupdateposition($getusermatrix, "L");

            $usercount=DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('user_id',$v->membershipid)
            ->count();
            if ($usercount==null||$usercount<1)
             {
            
             $inserted=DB::update('UPDATE matrix_users SET user_id ="'.
              $v->membershipid.'" where matrix_id = ? AND trpos=?',[$getusermatrix,$place]);
            
              
    
            /*DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('trpos', $place)
            ->update(['user_id' => $v->membershipid]);*/
           if($inserted!=0 || $inserted!=null){
           
            DB::table('matrix')
            ->where('matrix_id','=',$getusermatrix)
            ->increment('count_users',1);
           }

            }

          }

        } else {
          # code...
        }
        


////THE RIGHT LEG
        $firstrightchild = (new UserController)->getfirstchild($userid, "R");
        $firstrightchildmembershipid = $firstrightchild['membershipid'];
//count spaces not set in db for matrix users
        $results = DB::table('matrix_users')
        ->where('matrix_id', '=', $getusermatrix)
        ->where('user_id', '=', "0")
        ->where('position', '=', "R")
        ->count();
      //if (is_null($results)) {
          # code...
       //   $results=0;
        //}
        if ($results<=3) {
          # code...
       //extra that space(s) from db
            # code...
          /*$query = DB::select('SELECT m.*
            FROM member_table AS m
            WHERE m.sponsorid =' . "'" . $userid . "'" . '
            AND m.membershipid NOT IN(
            select user_id from matrix_users AS mr WHERE mr.user_id=m.membershipid AND matrix_id=' . $getusermatrix . '
            ) LIMIT ' . $results
            );*/


           /*$query=DB::select('SELECT m.*
            FROM member_table AS m
            WHERE m.sponsorid =' . "'" . $userid . "'" . 'LEFT JOIN matrix_users AS mu WHERE mu.user_id =m.membershipid AND
           matrix_id=' . $getusermatrix . ' AND
           WHERE mu.userid IS NULL
             LIMIT ' . $results);*/
             $query = DB::select('SELECT m.membershipid FROM member_table AS m LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id=' . $getusermatrix . ' WHERE m.sponsorid=' . "'" . $userid . "'" . ' AND mr.user_id IS NULL LIMIT '.$results);
//fill the spaces
//set matrix with values from member_table  if the value is not set


          foreach ($query as $key => $v) {
            $place = $this->getupdateposition($getusermatrix, "R");
           
         $usercount=DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('user_id',$v->membershipid)
            ->count();
            if ($usercount==null||$usercount<1)
             {
             
             $inserted=DB::update('UPDATE matrix_users SET user_id ="'.
              $v->membershipid.'" where matrix_id = ? AND trpos=?',[$getusermatrix,$place]);
               
            /*DB::table('matrix_users')
            ->where('matrix_id', $getusermatrix)
            ->where('trpos', $place)
            ->update(['user_id' => $v->membershipid]);*/
           if($inserted!=0 || $inserted!=null){
            
            DB::table('matrix')
            ->where('matrix_id','=',$getusermatrix)
            ->increment('count_users',1);
           }


             }

          }

        } else {
          # code...
        }

        $this->closematrix2($userid, $getusermatrix); 

      }
      public function getmatrixidofuser($userid, $stage)
      {
        //get matrixid of user
        $results = DB::table('matrix')
        ->where('ownerid', '=', $userid)
        ->where('type_id', '=', $stage)
        ->get();
        foreach ($results as $key => $v) {

          $matrixid = $v->matrix_id;

        }
        return $matrixid;
      }

      public function getusersinmatrixcount($matrixid)
      {
        $query = DB::table('matrix')
        ->where('matrix_id',$matrixid)
        ->get();
        foreach ($query as $key => $value) {
            # code...
          $userscount = $value->count_users;
        }
        return $userscount;
      }

//create the matrix of a user based on user id
      public function creatematrix4($userid, $type_id)
      {
        $matrix = new matrix;
        $todaysdate = new \DateTime();
        $result = $todaysdate->format('Y-m-d');
        $matrix->type_id = $type_id;
        $matrix->count_users = 1;
        $matrix->ownerid = $userid;
        $matrix->filled = 0;
        $matrix->created_at = $result;
        $matrix->save();
      }

//create new matrix if the old matrix is filled   
      public function createnewmatrix($userid, $formermatrixid)
      {
        $nextid = $this->getnextmatrix($formermatrixid);
        $this->creatematrix($userid, $nextid);

      }

//get next matrix after the matrix
      public function getnextmatrix($formermatrixid)
      {
        // $results = DB::table('matrix_type')
        //->where('stage', '=',$formermatrixid)
        // ->get();
        $results = DB::table('matrix')
        ->where('matrix_id', '=', $formermatrixid)
        ->get();
        foreach ($results as $key => $v) {
          $matrixid = $v->type_id;
        }

        return $matrixid + 1;
      }

//
      public function getmatrixexpectedcount($userid)
      {

        $stage = (new UserController)->getuserstage($userid);
        $results = DB::table('matrix_type')
        ->where('stage', '=', $stage)
        ->get();
        foreach ($results as $key => $v) {

          $stage_numbercount = $v->expected_downlines;
        }


        return $stage_numbercount;
      }

      public function getparenttrpos($matrix_id, $direction)
      {

        $query = DB::select('SELECT m.*
          FROM matrix_users AS m
          WHERE matrix_id =? AND position=?', [$matrix_id, $direction]);
//INSERT INTO `matrix_users`(`matrix_users_id`, `matrix_id`, `user_id`, `parentid`, `position`, `place`, `trpos`, `trchildren`, `tparent`, `children`, `stage`, `level`, `matrix_number`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
        if ($query == null) {
            # code...
          return ["parent" => 0, "position" => 0];
        } else {
            # code...
          foreach ($query as $key => $v) {

            if ($v->children == 0) {
              return ["parent" => "$v->trpos", "position" => "L", "parentid" => "$v->user_id"];
              break;
            } elseif ($v->children == 1) {

              return ["parent" => "$v->trpos", "position" => "R", "parentid" => "$v->user_id"];

              break;
            } else {
              continue;
            }
          }

        }
      }

      public function getadjacencylist($userid)
      {
        $query = DB::select('SELECT m1.*, m2.*, m3.*, m4.*
FROM member_table m1 -- 1st level
LEFT OUTER JOIN member_table m2
ON m2.parentid =m1.membershipid  -- 2nd level
LEFT OUTER JOIN member_table m3
ON m3.parentid = m2.membershipid -- 3rd level
LEFT OUTER JOIN member_table m4
ON m4.parentid = m3.membershipid -- 4th level');

        return $query;
      }

      public function getlastnum($matrix_id)
      {
        $query = DB::select('SELECT m.*
          FROM matrix_users AS m
          WHERE matrix_id =?', [$matrix_id]);
        foreach ($query as $key => $v) {
          $lastparentpos = $v->trpos;
        }
        return $lastparentpos;
      }

      public function setmatrixuserschildren($matrix_id, $parenttrpos)
      {
        DB::table('matrix_users')
        ->where('matrix_id', '=', $matrix_id)
        ->where('trpos', '=', $parenttrpos)
        ->increment('children', 1);
      }

//get the matrix of the user
      public function getusermatrix($userid)
      {
        $results = DB::table('member_table')
        ->where('membershipid', '=', $userid)
        ->get();

        foreach ($results as $key => $v) {
          $stage = $v->stage;
        }

        $results2 = DB::table('matrix')
        ->where('ownerid', '=', $userid)
        ->where('type_id', '=', $stage)
        ->get();

        foreach ($results2 as $key => $v) {

          $matrix_id = $v->matrix_id;

        }
        return $matrix_id;
      }

//get usernames
      public function getusernames($username, $num)
      {
        $usernames = array();
        $num = $num + 1;
        for ($i = 0; $i < $num; $i++) {

          $usernames[$i] = $username . $i;
        }
        array_shift($usernames);
        return $usernames;
      }

//function to create relational table data for users
      public function create2($parentid, $childid)
      {

        $query = DB::unprepared('INSERT INTO treepaths (ancestor, descendant,depth)
          SELECT t.ancestor,' . $childid . ',t.depth+1
          FROM treepaths AS t
          WHERE t.descendant =' . $parentid . '
          UNION ALL
          SELECT ' . $childid . ' ,' . $childid . ',0');


//$query=DB::insert('INSERT INTO treepaths (ancestor, descendant,depth)
//SELECT t.ancestor,'.$childid.',t.depth+1
//FROM treepaths AS t
//WHERE t.descendant =?
//UNION ALL
//SELECT '. $childid.' ,'.$childid.',0',[$parentid]);

        /*if ($query==true){

        return "inserted"; }

        else {

          return "not inserted"; } */

        }
        public function testgetfree(){

        }  

        public function getfreeposition($parentid)
        {

          $query = DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            WHERE m.children<2
            AND t.ancestor =?', [$parentid]);

          if ($query == null) {
            # code...
            return ["parent" => 0, "position" => 0];
          } else {
            # code...
            foreach ($query as $key => $v) {

              if ($v->children == 0) {
                return ["parent" => "$v->membershipid", "position" => "L"];
                break;
              } elseif ($v->children == 1) {

                return ["parent" => "$v->membershipid", "position" => "R"];

                break;
              } else {
                continue;
              }
            }

          }

        }

        public function getfreepositionwithplace2($parentid,$place)
        {

          $firstplacechild = (new UserController)->getfirstchild($parentid,$place);
          $firstplacechildmembershipid = $firstplacechild['membershipid']; 
         /* if ($firstplacechild==null || $firstplacechild==0) {
            # code...
           
          } else {
            # code...

          }*/
          

          $query = DB::select('SELECT m.*
            FROM member_table AS m
            JOIN treepaths AS t ON m.membershipid = t.descendant
            WHERE m.children<2
            AND t.ancestor =?', [$firstplacechildmembershipid]);

          if ($query == null) {
            # code...
            return ["parent" =>$parentid, "position" =>$place];
          } else {
            # code...
            foreach ($query as $key => $v) {

              if ($v->children == 0) {
                return ["parent" => "$v->membershipid", "position" => "L"];
                break;
              } elseif ($v->children == 1) {

                return ["parent" => "$v->membershipid", "position" => "R"];

                break;
              } else {
                continue;
              }
            }

          }


        }

        public function getfreepositiondisplay(){
          $display=$this->getfreepositionwithplace2('HW00016079','R');
          dd($display);
        }

        public function getfreepositionwithplace($parentid,$place){
         $firstplacechild = (new UserController)->getfirstchild($parentid,$place);
         $firstplacechildmembershipid = $firstplacechild['membershipid'];
        /*$query = DB::select('SELECT m.*
          FROM member_table AS m
          JOIN treepaths AS t ON m.membershipid = t.descendant
          WHERE m.children<2
          AND t.ancestor =?', [$firstplacechildmembershipid]);*/


         $freespace= DB::table('member_table as m')
         ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
         ->where('t.ancestor', '=', $firstplacechildmembershipid)
         ->where('m.children', '<','2')
         ->first();
      if ($freespace == null) {
            # code...
        return ["parent" =>$parentid, "position" =>$place];
          } else {

        if ($freespace->children == 0) {
          return ["parent" => "$freespace->membershipid", "position" => "L"];  
        }elseif ($freespace->children == 1) {
          # code...
         return ["parent" => "$freespace->membershipid", "position" => "R"];
       } 
          }



     }
     public function getuniqueid()
     {
      $todaysdate = new \DateTime();
      $result = $todaysdate->format('Y-m-d');
        //$date = $this->returntodaysdate();
      $uniqueid = "";
      $data = $this->filltotalregtable();
      $val = Totalreg::select('totalreg')->where('date', $result)->first();

      $total = $val->totalreg;

      $total = $total + 1;
        //$uid = explode("-", $date);
        //$uniqueid = implode($this->generaterandomalphbet(2), $uid);
      $uniqueid1 = $this->generaterandomalphbet(2);
      $uniqueid2 = $this->generaterandomalphbet(2);
        //$max_id=User::all()->max('id'); //to get max id so far in a table
      $date1 = date("Y");
      $date2 = date("m");
      $date3 = date("d");
      $date4 = date("H");
      $date5 = date("i");
      $date6 = date("s");
      $uniqueid = $uniqueid . $date1 . $date2 . $date3 . $date4 . $date5 . $uniqueid2 . $date6;
      return $uniqueid;
    }

    public function generaterandomalphbet($random_string_length)
    {
      $characters = 'BCDFGHJKLMNPQRSTVWXYZ';
      $string = "";
      for ($i = 0; $i < $random_string_length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
      }

      return $string;
    }

    public function returntodaysdate()
    {
        $date = new \DateTime(); //the create a new date instance for todays date note the \ in front of DateTime() is import DateTime class //// it can rather be done using     use DateTime(); where other namespaces are decleared
        $result = $date->format('m-Y-d');

        //$krr=explode("-",$result);
        //$result=implode("",$krr);
        //$myfunctions = new \App\Controllers\UserController;
        //echo ($myfunctions->generaterandomalphbet(4));

        return $result;
      }


      public function filltotalregtable()
      {
        $todaysdate = new \DateTime();
        $result = $todaysdate->format('Y-m-d');
        $totalreg = new Totalreg;
        $data = $totalreg::firstOrCreate(['date' => $result]);
        return $data;
      }




    }
