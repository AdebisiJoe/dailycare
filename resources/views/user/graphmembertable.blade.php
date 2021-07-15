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
                <h3 class="box-title">Downlines</h3>
                <h2>Showing only 100 downlines per page. <small>Click on previous 100 or next 100 button to view more.</small></h2>

                <div>  
                    <!--<ul class="pagination no-margin pull-left">-->
                        @if($take < 2)
                            <a class="btn btn-danger" href="{{ url('showmemberstablegraph/1/100') }}"> « Previous 100 </a>
                        @else
                            <a class="btn btn-danger" href="{{ url('showmemberstablegraph/' . ($take - 1) . '/100') }}"> « Previous 100 </a>
                        @endif
                        
                        @if($take == 0)
                            <a class="btn btn-success"  href="{{ url('showmemberstablegraph/' . ($take + 2) . '/100') }}"> Next 100 »</a>
                        @else
                            <a class="btn btn-success"  href="{{ url('showmemberstablegraph/' . ($take + 1) . '/100') }}"> Next 100 »</a>
                        @endif
                    <!--</ul>-->
                </div>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">

                <h1>members to the left leg</h1>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                    <tr>
                        <th>MembershipId</th>
                        <th>Username</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($firstrightchildmembers as $member)
                        <tr>

                            <td>{!!$member->membershipid!!}</td>
                            <td>{!!$member->username!!}</td>
                            

                        </tr>
                    @endforeach




                    </tbody>

                </table>
                <div class="pagination"> </div>

                <h1>members to the right leg</h1>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                    <thead>
                    <tr>
                        <th>MembershipId</th>
                        <th>Username</th>
                        

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($firstleftchildmembers  as $member)
                        <tr>

                            <td>{!!$member->membershipid!!}</td>
                            <td>{!!$member->username!!}</td>
                            

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
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        $(document).ready(function () {
            $('#dataTables-example2').DataTable({
                responsive: true
            });
        });
        $(document).ready(function () {
            $('#dataTables-example3').DataTable({
                responsive: true
            });
        });
    </script>
@endsection