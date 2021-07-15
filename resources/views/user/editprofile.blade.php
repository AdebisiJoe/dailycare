@extends('layouts.app')

@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Profile</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      @foreach($records as $record)
       <form role = "form" class ='form-horizontal' id = "defaultForm" method = "post" action = "{{url('/editprofile')}}">

      <input type = "hidden" class = "form-control" id = "parentid" name = "idforuser" placeholder = "" value="{{$record->idforuser}}" >
      <input type = "hidden" class = "form-control" id = "parentid" name = "idformember" placeholder = "" value="{{$record->idformember}}" >
      <div class = "form-group">
      <div class="col-md-2">
         <label for = "firstname">First Name</label>
      </div>
      
    
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "firstname" name = "firstname" value="{{$record->firstname}}" >
      </div>
    </div>
    <div class = "form-group">
         <div class="col-md-2">
            <label for = "middlename">Middle Name</label>
         </div>
       
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "middlename" name = "middlename" value="{{$record->middlename}}" >
      </div>
    </div>
    <div class = "form-group">
        
         <div class="col-md-2">
           <label for = "lastame">Last Name</label>
         </div>
        
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "lastname" name = "lastname" value="{{$record->lastname}}" >
      </div>
    </div>
    <div class = "form-group">
      
         <div class="col-md-2">
          <label for = "lastame">Date of Birth</label> 
         </div>
        
      
      <div class= "col-md-4">
        <div class = "input-group date" data-provide = "datepicker">
          <input type = "text" value="{{$record->dob}}" class = "form-control" name="dob">
          <div class = "input-group-addon">
            <span class = "glyphicon glyphicon-th"></span>
          </div>
        </div>
      </div>
    </div>

    <div class = "form-group">
      
         <div class="col-md-2">
          <label for = "email">Email address</label> 
         </div>
        
      
      <div class = "col-md-4">
        <input type = "email" class = "form-control" id = "email" name = "email" value="{{$record->email}}" placeholder = "Enter email">
      </div>
    </div>

    <div class = "form-group">
        
         <div class="col-md-2">
           <label for = "phonenumber">Phone Number</label>
         </div>
        
     
      <div class = "col-md-4">
        <input type = "phonenumber" class = "form-control" id = "phonenumber" name = "phonenumber" value="{{$record->bankname}}" placeholder = "Enter Phone Number">
      </div>
    </div>

    <div class = "form-group">
      
         <div class="col-md-2">
          <label for = "state">State</label> 
         </div>
        
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "state" value="{{$record->state}}" name = "state" placeholder = "Enter state">
      </div>
    </div>
    <div class = "form-group">
      
         <div class="col-md-2">
           <label for = "address">City</label>
         </div>
        
      
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "address" name = "city" value="{{$record->city}}" placeholder = "Enter City">
      </div>
    </div>

    <div class = "form-group">
       
         <div class="col-md-2">
          <label for = "address">Address</label> 
         </div>
        
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "address" name = "address" value="{{$record->address}}" placeholder = "Enter address">
      </div>
    </div>


    <div class = "form-group">
       
         <div class="col-md-2">
          <label for = "password">Old Password</label>
         </div>
        
   
      <div class = "col-md-4">
        <input type = "password" class = "form-control" id = "password" name = "oldpassword" value="" placeholder = "Enter password" required>
      </div>
    </div>
    <div class = "form-group">
        
         <div class="col-md-2">
           <label for = "password2">New Password</label> 
         </div>
       
   
      <div class = "col-md-4">
        <input type = "password" class = "form-control" id = "password2" name = "password" value="" placeholder = "Confirm password" required>
      </div>
    </div>

    <div class = "form-group">
      
         <div class="col-md-2">
           <label for = "transactionpass">Old Transaction Password</label>
         </div>
        
      
      <div class = "col-md-4">
        <input type = "password" class = "form-control" id = "transactionpass" name = "oldtransactionpass" value="" placeholder = "Enter Transaction password" required>
      </div>
    </div>

    <div class = "form-group">
        
         <div class="col-md-2">
           <label for = "transactionpass">New Transaction Password</label>
         </div>
        
     
      <div class = "col-md-4">
        <input type = "password" class = "form-control" id = "transactionpass2" name = "transactionpass" value="" placeholder = "Conf Transaction password" required>
      </div>
    </div>



    <div class = "form-group">
      
         <div class="col-md-2">
           <label for = "accountname">Account Name</label>
         </div>
        
   
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "accountname" name = "accountname" value="{{$record->accountname}}" placeholder = "Enter Account Name">
      </div>
    </div>
    <div class = "form-group">
      
         <div class="col-md-2">
          <label for = "accountnumber">Account Number</label> 
         </div>
        
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "accountnumber" name = "accountnumber" value="{{$record->accountnumber}}" placeholder = "Enter Account Number" >
      </div>
    </div>

    <div class = "form-group">
      
         <div class="col-md-2">
           <label for = "bankbranch">Bank Name</label>
         </div>
        
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "bankbranch" name = "bankname" value="{{$record->bankname}}" placeholder = "Enter Bank Name">
      </div>
    </div>

    <div class = "form-group">
      
         <div class="col-md-2">
            <label for = "accountnumber">Branch Name</label>
         </div>
       
     
      <div class = "col-md-4">
        <input type = "text" class = "form-control" id = "accountnumber" name = "bankbranch" value="{{$record->bankbranch}}" placeholder = "Enter Branch">
      </div>
    </div>





    <button type = "submit" class = "btn btn-success">Update</button>

  </form>
  @endforeach
</div><!-- /.box-body -->
</div><!-- /.box -->

</div>
</div>
</section>
@endsection
@section('scripts')
<!-- The daterange picker bootstrap plugin -->

<script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script> 
<script src="{{ asset('plugins/daterangepicker/sugar.min.js') }}"></script> 

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> 

<script src="{{ asset('plugins/daterangepicker/raphael.js') }}"></script> 

<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/morrischarthelp.js') }}"></script> 
@endsection
