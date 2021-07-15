@extends('layouts.app')
@section('stylesheet')
<!-- DataTables CSS -->
<link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

@endsection
@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Good's Collection</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
              <div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Goods Collection</a></li>
    
    <li role="presentation"><a href="#log" aria-controls="log" role="tab" data-toggle="tab">Check Log</a></li>
  
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home" style="margin-top:30px">
             <div class="row">
          <div class="col-md-12">
            <div class="form-group" id="username">
                <div class = "col-md-1">
                    <label for = "refferer">User ID</label>
                </div>
                <div class = "col-md-6">
                    <input type = "text" class = "form-control" id = "userid" name = "reffererid"  placeholder = "Enter User ID" required>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class = "form-group">
                <div class = "col-md-1">
                </div>
                <div class = "col-md-6">
                    <h3><span id="cus_name"></span>&nbsp;
                    <span id="cus_foodcash"></span>&nbsp;
                    <span id="cus_regpack"></span>&nbsp;</h3>
                </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div class = "form-group">
                <div class = "col-md-1">
                </div>
                <div class = "col-md-6" id="subAccountList">

                </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div class = "form-group">
                <div class = "col-md-1">
                    <label for = "amountdeduct">Amount</label>
                </div>
                <div class = "col-md-6">
                      <input type = "text" class = "form-control" onkeypress="return numbersonly(event);" id = "amountdeduct" name = "amountdeduct" placeholder = "Enter Amount" value="0" required>
                </div>
                <div class = "col-md-3">
                    <span id="amountdeductindicator"></span>
                </div>
            </div>
            
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div class = "form-group">
                <div class = "col-md-1">
                </div>
                <div class = "col-md-6">
                    <button class="btn btn-success" type="button" onclick="makePayment()">Make Payment</button>
                </div>
                <div class = "col-md-3">
                </div>
            </div>
            
          </div>
        </div>   

    </div>
    <div role="tabpanel" class="tab-pane" id="log" style="margin-top:30px">
         
        <div class="row">
          <div class="col-md-12">
            <div class="form-group" id="username">
                <div class = "col-md-1">
                    <label for = "refferer">User ID</label>
                </div>
                <div class = "col-md-6">
                    <input type = "text" class = "form-control" id = "userid2" name = "userid2"  placeholder = "Enter User ID" required>
                </div>
                
                <div>
                    <button id="checklog" class="btn btn-danger">Show log</button>
                </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12" id="showlog">
            


          
          </div>
        </div>


    </div>
  
  </div>

</div>
        </div>
    </div>


