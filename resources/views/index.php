<!DOCTYPE html>
<html lang="en-US" ng-app="employeeRecords">
    <head>
        <title>Laravel 5 AngularJS CRUD Example</title>

        <!-- Load Bootstrap CSS -->
    <link href="<?= asset('bootstrap/css/bootstrap.min.css')  ?>" rel="stylesheet">
            <!-- Bootstrap 3.3.5 -->
   <!-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">-->
    </head>
    <body>
        <h2>Employees Database</h2>
        <div  ng-controller="employeesController">

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Position</th>
                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New Employee</button></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="employee in employees">
                        <td>{{  employee.id }}</td>
                        <td>{{ employee.name }}</td>
                        <td>{{ employee.email }}</td>
                        <td>{{ employee.contact_number }}</td>
                        <td>{{ employee.position }}</td>
                        <td>
                            <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', employee.id)">Edit</button>
                            <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(employee.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{form_title}}</h4>
                        </div>
                        <div class="modal-body">
                            <form name="frmEmployees" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="{{name}}" 
                                        ng-model="employee.name" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.name.$invalid && frmEmployees.name.$touched">Name field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{email}}" 
                                        ng-model="employee.email" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{contact_number}}" 
                                        ng-model="employee.contact_number" ng-required="true">
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.contact_number.$invalid && frmEmployees.contact_number.$touched">Contact number field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Position</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="{{position}}" 
                                        ng-model="employee.position" ng-required="true">
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.position.$invalid && frmEmployees.position.$touched">Position field is required</span>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmEmployees.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="<?= asset('angular/angular.min.js') ?>"></script>
       <!-- <script src="{{asset('angular/angular.min.js')}}"></script>-->
         <!-- jQuery 2.1.4 -->
        <!--<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>-->
        <script src="<?= asset('plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
           <!-- Bootstrap 3.3.5 -->
       <!-- <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>-->
        <script src="<?= asset('bootstrap/js/bootstrap.min.js') ?>"></script>
        
        <!-- AngularJS Application Scripts -->
      <!--  <script src="{{ asset('angular/employee/app.js') }}"></script>-->
       <!-- <script src="{{ asset('angular/employee/employees.js') }}"></script>-->
      <script src="<?= asset('angular/employee/app.js') ?>"></script>
        <script src="<?= asset('angular/employee/employees.js') ?>"></script>
    </body>
</html>








   public function drawusertree($userid){
    $data='';
   // INSERT INTO `matrix_users`(`matrix_users_id`, `matrix_id`, `user_id`, `parentid`, `position`, `place`, `trpos`, `trchildrenp`, `tparent`, `children`, `stage`, `level`, `matrix_number`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])
   //INSERT INTO `member_table`(`id`, `membershipid`, `username`, `parentid`, `sponsorid`, `position`, `registrationpin`, `stage`, `children`, `firstname`, `lastname`, `phonenumber`, `sex`, `dob`, `country`, `state`, `city`, `address`, `nameofkin`, `nextofkinaddress`, `kinrelationship`, `phonenumberofkin`, `accountname`, `accountnumber`, `bankname`, `bankbranch`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26]) 
    $stage=$this->getuserstage($userid);
    $matrix_id=$this->getusermatrix($userid);
     $query = DB::table('matrix_users')
             ->where('matrix_id', '=',$matrix_id)
             ->where('trpos', '=',1)
             ->get();
       foreach ($query as $key => $v) {
         # code...
       $userid=$v->user_id;
       $trpos=$v->trpos;
       $results = DB::table('member_table')
            ->where('membershipid', '=',$userid)
            ->get();
     foreach ($results as $key => $v) {
         # code...
       $userid=$v->membershipid;
       $username=$v->username;
       $firstname=$v->firstname;
       $lastname=$v->lastname;
       $stage=$v->stage;
       }         
    $data.="<ul id='ul-data' style='display: none;'>
           <li id=''>".$username." ".$lastname."";
     $query = DB::table('matrix_users')
             ->where('matrix_id', '=',$matrix_id)
             ->where('tparent', '=',$trpos)
             ->get();   
    foreach ($query as $key => $v) {
       $userid=$v->user_id;
       $trpos=$v->trpos;
       if ($userid==null||$userid==0) {
         # code...
    $data.="<ul>
        <li id='0'>Empty</li>";
       } else {
         # code...
         $results = DB::table('member_table')
            ->where('membershipid', '=',$userid)
            ->get();
     foreach ($results as $key => $v) {
         # code...
       $userid=$v->membershipid;
       $username=$v->username;
       $firstname=$v->firstname;
       $lastname=$v->lastname;
       $stage=$v->stage;
   $data.="<ul id=''>
           <li id=''>".$username." ".$lastname."";

      
       }


       }

       $data.="</li>
    </ul>";
    
    }//second foreachloop   

    $data.="</li>
    </ul>";    
       }//first foreachloop

    
return $data;
   }




