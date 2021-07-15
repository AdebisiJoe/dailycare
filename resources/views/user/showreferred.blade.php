@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Accounts Referred</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->

            <!--/.personal box -->

            <div class = "box-body">
             @if($sponsor==null)
                    <H1>You have no referred account</H1>
               @else
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>



                        </tr>
                        </thead>
                        <tbody>


                       @foreach($sponsor as $sponsors)
                            <tr>
                                <td>{{$sponsors->username}}</td>
                                <td>{{$sponsors->firstname}}</td>
                                <td>{{$sponsors->lastname}}</td>

                            </tr>
                      @endforeach
                        </tbody>

                    </table>
              @endif

            </div>
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
