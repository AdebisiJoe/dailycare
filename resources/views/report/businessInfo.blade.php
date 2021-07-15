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
              <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <th>S/N</th>
                    <th>Registration ID</th>
                    <th>Type of Acct</th>
                    <th>Owner of Acct</th>
                    <th>No of Sub Accts</th>
                    <th>Stage</th>
                    <th>Date Joined</th>
                  </thead>
                  <tbody>
                      <?php $i = 0; ?>
                    @foreach ($results as $result)
                      <tr>
                        <td><?= ++$i; ?></td>
                        <td>{{ $result->membershipid }}</td>
                        <td>{{ $result->type }}</td>
                        <td>{{ $result->isownedby }}</td>
                        <td>{{ $result->numberofsubaccounts }}</td>
                        <td>{{ $result->stage }}</td>
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

@endsection