//fill a matrix based on the userid matrixtype and stage
public function fillmatrix($userid){
//$firstleftchild=$this->getfirstchild($userid,L);
//$firstrightchild=$this->getfirstchild($userid,R);
//$firstleftchildmembershipid=$firstleftchild['membershipid'];
//$firstrightchildmembershipid=$firstrightchild['membershipid'];
 $stage=$this->getuserstage($userid);
 
if ($stage==1) {
  # code...
$usercurrentleftmatrix=$this->getusercurrentleftmatrix($userid);
$usercurrentrightmatrix=$this->getusercurrentrightmatrix($userid);
$getusermatrix=$this->getusermatrix($userid);
//get all firstleft child children on same level as the person we want to fill his  matrix
//getfirstleft child id

$firstleftchild=$this->getfirstchild($userid,"L");
$firstleftchildmembershipid=$firstleftchild['membershipid'];
$queryleft=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.membershipid = t.descendant
WHERE m.stage >='.$stage.'
AND t.ancestor ='."'".$firstleftchildmembershipid."'".'
AND NOT EXISTS (
select user_id from matrix_users_left AS mr WHERE mr.user_id=m.membershipid AND matrix_id='.$getusermatrix.'
) LIMIT 3'
);
foreach ($queryleft as $key => $v) {
      echo $v->membershipid." ";

 $freeposition=$this->getmatrixleftfreeposition($getusermatrix);
 $parentid=$freeposition['parent'];
 $position=$freeposition['position'];
 $this->setparentleftmatrixchildren($parentid,$getusermatrix);   
   DB::table('matrix_users_left')->insert(
        ['matrix_id' =>$getusermatrix,'user_id'=>$v->membershipid,'parentid'=>$parentid,'position'=>$position,'children'=>0,'stage'=>$stage,'level'=>$stage,'matrix_number' => 0, ]
    );
  DB::table('matrix')
  ->where('matrix_id','=',$getusermatrix)
  ->increment('count_users',1);   
}
//get all firstleft child children on same level as the person we want to fill his  matrix
//getfirstright child id
$firstrightchild=$this->getfirstchild($userid,"R");
$firstrightchildmembershipid=$firstrightchild['membershipid'];
$queryright=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.membershipid = t.descendant
WHERE m.stage >='.$stage.'
AND t.ancestor ='."'".$firstrightchildmembershipid."'".'
AND NOT EXISTS (
select user_id from matrix_users_right AS mr WHERE mr.user_id=m.membershipid AND matrix_id='.$getusermatrix.'
) LIMIT 3'
);

foreach ($queryright as $key => $v) {
      echo $v->membershipid." ";
      

 $freeposition=$this->getmatrixrightfreeposition($getusermatrix);
 $parentid=$freeposition['parent'];
 $position=$freeposition['position'];
 $this->setparentrightmatrixchildren($parentid,$getusermatrix);   
   DB::table('matrix_users_right')->insert(
        ['matrix_id' =>$getusermatrix,'user_id'=>$v->membershipid,'parentid'=>$parentid,'position'=>$position,'children'=>0,'stage'=>$stage,'level'=>$stage,'matrix_number' => 0, ]
    );
  DB::table('matrix')
  ->where('matrix_id','=',$getusermatrix)
  ->increment('count_users',1); 
}

