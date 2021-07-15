@extends('layouts.app')
@section('stylesheet')
        <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('chart_dist/css/jquery.orgchart.css') }}" rel="stylesheet">
@endsection
@section('content')
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Resistrations under {{$membershipid}}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Username</th>
                            <th>MembershipID</th>
                            <th>Date joined</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($members as $member)
         <tr>
            <td>{!!$member->serialnumber!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->joindate!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>



 
         <!-- <button id="btn-export-hier" class="btn btn-success" >Get Hire</button>-->
        </div>
    </div>
</section>

@endsection
@section('scripts')

 <script type="text/javascript" src="{{ asset('chart_dist/js/html2canvas.min.js') }}"></script>   
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
 <script type="text/javascript" src="{{ asset('chart_dist/js/jquery.orgchart.js') }}"></script>   
<script>
    // $(document).ready(function () {
    //     $('#dataTables-example').DataTable({
    //         responsive: true
    //     });
    // });
    // $(document).ready(function () {
    //     $('#dataTables-example2').DataTable({
    //         responsive: true
    //     });
    // });
    //     $(document).ready(function () {
    //     $('#dataTables-example3').DataTable({
    //         responsive: true
    //     });
    // });
</script>
@endsection