</section><meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script type="text/javascript">
                                $(document).ready(function () {

                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": true,
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "3000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                    
                $( "#userid" ).bind( "focus keyup", function(e) {

                    //removes spaces from username
                    $(this).val($(this).val().replace(/\s/g, ''));

                    resetResult();
                    var username = $(this).val();
                    if(username.length <= 4){
                        $("#user-result").html('');
                        return;
                    }

                    if(username.length >= 4){
                        $("#useridindicator").empty().html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type:"POST",
                            url:"{!!URL::route('getAvailableAmount')!!}",
                            dataType:'json',
                            data:{'username':username},
                            success:function(data){
                                $('#userid').tooltip('destroy');
                                if(data != false){
                                    if (data[4].dateDiff <= 0) {
                                        $("#username").addClass("has-error has-feedback");
                                        $("#userid").attr({'data-toggle':"tooltip",'data-placement':"right", title:"This user is not qualified: late registration"});
                                        $('#userid').tooltip('show');
                                        $("#cus_name").empty().text(data[2].results[0].firstname.toUpperCase() + ' ' + data[2].results[0].middlename.toUpperCase() + ' ' + data[2].results[0].lastname.toUpperCase() + ' - ' + data[2].results[0].username).addClass("label label-info");
                                        var amount = data[3].foodcash;

                                        $("#cus_foodcash").empty().text('₦' + amount ).addClass("label label-warning");
                                        $("#subAccountList").empty();
  
                                    }else{

                                        if (data[0].hasSubAccounts == true) {
                                            $("#subAccountList").empty();
                                            $("#username").removeClass("has-error has-feedback");
                                            $("#userid").removeAttr("data-toggle data-placement title");
                                            $('#userid').tooltip('destroy');
                                            var i = 0;
                                            jQuery.each(data[1].subAccounts, function () {

                                                if(parseInt(data[2].results[0].stage) == 0){

                                                    // $("#amountdeduct").attr("disabled");
                                                    $("#username").addClass("has-error has-feedback");
                                                    $("#userid").attr({'data-toggle':"tooltip",'data-placement':"right", title:"This user is not qualified"});
                                                    $('#userid').tooltip('show');                                      
                                                }else{
                                                     $("#username").removeClass("has-error has-feedback");
                                                    $("#userid").removeAttr("data-toggle data-placement title");
                                                    $('#userid').tooltip('destroy');
                                                }
                                                if (data[1].subAccounts[i].regpack == 1) {
                                                    if (data[1].subAccounts[i].stage > 0) {
                                                        $("#subAccountList").append("<label><input type='checkbox' disabled checked id='subaccid"+i+"' value='" + data[1].subAccounts[i].userid +"'>  " + data[1].subAccounts[i].userid + "&nbsp;&dash;&nbsp;Collected Registration Pack&nbsp;&nbsp;</label><span class='label label-success'><i class='fa fa-check'></i>&nbsp;" + data[1].subAccounts[i].foodcash + "</span><br>");
                                                    }else{
                                                        $("#subAccountList").append("<label><input type='checkbox' disabled checked id='subaccid"+i+"' value='" + data[1].subAccounts[i].userid +"'>  " + data[1].subAccounts[i].userid + "&nbsp;&dash;&nbsp;Collected Registration Pack&nbsp;&nbsp;</label><span class='label label-danger'><i class='fa fa-ban'></i>&nbsp;" + data[1].subAccounts[i].foodcash + "</span><br>");
                                                    }
                                                }else{
                                                    if (data[1].subAccounts[i].stage > 0) {
                                                        $("#subAccountList").append("<label><input name='regpack_mgmt' type='checkbox' id='subaccid"+i+"' value='" + data[1].subAccounts[i].userid + "'>  "+ data[1].subAccounts[i].userid + "&nbsp;&dash;&nbsp;Not Collected Registration Pack&nbsp;&nbsp;</label><span class='label label-success'><i class='fa fa-check'></i>&nbsp;" + data[1].subAccounts[i].foodcash + "</span><br>");
                                                    }else{
                                                        $("#subAccountList").append("<label><input name='regpack_mgmt' type='checkbox' id='subaccid"+i+"' value='" + data[1].subAccounts[i].userid + "'>  "+ data[1].subAccounts[i].userid + "&nbsp;&dash;&nbsp;Not Collected Registration Pack&nbsp;&nbsp;</label><span class='label label-danger'><i class='fa fa-ban'></i>&nbsp;" + data[1].subAccounts[i].foodcash + "</span><br>");
                                                    }
                                                }
                                                i++;
                                            });
                                            if(data[2].results[0].regpack == 1){
                                                $("#subAccountList").append("<label><input disabled checked type='checkbox' id='subaccid"+i+"' value='" + data[2].results[0].userid +"'>  "+ data[2].results[0].userid + "&nbsp;&dash;&nbsp;Collected Registration Pack</label><br>");
                                            }else{
                                                $("#subAccountList").append("<label><input name='regpack_mgmt' type='checkbox' id='subaccid"+i+"' value='" + data[2].results[0].userid +"'>  "+ data[2].results[0].userid + "&nbsp;&dash;&nbsp;Not Collected Registration Pack</label><br>");
                                            }
                                        }else{
                                            $("#subAccountList").empty();
                                            $("#username").removeClass("has-error has-feedback");
                                            $("#userid").removeAttr("data-toggle data-placement title");
                                            $('#userid').tooltip('destroy');

                                            if(parseInt(data[2].results[0].stage) == 0){

                                                // $("#amountdeduct").attr("disabled");
                                                $("#username").addClass("has-error has-feedback");
                                                $("#userid").attr({'data-toggle':"tooltip",'data-placement':"right", title:"This user is not qualified"});
                                                $('#userid').tooltip('show');

                                                if(data[2].results[0].regpack == 0){
                                                    $("#cus_regpack").empty();
                                                    $("#subAccountList").append("<label><input name='regpack_mgmt' type='checkbox' id='subaccid"+i+"' value='" + data[2].results[0].userid + "'>  "+ data[2].results[0].userid + "&nbsp;&dash;&nbsp;Not Collected Registration Pack</label><br>");
                                                }else{
                                                    // $("#amountdeduct").removeAttr('disabled');
                                                    $("#cus_regpack").empty();
                                                    $("#subAccountList").append("<label><input type='checkbox' disabled checked id='subaccid"+i+"'  value='" + data[2].results[0].userid + "'>  "+ data[2].results[0].userid + "&nbsp;&dash;&nbsp;Collected Registration Pack</label><br>");

                                                }                                        
                                            }else{

                                                if(data[2].results[0].regpack == 0){
                                                    $("#cus_regpack").empty();
                                                    $("#subAccountList").append("<label><input name='regpack_mgmt' type='checkbox' id='subaccid"+i+"' value='" + data[2].results[0].userid + "'>  "+ data[2].results[0].userid + "&nbsp;&dash;&nbsp;Not Collected Registration Pack</label><br>");
                                                }else{
                                                    $("#cus_regpack").empty();
                                                    $("#subAccountList").append("<label><input type='checkbox' disabled checked id='subaccid"+i+"' value='" + data[2].results[0].userid + "'>  "+ data[2].results[0].userid + "&nbsp;&dash;&nbsp;Collected Registration Pack</label><br>");

                                                }                                        
                                            }
                                        }
                                        $("#cus_name").empty().text(data[2].results[0].firstname.toUpperCase() + ' ' + data[2].results[0].middlename.toUpperCase() + ' ' + data[2].results[0].lastname.toUpperCase() + ' - ' + data[2].results[0].username).addClass("label label-info");
                                        var amount = data[3].foodcash;
                                        var paycash = data[5].paycash;

                                        $("#cus_foodcash").empty().text('Food: ₦' + amount + '  Pay: ₦' + paycash + '  Total: ₦' + (amount + paycash)).addClass("label label-warning");
                                    } // CHECK THE DATE OF REGISTRATION
                                }else{

                                    $("#subAccountList").empty();
                                    $("#username").removeClass("has-error has-feedback");
                                    $("#userid").removeAttr("data-toggle data-placement title");
                                    $('#userid').tooltip('destroy');

                                    resetResult();    
                                }
                            }
                        });    
                    }
                }); 

                                });

                                function numbersonly(e) {
                                    var unicode = e.charCode ? e.charCode : e.keyCode
                                    if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
                                        if (unicode < 48 || unicode > 57)
                                            return false
                                    }
                                }

                                function makePayment() {
                                    var username = $('#userid').val();
                                    var amount = $('#amountdeduct').val();

                                    var collectedRegPack = [];
                                    $.each($("input[name='regpack_mgmt']:checked"), function () {
                                        collectedRegPack.push($(this).val());
                                    });


                                    var result = confirm('Are you sure?');
                                    if (result) {
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            type: "POST",
                                            url: "{!!URL::route('setNewAmount')!!}",
                                            dataType: 'json', data: {'username': username, 'amount': amount, 'collectedRegPack': collectedRegPack},
                                            success: function (data) {
                                                resetResult();
                                                $('#amountdeduct').val("");
                                                $("#userid").focus();
                                                $("#userid").select();
                                                toastr["success"]("Information", "Last operation was successful")
                                            }
                                        });
                                    } else {
                                        return false;
                                    }
                                }

                                function resetResult() {
                                    $("#cus_regpack").empty();
                                    $("#cus_name").empty();
                                    $("#cus_foodcash").empty();
                                }
