@extends('website.master')
@section('stylesheet')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endsection
@section('content')

<section id="contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="title-area">
          <h2 class="title">Join Now</h2>
          <span class="line"></span>
          <p></p>
      </div>
  </div>
  <div class="col-md-12 ">
    <form role = "form" class = "form-horizontal" id = "defaultForm" method = "post" action = "{{url('/saveregister')}}">

        <div class = "form-group">
           
            <div class = "col-md-4">
                <input data-toggle="tooltip" data-placement="top" title="This person gets the referral Bonus" type = "text" class = "form-control" id = "sponsorid" name = "reffererid"  placeholder = "Enter Refferer ID" required>
            </div>
            <span id="sponsoridindicator"></span>
        </div>


       <!--  <div class = "form-group">
            <div class = "col-md-2">
                <label for = "parentid">Parent ID</label>
            </div>
            <div class = "col-md-4">
            <input data-toggle="tooltip" data-placement="top" title="This is the person you want to place your registration under" type = "text" class = "form-control" id = "parentid" name = "parentid" placeholder = "Enter parent ID" required>

            </div>
            <span id="parentidindicator"></span>
        </div> -->

        <div class="form-group">
            <div class = "col-md-2">
                <label for = "position">Position</label>
            </div>
            <div class="col-md-4">
                <select  class="form-control " name="place" data-toggle="tooltip" data-placement="top" title="Place your downline on the leg you want" required>
                    <option class="0" disabled="true" selected="true">--Position--</option>
                    <option class="1" value="L">Left Leg</option>
                    <option class="2" value="R">Right Leg</option>
                </select>
            </div>       
        </div>

           <div class = "form-group">
            <div class = "col-md-2">
                <label for = "Registrationpin">Registration Pin</label>
            </div>
            <div class = "col-md-4">
                <input type = "text" class = "form-control" id = "Registrationpin" name = "registrationpin" placeholder = "Enter Registration Pin" required>

            </div>
            <div class="col-md-2">
               <a style="color:green" href="{{url('/buy-pin')}}" target="_blank">Buy pin</a>

           </div>

       </div>    




       <div class = "form-group">
        <div class = "col-md-2">
            <label for = "firstname">First Name</label>
        </div>
        <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "firstname" name = "firstname" placeholder = "Enter first Name" required>
        </div>
    </div>
    <div class = "form-group">
        <div class = "col-md-2">
            <label for = "middlename">Middle Name</label>
        </div>
        <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "middle" name = "middlename" placeholder ="Enter Middle Name" required>
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-md-2">
            <label for = "lastname">Last Name</label>
        </div>
        <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "lastname" name = "lastname" placeholder = "Enter Lastname" required>
        </div>
    </div> 
    <div class = "form-group">
        <div class = "col-md-2">
            <label for = "lastame">Date of Birth</label>
        </div>
        <div class= "col-md-4">
            <div class = "input-group date" data-provide = "datepicker">
                <input type = "text" class = "form-control" name="dob">
                <div class = "input-group-addon" required>
                    <span class = "glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class = "col-md-2">
            <label for = "lastame">Gender</label>
        </div>
        <div class="col-md-4">
            <select class="form-control sex" name="sex" required>
                <option class="0" disabled="true" selected="true">--Gender--</option>
                <option class="1" value="male" >Male</option>
                <option class="2" value="female">Female</option>
            </select>
        </div>       
    </div>
    <div class = "form-group">
        <div class = "col-md-2">
            <label for = "email">Email address</label>
        </div>
        <div class = "col-md-4">
            <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Enter email" required>
        </div>
    </div>

    <div class = "form-group">
        
        <div class = "col-md-4">
            <input type = "phonenumber" class = "form-control" id = "phonenumber" name = "phonenumber" placeholder = "Enter Phone Number" required>
        </div>
    </div> 

    <div class = "form-group">
       
        <div class = "col-md-4">

            <select class="form-control select2" id = "country"  name="country">                
                
            </select>
        </div>
    </div>
    <div class = "form-group">
       
        <div class = "col-md-4">
            <input type ="text" class ="form-control" id ="state" name ="state" placeholder ="Enter State" required>
        </div>

    </div> 


    <div class = "form-group">
      
        <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "username" name = "username" placeholder = "Enter username" required>
        </div>
        <span id="user-result"></span>
    </div>

    <div class = "form-group" id="newpassword">
       
        <div class = "col-md-4">
            <input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Enter password" required>
        </div>
    </div>
    <div class = "form-group" id="confirmnewpassword">
        
        <div class = "col-md-4">
            <input type = "password" class = "form-control" id ="password2" name = "password2" placeholder = "Confirm password" required>
        </div>
    </div>

    <div class = "form-group" id="transpassword">
        <div class = "col-md-2">
            <label for = "transactionpass">Transaction Password</label>
        </div>
        <div class = "col-md-4">
            <input type = "password" class = "form-control" id = "transactionpass" name = "transactionpass" placeholder = "Enter Transaction password" required>
        </div>
    </div>

    <div class = "form-group" id="transpassword2">
        <div class = "col-md-2">
            <label for = "transactionpass">Confirm Transaction Password</label>
        </div>
        <div class = "col-md-4">
            <input type = "password" class = "form-control" id = "transactionpass2" name = "transactionpass2" placeholder = "Conf Transaction password" required>
        </div>
    </div>

    <div class = "form-group">
        <div class = "col-md-2">
            <label for = "accountnumber">Account Number</label>
        </div>
        <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "accountnumber" name = "accountnumber" placeholder = "Enter Account Number" required>
        </div>
    </div>
    <button type = "submit" class = "btn btn-warning">Submit</button>

</form>

</div>



</div>






















                       <!-- <div class = "box-header with-border">
                            <h3 class = "box-title">Next of Kin Details</h3>
                        </div>

                        <div class = "box-body">
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "kinname">Name of Next of Kin</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "kinname" name = "nameofkin" placeholder = "Enter Name of Next of kin">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "phonenumber">Phone Number</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "phonenumber" name = "phonenumberofkin" placeholder = "Enter Phone Number of Kin" >
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "kinrelationship">Relationship</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "kinrelationship" name = "kinrelationship" placeholder = "Enter Relationship with next of kin">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "nextofkinaddress">Next of kin Address</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "nextofkinaddress" name = "nextofkinaddress" placeholder = "Enter address of next of kin">
                                </div>
                            </div>-->








                        </div>
                    </div>
                </div>
            </section>
            <!-- End contact section  -->




            <meta name="_token" content="{!! csrf_token() !!}" />
            @endsection
            @section('scripts')






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