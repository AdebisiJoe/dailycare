
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
    <div class = "col-md-12">
        <div class = "nav-tabs-custom">
            <ul class = "nav nav-tabs">
                <li class = "active"><a href = "#home" data-toggle = "tab">Database functions</a></li>
                <li><a href = "#generatepins" data-toggle = "tab">Generate Pins</a></li>
                <li><a href = "#printpins" data-toggle = "tab">Print Pins</a></li>
                <li><a href = "#recoverpins" data-toggle = "tab">Recover Pins</a></li>
                <li><a href = "#settings" data-toggle = "tab"></a></li>
                <li><a href = "#setactivecountries" data-toggle = "tab">Set Active Country </a></li>
            </ul>
            <div class = "tab-content">
                <div class = "active tab-pane" id = "home">
                    <!--Post -->
                    <div class="row">
                     <div class="col-md-6">
                         <h3>Truncate Tables</h3>
                         <a  href="{{url('/truncatetables')}}" class="btn btn-danger">Truncate Tables</a>
                     </div>
                     <div class="col-md-6">
                         <h3>Backup Database</h3>
                         <a  href="{{url('/backuptables')}}" class="btn btn-success">Backup Database</a>
                     </div>
                 </div>



             </div><!--/.tab-pane -->

             <div class = "tab-pane" id ="generatepins">

                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                         <form class="form-horizontal" method="POST" action="{{url('/generatepin')}}">

                                 <!--<div class="form-group">
                                 <div class="col-md-3">
                                    <label for = "">Account Type</label> 
                                 </div>
                                 <div class="col-md-6">
                                  <<select id="registernum" name="registernum" class="form-control">
                                   <option value="1">1</option>
                                   <option value="3">3</option>
                                   <option value="7">7</option>
                                  </select>  
                                 </div>
                                 </div>-->
                              
                                
                                 <div class="form-group">
                                 <div class="col-md-3">
                                   <label for="exampleInputEmail1">Number of pins to Generate</label>  
                                 </div>
                                 <div class="col-md-6">
                                   <input type="text" class="form-control" id="inputnumber" name="inputnumber"  placeholder="Enter Number of Pins to Generate">  
                                 </div>
                                  
                                   
                                 </div>
                               

                                 <div class="form-group">
                                  <div class="col-md-6">
                                    <button style="margin-top:15px" type="submit" id="submit" class="btn btn-danger">Generate Pin</button>  
                                  </div>
                                     
                                 </div>
                                 

                               
                         </form> 

                        <!--<div class="col-md-4" style="margin-top:20px">
                           <span   id="pinvalue"></span>    
                       </div>-->


                   </div>
               </div>
           </div>
       </div><!--/.tab-pane -->

     <div class = "tab-pane" id ="printpins">
      
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Number of pins to Print</label>
                                <input type="text" class="form-control" id="inputnumber2" placeholder="Enter Number of Pins to Print">
                            </div>

                           <!-- <div class = "col-md-6">
                                <label for = "">Account Type</label>

                                
                                <select id="registernum2" name="registernum" class="form-control">
                                   <option value="1">1</option>
                                   <option value="3">3</option>
                                   <option value="7">7</option>
                               </select>

                           </div>-->


                           <div class="col-md-12">
                             <button style="margin-top:15px" type="submit2" id="submit2" class="btn btn-danger">Print Pin</button>

                         </div>                                         
                         <div class="col-md-offset-2 col-md-8" style="margin-top:20px">
                           <div   id="printable">
                               <span id="pinvalue2">
                                   
                               </span>
                           </div> 
                           <div class="col-md-12" id="toprint">
                             <button id="print" class="print btn btn-danger"> Send to printer</button>
                           </div>
                           
  
                       </div>


                   </div>
               </div>
           </div>


    </div><!--/.tab-pane -->
    <div class = "tab-pane" id ="recoverpins">



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



    $(document).ready(function() {
        /*$("#submit").click(function (e) {
            //var formdata={email:$("input#InputEmail").val(),accounttype:$("select#registernum").val()};
            var formdata={number:$("#inputnumber").val(),accounttype:$("#registernum").val()};

            $("#pinvalue").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url:"{!!URL::route('generatepin')!!}",
                data:formdata,
                dataType:'json',
                success:function(data){
            //$("#user-result").html(data); 
            console.log(data);
            //var json =JSON.parse(data); 
            var json=data;

            var pin= json.pin;
            $("#pinvalue").html(pin); 




        }
    }
    );      


        }); */

        $("#submit2").click(function (e) {
            //var formdata={email:$("input#InputEmail").val(),accounttype:$("select#registernum").val()};
            $("#pinvalue2").empty(); 
            var formdata={number:$("#inputnumber2").val(),accounttype:$("#registernum2").val()};

            $("#pinvalue").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url:"{!!URL::route('printpins')!!}",
                data:formdata,
                dataType:'json',
                success:function(data){
            //$("#user-result").html(data); 
            console.log(data);
            
             /*jQuery.each(data, function(index, item) {
            //now you can access properties using dot notation
                   
               //$(data[index].pin).appendTo("#pinvalue2");

             $("#pinvalue2").append("<table class='table'><tbody>");  
          $("#pinvalue2").append("<td>"+data[index].pin+" </td>");
               //$("#pinvalue2").append("<br/>");
             $("#pinvalue2").append("</td></tbody></table>");
            });*/

                          var i = 0;
              var table = '<br/>';
                 table +=(' <table class="table">');
          table +=('<thead>');

          table += ('</thead>');
          table += ('<tbody>');                  
          //data = $.parseJSON(data)

               
            
            $.each(data, function (index, item) {  
          table += ('<tr style="font-size:25px;font-weight: bold;">');
          table += ('<th>SERIAL NO</th>');
          table += ('<th>MEMBERSHIP ID</th> ');
          table += ('<th>PIN</th>');
          table += ('</tr>');
          table += ('</tr>');
          table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].id + '</td>');
        table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].membershipid+ '</td>');
          table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].pin + '</td>');
            table += ('</tr>');

                              
                              });
            table += ('</tbody>');
            table += ('</table>');                


 
      
    
    
  



                        $("#pinvalue2").html(table);






             
        }
    }
    );      


        }); 
        
    });
</script>



<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script> 
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

</script> 

<script type="text/javascript">


    $(document).ready(function () {

        $("#print").click(function(){
            $("#printable").printMe(
                { "path": ["{{ asset('bootstrap/css/bootstrap.min.css') }}"],
                    "title": "REGISTRATION PINS"
                 }

                );
        });



    });



</script>
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
