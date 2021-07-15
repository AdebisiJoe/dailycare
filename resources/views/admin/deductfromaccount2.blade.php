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
 <form class="form-horizontal">
  <div class="form-group">
    <div class="col-md-2">
    <label for="membershipid">Membership Id</label>
    </div>
    <div class="col-md-6">
    <input type="text" name="membershipid" class="form-control" id="membershipid" placeholder="Enter Membership id">
    </div>
  </div>
  <div class="form-group">
  <div class="col-md-2">
    <label for="name">Name</label>
  </div>  
  <div class="col-md-6">
    <input type="text" class="form-control" id="name" placeholder="">
 </div>
  </div>
    <div class="form-group">
    <div class="col-md-2">
    <label for="accountdetails">Account balance</label>
    </div>
    <div class="col-md-6">
    <input type="text" class="form-control" id="accountdetails" placeholder="">
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
$(document).on('focus','.membershipid',function(){
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
      $('#accountdetails').val(ui.item.pid);
    }           
  });

}); 
  
</script>

@endsection