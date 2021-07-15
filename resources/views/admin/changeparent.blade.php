@extends('layouts.app')
@section('stylesheet')
<!-- DataTables CSS -->
<link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">

    </div>
    <!-- /.box-header -->
    <div class="box-body" >


      <form class="form-horizontal" method="POST" action="{{url('/changeparent')}}">
  <!--<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">parent</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="ansector" name="ansector" placeholder="Parent">
    </div
  </div>-->
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">New parent</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="newansector" name="newansector" placeholder="New Ansector Membership ID" required>
    </div>
  </div>

  <div class="form-group">

    <label class = "col-sm-2 control-label" for = "position">Position</label>

    <div class="col-sm-10">
      <select class="form-control" name="place" required>
        <option class="0" disabled="true" selected="true">--Position--</option>
        <option class="1" value="L">Left Leg</option>
        <option class="2" value="R">Right Leg</option>
      </select>
    </div>       
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Child</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="" name="descendant" placeholder="Child Membership ID" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Change parent</button>
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

  $(document).ready(function() {



  });
</script>
<script type="text/javascript">


  $(document).ready(function () {

    $("#print").click(function(){
      $("#printable").printMe(
        { "path": ["{{ asset('bootstrap/css/bootstrap.min.css') }}"],
        "title": "ACCOUNT DETAILS"
      }

      );
    });



  });



</script>

@endsection                   




















