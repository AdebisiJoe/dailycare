<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Feed the nations</title>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <!--<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>-->
    <!-- Bootstrap 3.3.5 -->
   <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
   <link rel="stylesheet" href="{{ asset('dist/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <link rel="stylesheet" href="{{ asset('dist/ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/bootstrapValidator.min.css') }}">
        <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.js')}}">     
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
  <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.css') }}">
 
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
   
    

    @yield('stylesheet')
</head>
<body class="hold-transition skin-red sidebar-mini">
<!--<body class="hold-transition skin-red sidebar-mini">-->
  <!-- Overlay  -->
  <div id="overlay" style="background-color: #ecf0f5;opacity: 0.5;z-index: 2000;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;">
    <i style="position: fixed;width: auto;height: auto;z-index: 15;top: 20%;left: 45%;" class="fa fa-spinner fa-spin fa-5x fa-bw"></i>
  </div>

@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>Feed the nations</b>
               
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        


                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">{{$userMessageCount}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have {{$userMessageCount}} messages</li>
                                <li>

                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        
                                   @foreach($userMessages as $message)
                                        <li>
                                            <a href="tickets/{{$message->ticket_id}}">
                                                
                                                <h4>
                                                  <strong>
                                                      {{$message->title}}
                                                  </strong>  
                                                    <br>
                                                    <small><i class="fa fa-clock-o"></i>{{date('F d, Y', strtotime($message->created_at))}}</small>
                                                    

                                                
                                                {!!$message->comment!!}
                                                    
                                                </h4>
                                                
                                            </a>
                                        </li>
                                        @endforeach



                                    </ul>
                                </li>
                                <li class="footer"><a href="{{url('/my_tickets')}}">See All Tickets</a></li>
                            </ul>
                        </li>




                            
                        
                        

                        

                            <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{asset('dist/img/profileimage.jpg')}}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">
                                      @if (Auth::guest())
                                        InfyOm
                                    @else
                                    {{ Auth::user()->name}}
                                    @endif
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{asset('dist/img/profileimage.jpg')}}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        @if (Auth::guest())
                                            InfyOm
                                        @else
                                            {{ Auth::user()->name}}
                                        @endif
                                        <small>Member since Apr. 2015</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')


                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

    
      @if (Session::has('flash_danger'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('flash_danger')}}</div>
    @endif
    
      @if (Session::has('flash_warning'))
    <div class="alert alert-warning">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('flash_warning')}}</div>
    @endif

    @if (Session::has('flash_success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('flash_success')}}</div>
    @endif
   
    @if (Session::has('flash_info'))
    <div class="alert alert-info">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('flash_info')}}</div>
    @endif

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


            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © <?php echo date('Y'); ?> <a href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Go Back to Home Page</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <!--<li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>-->
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <div id="page-content-wrapper">

        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif
    

    <!--notification Modal -->
<div class="modal fade" id="notificationmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


    
    
    <script src="{{ asset('assets/js/jQuery-3.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-printme.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script type="text/javascript" src="{{asset('plugins/jQueryUI/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!--{{ asset('dist/js/demo.js') }}-->
    <!-- Bootstrap 3.3.5 -->
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  
    <!-- Slimscroll -->
    <script src=" {{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
   
    <!-- Select2 -->
    <!-- Select2 -->
    <script src=" {{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src=" {{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('dist/js/app.min.js') }}"></script>
    <script src=" {{ asset('dist/js/bootstrapValidator.min.js') }}"></script>
   
@if(Session::has('notificationmessage'))
  <script type="text/javascript">
  $(document).ready(function() {
 
 
 $('.modal-body').html("{{Session::get('notificationmessage')}}"); 
 $('#notificationmodal').modal();
 

  });
</script>

@endif
   
   

    @yield('scripts')

</body>
</html>