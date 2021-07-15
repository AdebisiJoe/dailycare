
@extends('layouts.app')
@section('stylesheet')
        <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')

<section class="content">
   <div class="row">
    <div class = "col-md-11">
        <div class = "nav-tabs-custom">
            <ul class = "nav nav-tabs">
                <li class = "active"><a href = "#home" data-toggle = "tab">Register first User</a></li>
                <li><a href = "#messages" data-toggle = "tab">Database Settings</a></li>
                <li><a href = "#settings" data-toggle = "tab">Mail Setting</a></li>
                <li><a href = "#setactivecountries" data-toggle = "tab">Set Active Country </a></li>
            </ul>
            <div class = "tab-content">
                <div class = "active tab-pane" id = "home">
                    <!--Post -->
                   <div class="container">
                       <div class="row">
                           <div class="col-md-6">
                               <h3>Truncate Tables</h3>
                           </div>
                           <div class="col-md-6">
                               <h3>Backup Database</h3>
                           </div>
                       </div>
                   </div> 


                </div><!--/.tab-pane -->

                <div class = "tab-pane" id = "settings">

                </div><!--/.tab-pane -->
                <div class = "tab-pane" id = "setactivecountries">



                </div><!--/.tab-pane -->
            </div><!--/.tab-content -->
        </div><!--/.nav-tabs-custom -->
    </div><!--/.col -->
   </div>

</section>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('scripts')


<script type = "text/javascript">
    //Initialize Select2 Elements
    $(".select2").select2();

    var i = $('table tr').length;

    $(".addmore").on('click', function () {
        html = '<tr>';
        html += ' <td> <input type="text" name="levelname[]" id="levelname_' + i + '" class="form-control"   ></td>';
        html += '<td><input type="text"  name="level[]" data-type="productName" id="level_' + i + '" class="form-control"></td>';
        html += '<td><input type="text" name="dowlines[]" id="dowlines_' + i + '" class="form-control" onkeypress="return IsNumeric(event);" ></td>';
        html += '<td><input type = "text" name = "stage[]" data-type = "productName" id = "stage_' + i + '"  class = "form-control"></td>';
        html += '<td><input type="text" name="bonus[]" id="bonus_' + i + '" class="form-control" onkeypress="return IsNumeric(event);" ></td>';
        html += '<td><a class="btn btn-danger remove"><i class="fa fa-remove"></i></a></td>';
        html += '</tr>';
        $('table').append(html);
        i++;
    });

    $(document).on('click', '.remove', function () {
        var r = confirm("are you sure you want to remove this bonus ?")
        if (r == true) {
            $(this).parent().parent().remove();
        } else {

        }



    });

    $(document).ready(function() {
    $("#username").keyup(function (e) {
    
        //removes spaces from username
        $(this).val($(this).val().replace(/\s/g, ''));
        
        var username = $(this).val();
        if(username.length <= 4){
            $("#user-result").html('');
            return;
    }
       
        if(username.length >= 4){
            $("#user-result").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        type:"POST",
        url:"{!!URL::route('availableusername')!!}",
        dataType:'json',
        data:{'username':username},
        success:function(data){
            //$("#user-result").html(data); 
            console.log(data);
            //var json =JSON.parse(data); 
            var json=data;
            if ( json.availability === "available" ) {
     $("#user-result").html("Available <img src='{{asset('images/availableimg/available.png') }}'/>"); 
            }else{
    $("#user-result").html("Not-Available <img src='{{asset('images/availableimg/not-available.png') }}'/>");   
            }
        }

    });



















        }
    }); 
});


</script> 
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script> 
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
