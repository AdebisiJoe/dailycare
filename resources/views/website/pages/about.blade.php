@extends('website.mas')

@section('page-title')
 Index
@endsection

@section('content')
<!-- START SECTION BANNER -->
<section class="bg_light_yellow breadcrumb_section background_bg bg_fixed bg_size_contain" data-img-src="{{ asset('front/assets/images/breadcrumb_bg.png') }}">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-12 text-center">
            	<div class="page-title">
            		<h1>About Us</h1>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION ABOUT US -->
<section>
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            	<div class="about_wrap">
                    <div class="row align-items-center">	
                        <div class="col-xl-7 col-md-6 animation" data-animation="bounceInUp" data-animation-delay="0.3s">
                            <div class="about_img fancy_border text-center">
                                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/about_img.png') }}" alt="about_img" />
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-6 order-md-first animation" data-animation="bounceInUp" data-animation-delay="0.4s">
                            <div class="heading_s2">
                                <span class="sub_heading">With Happy Life</span>
                                <h2>About Organiq Store</h2>
                            </div>
                            <p>UFS & Agricultural Services {A UNIQUE FOOD SOLUTIONS PROVIDER} is a Multi-Level Marketing (MLM) Company duly registered and established for professional development, human capacity development and to alleviate hunger and poverty by simple system of weekly and monthly food distribution for all the nations. It is a clarion call to “feed the nations” with the basic necessities of life. Our strategy is premised on best global business practices aimed at delivering on our corporate promise to our partners.</p>
                            <p>
                                Starting with our free skills acquisition and other leadership management trainings to develop our people’s skills, to food security by encouraging agricultural projects, then our partners will surely experience financial upliftment. People look for different things in life in their quest for financial freedom.</p>
                            <ul class="list_none social_icons mt-4">
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                            </ul> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlap_shape">
        <div class="ol_shape25">
            <div class="animation" data-animation="bounceInDown" data-animation-delay="0.5s">
                <img data-parallax='{"y": -30, "smoothness": 20}' src="{{ asset('front/assets/images/shape44.png') }}" alt="shape44"/>
            </div>
        </div>
        <div class="ol_shape26">
            <div class="animation" data-animation="zoomIn" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape45.png') }}" alt="shape45"/>
            </div>
        </div>
        <div class="ol_shape27">
            <div class="animation" data-animation="zoomIn" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape46.png') }}" alt="shape46"/>
            </div>
        </div>
        <div class="ol_shape28">
            <div class="animation" data-animation="bounceInUp" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape47.png') }}" alt="shape47"/>
            </div>
        </div>
        <div class="ol_shape29">
            <div class="animation" data-animation="slideInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape48.png') }}" alt="shape48"/>
            </div>
        </div>
        <div class="ol_shape30">
            <div class="animation" data-animation="slideInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape49.png') }}" alt="shape49"/>
            </div>
        </div>
        <div class="ol_shape31">
            <div class="animation" data-animation="slideInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape50.png') }}" alt="shape50"/>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION ABOUT US -->

<!-- START SECTION WHY CHOOSE US -->
<section class="bg_gray">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-md-8 text-center">
                <div class="heading_s2 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                	<span class="sub_heading">See Our Features</span>
                    <h2>Why Choose Us</h2>
                </div>
                <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s"> Lorem ipsum dolor sit amet, consectetur blandit magna adipiscing elit ncididunt labore et dolore magna aliqua enim. </p>
            </div>
        </div>
        <div class="row">
        	<div class="col-xl-3 col-md-6">
            	<div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon1.png') }}" alt="icon1">
                    </div>
                    <div class="intro_desc">
                        <h6>Natural Organic Fruits</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed eiusmod labore dolore magna.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon2.png') }}" alt="icon2">
                    </div>
                    <div class="intro_desc">
                        <h6>Fresh Vegetables</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed eiusmod labore dolore magna.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
            	<div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon3.png') }}" alt="icon3">
                    </div>
                    <div class="intro_desc">
                        <h6>100% Organic Juices</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed eiusmod labore dolore magna.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon4.png') }}" alt="icon4">
                    </div>
                    <div class="intro_desc">
                        <h6>Natural Organic Tea</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed eiusmod labore dolore magna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION WHY CHOOSE US -->

<!-- START SECTION TEAM -->
<section class="pb_70">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-md-8 text-center">
            	<div class="heading_s2 text-center">
                	<span class="sub_heading">Meet Our Team</span>
                	<h2>Our Farmers</h2>
                </div>
                <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s"> Lorem ipsum dolor sit amet, consectetur blandit magna adipiscing elit ncididunt labore et dolore magna aliqua enim. </p>
                <div class="small_divider clearfix"></div>
            </div>
        </div>
        <div class="row animation" data-animation="fadeInUp" data-animation-delay="0.4s">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/team1.jpg') }}" alt="team1">
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <h5>Alea Brooks</h5>
                            <span>Farmers</span>
                        </div>
                        <ul class="list_none social_icons social_style1 rounded_social">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/team2.jpg') }}" alt="team2">
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <h5>Grace Wong</h5>
                            <span>Farmers</span>
                        </div>
                        <ul class="list_none social_icons social_style1 rounded_social">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/team3.jpg') }}" alt="team3">
                        
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <h5>Maria Redwood</h5>
                            <span>Farmers</span>
                        </div>
                        <ul class="list_none social_icons social_style1 rounded_social">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box">
                	<div class="team_img">
                    	<img src="{{ asset('front/assets/images/team4.jpg') }}" alt="team4">
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <h5>james white</h5>
                            <span>Farmers</span>
                        </div>
                        <ul class="list_none social_icons social_style1 rounded_social">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TEAM -->

