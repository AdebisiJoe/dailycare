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
            <h3 class="box-title">New Notification</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        
          <form class="form-horizontal" method="post" action="{{ url('/store-notification') }}">
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name1">Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="title" placeholder="Notification Title" id="input-name1" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description1">Content</label>
                    <div class="col-sm-10">
                      <textarea name="content" placeholder="Notification Content" id="input-description1" class="form-control summernote"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-title1">Want to publish</label>
                    <div class="col-sm-10">
                      <select name="published" id="inputPublished" class="form-control" required="required">
                        <option value="-1">---Select Option---</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                   <div class="col-md-2"></div>
                   <div class="col-md-10 ">
                   <button type="submit" class="btn btn-success clear-fix" >Create Notification</button>
                   </div>
                  </div>
</form>


             
          
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
</script>

@endsection


                  
               
                            
