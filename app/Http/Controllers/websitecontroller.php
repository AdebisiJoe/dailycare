<?php

namespace App\Http\Controllers;

use App\GraphDB\MySQLToGraphDB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\matrix;
use App\Totalreg;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class websitecontroller extends Controller
{
    private $graphdb;
    private $fiftypercentcalflag1;
    private $fiftypercentcalflag2;

    public function __construct()
    {
        $this->graphdb = new MySQLToGraphDB();
        $this->fiftypercentcalflag1 = true;
        $this->fiftypercentcalflag2 = true;

    }
    public function CalculateBonusForStage(Request $request)
    {
        ini_set('max_execution_time', 300000);
        ini_set('memory_limit', '2G');
        $stage = $request->stage;
        $results = DB::table('member_table')->where('stage', $stage)->get();

        //dd($results);
        //foreach ($results as $key => $value)
        foreach ($results as $value) {

            //$getusermatrix = $this->getusermatrix($value->membershipid);

            $results2 = DB::table('matrix')
                ->where('ownerid', '=', $value->membershipid)
                ->where('type_id', '=', $stage)
                ->count();

            if ($results2 == null or $results2 == 0) {
                echo "Bonus not calculated for " . $value->membershipid . "<br/>";
            } else {
                $this->fillmatrix2($value->membershipid);
                echo "calculated bonus for " . $value->membershipid . "<br/>";
            }

        }
    }

    public function testinggetfreespace()
    {

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $parentid = "HW00016001";
        $place = "R";

        $freepositionwithplace2 = $this->graphdb->countdownlines($parentid);

        // return  $freepositionwithplace2;

        // $websitecontroller=new websitecontroller();
        // $freepositionwithplace=$websitecontroller->getfreepositionwithplace($parentid,$place);

        // $firstplacechild = (new UserController)->getfirstchild($parentid,$place);
        // // dump($freepositionwithplace);

        //$freepositionwithplace2=$this->graphdb->getfreepositionwithplace($parentid,$place);

        // $graphdbfirstchild=$this->graphdb->getFirstChildByPosition($parentid,$place);

        // echo "</br>";

        // echo "first child by Graph";

        // print_r($graphdbfirstchild);

        // echo "</br>";
        // echo "first child";
        // print_r($firstplacechild);
        // echo "</br>Treepath Result: ";
        // print_r($freepositionwithplace);
        // echo "</br>GraphDB Result: ";
        print_r($freepositionwithplace2);

//       //$freespace=$this->graphdb->getfreepositionwithplace("HW00016001","L");
        //
        //       //return $freespace;
        //
        //        $getusermatrix=1;
        //        $position="L";
        //
        //        $result=DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id='.$getusermatrix.' AND m.user_id !="0" AND position='."'".$position."'".'');
        //
        //        $data=array();
        //
        //        foreach ($result as $key) {
        //
        //            $data[]=strtoupper($key->user_id);
        //        }
        //
        //
        //
        //        $firstrightchildmembershipid="HW00016001";
        //
        //        $results = DB::table('member_table')
        //            ->where('membershipid', $firstrightchildmembershipid)
        //            ->get();
        //        // var_dump($results);
        //        foreach ($results as $key => $v) {
        //            $usermatrixtype = $v->stage;
        //        }
        //
        //
        //        $query=$this->graphdb->getMembersToFillMatrix($firstrightchildmembershipid,$data,"'" . $usermatrixtype . "'");
        //
        //        //return $query;
        //
        //        foreach ($query as $key) {
        //            print_r($key);
        //            echo "<br/>";
        //        }

    }

    public function testinggetfreespacewithview()
    {
        $parentid = "HW00016001";
        $place = "R";

        $websitecontroller = new websitecontroller();
        $freepositionwithplace = $websitecontroller->getfreepositionwithplace($parentid, $place);

        $firstplacechild = (new UserController)->getfirstchild($parentid, $place);
        // dump($freepositionwithplace);

        $freepositionwithplace2 = $this->graphdb->getfreepositionwithplace($parentid, $place);

        $graphdbfirstchild = $this->graphdb->getFirstChildByPosition($parentid, $place);

        echo "</br>";

        print_r($graphdbfirstchild);
        echo "</br>";

        echo "</br>";

        print_r($firstplacechild);
        echo "</br>";
        print_r($freepositionwithplace);
        echo "</br>";
        print_r($freepositionwithplace2);

    }

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
        ini_set('max_execution_time', 3000);
        $matrix = new matrix;
        $todaysdate = new \DateTime();
        $result = $todaysdate->format('Y-m-d');
        $matrix->type_id = $type_id;
        $matrix->count_users = 1;
        $matrix->ownerid = $userid;
        $matrix->filled = 0;
        $matrix->created_at = $result;
        $matrix->save();
        $getusermatrix = $this->getusermatrix($userid);

        if($type_id==0||$type_id==1){
                        
                $data = array(
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0, 'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                )
            );

          DB::table('matrix_users')->insert($data);      
        }
        else if ($type_id == 2 || $type_id == 3 || $type_id == 4) {
            # code...
            $data = array(
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0, 'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 4, 'trchildrenp' => 'L', 'tparent' => 2, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),

                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 5, 'trchildrenp' => 'R', 'tparent' => 2, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),

                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 6, 'trchildrenp' => 'L', 'tparent' => 3, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 7, 'trchildrenp' => 'R', 'tparent' => 3, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
            );

            DB::table('matrix_users')->insert($data);
        } else {
            # code...

            $data = array(
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => $userid, 'parentid' => 0, 'position' => '0', 'place' => 0, 'trpos' => 1, 'trchildrenp' => 0, 'tparent' => 0, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'L', 'place' => 0, 'trpos' => 2, 'trchildrenp' => 'L', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => $userid, 'position' => 'R', 'place' => 0, 'trpos' => 3, 'trchildrenp' => 'R', 'tparent' => 1, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 4, 'trchildrenp' => 'L', 'tparent' => 2, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),

                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 5, 'trchildrenp' => 'R', 'tparent' => 2, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),

                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 6, 'trchildrenp' => 'L', 'tparent' => 4, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 7, 'trchildrenp' => 'R', 'tparent' => 4, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 8, 'trchildrenp' => 'L', 'tparent' => 5, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'L', 'place' => 0, 'trpos' => 9, 'trchildrenp' => 'R', 'tparent' => 5, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 10, 'trchildrenp' => 'L', 'tparent' => 3, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 11, 'trchildrenp' => 'R', 'tparent' => 3, 'children' => 2, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 12, 'trchildrenp' => 'L', 'tparent' => 10, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 13, 'trchildrenp' => 'R', 'tparent' => 10, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 14, 'trchildrenp' => 'L', 'tparent' => 11, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
                array(

                    'matrix_id' => $getusermatrix, 'user_id' => 0, 'parentid' => 0, 'position' => 'R', 'place' => 0, 'trpos' => 15, 'trchildrenp' => 'R', 'tparent' => 11, 'children' => 0, 'stage' => 0, 'level' => 1, 'matrix_number' => 0,
                ),
            );

            DB::table('matrix_users')->insert($data);
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
        $UserController = new UserController();
        $hisstage = $UserController->getuserstage("HW00016025");
        echo $hisstage;
    }

    public function chechMembershipIDRegistrationdate($membershipid)
    {
        $membervalue = DB::table('member_table')->where('membershipid', $membershipid)->where('joindate', '>', '2018-04-30')->count();

    }

    public function fillmatrix2($userid)
    {

        ini_set('max_execution_time', 3000);

        $UserController = new UserController();
        $accountcontroller = new accountcontroller();
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

        $memberdatecount = DB::table('member_table')->where('membershipid', $userid)->where('joindate', '<', '2018-04-20')->count();


        $numberofdownlines2 = $numberofdownlines + 1;
        $leftplace = $numberofdownlines / 2;
        $rightplace = $numberofdownlines / 2;
        $getusermatrix = $this->getusermatrix($userid);
        $hisstage = $UserController->getuserstage($userid);
        if ($hisstage == 0) {
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

            $position = "L";

            $result = DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id=' . $getusermatrix . ' AND m.user_id !="0" AND position=' . "'" . $position . "'" . '');

            $data = array();

            foreach ($result as $key) {

                $data[] = strtoupper($key->user_id);
            }

            if ($memberdatecount >= 1) {

                $query = $this->graphdb->getMembersToFillMatrixForOldUsers($firstleftchildmembershipid, $data, $usermatrixtype);

            } else {

                $query = $this->graphdb->getMembersToFillMatrix($firstleftchildmembershipid, $data, $usermatrixtype);
            }

            // $query=$this->graphdb->getMembersToFillMatrix($firstleftchildmembershipid,$data,"'". $usermatrixtype . "'",$hisstage);
            // var_dump($query);
            // die();
            //fill the spaces
            //set matrix with values from member_table  if the value is not set
            //set matrix with values from member_table  if the value is not set

            foreach ($query as $key) {
                //key =membershipid from array
                $place = $this->getupdateposition($getusermatrix, "L");

                $usercount = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', $key)
                    ->count();
                $filledup = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', "<>", "0")
                    ->where('position', "=", "L")
                    ->count();
                if ($filledup == 7) {
                    # code...
                    break;
                }
                if ($usercount == null || $usercount < 1 && $filledup != 7) {
                    # code...
                    $inserted = DB::update('UPDATE matrix_users SET user_id ="' .
                        $key . '" where matrix_id = ? AND trpos=?', [$getusermatrix, $place]);

                    /*DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('trpos', $place)
                    ->update(['user_id' => $v->membershipid]);*/
                    if ($inserted != 0 || $inserted != null) {
                        //  $inDepth5 = $this->graphdb->getMembersToFillMatrixWithDepth5($firstleftchildmembershipid,$data,$usermatrixtype);
                        //    $this->fiftypercentcalflag1=in_array( $key ,$inDepth5 );
                        // if($this->fiftypercentcalflag1){
                        // Pay full payment
                        $accountcontroller->singledropbonus($userid);
                        // }else{
                        //   $accountcontroller->singledropbonusfiftypercent($userid);
                        // }
                        DB::table('matrix')
                            ->where('matrix_id', '=', $getusermatrix)
                            ->increment('count_users', 1);
                    }

                } else {

                }
            }

////THE RIGHT LEG
            $position = "R";
            $firstrightchild = (new UserController)->getfirstchild($userid, $position);
            $firstrightchildmembershipid = $firstrightchild['membershipid'];
//count spaces not set in db for matrix users
            $results = DB::table('matrix_users')
                ->where('matrix_id', '=', $getusermatrix)
                ->where('user_id', '=', "0")
                ->where('position', '=', $position)
                ->count();
//extra that space(s) from db

            $result = DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id=' . $getusermatrix . ' AND m.user_id !="0" AND position=' . "'" . $position . "'" . '');

            $data = array();

            foreach ($result as $key) {

                $data[] = strtoupper($key->user_id);
            }

            // $query=$this->graphdb->getMembersToFillMatrix($firstrightchildmembershipid,$data,"'" . $usermatrixtype . "'",$hisstage);

            if ($memberdatecount >= 1) {
                $query = $this->graphdb->getMembersToFillMatrixForOldUsers($firstrightchildmembershipid, $data, $usermatrixtype);
            } else {
                $query = $this->graphdb->getMembersToFillMatrix($firstrightchildmembershipid, $data, $usermatrixtype);
            }

//fill the spaces
            //set matrix with values from member_table  if the value is not set

            foreach ($query as $key) {
                //key = position
                $place = $this->getupdateposition($getusermatrix, $position);

                $usercount = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', $key)
                    ->count();
                $filledup = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', "<>", "0")
                    ->where('position', "=", $position)
                    ->count();
                if ($filledup == 7) {
                    # code...
                    break;
                }
                if ($usercount == null || $usercount < 1 && $filledup != 7) {
                    $inserted = DB::update('UPDATE matrix_users SET user_id ="' .
                        $key . '" where matrix_id = ? AND trpos=?', [$getusermatrix, $place]);

                    /*DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('trpos', $place)
                    ->update(['user_id' => $v->membershipid]);*/
                    if ($inserted != 0 || $inserted != null) {

                        //  $inDepth5 = $this->graphdb->getMembersToFillMatrixWithDepth5($firstrightchildmembershipid,$data,$usermatrixtype);

                        // $this->fiftypercentcalflag2=in_array( $key ,$inDepth5 );

                        // if($this->fiftypercentcalflag2){
                        // Pay full payment
                        $accountcontroller->singledropbonus($userid);
                        //  }else{
                        //  $accountcontroller->singledropbonusfiftypercent($userid);
                        // }

                        DB::table('matrix')
                            ->where('matrix_id', '=', $getusermatrix)
                            ->increment('count_users', 1);
                    }

                } else {

                }
                # code...

            }

            // if ($this->fiftypercentcalflag1 || $this->fiftypercentcalflag2) {
            // $this->closematrix($userid, $getusermatrix);
            // }else{

            $this->closematrix2($userid, $getusermatrix);

            //  }

        }
    }

    public function fillmatrix4($userid)
    {

        ini_set('max_execution_time', 3000);
        $UserController = new UserController();
        $accountcontroller = new accountcontroller();
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
        $hisstage = $UserController->getuserstage($userid);
        if ($hisstage == 1 || $hisstage == 2 || $hisstage == 3 || $hisstage == 4) {
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

            $position = "L";

            $result = DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id=' . $getusermatrix . ' AND m.user_id !="0" AND position=' . "'" . $position . "'" . '');

            $data = array();

            foreach ($result as $key) {

                $data[] = strtoupper($key->user_id);
            }

            $query = $this->graphdb->getMembersToFillMatrixForSingleUser($firstleftchildmembershipid, $data, $usermatrixtype);

            // $query=$this->graphdb->getMembersToFillMatrix($firstleftchildmembershipid,$data,"'". $usermatrixtype . "'",$hisstage);
            // var_dump($query);
            // die();
            //fill the spaces
            //set matrix with values from member_table  if the value is not set
            //set matrix with values from member_table  if the value is not set

            foreach ($query as $key) {
                //key =membershipid from array
                $place = $this->getupdateposition($getusermatrix, "L");

                $usercount = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', $key)
                    ->count();
                $filledup = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', "<>", "0")
                    ->where('position', "=", "L")
                    ->count();
                if ($filledup == 7) {
                    # code...
                    break;
                }
                if ($usercount == null || $usercount < 1 && $filledup != 7) {
                    # code...
                    $inserted = DB::update('UPDATE matrix_users SET user_id ="' .
                        $key . '" where matrix_id = ? AND trpos=?', [$getusermatrix, $place]);

                    /*DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('trpos', $place)
                    ->update(['user_id' => $v->membershipid]);*/
                    if ($inserted != 0 || $inserted != null) {
                        $accountcontroller->singledropbonus($userid);
                        DB::table('matrix')
                            ->where('matrix_id', '=', $getusermatrix)
                            ->increment('count_users', 1);
                    }

                } else {

                }
            }

////THE RIGHT LEG
            $position = "R";
            $firstrightchild = (new UserController)->getfirstchild($userid, $position);
            $firstrightchildmembershipid = $firstrightchild['membershipid'];
//count spaces not set in db for matrix users
            $results = DB::table('matrix_users')
                ->where('matrix_id', '=', $getusermatrix)
                ->where('user_id', '=', "0")
                ->where('position', '=', $position)
                ->count();
//extra that space(s) from db

            $result = DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id=' . $getusermatrix . ' AND m.user_id !="0" AND position=' . "'" . $position . "'" . '');

            $data = array();

            foreach ($result as $key) {

                $data[] = strtoupper($key->user_id);
            }

            // $query=$this->graphdb->getMembersToFillMatrix($firstrightchildmembershipid,$data,"'" . $usermatrixtype . "'",$hisstage);
            $query = $this->graphdb->getMembersToFillMatrixForSingleUser($firstrightchildmembershipid, $data, $usermatrixtype);

//fill the spaces
            //set matrix with values from member_table  if the value is not set

            foreach ($query as $key) {
                //key = position
                $place = $this->getupdateposition($getusermatrix, $position);

                $usercount = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', $key)
                    ->count();
                $filledup = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', "<>", "0")
                    ->where('position', "=", $position)
                    ->count();
                if ($filledup == 7) {
                    # code...
                    break;
                }
                if ($usercount == null || $usercount < 1 && $filledup != 7) {
                    $inserted = DB::update('UPDATE matrix_users SET user_id ="' .
                        $key . '" where matrix_id = ? AND trpos=?', [$getusermatrix, $place]);

                    /*DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('trpos', $place)
                    ->update(['user_id' => $v->membershipid]);*/
                    if ($inserted != 0 || $inserted != null) {
                        $accountcontroller->singledropbonus($userid);
                        DB::table('matrix')
                            ->where('matrix_id', '=', $getusermatrix)
                            ->increment('count_users', 1);
                    }

                } else {

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

            if ($v->user_id == "0") {
                $place = $v->trpos;
                return $place;
                break;
            } elseif ($v->user_id == "1") {

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
        $UserController = new UserController();
        $hisstage = $UserController->getuserstage($userid);
        $accountcontroller = new accountcontroller();
        $matrixnumber = $this->getusersinmatrixcount($matrixid);
        $expectednumberformatrix = $this->getmatrixexpectedcount($userid);
        $expectednumberformatrix = $expectednumberformatrix + 1;
        if ($matrixnumber == $expectednumberformatrix) {
            $accountcontroller->matrixcompletebonus($userid);
            $nextid = $this->getnextmatrix($matrixid);

            DB::table('matrix')
                ->where('ownerid', $userid)
                ->where('type_id', $hisstage)
                ->update(['filled' => '1']);

            DB::table('member_table')
                ->where('membershipid', $userid)
                ->update(['stage' => $nextid]);

            $this->graphdb->setStageInGraphDB($userid, $nextid);

            $this->createnewmatrix($userid, $matrixid);

        } else {

        }

    }

//the closed matrix
    public function closematrix($userid, $matrixid)
    {
        $UserController = new UserController();
        $hisstage = $UserController->getuserstage($userid);
        $accountcontroller = new accountcontroller();
        $matrixnumber = $this->getusersinmatrixcount($matrixid);
        $expectednumberformatrix = $this->getmatrixexpectedcount($userid);
        $expectednumberformatrix = $expectednumberformatrix + 1;
        if ($matrixnumber == $expectednumberformatrix) {
            $accountcontroller->matrixcompletebonusfiftypercent($userid);
            $nextid = $this->getnextmatrix($matrixid);

            DB::table('matrix')
                ->where('ownerid', $userid)
                ->where('type_id', $hisstage)
                ->update(['filled' => '1']);

            DB::table('member_table')
                ->where('membershipid', $userid)
                ->update(['stage' => $nextid]);

            $this->graphdb->setStageInGraphDB($userid, $nextid);

            $this->createnewmatrix($userid, $matrixid);

        } else {

        }

    }



    public function fillstagezeromatrix($userid)
    {

        $accountcontroller = new accountcontroller();
        $results = DB::table('member_table')
            ->where('membershipid', $userid)
            ->get();
        
        foreach ($results as $key => $v) {
            $usermatrixtype = $v->stage;
        }

        $results = DB::table('matrix_type')->where('stage', '=', $usermatrixtype)->get();

        foreach ($results as $key => $v) {

            $numberofdownlines = $v->expected_downlines;
        }

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

           

         $position='L';
         $resultofquery = DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id=' . $getusermatrix . ' AND m.user_id !="0" AND position=' . "'" . $position . "'" . '');


            $data = array();

            foreach ($resultofquery as $key) {

                $data[] = strtoupper($key->user_id);
            }

        if (is_null($results)) {
            # code...
            $results = 0;
        }

        if ($results <= 1) {
            # code...
            //extra that space(s) from db

            // $query = DB::select('SELECT m.membershipid FROM member_table AS m LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id=' . $getusermatrix . ' WHERE m.sponsorid=' . "'" . $userid . "'" . ' AND mr.user_id IS NULL LIMIT ' . $results);

            //check if user has someone sponsored on the left 
            $hasleftsponsored=$this->graphdb->checkIfPositionSponsored($firstleftchildmembershipid,$userid);
            
            if($hasleftsponsored){

              $query = $this->graphdb->getMembersWithTwoSponsorUnderAUser($userid,$firstleftchildmembershipid,$data);

              foreach ($query as $key) {

                $place = $this->getupdateposition($getusermatrix, "L");

                $usercount = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', $key)
                    ->count();
                if ($usercount == null || $usercount < 1) {

                    $inserted = DB::update('UPDATE matrix_users SET user_id ="' .
                        $key . '" where matrix_id = ? AND trpos=?', [$getusermatrix, $place]);

                    if ($inserted != 0 || $inserted != null) {

                        $accountcontroller->singledropbonus($userid);

                        DB::table('matrix')
                            ->where('matrix_id', '=', $getusermatrix)
                            ->increment('count_users', 1);
                    }

                } 
              }

            } 

        } else {
            # code...
        }

        ////THE RIGHT LEG
        $firstrighttchild = (new UserController)->getfirstchild($userid, "R");
                $firstrightchildmembershipid = $firstrighttchild['membershipid'];
        ////THE LEFT LEG

        //count spaces not set in db for matrix users
        $results = DB::table('matrix_users')
            ->where('matrix_id', '=', $getusermatrix)
            ->where('user_id', '=', "0")
            ->where('position', '=', "R")
            ->count();

           

         $position='R';
         $resultofquery = DB::select('SELECT m.user_id FROM matrix_users AS m WHERE m.matrix_id=' . $getusermatrix . ' AND m.user_id !="0" AND position=' . "'" . $position . "'" . '');


            $data = array();

            foreach ($resultofquery as $key) {

                $data[] = strtoupper($key->user_id);
            }

        if (is_null($results)) {
            # code...
            $results = 0;
        }

        if ($results <= 1) {
            # code...
            //extra that space(s) from db

            // $query = DB::select('SELECT m.membershipid FROM member_table AS m LEFT JOIN matrix_users AS mr ON mr.user_id=m.membershipid AND mr.matrix_id=' . $getusermatrix . ' WHERE m.sponsorid=' . "'" . $userid . "'" . ' AND mr.user_id IS NULL LIMIT ' . $results);

            //check if user has someone sponsored on the left 
            $hasrightsponsored=$this->graphdb->checkIfPositionSponsored($firstrightchildmembershipid,$userid);
            
            if($hasrightsponsored){
                
              $query = $this->graphdb->getMembersWithTwoSponsorUnderAUser($userid,$firstrightchildmembershipid,$data);

              foreach ($query as $key) {

                $place = $this->getupdateposition($getusermatrix, "R");

                $usercount = DB::table('matrix_users')
                    ->where('matrix_id', $getusermatrix)
                    ->where('user_id', $key)
                    ->count();
                if ($usercount == null || $usercount < 1) {

                    $inserted = DB::update('UPDATE matrix_users SET user_id ="' .
                        $key . '" where matrix_id = ? AND trpos=?', [$getusermatrix, $place]);

                    if ($inserted != 0 || $inserted != null) {

                        $accountcontroller->singledropbonus($userid);

                        DB::table('matrix')
                            ->where('matrix_id', '=', $getusermatrix)
                            ->increment('count_users', 1);
                    }

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
            ->where('matrix_id', $matrixid)
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
    public function testgetfree()
    {

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

    public function getfreepositionwithplace2($parentid, $place)
    {

        $firstplacechild = (new UserController)->getfirstchild($parentid, $place);
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
            return ["parent" => $parentid, "position" => $place];
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

    public function getfreepositiondisplay()
    {
        $display = $this->getfreepositionwithplace2('HW00016079', 'R');
        dd($display);
    }

    public function getfreepositionwithplace($parentid, $place)
    {
        $firstplacechild = (new UserController)->getfirstchild($parentid, $place);

        $firstplacechildmembershipid = $firstplacechild['membershipid'];
        /*$query = DB::select('SELECT m.*
        FROM member_table AS m
        JOIN treepaths AS t ON m.membershipid = t.descendant
        WHERE m.children<2
        AND t.ancestor =?', [$firstplacechildmembershipid]);*/

        $freespace = DB::table('member_table as m')
            ->join('treepaths as t', 'm.membershipid', '=', 't.descendant')
            ->where('t.ancestor', '=', $firstplacechildmembershipid)
            ->where('m.children', '<', '2')
            ->first();
        if ($freespace == null) {
            # code...
            return ["parent" => $parentid, "position" => $place];

        } else {

            if ($freespace->children == 0) {

                return ["parent" => "$freespace->membershipid", "position" => "L"];

            } elseif ($freespace->children == 1) {

                if ($this->getParentIfPositionIsRightAndChildIsOneAlready($freespace->membershipid)) {
                    return ["parent" => "$freespace->membershipid", "position" => "L"];
                } else {
                    return ["parent" => "$freespace->membershipid", "position" => "R"];
                }

            }
        }

    }

    public function getParentIfPositionIsRightAndChildIsOneAlready($membershipid)
    {
        $result = DB::table('member_table')->where('parentid', '=', $membershipid)->where('position', '=', 'R')->count();

        if ($result > 0) {
            return true;
        }

        return false;
    }

    public function testGetFreePositionWithSpace($parentid, $place)
    {
        dd($this->getfreepositionwithplace($parentid, $place));
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

    public function getAllMembersFinrecords($stage, $limit, $offset)
    {

        ini_set('max_execution_time', 0);

        $key = DB::select("SELECT * FROM matrix where created_at between '2018-12-13' and '2019-05-06' and type_id=? ORDER BY matrix_id ASC Limit ? OFFSET ?", [$stage, $limit, $offset]);
        $i = 0;
        foreach ($key as $value) {
            $membershipid = $value->ownerid;
            echo $i++ . "---    " . $membershipid;
            echo "----  ";

            $removefrommatrix = $stage + 2;

            $key = DB::select("SELECT count(mrr.trpos)/15 as countvalue  FROM matrix join matrix_users as mrr on matrix.matrix_id=mrr.matrix_id and matrix.type_id=? AND EXISTS ( select user_id from matrix_users AS mr WHERE mr.matrix_id=mrr.matrix_id and mr.user_id=?  AND trpos!=1 )", [$stage, $membershipid]);

            // $key= DB::select("SELECT count(*)-? as countvalue from  matrix_users where user_id =? ",[$removefrommatrix,$membershipid]);

            foreach ($key as $value) {

                echo $value->countvalue;
                echo "<br/>";
            }

        }

    }

}
