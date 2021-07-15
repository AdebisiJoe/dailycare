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

            </div>
            <!-- /.box-header -->
            <div class="box-body" >


                <form class="form-horizontal" method="POST" action="{{url('/subadminpinrequest')}}">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">No Of Pins</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="noofpins" name="noofpins" placeholder="No Of Pins" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Request Pins</button>
                        </div>
                    </div>
                </form>


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

        $(document).ready(function() {



        });
    </script>
    <script type="text/javascript">


        $(document).ready(function () {

            $("#print").click(function(){
                $("#printable").printMe(
                    { "path": ["{{ asset('bootstrap/css/bootstrap.min.css') }}"],
                        "title": "ACCOUNT DETAILS"
                    }

                );
            });



        });



    </script>

@endsection




















