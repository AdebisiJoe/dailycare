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
  <div class="box-body" id="">

   <div id="printable">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example ">
      <thead>
        <tr>
          <th>S/No</th>
          <th>stage</th>
          <th>total amount</th>



        </tr>
      </thead>
      <tbody>                               
              

       <tr>
         <td>1</td>
         <td>0</td> 
         <td>{!!$stagezerocash!!}</td> 
         
       </tr> 

       <tr>
         <td>2</td>
         <td>1</td> 
         <td>{!!$stageonecash!!}</td> 
         
       </tr> 


       <tr>
         <td>3</td>
         <td>2</td> 
         <td>{!!$stagetwocash!!}</td> 
         
       </tr> 

       <tr>
         <td>4</td>
         <td>3</td> 
         <td>{!!$stagethreecash!!}</td> 
       
       </tr> 

       <tr>
         <td>5</td>
         <td>4</td> 
         <td>{!!$stagefourcash!!}</td> 
         
       </tr> 


       <tr>
         <td>6</td>
         <td>5</td> 
         <td>{!!$stagefivecash!!}</td> 
        
       </tr>          

      
      </tbody>

        <tfoot>
          
          <tr>
            <td>
              Total
            </td>
            <td>
              
            </td>
            <td>
              {!!$totalcash!!}
            </td>
          </tr>
        </tfoot>
         

   </table>
   </div>

 

<button id="print" class="print btn btn-danger"> Send to printer</button>

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




















