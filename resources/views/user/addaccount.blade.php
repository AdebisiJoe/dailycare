@extends('layouts.app')

@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Add New Account</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">

     <form role = "form" class = "form-horizontal" id = "defaultForm" method = "post" action = "{{url('/addregistration')}}">
       <!--/.personal box -->

       <div class = "box-body">
         

        <div class="form-group">
          <div class = "col-md-2">
            <label for = "position">Position</label>
          </div>
          <div class="col-md-4">
            <select class="form-control sex" name="place" required>
              <option class="0" disabled="true" selected="true">--Position--</option>
              <option class="1" value="L">Left Leg</option>
              <option class="2" value="R">Right Leg</option>
            </select>
          </div>       
        </div>
        <div class = "form-group">
          <div class = "col-md-2">
            <label for = "Registrationpin">Registration Pin</label>
          </div>
          <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "Registrationpin" name ="registrationpin" placeholder = "Enter Registration Pin" required>
            
          </div>
          
        </div>

         <div class = "form-group">
            <div class = "col-md-2">
                <label for = "membershipid">Membership ID</label>
            </div>
            <div class = "col-md-4">
                <input type = "text" class = "form-control" id = "membershipid" name="membershipid" placeholder = "Enter Membership ID of the PIN" required>

            </div>

       </div>

        
        
        <div class = "form-group">
          
          <div class = "col-md-4">
            <button type="submit" class="btn btn-danger">Submit</button>   
            
          </div>
          
        </div>

      </div>
    </form>  
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
<script>
  $('button[type="submit"]').click(function() {
    var wH = $(document).height();
    $('#overlay').css({height: wH});
    $('#overlay').show();
  });
</script>
@endsection
