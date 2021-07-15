@extends('layouts.app')
@section('stylesheet')
<!-- DataTables CSS -->
<link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<!-- DataTables Responsive CSS -->
<link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
<style type="text/css">
  /*@media all {
    .page-break { display: none; }
  }*/

  @media print {
    .page-break { display: block; page-break-before: always; }
  }
</style>
@endsection
@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Food Collection Reports @if (isset($user_id)) For Sub Account: @endif {{$user_id or '' }}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="collectionHistory" class="display text-center" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>S/N</th>
                      <th>Order Date</th>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th>Amount</th>
                  </tr>
              </thead>
          </table>
        </div>
    </div>

</section>

<!-- <meta name="_token" content="{!! csrf_token() !!}" /> -->
@endsection

@section('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/moment.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>


<script type="text/javascript">
$(function() {
    $('#collectionHistory').DataTable( {
        "ajax": '{{ url("/")}}/food-collection/get_food_history'
    } );

    // getGroups();
});
</script>

<script type="text/javascript">
    // function getGroups() {
    //   $.ajax({
    //       type:"GET",
    //       url:'{{ url("/")}}/food-collection/get_food_history',
    //       success:function(data){
    //           //Load Collection History
    //           var data = data;
    //           $('#collectionHistory').DataTable( {
    //               "data": data
    //           } );
    //       }
    //   });  
    // }
</script>
@endsection
