<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DB;

class Matrix extends Controller
{
    



public function create2($parentid,$childid){

 $query=DB::unprepared('INSERT INTO treepaths (ancestor, descendant,depth)
SELECT t.ancestor,'.$childid.',t.depth+1
FROM treepaths AS t
WHERE t.descendant ='.$parentid.'
UNION ALL
SELECT '. $childid.' ,'.$childid.',0');

if ($query==true){

return "inserted"; }

else {

return "not inserted";
 }    

    }

    public function create(){
     $result=$this->getfreeposition(1);

echo "Peter is " . $result['parent'] . " years old.";
    }
public function insert(){
    	
    	
    }
    public function update(){
    	
    }
    public function retrieve(){
    	
    }
    public function getfreeposition($parentid){
      
$query=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.username = t.descendant
WHERE t.ancestor =?',[$parentid]);

    
        //$results = DB::table('member_table')
                //->where('parentid', '=', $parentid)
                //->orderBy('position')
                //->get();
            foreach ($query as $key => $v) {
               echo $v->username;
              if($v->children==0){
              return ["parent" => $v->username,"position" =>"L"];
              break;
              }
              elseif($v->children==1){

              return ["parent" => $v->username,"position" =>"R"];

              break;
              }
             else{
                continue;
             }
      }
  

    }
}
