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
            <h3 class="box-title">Notifications</h3>
            <div class="box-tools pull-right">
            <a href="/create-notification" class="btn btn-info"><i class="fa fa-new"></i>&nbsp;New Notification</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>S/No</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i = 0; ?>
                   @foreach($results as $prod)
                   <tr>
                     <td><?= ++$i; ?></td>
                     <td>{!!$prod->title!!}</td> 
                     <td>{!!$prod->content!!}</td> 
                     <td>
                        @if ($prod->published == 0)
                          <option value="0">No</option>                        
                        @else
                          <option value="1">Yes</option>                        
                        @endif
                     </td> 
                     <td>
                        <a href="/edit-notification/{!!$prod->id!!}" title="Edit" class="btn btn-primary"><span class="fa fa-edit"></span>&nbsp;Edit</a>
                        <a onclick="return confirm('Are You Sure Want to Delete?');" href="/delete-notification/{!!$prod->id!!}" title="Delete" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;Delete</a>
                     </td>
                   </tr>          
                   @endforeach

                </tbody>
            </table>
        
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


                  
               
                            
