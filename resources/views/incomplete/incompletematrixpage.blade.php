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
    <div class="box box-default hidden-print">
        <div class="box-header with-border">
            <h3 class="box-title">Duplicate Report</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          
        <div class="form-group">
    <input type="text" name="" class="form-control" id="incompletematrixstage">      
        </div> 
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="button" class="btn btn-success pull-left" onclick="generateReport()"><i class="fa fa-save"></i>&nbsp;<span id="spinner">Generate Report</span></button>
          <button type="button" class="btn btn-warning pull-right" onclick="printReport('reportForm')"><i class="fa fa-print"></i>&nbsp;Print Report</button>
        </div>
        <!-- /.box-footer -->
    </div>

    <div id="reportForm"></div>
</section>

<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

<script type="text/javascript">
  function generateReport()
  {
       // Check If Fields are empty
    var incompletematrixstage = $('#incompletematrixstage').val();
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

    $.ajax({
        type:"POST",
        url:"{!!URL::route('incompletematrix')!!}",
        dataType:'json',
        data:{'incompletematrixstage':incompletematrixstage},
      beforeSend: function() {
        $('#spinner').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> generating list...');

      },
      complete: function() {
        $('#spinner').html('Generate Report');
      },
      success: function(data) {
        console.log(data);
        $('#reportForm').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
</script>