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

    @yield('stylesheet')
</head>



<body>


<div class="container-fluid">


    <div class="row">
        <div class="col-lg-12">
            @yield('content')
        </div>
    </div>
</div>





<script src="{{ asset('assets/js/jQuery-3.1.0.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery-printme.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script type="text/javascript" src="{{asset('plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

@yield('scripts')
</body>
</html>