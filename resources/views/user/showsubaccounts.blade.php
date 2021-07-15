@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Your Sub Accounts</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        
         <!--/.personal box -->

        <div class = "box-body">
    @if($results==null)
       <H1>You have no sub account under your main account</H1>
    @else
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                           
                            <th>Membership Id</th>
                            <th>Stage</th>

                            <th>Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
     @foreach($results as $result)
         <tr>  
           <td>{!!$result->membershipid!!}</td>
           <td>{!!$result->stage!!}</td> 
           <td><a class="btn btn-success" href="{{url('/subaccount')}}/{!!$result->membershipid!!}">View Downlines</a>
           </td>
         </tr>          
    @endforeach
         </tbody>

      </table>                
      @endif  
                            
        </div>
    
</section>

@endsection
@section('scripts')
<!-- The daterange picker bootstrap plugin -->
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
@endsection
