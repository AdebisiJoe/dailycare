<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Daily Care International</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.gif"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">    
  <!-- Slick slider -->
  <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">  
  <!-- Fancybox slider -->
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}">  
  <!-- Animate css -->
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">  
 
  <!-- Progress bar  -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-progressbar-3.3.4.css') }}">   
  <!-- Theme color -->
  <link rel="stylesheet" href="{{ asset('assets/css/theme-color/orange-theme.css') }}">  
  <link rel="stylesheet" href="{{ asset('plugins/fuelux/fuelux.min.css') }}">  
  <!-- Main Style -->

  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/lightbox.min.css')}}">
  
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">  

  <!-- Fonts -->

  <!-- Open Sans for body font -->
  <!--<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>-->
  <!-- Lato for Title -->
  <!--<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>  -->  
  
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      @yield('stylesheet')
    </head>
    <body class="fuelux">

      <!-- BEGAIN PRELOADER -->
      
      <!-- END PRELOADER -->

      <!-- SCROLL TOP BUTTON -->
      <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
      <!-- END SCROLL TOP BUTTON -->

      <!-- Start header -->
      <header id="header" style="">

        <!-- header bottom -->
        <div class="header-bottom">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="header-contact">
                  <ul>
                    <li>
                      <div class="phone">
                        <i class="fa fa-phone"></i>
                        (+234)7086509321

                      </div>
                    </li>
                    <li>
                      <div class="mail">
                        <i class="fa fa-envelope"></i>
                        info@uniquefoodsolutions.org
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="header-login">
                  <a class="login modal-form" data-target="#login-form" data-toggle="modal" href="#">Login Here</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- End header -->
      
      <!-- Start login modal window -->
      <div aria-hidden="false" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade in">
        <div class="modal-dialog">
          <!-- Start login section -->
          <div id="login-content" class="modal-content">
            <div class="modal-header">
              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title"><i class="fa fa-unlock-alt"></i>Login</h4>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{url('/login')}}" >
                <!--<form method="POST" action="{{url('/login')}}" >-->
                <div class="form-group">
                  <input type="text" name="login" placeholder="User name" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}"> 
                <div class="loginbox">
                  <label><input type="checkbox"><span>Remember me</span></label>
                  
                  <button class="btn signin-btn" type="submit" name="" >SIGN IN</button>
                </div>                    
              </form>
            </div>
            <div class="modal-footer footer-box">
              <a href="#">Forgot password ?</a>
              <span>No account ? <a  href="{{url('/join-now')}}">Register</a></span>            
            </div>
          </div>
          <!-- Start signup section -->
          <div id="signup-content" class="modal-content">
            <div class="modal-header">
              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title"><i class="fa fa-lock"></i>Sign Up</h4>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <input placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                  <input placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                  <input placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password" class="form-control">
                </div>
                <div class="signupbox">
                  <span>Already got account? <a id="login-btn" href="#">Sign In.</a></span>
                </div>
                <div class="loginbox">
                  <label><input type="checkbox"><span>Remember me</span><i class="fa"></i></label>
                  <button class="btn signin-btn" type="button">SIGN UP</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End login modal window -->

      <!-- BEGIN MENU -->
      <section id="menu-area">      
        <nav class="navbar navbar-default" role="navigation">  
          <div class="container">
            <div class="navbar-header">
              <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- LOGO -->              
              <!-- TEXT BASED LOGO -->
              <a class="navbar-brand" href="{{url('/index')}}" style="max-width:200px;"> 
               <img src="{{asset('images/pagelogo.png')}}" alt="LOGO" class="img-responsive" />
             </a>              
             <!-- IMG BASED LOGO  -->
             <!-- <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="logo"></a> -->
           </div>
           <div id="navbar" class="navbar-collapse collapse">
            <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
              <li class=""><a href="{{url('/')}}">Home</a></li>
              <li><a href="{{url('/about-us')}}">About us</a></li>
              <li><a href="{{url('/compensation-plan')}}">Compensation plan</a></li>
           <!--<li><a href="{{url('/service')}}">Service</a></li>
            <li><a href="{{url('/faq')}}">Faq</a></li> 
            <li><a href="{{url('/how-it-works')}}">How it works</a></li>-->
            <li><a href="{{url('/join-now')}}">Join now</a></li>
            <li><a href="{{url('/login')}}">Login</a></li>
            <!--<li><a href="{{url('/foundation')}}">Foundation</a></li>-->
            
            <li><a href="{{url('/contact')}}">Contact</a></li>

          </ul>                     
        </div><!--/.nav-collapse -->
        
      </div>     
    </nav>
  </section>
  <!-- END MENU -->
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
@yield('content')


<!-- dashboard navigator and logut -->
@if(Auth::check())
<ul class="list-group dash-nav" style="position:fixed; right:0px; top:50%; width:50px; height:200px;">
  <li class="list-group-item"><a href="{{url('/home')}}"><i class="fa fa-user" style="color:green;"></i></a></li>
  <li class="list-group-item bg-success"><a href="{{url('/logout')}}"><i class="fa fa-power-off" style="color:red";></i></a></li>
</ul>
@endif

<!-- dashboard nav and logout icons -->
<!-- Start footer -->
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="footer-left">
          <p >Designed by <a href="#">uniquefoodsolutions</a></p>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="footer-right">
          <a href="https://www.facebook.com//" target="_blank"><i class="fa fa-facebook"></i></a>
          <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>

          <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
          <a href="#"><i class="fa fa-google-plus" target="_blank"></i></a>
          <a href="#"><i class="fa fa-pinterest" target="_blank"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- End footer -->



<!-- jQuery library -->
<script type="text/javascript" src="{{asset('assets/js/jQuery-2.1.4.min.js')}}"></script>   
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Bootstrap -->
<script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>  
<!-- Slick Slider -->
<script type="text/javascript" src="{{asset('assets/js/slick.js')}}"></script>     
<!-- mixit slider -->
<script type="text/javascript" src="{{asset('assets/js/jquery.mixitup.js')}}"></script>  
<!-- Add fancyBox -->        
<script type="text/javascript" src="{{asset('assets/js/jquery.fancybox.pack.js')}}"></script>  
<!-- counter -->
<script type="text/javascript" src="{{asset('assets/js/waypoints.js')}}"></script>  

<script type="text/javascript" src="{{asset('assets/js/jquery.counterup.js')}}"></script>  
<!-- Wow animation --> 
<script type="text/javascript" src="{{asset('assets/js/wow.js')}}"></script>  
<!-- progress bar   -->
<script type="text/javascript" src="{{asset('assets/js/bootstrap-progressbar.js')}}"></script>
<!-- lightbox -->
<script type="text/javascript" src="{{asset('assets/js/lightbox.min.js')}}"></script>
<script type="text/javascript" src="{{asset('dist/font-awesome/css/font-awesome.min.css')}}"></script>

 <script type="text/javascript">
  $(document).ready(function() {
 
 
// $('.modal-body2').html("{{Session::get('notificationmessage')}}"); 
 $('#notificationmodal').modal('show');
 

  });
   $('#notificationmodal').modal('show');
</script>



<!-- Custom js -->
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script> 
<script type="text/javascript" src="{{asset('plugins/fuelux/fuelux.min.js')}}"></script> 
@yield('scripts')

       


<script type="text/javascript">
  $(document).ready(function() {
    $('#media').carousel({
      pause: true,
      interval: 8000,
    });
  });

</script>





 






</body>
</html>