//get user stage
$stage=$this->getuserstage($userid);   
//get matrixid of user  
$matrixid=$this->getmatrixidofuser($userid,$stage);   
//fill matrix with returned values 
$leftmatrixnumber=$this->countusercurrentleftmatrix($userid);
$rightmatrixnumber=$this->countusercurrentrightmatrix($userid);
$expectednumberformatrix=$this->getmatrixusersexpectedcount($userid);

$this->closematrix($userid,$matrixid);

echo "we have filled the matrix";
} else {
  # code...
$usercurrentleftmatrix=$this->getusercurrentleftmatrix($userid);
$usercurrentrightmatrix=$this->getusercurrentrightmatrix($userid);
$getusermatrix=$this->getusermatrix($userid);
//get all firstleft child children on same level as the person we want to fill his  matrix
//getfirstleft child id
$firstleftchild=$this->getfirstchild($userid,"L");
$firstleftchildmembershipid=$firstleftchild['membershipid'];
$queryleft=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.membershipid = t.descendant
WHERE m.stage >='.$stage.'
AND t.ancestor ='."'".$firstleftchildmembershipid."'".'
AND NOT EXISTS (
select user_id from matrix_users_left AS mr WHERE mr.user_id=m.membershipid AND matrix_id='.$getusermatrix.'
) LIMIT 32'
);
foreach ($queryleft as $key => $v) {
      echo $v->membershipid." ";

 $freeposition=$this->getmatrixleftfreeposition($getusermatrix);
 $parentid=$freeposition['parent'];
 $position=$freeposition['position'];
 $this->setparentleftmatrixchildren($parentid,$getusermatrix);   
   DB::table('matrix_users_left')->insert(
        ['matrix_id' =>$getusermatrix,'user_id'=>$v->membershipid,'parentid'=>$parentid,'position'=>$position,'children'=>0,'stage'=>$stage,'level'=>$stage,'matrix_number' => 0, ]
    );
  DB::table('matrix')
  ->where('matrix_id','=',$getusermatrix)
  ->increment('count_users',1);   
}
//get all firstleft child children on same level as the person we want to fill his  matrix
//getfirstright child id
$firstrightchild=$this->getfirstchild($userid,"R");
$firstrightchildmembershipid=$firstrightchild['membershipid'];
$queryright=DB::select('SELECT m.*
FROM member_table AS m
JOIN treepaths AS t ON m.membershipid = t.descendant
WHERE m.stage >='.$stage.'
AND t.ancestor ='."'".$firstrightchildmembershipid."'".'
AND NOT EXISTS (
select user_id from matrix_users_right AS mr WHERE mr.user_id=m.membershipid AND matrix_id='.$getusermatrix.'
) LIMIT 32'
);

foreach ($queryright as $key => $v) {
      echo $v->membershipid." ";
      

 $freeposition=$this->getmatrixrightfreeposition($getusermatrix);
 $parentid=$freeposition['parent'];
 $position=$freeposition['position'];
 $this->setparentrightmatrixchildren($parentid,$getusermatrix);   
   DB::table('matrix_users_left')->insert(
        ['matrix_id' =>$getusermatrix,'user_id'=>$v->membershipid,'parentid'=>$parentid,'position'=>$position,'children'=>0,'stage'=>$stage,'level'=>$stage,'matrix_number' => 0, ]
    );
  DB::table('matrix')
  ->where('matrix_id','=',$getusermatrix)
  ->increment('count_users',1); 
}

//get user stage
$stage=$this->getuserstage($userid);   
//get matrixid of user  
$matrixid=$this->getmatrixidofuser($userid,$stage);   
//fill matrix with returned values 
$leftmatrixnumber=$this->countusercurrentleftmatrix($userid);
$rightmatrixnumber=$this->countusercurrentrightmatrix($userid);
$expectednumberformatrix=$this->getmatrixusersexpectedcount($userid);

$this->closematrix($userid,$matrixid);

echo "we have filled the matrix";
}


}