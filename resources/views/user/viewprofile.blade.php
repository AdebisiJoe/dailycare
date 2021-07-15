@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">profile</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            @foreach($records as $record)
            <!-- Profile Image -->
            <div class="box box-danger">
                <div class="box-body box-profile">

                    <div class="row">
                       <div class="col-md-12">
                        <h3>Personal Information</h3>
                        <hr>
                        <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                                <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/profileimage.jpg')}}" alt="User profile picture">
                                <form>
                                 <!-- <input id="fileUpload" type="file" value="change picture" /> --> 
                              </form>  
                          </div>
                      </div>
                      
                      <h3 class="profile-username text-center">{{$record->lastname}} {{$record->middlename}} {{$record->firstname}}</h3>
                      <p class="text-muted text-center">{{$record->membershipid}}</p>

                      <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                          <b>Email</b> <a class="pull-right"><?php 

                          if (trim($record->email)!="0") {
                            # code...
                            echo $record->email;
                        } else {
                            # code...
                          echo 'please update this';
                      }
                      ?></a>
                  </li>

                  <li class="list-group-item">
                      <b>Phone Number</b> <a class="pull-right">{{$record->phonenumber}}</a>
                  </li>
                  <li class="list-group-item">
                      <b>Date of Birth</b> <a class="pull-right">{{$record->dob}}</a>
                  </li>
                  <li class="list-group-item">
                      <b>State</b> <a class="pull-right">{{$record->state}}</a>
                  </li>
                  <li class="list-group-item">
                      <b>Country</b> <a class="pull-right"><?php 

                      if (trim($record->country)!="0") {
                            # code...
                        echo $record->country;
                    } else {
                            # code...
                      echo 'please update this';
                  }
                  ?></a>
              </li>
              <li class="list-group-item">
                  <b>Address</b> <a class="pull-right"><?php 

                  if (trim($record->address)!="0") {
                            # code...
                    echo $record->address;
                } else {
                            # code...
                  echo 'please update this';
              }
              ?></a>
          </li>

      </ul>
  </div>
  <div class="col-md-4">
   <a href="{{url('/editpersonalinfo')}}" class="btn btn-danger">Edit personal information</a>
</div>

<div class="col-md-4">
   <a href="{{url('/changepassword')}}" class="btn btn-danger">Edit Password information</a>
</div>

<div class="col-md-4">
   <a href="{{url('/changewalletpassword')}}" class="btn btn-danger">Edit Wallet Password</a>
</div>


<hr>
<div class="col-md-12">
 <h3>Bank Information</h3>


 <ul class="list-group list-group-unbordered">
    <li class="list-group-item">
      <b>Account Name</b> <a class="pull-right"><?php 

      if (trim($record->accountname)!="0") {
                            # code...
        echo $record->accountname;
    } else {
                            # code...
      echo 'please update this';
  }
  ?></a>
</li>
<li class="list-group-item">
  <b>Account Number</b> <a class="pull-right">{{$record->accountnumber}}</a>
</li>
<li class="list-group-item">
  <b>Bank Name</b> <a class="pull-right"><?php 

  if (trim($record->bankname)!="0") {
                            # code...
    echo $record->bankname;
} else {
                            # code...
  echo 'please update this';
}
?></a>
</li>

<li class="list-group-item">
  <b>Bank Branch</b> <a class="pull-right"><?php 

  if (trim($record->bankbranch)!="0") {
                            # code...
    echo $record->bankbranch;
} else {
                            # code...
  echo 'please update this';
}
?></a>
</li>

</ul>
</div>

<div class="col-md-4">
  <a href="{{url('/editbankinfo')}}" class="btn btn-danger">Edit Bank information</a>
</div>

<hr>





</div>
</div><!-- /.box-body -->
</div><!-- /.box -->

@endforeach
</div>
</div>
</section>

@endsection
@section('scripts')



@endsection


