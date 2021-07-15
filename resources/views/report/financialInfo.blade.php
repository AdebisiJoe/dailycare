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
    @include('report.search')
    <div class="box box-default">
      <div class="box-header with-border">
          <h3 class="box-title">Reports</h3>
      </div><!-- /.box-header -->
      <div class="box-body table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example">
                  <thead>
                    <th>S/N</th>
                    <th>Registration ID</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>Food Cash</th>
                    <th>Payout Cash</th>
                    <th>Date Joined</th>
                  </thead>
                  <tbody>
                      <?php $i = 0; ?>
                    @foreach ($results as $result)
                      <tr>
                        <td><?= ++$i; ?></td>
                        <td>{{ $result->membershipid }}</td>
                        <td>{{ $result->bankname }}</td>
                        <td>{{ $result->accountnumber }}</td>
                        <td>{{ $result->foodcash }}</td>
                        <td>{{ $result->payoutcash }}</td>
                        <td>{{ $result->joindate }}</td>
                      </tr> 
                    @endforeach
                    
                  </tbody>
              </table>
              <ul class="pagination">
                <?php echo $results->render(); ?>
              </ul>
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
    </script>
@endsection



