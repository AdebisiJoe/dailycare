@extends('webview.webviewlayout')

@section('stylesheet')
    <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('chart_dist/css/jquery.orgchart.css') }}" rel="stylesheet">
@endsection
@section('content')

            <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">








                <div id="chart-container" >
                    {!!$data!!}
                </div>

            </div>


@endsection
@section('scripts')

    <script type="text/javascript" src="{{ asset('chart_dist/js/html2canvas.min.js') }}"></script>


    <script type="text/javascript" src="{{ asset('chart_dist/js/jquery.orgchart.js') }}"></script>

    <script type="text/javascript">
        //var  data="{!!URL::route('jsonfortree')!!}";




        $('#chart-container').orgchart({

            'data' : $('#ul-data'),
            //'nodeContent':'stage',
            'exportButton': true,
            'exportFilename': 'My Downlines',

            'createNode': function($node, data) {
                //id_arr = $("li").attr('id');

                value = data.id.split("_");
                var img = value[0];
                var username = value[1];
                var firstname = value[2];
                var lastname = value[3];
                var empty = "empty";
                if (username == empty) {


                    $node.children('.title').html('<img src="{{url('/')}}/imgavatar/' + img + '.jpg" widht="50%" height="50%">');
                } else {

                    $node.children('.title').html('<p id="name" style="">' + firstname + ' ' + lastname + '</p><p id="username" style="">' + username + '</p><img src="{{url('/')}}/imgavatar/' + img + '.jpg" widht="50%" height="50%">');
                }

                {{--var secondMenuIcon = $('<i>', {--}}
                    {{--'class': 'fa fa-info-circle second-menu-icon',--}}
                    {{--click: function () {--}}
                        {{--$(this).siblings('.second-menu').toggle();--}}
                    {{--}--}}
                {{--});--}}
                {{--var secondMenu = '<div class="second-menu"><img class="avatar" src="{{url('/')}}/imgavatar/' + img + '.jpg"></div>';--}}
                {{--$node.append(secondMenuIcon).append(secondMenu);--}}


            }




        });





    </script>
    <script>
        $('#popoverOption').popover({ trigger: "hover" });
    </script>



@endsection


