@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit personal Information</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
        @foreach($records as $record)
        <form class="form-horizontal" method="POST" action="{{url('/editpersonalinfo')}}">
                      <div class="form-group"  >
                        <label for="inputName" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="firstname" id="inputName"  value="{{$record->firstname}}" placeholder="Enter Firstname" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Middle Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="middlename" id="inputEmail" value="{{$record->middlename}}" placeholder="Middle Name" required>
                        </div>
                      </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Date of Birth</label>
                <div class="col-sm-10">

                    <div class="input-group date" data-provide="datepicker">
                        <input type="text"  class="form-control" name="dob" id="inputdob" value="{{$record->dob}}" placeholder="Date of Birth" required>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>

            </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="lastname" id="inputName" value="{{$record->lastname}}" placeholder="Last Name" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Phone Number</label>
                        <div class="col-sm-10">
                          <input type="text"  class="form-control" name="phonenumber" id="inputExperience" value="{{$record->phonenumber}}" placeholder="Phone Number" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email"  class="form-control" name="email" value="<?php if (trim($record->email)!="0") {
                            # code...
                            echo $record->email;
                        } else {
                            # code...
                           
                        } ?>"
                          id="inputExperience" placeholder="Email"  required>
                        </div>
                      </div>


                        <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">country</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" id = "inputGroupCountry" onchange="loadState()"  name="country"></select>
                        </div>
                      </div>

            <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">

                    <select id="inputGroupState" value="<?php if (trim($record->state)!="0") {
                        # code...
                        echo $record->state;
                    } else {
                        # code...

                    } ?>" name="state" class="form-control"></select>

                </div>
            </div>

            <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">city</label>
                <div class="col-sm-10">
                    <input type="text" name="city" class="form-control"  value="<?php if (trim($record->city)!="0") {
                        # code...
                        echo $record->city;
                    } else {
                        # code...

                    } ?>" placeholder="city" required>
                </div>
            </div>



                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                         
                        <textarea name="address" class="form-control"  placeholder="Enter address" required><?php 
                         
                        if (trim($record->address)!="0") {
                            # code...
                            echo $record->address;
                        } else {
                            # code...
                         
                        }
                          ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>

     @endforeach

      </div>
    </div>
</section>

@endsection
@section('scripts')

    <script type="text/javascript" src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.js')}}"></script>

<script >
   $('#inputdob').datepicker();
</script>

    <script src="{{ asset('plugins/country_state/country_state.js') }}"></script>

    <script type="text/javascript">
        init('Nigeria','inputGroupCountry', 'inputGroupState');
        function loadState() {
            selectState('inputGroupCountry', 'inputGroupState');
        }
    </script>

@endsection


