@extends('website3.layouts.app')

@section('content')
<div class="ms-hero-page-override ms-hero-img-reg ms-bg-fixed ms-hero-bg-dark-light">
    <div class="container">
      <div class="text-center">
        <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Registration</h1>
        <p class="lead lead-lg color-light text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Welcome to Join our community<br>
          <span class="color-info" style="text-transform: lowercase;">... a community of happy people</span></p>
      </div>
    </div>
</div>
    <div class="container">
        <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
            <div class="card-block">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">New Registration</div>
                            <div class="panel-body">
                                <form role="form" class="form-horizontal" id="defaultForm" method="post" action="{{url('/saveregister')}}">
                      
                      <div class="panel panel-warning">
                          <div class="panel-heading">Sponsor and parent Information</div>
                          <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="refferer">Sponsor ID</label>
                                </div>
                                <div class="col-md-6">
                                    <input data-toggle="tooltip" data-placement="top" title="This person gets the referral Bonus" type="text" class="form-control" id="sponsorid" name="reffererid" value="{{old('reffererid')}}"  placeholder="Enter Refferer ID" required>
                                </div>
                                <div class="col-md-4">
                                <span id="sponsoridindicator"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="parentid">Parent ID</label>
                                </div>
                                <div class="col-md-6">
                                <input data-toggle="tooltip" data-placement="top" title="This is the person you want to place your registration under" type="text" class="form-control" id="parentid" name="parentid" value="{{old('parentid')}}" placeholder="Enter parent ID" required>

                                </div>
                                <div class="col-md-4">
                                <span id="parentidindicator"></span>
                                </div>
                            </div>

                           <div class="form-group">
            <div class = "col-md-4">
                <label for = "position">Position</label>
            </div>
            <div class="col-md-6">
                <select  class="form-control " name="place" data-toggle="tooltip" data-placement="top" title="Place your downline on the leg you want" required>
                    <option class="0" disabled="true" selected="true">--Position--</option>
                    <option class="1" value="L" @if (old('place') == 'L') selected="selected" @endif>Left Leg</option>
                    <option class="2" value="R" @if (old('place') == 'R') selected="selected" @endif>Right Leg</option>
                </select>
            </div>       
        </div>

                            <input  type = "hidden" class = "form-control"  name = "role" placeholder = "" value="user" required>



                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="membershipid">Membership ID</label>
                                </div>
                                <div class="col-md-6">
                                    <input data-toggle="tooltip" data-placement="top" title="Enter membership ID of the pin" type="text" class="form-control" id="membershipid" name ="membershipid" value="{{old('membershipid')}}"  placeholder="Enter Membership ID of pin" required>

                                </div>
                            </div>

                               <div class="form-group">
                                <div class="col-md-4">
                                    <label for="Registrationpin">Registration Pin</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="Registrationpin" name="registrationpin" value="{{old('registrationpin')}}" placeholder="Enter Registration Pin" required>

                                </div>

                           </div> 

                       


                          </div>
                        </div>


                        <div class="panel panel-warning">
                            <div class="panel-heading">Personal Information</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="firstname">First Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}" placeholder="Enter first Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="middlename">Middle Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="middle" name="middlename" value="{{old('middlename')}}" placeholder ="Enter Middle Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="lastname">Last Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}" placeholder="Enter Lastname" required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="lastame">Date of Birth</label>
                                    </div>
                                    <div class= "col-md-6">
                                        <div class="input-group date" data-provide="datepicker">
                                            <input type="text" class="form-control" id="datepicker" name="dob" value="{{old('dob')}}">
                                            <div class="input-group-addon" required>
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                        <small>example: 30/10/1914</small>
                                    </div>
                                </div>
                                <div class="form-group">
        <div class = "col-md-4">
            <label for = "lastame">Gender</label>
        </div>
        <div class="col-md-6">
            <select class="form-control sex" name="sex" required>
                <option class="0" disabled="true" selected="true">--Gender--</option>
                <option class="1" value="male" @if (old('sex') == 'male') selected="selected" @endif>Male</option>
                <option class="2" value="female" @if (old('sex') == 'female') selected="selected" @endif>Female</option>
            </select>
        </div>       
    </div>
                                 <div class = "form-group">
        <div class = "col-md-4">
            <label for = "email">Email address</label>
        </div>
        <div class = "col-md-6">
            <input type = "email" class = "form-control" id = "email" name = "email" value="{{old('email')}}" placeholder = "Enter email" required>
        </div>
    </div>

                                <div class = "form-group">
        <div class = "col-md-4">
            <label for = "phonenumber">Phone Number</label>
        </div>
        <div class = "col-md-6">
            <input type = "phonenumber" class = "form-control" id = "phonenumber" name = "phonenumber" value="{{old('phonenumber')}}" placeholder = "Enter Phone Number" required>
        </div>
    </div>

                                


                               <div class="form-group">
                                            <div class="col-md-4">
                                        <label for="country">Country</label>
                                           </div>
                                            <div class="col-md-6">


                                                <select name="country" value="{{old('country')}}" id="inputGroupCountry" onchange="loadState()" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                        <label for="state">State</label>
                                           </div>
                                            <div class="col-md-6">

                                                <select id="inputGroupState" value="{{old('state')}}" name="state" class="form-control cs-states"></select>
                                            </div>
                                        </div>






                            </div>
                        </div>
                                    
                            

                            <div class="panel panel-warning">
                              <div class="panel-heading">Username And Password Information</div>
                              <div class="panel-body">
                                
                               

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="username">Username</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="username" name="username" value="" placeholder="Enter username" required>
                                </div>
                                <span id="user-result"></span>
                            </div>

                            <div class="form-group" id="newpassword">
                                <div class="col-md-4">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>
                            </div>
                            <div class="form-group" id="confirmnewpassword">
                                <div class="col-md-4">
                                    <label for="password2">Confirm Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id ="password2" name="password2" placeholder="Confirm password" required>
                                </div>
                            </div>

                            <div class="form-group" id="transpassword">
                                <div class="col-md-4">
                                    <label for="transactionpass">Transaction Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="transactionpass" name="transactionpass" placeholder="Enter Transaction password" required>
                                </div>
                            </div>

                            <div class="form-group" id="transpassword2">
                                <div class="col-md-4">
                                    <label for="transactionpass">Confirm Transaction Password</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="transactionpass2" name="transactionpass2" placeholder="Conf Transaction password" required>
                                </div>
                            </div>
                              </div>
                            </div>  





                            <div class="panel panel-warning">
                              <div class="panel-heading">Account Information</div>
                              <div class="panel-body">
                                    <div class="form-group">
                                <div class="col-md-4">
                                    <label for="accountnumber">Account Number</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="accountnumber" name="accountnumber" value="" placeholder="Enter Account Number" required>
                                </div>
                            </div>
                              </div>
                            </div>

                            <button type="submit" style="" class ="btn btn-large btn-default registerbtn pull-right">Submit</button>

                        </form>
                            </div>
                <p>NOTE: Registration Fee is Non Refundable</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
    <script src="{{ asset('plugins/bootstrap-formhelpers/bootstrap-formhelpers.js') }}"></script>
    <script type="text/javascript">
        $('#myWizard').wizard();
        $('[data-toggle="tooltip"]').tooltip();
    </script>

    <script type="text/javascript">
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
                                $("#user-result").html("<p id='notavailable1'>Not-Available</p> <img  src='{{asset('images/availableimg/not-available.png') }}'/>");
                            }
                        }

                    });
                }
            });



            $("#parentid").keyup(function (e) {

                //removes spaces from username
                $(this).val($(this).val().replace(/\s/g, ''));

                var username = $(this).val();
                if(username.length <= 4){
                    $("#user-result").html('');
                    return;
                }

                if(username.length >= 4){
                    $("#parentidindicator").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"POST",
                        url:"{!!URL::route('showmembershipid')!!}",
                        dataType:'json',
                        data:{'username':username},
                        success:function(data){
                            //$("#user-result").html(data);
                            console.log(data);
                            //var json =JSON.parse(data);
                            var json=data;
                            if ( json.availability === "available" ) {
                                var membershipid=json.membershipid;
                                var firstname=json.firstname;
                                var lastname=json.lastname;
                                //$("#parentidindicator").html("Available <img src='{{asset('images/availableimg/available.png') }}'/>");
                                $("#parentidindicator").html("<p style='color:green'>"+firstname+" "+ lastname+"</p>");
                            }else{
                                $("#parentidindicator").html("<p id='notavailable2'>Not-Available</p> <img  src='{{asset('images/availableimg/not-available.png') }}'/>");

                            }
                        }

                    });
                }
            });


            $("#sponsorid").keyup(function (e) {

                //removes spaces from username
                $(this).val($(this).val().replace(/\s/g, ''));

                var username = $(this).val();
                if(username.length <= 4){
                    $("#user-result").html('');
                    return;
                }

                if(username.length >= 4){
                    $("#sponsoridindicator").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"POST",
                        url:"{!!URL::route('showmembershipid')!!}",
                        dataType:'json',
                        data:{'username':username},
                        success:function(data){
                            //$("#user-result").html(data);
                            console.log(data);
                            //var json =JSON.parse(data);
                            var json=data;
                            if ( json.availability === "available" ) {
                                var membershipid=json.membershipid;
                                var firstname=json.firstname;
                                var lastname=json.lastname;
                                //$("#parentidindicator").html("Available <img src='{{asset('images/availableimg/available.png') }}'/>");
                                $("#sponsoridindicator").html("<p style='color:green'>"+firstname+" "+ lastname+"</p>");
                            }else{
                                $("#sponsoridindicator").html("<p id='notavailable2'>Not-Available</p> <img  src='{{asset('images/availableimg/not-available.png') }}'/>");

                            }
                        }

                    });
                }
            });


        });

    </script>
    <!-- datepicker -->
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript">
        $('#myWizard').wizard();
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script type="text/javascript">

        $("#password2").keyup(function (e) {

            var password1 = $('#password').val();
            var password2 = $('#password2').val();

            if (password1==password2) {

                $("#newpassword").removeClass("has-error has-feedback");
                $("#confirmnewpassword").removeClass("has-error has-feedback");
                $("#password2").removeAttr("data-toggle data-placement title");
                $('#password2').tooltip('destroy');

            } else {

                $("#newpassword").addClass("has-error has-feedback");
                $("#confirmnewpassword").addClass("has-error has-feedback");
                $("#password2").attr({'data-toggle':"tooltip",'data-placement':"right", title:"This password is not the same with the one above"});
                $('#password2').tooltip('show');

            }



        });


        $("#transactionpass2").keyup(function (e) {

            var password1 = $('#transactionpass').val();
            var password2 = $('#transactionpass2').val();

            if (password1==password2) {

                $("#transpassword").removeClass("has-error has-feedback");
                $("#transpassword2").removeClass("has-error has-feedback");
                $("#transactionpass2").removeAttr("data-toggle data-placement title");
                $('#transactionpass2').tooltip('destroy');

            } else {

                $("#transpassword").addClass("has-error has-feedback");
                $("#transpassword2").addClass("has-error has-feedback");
                $("#transactionpass2").attr({'data-toggle':"tooltip",'data-placement':"right", title:"This password is not the same with the one above"});
                $('#transactionpass2').tooltip('show');

            }
        });


    </script>

    <script src="{{ asset('plugins/country_state/country_state.js') }}"></script>

    <script type="text/javascript">
        init('Nigeria','inputGroupCountry', 'inputGroupState');
        function loadState() {
            selectState('inputGroupCountry', 'inputGroupState');
        }
    </script>
    <script type="text/javascript">
        init('Nigeria','modal-inputGroupCountry', 'modal-inputGroupState');
        function loadState() {
            selectState('modal-inputGroupCountry', 'modal-inputGroupState');
        }
    </script>

@endsection