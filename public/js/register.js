$('.carousel').on('slid.bs.carousel', function () {
    var currentIndex = $('div.active').index() + 1;
    console.log("currentIndex: " + currentIndex);
    if(currentIndex == 4){
        $(".btn1").hide();
        $(".btn2").show();
    }else{
        $(".btn1").show();
        $(".btn2").hide();
    }
    if(currentIndex > 1){
        $(".prevBtn").removeClass("disabled");
    }else{
        $(".prevBtn").addClass("disabled");
    }
});

$('.regdOrNot1').click(function(){
    $(".regArea").show();
    $(".loginArea").hide();

    $('.carousel').carousel(0);
    $(".btn1").show();
    $(".btn2").hide();

    
    $(".firstName").val("");
    $(".lastName").val("");
    $(".username").val(""); 
    $(".gender").prop('selectedIndex', 0); 
    $(".phone").val("");
    $(".city").val(""); 
    $(".state").val(""); 
    $(".country").val(""); 
    $(".sponsorId").val(""); 
    $(".memberId").val(""); 
    $(".position").prop('selectedIndex', 0); 
    $(".regPin").val(""); 
    $(".transPwd").val(""); 
    $(".confirmTransPwd").val("");
    $(".pwd").val(""); 
    $(".confirmPwd").val("");

})

$('.regdOrNot2').click(function(){
    $(".regArea").hide();
    $(".loginArea").show();
})

function emptyFieldsMsg(){
    $('#myModal').modal('show');
    $(".alertTitle").text("Empty Fields");
    $(".alertMsg").text("One or More form fields are empty!");
}

function generalErrorMsg(title, msg){
    $('#myModal').modal('show');
    $(".alertTitle").text(title);
    $(".alertMsg").text(msg);
}

function registerScreen1(){
    if($(".firstName").val() == "" || $(".lastName").val() == "" || 
    $(".username").val() == "" || $(".gender").val() == "" ){
        emptyFieldsMsg();
        return false;
    }
    $('.carousel').carousel('next');
}

function registerScreen2(){
    if($(".phone").val() == "" || $(".city").val() == "" || $(".state").val() == "" || 
    $(".country").val() == ""){
        emptyFieldsMsg();
        return false;
    }
    $('.carousel').carousel('next');
}

function registerScreen3(){
    if($(".sponsorId").val() == "" || $(".memberId").val() == "" || $(".position").val() == "" || 
    $(".regPin").val() == ""){
        emptyFieldsMsg();
        return false;
    }
    $('.carousel').carousel('next');
}

$(".nextBtn").click(function(){
    var currentIndex = $('div.active').index() + 1;

    switch(currentIndex){
        case 1:
            registerScreen1();
            break;
        case 2:
            registerScreen2();
            break;
        case 3:
            registerScreen3();
            break;
    }
        
});

$(".prevBtn").click(function(){
    var currentIndex = $('div.active').index() + 1;
    
    if(currentIndex !== 1){
        $('.carousel').carousel('prev');
        return false;
    }
    
    
    
})

function registerScreen4(){
    if($(".transPwd").val() == "" || $(".confirmTransPwd").val() == "" ||
        $(".pwd").val() == "" || $(".confirmPwd").val() == ""){
            emptyFieldsMsg();
            return false;
    }
    if($(".transPwd").val() !== $(".confirmTransPwd").val()){
        generalErrorMsg("Password Mismatch", "Transaction Passwords do not match!");
        return false;
    }
    if($(".pwd").val() !== $(".confirmPwd").val()){
        generalErrorMsg("Password Mismatch", "User Passwords do not match!");
        return false;
    }
    $('.carousel').carousel('next');
}

$(".regBtn").click(function(){
    registerScreen4();
})

    
        

    

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


  

    
