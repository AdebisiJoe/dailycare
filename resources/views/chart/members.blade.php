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
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">
    

      


           <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
    
     @foreach($members as $member)
         <tr>
           
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->firstname!!}</td>
           <td>{!!$member->lastname!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>

<h1>members to the right leg</h1>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
    
     @foreach($firstrightchildmembers as $member)
         <tr>
           
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->firstname!!}</td>
           <td>{!!$member->lastname!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>
                

<h1>members on the left leg</h1>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
    
     @foreach($firstleftchildmembers  as $member)
         <tr>
           
           <td>{!!$member->membershipid!!}</td>
           <td>{!!$member->username!!}</td> 
           <td>{!!$member->firstname!!}</td>
           <td>{!!$member->lastname!!}</td>

         </tr>          
         @endforeach 


                     

                    </tbody>

                </table>        

 
          <div id="chart-container" >
              {!!$data!!}
          </div>
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
<script type="text/javascript">
//var  data="{!!URL::route('jsonfortree')!!}";

     //$('#chart-container').orgchart({
    
      //'data' :data ,
      //'depth': 2,
      //'nodeContent': 'name'
   // });
 //var baseurl = window.location.origin+window.location.pathname;
 //var baseurl = window.location.origin+window.location;
 //var baseurl=location.protocol + "//" + location.hostname;
function getRootUrl() {
  // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   //indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
//return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') +'/';
  
  return window.location.origin;
}
var baseurl=getRootUrl();

    $('#chart-container').orgchart({
     
      'data' : $('#ul-data'),
      //'nodeContent':'stage',
      'exportButton': true,
      'exportFilename': 'My Downlines',
    
      'createNode': function($node, data) {
    //id_arr = $("li").attr('id');
      
        value = data.id.split("_");
        var img=value[0];
        var username=value[1];
        var firstname=value[2];
        var lastname=value[3];
        var empty="empty";
        if (username==empty) {
          /*$node.children('.title').html('<img src="http://localhost:800/mywebsites/laravel%20MLM/public/imgavatar/' +img+ '.jpg" widht="50%" height="50%">');*/

          $node.children('.title').html('<img src="{{url('/')}}/imgavatar/' +img+ '.jpg" widht="50%" height="50%">');
        } else {
          /*$node.children('.title').html('<p style="">'+firstname+' '+lastname+'</p><p style="">'+username+'</p><img src="http://localhost:800/mywebsites/laravel%20MLM/public/imgavatar/' + img+ '.jpg" widht="50%" height="50%">');*/
          $node.children('.title').html('<p style="">'+firstname+' '+lastname+'</p><p style="">'+username+'</p><img src="{{url('/')}}/imgavatar/' + img+ '.jpg" widht="50%" height="50%">');
        }
       
      
        
         
         // $node.children('.title').append('<img src="http://localhost:800/mywebsites/laravel%20MLM/public/imgavatar/' + data.id + '.jpg" widht="100%" height="100%">');
      }




    });

   // $('#btn-export-hier').on('click', function() {
     // if (!$('pre').length) {
       // var hierarchy = $('#chart-container').orgchart('getHierarchy');
        //$('#btn-export-hier').after('<pre>').next().append(JSON.stringify(hierarchy, null, 2));
     // }
   // });

//  });  
</script>

@endsection



