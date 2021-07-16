<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Anil z" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Organiq is clean and modern organic foods store template perfect for Organic Farm shop, organic foods, agriculture and niche foods store.">
<meta name="keywords" content="food shop, fresh, modern, organic farm, organic farm shop, organic food, organic shop, agriculture, agritourism, agrotourism, e-commerce, eco, eco products, farm, farming, food, health, organic, organic food, retail, shop, store">

<!-- SITE TITLE -->
<title>Organiq - Organic Food HTML Template</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/images/favicon.png') }}">
<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/bootstrap/css/bootstrap.min.css') }}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Lobster+Two:400,700" rel="stylesheet">  
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/ionicons.min.css') }}">
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/all.min.css') }}">
<!-- Themify Font CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/themify-icons.css') }}">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="{{ asset('front/assets/owlcarousel/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owlcarousel/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/owlcarousel/css/owl.theme.default.min.css') }}">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
<!-- jquery-ui CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/jquery-ui.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
<link rel="stylesheet" id="layoutstyle" href="{{ asset('front/assets/color/theme-default.css') }}">

<script>
var sc_project=11981757; 
var sc_invisible=1; 
var sc_security="35d2687e"; 
var sc_https=1; 
</script>

</head>

<body>

<!-- LOADER -->
<div id="preloader">
    <div class="line-scale">
    	<div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</div>
<!-- END LOADER --> 

<!-- START HEADER -->
@include('website.includes.header')
<!-- END HEADER --> 

@yield('content')

<!-- START FOOTER -->
@include('website.includes.footer')
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

@include('website.includes.scripts')

</body>
</html>