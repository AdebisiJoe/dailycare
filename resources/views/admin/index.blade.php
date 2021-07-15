<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bookstore</title>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
   <link rel="stylesheet" href="{{ asset('dist/font-awesome/css/font-awesome.min.css') }}">
    
     <script type="text/javascript">

     var baseUrl="{{url('/')}}"
     </script>
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

@if (Session::has('flash_error'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('flash_error')}}</div>
    @endif
<div id="loginModal" class="modal show " tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:5em">
  <div class="modal-dialog">
  <div class="modal-content">
      
         <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
          <h1 class="text-center">Login</h1>
     

      
        
          <form  role="form" method="POST" action="{{url('user/do-login')}}" class="form col-md-12 center-block">              
       <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="email" id="username" placeholder="Email">
  </div>
       <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>
              
            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" name="login" >Sign In</button>
            
            </div>
              <input type="hidden" name="_token" value="{{csrf_token()}}">
          </form>
    
      <div class="modal-footer">
          <div class="col-md-12">
              <div class="text-center bg-warning"><strong></strong></div>
      </div>  
      </div>
       </div>
           </div>
         </div>
     </div>
  </body>
 <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</html>



