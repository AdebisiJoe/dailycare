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
        <form class="form-horizontal" method="POST" action="{{url('/editbankinfo')}}">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Account Number</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="accountnumber"
                          value="<?php 
                         
                        if (trim($record->accountnumber)!="0") {
                            # code...
                            echo $record->accountnumber;
                        } else {
                            # code...
                         
                        }
                          ?>" placeholder="Account Number" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Account Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail" value="<?php 
                         
                        if (trim($record->accountname)!="0") {
                            # code...
                            echo $record->accountname;
                        } else {
                            # code...
                         
                        }
                          ?>" name="accountname" placeholder="Account Name" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Bank Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" value="<?php 
                         
                        if (trim($record->bankname)!="0") {
                            # code...
                            echo $record->bankname;
                        } else {
                            # code...
                         
                        }
                          ?>" name="bankname" placeholder="Bank Name" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Bank Branch</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputExperience" value="<?php 
                         
                        if (trim($record->bankbranch)!="0") {
                            # code...
                            echo $record->bankbranch;
                        } else {
                            # code...
                         
                        }
                          ?>" name="bankbranch" placeholder="Bank Branch" required>
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



@endsection