</script>


<script type="text/javascript">
        $(document).ready(function() {


        $("#checklog").click(function (e) {
  
            $("#showlog").empty(); 
            var formdata={userid:$("#userid2").val()};

            $("#showlog").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url:"{!!URL::route('getcollectionlog')!!}",
                data:formdata,
                dataType:'json',
                success:function(data){

            console.log(data);
            
  

                          var i = 0;
              var table = '<br/>';
                 table +=(' <table class="table">');
          table +=('<thead>');

          table += ('</thead>');
          table += ('<tbody>');                  
          //data = $.parseJSON(data)
 
  table += ('<tr style="font-size:25px;font-weight: bold;">');
          table += ('<th>USER ID</th>');
          table += ('<th>PREVIOUS AMOUNT</th> ');
          table += ('<th>AMOUNT DEDUCTED</th>');
          table += ('<th>TRANSACTION DATE</th>');
          table += ('</tr>');
          table += ('</tr>'); 
            
            $.each(data, function (index, item) {  
        
          table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].user_id + '</td>');
        table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].prev_amount+ '</td>');
          table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].amount_deducted*200 + '</td>');
        table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].trans_date + '</td>');
            table += ('</tr>');

                              
                              });
            table += ('</tbody>');
            table += ('</table>');                

      $("#showlog").html(table);
     
        }
    }
    );      


        }); 
        
    });

</script>

@endsection
