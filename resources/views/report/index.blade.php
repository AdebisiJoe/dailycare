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

    function confirmDelete(delUrl){
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this item!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: true
        },
        function(){
            document.location = delUrl;
        });
    }

    function performSearch() {
      //Get The ID'd
      var userid = $('#userid').val();
      var criteria =$('#criteria').val();

      //Perform specific actions on input
      var url="{{url('/')}}/fetch-result";
      var formdata={mem_id:userid};
      var myList;

        $.ajax({
          type:"POST",
          url:url,
          data:formdata,
          dataType:'json',
          success:function(data){
              // var trList;
              // var tdList;
            // console.log(data);
            for (var i = 0; i < data.length; i++){
                var obj = data[i];
                  for (var key in obj){
                      $('#searchList').append("<li>" + obj[key] + "</li>");
                      // console.log(attrName);
                      // var attrValue = obj[key];
                      // console.log(attrValue);
                  }
            }

            // jQuery.each(data, function(i, val) {
            //   $("#" + i).append(document.createTextNode(" - " + val));
            // });
              // $("#thespan").remove();
          }
      });

    }
</script>

<script src="{{ asset('plugins/country_state/country_state.js') }}"></script>

<script type="text/javascript">
      init('Nigeria','inputGroupCountry', 'inputGroupState');
       function loadState() {
           selectState('inputGroupCountry', 'inputGroupState');
       }
</script>

@endsection



