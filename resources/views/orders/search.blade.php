@extends('layouts.app')
@section('stylesheet')
        <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">    

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

@endsection
@section('content')

 <section class="content">
  <div class="box box-default">

      <div class="box-header with-border">
          <h3 class="box-title">Search Criteria</h3>
      </div>

      <div class="box-body">
        <form action="/get-orders" method="get">
          <div class="row">
            
            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid">Date From</label>
                <input type="text" class="form-control" name="date_from" value="{{ old('date_from') }}" placeholder="<?= date('d-m-Y'); ?>" >
              </div>
            </div>
            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid">Date To</label>
                <input type="text" class="form-control" name="date_to" value="{{ old('date_to') }}"" placeholder="<?= date('d-m-Y'); ?>" >
              </div>
            </div>
            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid"></label>
                <select name="" id="input" class="form-control" >
                  <option value="0" selected>Customers</option>
                  <option value="1">Quantity</option>
                </select>
              </div>
            </div>

            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid">&nbsp;</label>
                <input type="submit" value="Search" class="form-control btn btn-success" >
              </div>
            </div>
          </div>      
        </form>
     
      </div>
  </div>
    <div class="box box-default">

      <div class="box-header with-border">
          <h3 class="box-title">Results</h3>
      </div>

      <div class="box-body">
        <form action="" method="get">
          <div class="row">
            
            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid">Date From</label>
                <input type="text" class="form-control" name="date_from" value="{{ old('date_from') }}" placeholder="<?= date('Y-m-d'); ?>" >
              </div>
            </div>
            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid">Date To</label>
                <input type="text" class="form-control" name="date_to" value="{{ old('date_to') }}"" placeholder="<?= date('Y-m-d'); ?>" >
              </div>
            </div>
            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid"></label>
                <select name="" id="input" class="form-control" >
                  <option value="0" selected>Customers</option>
                  <option value="1">Quantity</option>
                </select>
              </div>
            </div>

            <div class="col-md-3 col-lg-3">
              <div class="form-group">
                <label for="userid">&nbsp;</label>
                <input type="submit" value="Search" class="form-control btn btn-success" >
              </div>
            </div>
          </div>      
        </form>
     
      </div>
  </div>
</section>

@endsection
@section('scripts')
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

    function confirmDelete(delUrl){
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this item!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: true
        },
        function(){
            document.location = delUrl;
        });
    }

    function performSearch() {
      //Get The ID'd
      var userid = $('#userid').val();
      var criteria =$('#criteria').val();

      //Perform specific actions on input
      var url="{{url('/')}}/fetch-result";
      var formdata={mem_id:userid};
      var myList;

        $.ajax({
          type:"POST",
          url:url,
          data:formdata,
          dataType:'json',
          success:function(data){
              // var trList;
              // var tdList;
            // console.log(data);
            for (var i = 0; i < data.length; i++){
                var obj = data[i];
                  for (var key in obj){
                      $('#searchList').append("<li>" + obj[key] + "</li>");
                      // console.log(attrName);
                      // var attrValue = obj[key];
                      // console.log(attrValue);
                  }
            }

            // jQuery.each(data, function(i, val) {
            //   $("#" + i).append(document.createTextNode(" - " + val));
            // });
              // $("#thespan").remove();
          }
      });

    }
</script>

@endsection



