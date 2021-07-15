<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\websitecontroller;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class FixMultipleLegErrorController extends Controller
{

    private $websitecontroller;
   private  $adminController;

    public function __construct()
    {
        $websitecontroller=new websitecontroller();
        $adminController=new AdminController();
    }

    public function getAndCorrectAllDuplicatedLegs($limit){

        ini_set('max_execution_time',60000);

        //$duplicatedlegs=DB::select('SELECT u.membershipid, u.parentid, u.position,u.joindate FROM member_table u INNER JOIN ( SELECT parentid, position, COUNT(*) FROM member_table GROUP BY parentid, position HAVING COUNT(*) > 1) temp ON temp.parentid = u.parentid AND temp.position = u.position ORDER BY parentid, position');

        $duplicatedlegs=DB::select('SELECT u.id,u.membershipid, u.parentid, u.position,u.joindate FROM member_table u INNER JOIN ( SELECT id,parentid, position, COUNT(*) FROM member_table GROUP BY parentid, position HAVING COUNT(*) > 1) temp ON temp.parentid = u.parentid AND temp.position = u.position WHERE temp.id = u.id ORDER BY parentid, position LIMIT '.$limit);

        // SELECT u.id,u.membershipid, u.parentid, u.position,u.joindate FROM member_table u INNER JOIN ( SELECT id,parentid, position, COUNT(*) FROM member_table GROUP BY parentid, position HAVING COUNT(*) > 1) temp ON temp.parentid = u.parentid AND temp.position = u.position WHERE temp.id = u.id ORDER BY parentid, position LIMIT 20

       // SELECT u.membershipid, u.parentid, u.position,u.joindate FROM member_table u INNER JOIN ( SELECT parentid, position,MAX(joindate) AS MaxDate, COUNT(*) FROM member_table GROUP BY parentid, position HAVING COUNT(*) > 1) temp ON temp.parentid = u.parentid AND temp.position = u.position AND temp.MaxDate = u.MaxDate ORDER BY parentid, position

        //SELECT u.id,u.membershipid, u.parentid, u.position,u.joindate FROM member_table u INNER JOIN ( SELECT id,parentid, position, COUNT(*) FROM member_table GROUP BY parentid, position HAVING COUNT(*) > 1) temp ON temp.parentid = u.parentid AND temp.position = u.position WHERE temp.id = u.id ORDER BY parentid, position

        foreach ($duplicatedlegs as $result){

            $newansector= $result->parentid;
            $descendant= $result->membershipid;
            $position= $result->position;

            $this->changeParent($newansector,$descendant,$position);
        }
    }


    public function changeParent($newansector,$descendant,$position){

        ini_set('max_execution_time',60000);
        //$ansector=$request->ansector;


        //$newansector=$request->newansector;
        //$descendant=$request->descendant;

        $parentid=(new AdminController)->getparent($descendant);


//update number of children for old parent
        (new AdminController)->updateparent($parentid);

        $place=$position;
        $freepositionwithplace=(new websitecontroller)->getfreepositionwithplace($newansector,$place);



        $realparent=$freepositionwithplace["parent"];
        $realposition=$freepositionwithplace["position"];

//set descendant parent to new parent
        $results = DB::table('member_table')->where('membershipid',$descendant)->update(['parentid' =>$realparent]);


        (new websitecontroller)->setparentchildren($realparent);
//disconnect from first parent
        $query=DB::unprepared('DELETE a FROM treepaths AS a
  JOIN treepaths AS d ON a.descendant = d.descendant
  LEFT JOIN treepaths AS x
  ON x.ancestor = d.ancestor AND x.descendant = a.ancestor
  WHERE d.ancestor ="'.$descendant.'" AND x.ancestor IS NULL');


//connect to new parent

        $query=DB::unprepared('INSERT INTO treepaths (ancestor, descendant, depth)
  SELECT supertree.ancestor, subtree.descendant,
  supertree.depth+subtree.depth+1
  FROM treepaths AS supertree JOIN treepaths AS subtree
  WHERE subtree.ancestor ="'.$descendant.'"
  AND supertree.descendant ="'.$realparent.'"');


        $message='You you have changed the parent of '.$descendant.' from  '.$parentid.' to '.$realparent.' using '.$newansector.'</br>';

        echo $message;

    }


}
