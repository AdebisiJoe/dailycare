@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Bonuses and user stages</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        
         <!--/.personal box -->

        <div class = "box-body">
   <div> 
   <H4 style="text-align: center" >Qualified for stage 1 Bonuses</H4>  
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                      
                    
                       <h3 style="text-align:center;">Qualified with 2</h3>
                    

                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($qualifiedfor2 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           <td>{!!$stage->firstname!!}
           <td>{!!$stage->lastname!!}
         </tr>          
         @endforeach
         </tbody>
      </table>

    <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                    <thead>
                     <h3 style="text-align:center;">Qualified with 4</h3>
                      
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($qualifiedfor4 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           <td>{!!$stage->firstname!!}
           <td>{!!$stage->lastname!!}
         </tr>          
         @endforeach
         </tbody>
      </table>
 
    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                      
                     <h3 style="text-align:center;">Qualified with 6</h3>

                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($qualifiedfor6 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           <td>{!!$stage->firstname!!}
           <td>{!!$stage->lastname!!}
         </tr>          
         @endforeach
         </tbody>
      </table> 
   </div>

      <div style="margin-top:50px">
      <h4 style="text-align: center">User and their stages</h4>
          <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
             
                    <thead>
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($stage0 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           
         </tr>          
         @endforeach
         </tbody>
      </table> 


    <table class="table table-striped table-bordered table-hover" id="dataTables-example4">
                    <thead>
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($stage1 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
          
         </tr>          
         @endforeach
         </tbody>
      </table> 


    <table class="table table-striped table-bordered table-hover" id="dataTables-example5">
                    <thead>
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($stage2 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           
         </tr>          
         @endforeach
         </tbody>
      </table> 

                
    <table class="table table-striped table-bordered table-hover" id="dataTables-example6">
                    <thead>
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($stage3 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           
         </tr>          
         @endforeach
         </tbody>
      </table> 


    <table class="table table-striped table-bordered table-hover" id="dataTables-example7">
                    <thead>
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($stage4 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
           
         </tr>          
         @endforeach
         </tbody>
      </table> 


    <table class="table table-striped table-bordered table-hover" id="dataTables-example8">
                    <thead>
                        <tr>   
                            <th>Membership Id</th>
                            <th>Stage</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
     @foreach($stage5 as $stage)
         <tr>
           <td>{!!$stage->membershipid!!}</td>
           <td>{!!$stage->stage!!}</td> 
         </tr>          
         @endforeach
         </tbody>
      </table> 
      </div>
          
    

                            
        </div>
    
</section>

@endsection
@section('scripts')
<!-- The daterange picker bootstrap plugin -->

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

    $(document).ready(function () {
    $('#dataTables-example4').DataTable({
            responsive: true
        });
    });

    $(document).ready(function () {
    $('#dataTables-example5').DataTable({
            responsive: true
        });
    });
        $(document).ready(function () {
    $('#dataTables-example6').DataTable({
            responsive: true
        });
    });

    $(document).ready(function () {
    $('#dataTables-example7').DataTable({
            responsive: true
        });
    });

    $(document).ready(function () {
    $('#dataTables-example8').DataTable({
            responsive: true
        });
    });
</script>

@endsection
