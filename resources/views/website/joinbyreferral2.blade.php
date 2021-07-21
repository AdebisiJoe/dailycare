@extends('website.mas')

@section('page-title')
 Join now
@endsection
@section('stylesheet')
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endsection
@section('content')
<section class="bg_light_yellow breadcrumb_section background_bg bg_fixed bg_size_contain" data-img-src="{{ asset('front/assets/images/breadcrumb_bg.png') }}">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-12 text-center">
            	<div class="page-title">
            		<h1>Join-now</h1>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Join-now</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
@if(Session::has('errors')) 
@if ( $errors->count() > 0 )
 <div class="alert alert-danger">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <p>The following errors have occurred:</p>

     <ul>
       @foreach( $errors->all() as $message )
       <li>{{ $message }}</li>
       @endforeach
     </ul>
   </div>
@endif
@endif
<section>
    <div class="container">
    	<div class="row">
            <div class="row">
                <div class="offset-md-3 col-md-6">

                    <div class="form-wrapper">
                        <div class="card card-shadow">
                            <div class="card-header">
                                <h4 class="text-center">Registration</h4>
                            </div>
                            <div class="card-body">
                                <form id="register-form"   method = "post" action = "{{url('/saveregister')}}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sponsor ID</label>
                                                <input data-toggle="tooltip" data-placement="top"  value={{$sponsorusername}}  title="This person gets the referral Bonus" type="text" class="form-control" id="sponsorid" name="reffererid" value="{{old('reffererid')}}"   readonly>
                                            </div>
                                            <span id="sponsoridindicator"></span>
                                        </div>
                                       <!--  <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Parent ID</label>
                                                <input data-toggle="tooltip" data-placement="top" title="This is the person you want to place your registration under" type="text" class="form-control" id="parentid" name="parentid" value="{{old('parentid')}}" required>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                 <select  class="form-control " name="place" data-toggle="tooltip" data-placement="top" title="Place your downline on the leg you want" required>
                                                    <option class="0" disabled="true" selected="true">--Position--</option>
                                                    <option class="1" value="L" @if (old('place') == 'L') selected="selected" @endif>Left Leg</option>
                                                    <option class="2" value="R" @if (old('place') == 'R') selected="selected" @endif>Right Leg</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Membership ID</label>
                                                 <input data-toggle="tooltip" data-placement="top" title="Enter membership ID of the pin" type="text" class="form-control" id="membershipid" name ="membershipid" value="{{old('membershipid')}}"  required>
                                            </div>
                                         </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Registration Pin</label>
                                                <input type="text" class="form-control" id="Registrationpin" name="registrationpin" value="{{old('registrationpin')}}" required>
                                            </div>
                                         </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}" required>
                                            </div>
                                         </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type = "email" class = "form-control" id = "email" name = "email" value="{{old('email')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type = "tel" class = "form-control" id = "phonenumber" name = "phonenumber" value="{{old('phonenumber')}}" required>
                                            </div>
                                         </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country" value="{{old('country')}}" id="inputGroupCountry" onchange="loadState()" class="form-control"></select>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select id="inputGroupState" value="{{old('state')}}" name="state" class="form-control cs-states"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" id="city" class="form-control" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" id="username" class="form-control" required="required">
                                            </div>
                                            <span id="user-result"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="password" class="form-control" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="form-group">
                                                 <label>Confirm Password</label>
                                                <input type="password" name="repassword" id="password2" onkeyup="checkPass(); return false;" class="form-control" required="required">
                                                <span id="confirmMessage" class="confirmMessage"></span>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="custom-control custom-checkbox checkbox-secondary">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3" checked="">
                                        <label class="custom-control-label" for="customCheck3">I agree with the all additional <a href="<?php ; ?>terms-and-conditions" target="_blank">Terms and Conditions</a></label>
                                    </div>
                                    <div class="form-group text-center m-top-30 m-bottom-20">
                                        <button class="btn" type="submit" style="background-color:#ff871c;color:white">Sign Up</button>
                                    </div>
                                    
                                </form><br>
                                <p class="text-center m-bottom-25">Already have an account? <a href="{{url('login')}}">Sign In</a></p>
                                

                            </div>
                        </div>
                    </div>
                </div><!-- ends: .col-lg-6 -->
                
            </div>
        </div>
        
    </div>
    
</section>    
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection

@section('scripts')


 <!-- <script src="{{asset('homepage/js/countries.js')}}"></script>

  <script language="javascript">
        populateCountries("country", "state");
  </script> -->

    <script src="{{ asset('plugins/country_state/country_state.js') }}"></script>

    <script type="text/javascript">
        init('Nigeria','inputGroupCountry', 'inputGroupState');
        function loadState() {
            selectState('inputGroupCountry', 'inputGroupState');
        }
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


@endsection