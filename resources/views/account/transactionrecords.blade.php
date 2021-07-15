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
            <h3 class="box-title">Transactions</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Transaction Id</th>
                            <th>User Id</th>
                            <th>Type</th>

                            <th>Receiver Id</th>
                            <th>Amount</th>
                            <th>Time created</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
       @foreach($records as $record)
         <tr>
        
           <td>{!!$record->id!!}</td>
           <td>{!!$record->userid!!}</td>
           <td>{!!$record->type!!}</td> 
           <td>{!!$record->receiverid!!}</td> 
           <td>{!!$record->amount!!}</td> 
           <td>{!!$record->created_at!!}</td> 
         </tr>          
         @endforeach

                    </tbody>

                </table>

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