<!-- START SECTION TESTIMONIAL -->
<section class="bg_gray">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="heading_s2 text-center">
                    	<span class="sub_heading">Testimonial</span>
                        <h2>Our Client Say!</h2>
                    </div>
                    <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                </div>
                <div class="small_divider"></div>
            </div>
        </div>
        <div class="row justify-content-center">
        	<div class="col-12 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
            	<div class="testimonial_slider testimonial_style1 carousel_slide3 owl-carousel owl-theme" data-margin="30" data-loop="true" data-autoplay="true" data-dots="false">
                    <div class="testimonial_box">
                        <div class="testi_desc">
                            	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam id varius nunc id varius nunc.Lorem ipsum dolor sit amet consectetur adipiscing</p>
                            </div>
                        <div class="testi_meta">
                        	<div class="testimonial_img">
                                <img src="{{ asset('front/assets/images/client_img1.jpg') }}" alt="client">
                            </div>
                        	<div class="testi_user">
                            	<h5>Merry Walter</h5>
                                <span>Web Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial_box">
                        <div class="testi_desc">
                            	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam id varius nunc id varius nunc.Lorem ipsum dolor sit amet consectetur adipiscing</p>
                            </div>
                        <div class="testi_meta">
                        	<div class="testimonial_img">
                                <img src="{{ asset('front/assets/images/client_img2.jpg') }}" alt="client">
                            </div>
                        	<div class="testi_user">
                            	<h5>John Mark</h5>
                                <span>Web Designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial_box">
                        <div class="testi_desc">
                            	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam id varius nunc id varius nunc.Lorem ipsum dolor sit amet consectetur adipiscing</p>
                            </div>
                        <div class="testi_meta">
                        	<div class="testimonial_img">
                                <img src="{{ asset('front/assets/images/client_img3.jpg') }}" alt="client">
                            </div>
                        	<div class="testi_user">
                            	<h5>Calvin William</h5>
                                <span>Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlap_shape">
        <div class="ol_shape17">
            <div class="animation" data-animation="fadeInLeft" data-animation-delay="0.5s">
                <img data-parallax='{"y": 20, "smoothness": 20}' src="{{ asset('front/assets/images/testimonial_bg_img1.jpg') }}" alt="testimonial_bg_img1"/>
            </div>
        </div>
        <div class="ol_shape18">
            <div class="animation" data-animation="fadeInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 20, "smoothness": 20}' src="{{ asset('front/assets/images/testimonial_bg_img2.png') }}" alt="testimonial_bg_img2"/>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION TESTIMONIAL -->

<!-- START SECTION CLIENT LOGO -->
<section>
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center">
                    <div class="heading_s1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                        <h2>Our partner</h2>
                    </div>
                    <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                    <div class="small_divider"></div>
                </div>
            </div>
        </div>
    	<div class="row">
        	<div class="col-12 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
            	<div class="carousel_slide5 owl-carousel owl-theme" data-margin="30" data-dots="false" data-loop="true" data-autoplay="true">
                	<div class="items">
                    	<a href="#"><img src="{{ asset('front/assets/images/cl_logo1.png') }}" alt="cl_logo1"/></a>
                    </div>
                    <div class="items">
                    	<a href="#"><img src="{{ asset('front/assets/images/cl_logo2.png') }}" alt="cl_logo2"/></a>
                    </div>
                    <div class="items">
                    	<a href="#"><img src="{{ asset('front/assets/images/cl_logo3.png') }}" alt="cl_logo3"/></a>
                    </div>
                    <div class="items">
                    	<a href="#"><img src="{{ asset('front/assets/images/cl_logo4.png') }}" alt="cl_logo4"/></a>
                    </div>
                    <div class="items">
                    	<a href="#"><img src="{{ asset('front/assets/images/cl_logo5.png') }}" alt="cl_logo5"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CLIENT LOGO -->

<!-- END SECTION NEWSLATTER -->
<section class="bg_light_green newslatter_wrap">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-lg-6 col-md-8 text-center">
                <div class="heading_s2 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <h2>Subscribe Our Newsletter</h2>
                </div>
                <p class="m-0 animation" data-animation="fadeInUp" data-animation-delay="0.03s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                <div class="small_divider"></div> 
                <div class="newsletter_form animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                    <form> 
                        <div class="rounded_input">
                           <input type="text" class="form-control" required="" placeholder="Enter your Email Address">
                        </div>
                        <button type="submit" title="Subscribe" class="btn btn-default" name="submit" value="Submit">subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="overlap_shape">
        <div class="ol_shape19">
            <div class="animation" data-animation="fadeInLeft" data-animation-delay="0.5s">
                <img data-parallax='{"y": 20, "smoothness": 20}' src="{{ asset('front/assets/images/shape34.png') }}" alt="shape34"/>
            </div>
        </div>
        <div class="ol_shape20">
            <div class="animation" data-animation="fadeInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 20, "smoothness": 20}' src="{{ asset('front/assets/images/shape35.png') }}" alt="shape35"/>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION NEWSLATTER -->
@endsection