@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Group</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">All Groups</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Create Group</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Owner ID <i class="loader"></th>
                <th>Group Name <i class="loader"></th>
                <th>Action <i class="loader"></th>
              </tr>      
            </thead>
            <tbody id="list-of-groups">
              
            </tbody>
          </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <div class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputOwnerID" class="col-sm-2 control-label">Owner ID </label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputOwnerID" placeholder="Owner ID">
                </div>
              </div>
              <div class="form-group">
                <label for="inputGroupName" class="col-sm-2 control-label">Group Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputGroupName" placeholder="Group Name">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="button" data-loading-text="Creating Group" data-done-text="Group Created" data-reset-text="Create Group" class="btn btn-success pull-right" onclick="createGroup()"><i class="fa fa-save"></i>&nbsp;<span id="spinner">Create Group</span></button>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>

   </div>
 </div>
</section>

@endsection
@section('scripts')
<script type="text/javascript">

  $(document).ready(function(){

    $('.loader').addClass("fa fa-spinner fa-spin fa-1x fa-fw");

    $.ajax({
      url: '{{ url("/")}}/food-collection/groups/list',
      type: 'get',
      dataType: 'html',
      complete: function() {
        $('.loader').removeClass("fa fa-spinner fa-spin fa-1x fa-fw");
      },
      success: function(data) {
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });


  function createGroup() {
    // Check If Fields are empty
    var ownerID = $('#inputOwnerID').val();
    var groupName = $('#inputGroupName').val();

    $.ajax({
      url: '{{ url("/")}}/food-collection/groups/save',
      type: 'get',
      data: 'owner_id=' + ownerID + '&group_name=' + groupName,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Creating Group...');

      },
      complete: function() {
        $('#spinner').html('Create Group');
      },
      success: function(data) {
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function deleteGroup(id) {
    $.ajax({
      url: '{{ url("/")}}/food-collection/groups/delete',
      type: 'post',
      data: 
      {
          "_token": "{{ csrf_token() }}",
          "id": id,
      },
      dataType: 'html',
      beforeSend: function() {
        $('#delete' + id).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
      },
      success: function(data) {
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function updateGroup(id) {
    var value = $('#' + id).text();

    $.ajax({
      url: '{{ url("/")}}/food-collection/groups/update',
      type: 'post',
      data: 
      {
          "_token": "{{ csrf_token() }}",
          "value": value,
          "id": id,
      },
      dataType: 'html',
      beforeSend: function() {
        $('#delete' + id).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
      },
      success: function(data) {
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
</script>
@endsection


