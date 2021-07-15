<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class DetectIncompleteMatrix extends Controller
{
    //

    public function __construct()
    {
      $this->middleware('auth');
    }

   public function detectincompletematrix(Request $request)
    {
    $stage=$request->incompletematrixstage;
    /*$stageMatrices= DB::table('matrix')
    ->where('type_id','=',$stage)
    ->get();*/

    $stageMatrices=DB::select('SELECT matrix_id , COUNT(matrix_id) c FROM matrix_users GROUP BY `matrix_id` HAVING c<15 AND NOT EXISTS (
            select matrix_id from matrix AS mr WHERE mr.type_id='.$stage.'
            )');
    /*$html = '';
     $html .= '<div class="box box-default page-break"><div class="box-header with-border">
            <h3 class="box-title">

            </h3>
            </div><div class="box-body">';

     $html.='<table class="table table-striped table-bordered">';    
     $html.="<table>
   <tr>
    <th>Ownerid</th>
    <th>count</th> 
    <th>Date Created</th>
   </tr>";*//*
    foreach ($stageMatrices as  $value)
     {
     $usercount= DB::table('matrix_users')
    ->where('matrix_id','=',$value->matrix_id)
    ->count();

    

    DB::select('SELECT matrix_id , COUNT(matrix_id) c FROM matrix_users GROUP BY `matrix_id` HAVING c<15')


     if ($usercount>15) 
     {
    // $html.="<tr>
     //<td>".$value->ownerid."</td>
    //<td>".$usercount."</td> 
    //<td>".$value->created_at."</td> 
     //</tr>";

     }

     }*/
//$html .= '</table><div class="text-center"></div>';
//$html .= '</div></div>';

     //echo $html;

  return   json_encode($stageMatrices);
}


public function showIncompleteMatrixPage()
{
	return view('incomplete.incompletematrixpage');
}


}