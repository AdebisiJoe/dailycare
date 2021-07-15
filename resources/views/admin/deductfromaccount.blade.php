@extends('layouts.app')

@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Deduct from Account</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->

    <!--/.personal box -->

    <div class = "box-body">
     <form class="form-horizontal" method="post" action="{!!URL::route('processdeduct')!!}">
      <div class="form-group">
        <div class="col-md-2">
          <label for="membershipid">Membership Id</label>
        </div>
        <div class="col-md-6">
          <input type="text" name="membershipid" class="form-control" id="membershipid" placeholder="Enter Membership id" required>
        </div>
      </div>

      <div class="form-group">
          <div class = "col-md-2">
            <label for = "position">Select Action</label>
          </div>
          <div class="col-md-6">
            <select class="form-control " name="action" required>
              <option class="0" disabled="true" selected="true">--Select Action--</option>
              <option class="1" value="1">Increment</option>
              <option class="2" value="2">Decrement</option>
            </select>
          </div>       
        </div>

      <div class="form-group">
        <div class="col-md-2">
          <label for="accountdetails">Account to deduct in feed the nations Dollars</label>
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" name="amount" id="accountdetails" placeholder="Enter Amount to deduct in dollars" required>
        </div>
      </div>

      


      <button type="submit" class="btn btn-default">Process</button>
    </form>

  </div>

</section>

@endsection
@section('scripts')
<!-- The daterange picker bootstrap plugin -->

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $('#dataTables-example').DataTable({
      responsive: true
    });
  });
  $(document).ready(function () {
    $('#dataTables-example1').DataTable({
      responsive: true
    });
  });
 //autocomplete script
/*$(document).on('focus','.membershipid',function(){
  type = $(this).data('type');
  
  //if(type =='productCode')autoTypeNo=0;
  //if(type =='productName')autoTypeNo=1; 

  id_arr = $(this).attr('id');
  id = id_arr.split("_");
  
  $(this).autocomplete({
    source: '{!!URL::route('getautocompletemembershipid')!!}',       
    minLength: 1,
    autoFocus: true, 
    select: function( event, ui ) {
        
      $('#name').val(ui.item.name);
      $('#accountdetails').val(ui.item.price);
    }           
  });

});*/ 

</script>

@endsection