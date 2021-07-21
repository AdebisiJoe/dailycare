@extends('website.mas')

@section('page-title')
 Index
@endsection

@section('content')
<!-- START SECTION BANNER -->
<section class="banner_slider p-0">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active bg_light_green background_bg" data-img-src="{{ asset('front/assets/images/slide_bg_pattern.png') }}">
            	<div class="banner_slide_content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-1 col-lg-9 offset-lg-1">
                                <div class="banner_content banner_content_pad animation" data-animation="fadeIn" data-animation-delay="0.4s" data-parallax='{"y": 30, "smoothness": 10}'>
                            <h2 class="animation" data-animation="fadeInDown" data-animation-delay="0.5s">Welcome to Daily Care International</h2>
                            <p class="animation" data-animation="fadeInUp" data-animation-delay="0.6s">We truly care about meeting your daily needs<br> massa enim. Nullam id varius nunc id varius nunc.</p>
                            <a class="btn btn-default btn-radius btn-borderd animation" href="#" data-animation="fadeInUp" data-animation-delay="0.7s">Learn More</a>
                            <a class="btn btn-white btn-radius btn-borderd animation" href="#" data-animation="fadeInUp" data-animation-delay="0.8s">Contact Us</a>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner_shape">
                    <div class="shape1">
                    	<div class="animation" data-animation="rollIn" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": -30, "smoothness": 20}' src="{{ asset('front/assets/images/shape1.png') }}" alt="shape1"/>
                        </div>
                    </div>
                    <div class="shape2">
                    	<div class="animation" data-animation="bounceInDown" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape2.png') }}" alt="shape2"/>
                        </div>
                    </div>
                    <div class="shape3">
                    	<div class="animation" data-animation="bounceInRight" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape3.png') }}" alt="shape3"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item bg_light_yellow">
                <div class="banner_slide_content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="banner_content border_shape text-center animation" data-animation="zoomIn" data-animation-delay="0.4s" data-parallax='{"y": 30, "smoothness": 10}'>
                                    <h2 class="animation" data-animation="fadeInDown" data-animation-delay="0.5s"> Vegetable 100% Organic</h2>
                                    <p class="animation" data-animation="fadeInUp" data-animation-delay="0.6s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit<br> massa enim. Nullam id varius nunc id varius nunc.</p>
                                    <a class="btn btn-default btn-radius btn-borderd animation" href="#" data-animation="fadeInUp" data-animation-delay="0.7s">Learn More</a>
                                    <a class="btn btn-white btn-radius btn-borderd animation" href="#" data-animation="fadeInUp" data-animation-delay="0.8s">Contact Us</a>
                        		</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner_shape">
                    <div class="shape4">
                    	<div class="animation" data-animation="fadeInLeftBig" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": -30, "smoothness": 20}' src="{{ asset('front/assets/images/shape4.png') }}" alt="shape4"/>
                        </div>
                    </div>
                    <div class="shape5">
                    	<div class="animation" data-animation="slideInDown" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape5.png') }}" alt="shape5"/>
                        </div>
                    </div>
                    <div class="shape6">
                    	<div class="animation" data-animation="bounceInDown" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape6.png') }}" alt="shape6"/>
                        </div>
                    </div>
                    <div class="shape7">
                    	<div class="animation" data-animation="fadeInRightBig" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape7.png') }}" alt="shape7"/>
                        </div>
                    </div>
                    <div class="shape8">
                    	<div class="animation" data-animation="slideInUp" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape8.png') }}" alt="shape8"/>
                        </div>
                    </div>
                    <div class="shape9">
                    	<div class="animation" data-animation="bounceInUp" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape9.png') }}" alt="shape9"/>
                        </div>
                    </div>
                    <div class="shape10">
                    	<div class="animation" data-animation="bounceInUp" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape10.png') }}" alt="shape10"/>
                        </div>
                    </div>
                    <div class="shape11">
                    	<div class="animation" data-animation="bounceInUp" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape11.png') }}" alt="shape11"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item bg_light_blue">
                <div class="banner_slide_content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-1 col-lg-9 offset-lg-1 col-md-10">
                                <div class="banner_content banner_content_pad animation" data-animation="fadeIn" data-animation-delay="0.4s" data-parallax='{"y": 30, "smoothness": 10}'>
                            <h2 class="animation font_style1" data-animation="fadeInDown" data-animation-delay="0.5s">The Fresh Organic Juices.</h2>
                            <p class="animation" data-animation="fadeInUp" data-animation-delay="0.6s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit<br class="d-none d-lg-block"> massa enim. Nullam id varius nunc id varius nunc.</p>
                            <a class="btn btn-default btn-radius btn-borderd animation" href="#" data-animation="fadeInUp" data-animation-delay="0.7s">Learn More</a>
                            <a class="btn btn-white btn-radius btn-borderd animation" href="#" data-animation="fadeInUp" data-animation-delay="0.8s">Contact Us</a>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner_shape">
                    <div class="shape12">
                    	<div class="animation" data-animation="slideInDown" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": -30, "smoothness": 20}' src="{{ asset('front/assets/images/shape12.png') }}" alt="shape12"/>
                        </div>
                    </div>
                    <div class="shape13">
                    	<div class="animation" data-animation="slideInDown" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape13.png') }}" alt="shape13"/>
                        </div>
                    </div>
                    <div class="shape14">
                    	<div class="animation" data-animation="zoomIn" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape14.png') }}" alt="shape14"/>
                        </div>
                    </div>
                    <div class="shape15">
                    	<div class="animation" data-animation="bounceInUp" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape15.png') }}" alt="shape15"/>
                        </div>
                    </div>
                    <div class="shape16">
                    	<div class="animation" data-animation="zoomInUp" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape16.png') }}" alt="shape16"/>
                        </div>
                    </div>
                    <div class="shape17">
                    	<div class="animation" data-animation="slideInLeft" data-animation-delay="0.5s">
                    		<img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape17.png') }}" alt="shape17"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION BANNER BOX -->
<!-- START SECTION WHY CHOOSE US -->
<section class="bg_gray">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-md-8 text-center">
                <div class="heading_s2 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <h2>How it Works</h2>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-xl-4 col-md-6">
            	<div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon1.png') }}" alt="icon1">
                    </div>
                    <div class="intro_desc">
                        <h6>Create an Account</h6>
                        <p>Simply register via wallet or scratch card with $31.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon2.png') }}" alt="icon2">
                    </div>
                    <div class="intro_desc">
                        <h6>Refer Family & Friends</h6>
                        <p>Build your downlines by inviting members to register with your username.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
            	<div class="icon_box icon_box_style3 box_shadow4 bg-white animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon3.png') }}" alt="icon3">
                    </div>
                    <div class="intro_desc">
                        <h6>Start Earning</h6>
                        <p>Earn money and get bonus as you move through the stages.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION WHY CHOOSE US -->
<!-- END SECTION BANNER BOX -->

<!-- START SECTION WHY CHOOSE US -->
<section class="bg_gray">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-4 col-md-6 col-sm-8 text-center">
                <div class="heading_s1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <h2>Why Choose Us</h2>
                </div>
                <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s"> Lorem ipsum dolor sit amet, consectetur blandit magna adipiscing elit. </p>
            </div>
        </div>
        <div class="row align-items-center">
        	<div class="col-lg-4 col-md-6">
            	<div class="icon_box icon_box_style1 bg-white radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon1.png') }}" alt="icon1">
                    </div>
                    <div class="intro_desc">
                        <h6>Natural Organic Fruits</h6>
                        <p>Lorem ipsum dolor consectetur adipiscing Phasellus blandit.</p>
                    </div>
                </div>
                <div class="icon_box icon_box_style1 bg-white radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon2.png') }}" alt="icon2">
                    </div>
                    <div class="intro_desc">
                        <h6>Fresh Vegetables</h6>
                        <p>Lorem ipsum dolor consectetur adipiscing Phasellus blandit.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 order-lg-last">
            	<div class="icon_box icon_box_style1 bg-white radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon3.png') }}" alt="icon3">
                    </div>
                    <div class="intro_desc">
                        <h6>100% Organic Juices</h6>
                        <p>Lorem ipsum dolor consectetur adipiscing Phasellus blandit.</p>
                    </div>
                </div>
                <div class="icon_box icon_box_style1 bg-white radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="box_icon">
                		<img src="{{ asset('front/assets/images/icon4.png') }}" alt="icon4">
                    </div>
                    <div class="intro_desc">
                        <h6>Natural Organic Tea</h6>
                        <p>Lorem ipsum dolor consectetur adipiscing Phasellus blandit.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="why_choose_img bounceimg">
                    <img src="{{ asset('front/assets/images/why_choose_img.png') }}" alt="why_choose_img">
                </div>
            </div>
        </div>
    </div>
    <div class="wave_shape"><img src="{{ asset('front/assets/images/wave_shape.png') }}" alt="wave_shape"></div>
    <div class="overlap_shape">
        <div class="ol_shape1">
            <div class="animation" data-animation="bounceInDown" data-animation-delay="0.5s">
                <img data-parallax='{"y": -30, "smoothness": 20}' src="{{ asset('front/assets/images/shape18.png') }}" alt="shape18"/>
            </div>
        </div>
        <div class="ol_shape2">
            <div class="animation" data-animation="zoomIn" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape19.png') }}" alt="shape19"/>
            </div>
        </div>
        <div class="ol_shape3">
            <div class="animation" data-animation="zoomIn" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape20.png') }}" alt="shape20"/>
            </div>
        </div>
        <div class="ol_shape4">
            <div class="animation" data-animation="bounceInUp" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape21.png') }}" alt="shape21"/>
            </div>
        </div>
        <div class="ol_shape5">
            <div class="animation" data-animation="slideInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape22.png') }}" alt="shape22"/>
            </div>
        </div>
        <div class="ol_shape6">
            <div class="animation" data-animation="slideInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape23.png') }}" alt="shape23"/>
            </div>
        </div>
        <div class="ol_shape7">
            <div class="animation" data-animation="slideInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape24.png') }}" alt="shape24"/>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION WHY CHOOSE US -->

<!-- START SECTION PRODUCT -->
<section class="pb_70">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8 col-sm-10 text-center">
                <div class="heading_s1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <h2>
                        Business Packages
                    </h2>
                </div>
                <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pricing_box pricing_style2">
                            <div class="pr_title_wrap bg_dark text_white">
                                <h4 class="pr_title">Basic</h4>
                                <div class="price_tage">
                                    <h2>$49<span>/ Month</span></h2>
                                </div>
                            </div>
                            <div class="pr_content pt-3">
                                <ul class="list_none pr_list">
                                    <li>Basic Options</li>
                                    <li>Full Access</li>
                                    <li>Customers Support</li>
                                    <li>Free Updates</li>
                                    <li>Advanced Options</li>
                                </ul>
                            </div>
                            <div class="pr_footer">
                                <a href="#" class="btn btn-dark">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing_box pricing_style2">
                            <div class="pr_title_wrap bg_default text_white">
                                <h4 class="pr_title">Standard</h4>
                                <div class="price_tage">
                                    <h2>$99<span>/ Month</span></h2>
                                </div>
                            </div>
                            <div class="pr_content pt-3">
                                <ul class="list_none pr_list">
                                    <li>Standard Options</li>
                                    <li>Full Access</li>
                                    <li>Customers Support</li>
                                    <li>Free Updates</li>
                                    <li>Advanced Options</li>
                                </ul>
                            </div>
                            <div class="pr_footer">
                                <a href="#" class="btn btn-default">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pricing_box pricing_style2">
                            <div class="pr_title_wrap bg_dark text_white">
                                <h4 class="pr_title">Unlimited</h4>
                                <div class="price_tage">
                                    <h2>$199<span>/ Month</span></h2>
                                </div>
                            </div>
                            <div class="pr_content pt-3">
                                <ul class="list_none pr_list">
                                    <li>Unlimited Options</li>
                                    <li>Full Access</li>
                                    <li>Customers Support</li>
                                    <li>Free Updates</li>
                                    <li>Advanced Options</li>
                                </ul>
                            </div>
                            <div class="pr_footer">
                                <a href="#" class="btn btn-dark">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlap_shape">
        <div class="ol_shape8">
            <div class="animation" data-animation="fadeInLeft" data-animation-delay="0.5s">
                <img data-parallax='{"y": -30, "smoothness": 20}' src="{{ asset('front/assets/images/shape25.png') }}" alt="shape25"/>
            </div>
        </div>
        <div class="ol_shape9">
            <div class="animation" data-animation="fadeInLeft" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape26.png') }}" alt="shape26"/>
            </div>
        </div>
        <div class="ol_shape10">
            <div class="animation" data-animation="fadeInLeft" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape27.png') }}" alt="shape27"/>
            </div>
        </div>
        <div class="ol_shape11">
            <div class="animation" data-animation="fadeInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape28.png') }}" alt="shape28"/>
            </div>
        </div>
        <div class="ol_shape12">
            <div class="animation" data-animation="fadeInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape29.png') }}" alt="shape29"/>
            </div>
        </div>
        <div class="ol_shape13">
            <div class="animation" data-animation="fadeInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape30.png') }}" alt="shape30"/>
            </div>
        </div>
        <div class="ol_shape14">
            <div class="bounceimg" data-animation="fadeInRight" data-animation-delay="0.5s">
                <img data-parallax='{"y": 30, "smoothness": 20}' src="{{ asset('front/assets/images/shape31.png') }}" alt="shape31"/>
            </div>
        </div>
    </div>
</section>
<!-- START SECTION PRODUCT -->

<!-- START SECTION TESTIMONIAL -->
<section class="bg_gray">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="heading_s1 text-center">
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

<!-- START SECTION BLOG -->
<section class="pb_20">
	<div class="container">
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center">
                    <div class="heading_s1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                        <h2>Blog News</h2>
                    </div>
                    <p class="animation" data-animation="fadeInUp" data-animation-delay="0.03s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                    <div class="small_divider"></div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
        	<div class="col-lg-4 col-md-6">
            	<div class="blog_post blog_style1 radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="blog_img">
                        <a href="#">
                            <img src="{{ asset('front/assets/images/blog_small_img1.jpg') }}" alt="blog_small_img1">
                        </a>
                        <div class="blog_date style1"><h4>02</h4><span>May</span></div>
                    </div>
                    <div class="blog_content">
                        <h6 class="blog_title"><a href="#">Varius Phasellus blandit massa enim</a></h6>
                        <ul class="list_none blog_meta">
                            <li><a href="#"><i class="far fa-user"></i>by <span class="text_default">admin</span></a></li>
                            <li><a href="#"><i class="far fa-comments"></i>4 Comment</a></li>
                        </ul>
                        <p>Phasellus blandit massa enim elit variununc Lorems ipsum dolor sit consectetur industry. If you are use passage of Lorem Ipsum.</p>
                        <a href="#" class="blog_link">Read More <i class="ion-ios-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
            	<div class="blog_post blog_style1 radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="blog_img">
                        <a href="#">
                            <img src="{{ asset('front/assets/images/blog_small_img2.jpg') }}" alt="blog_small_img2">
                        </a>
                        <div class="blog_date style1"><h4>25</h4><span>Mar</span></div>
                    </div>
                    <div class="blog_content">
                        <h6 class="blog_title"><a href="#">Varius Phasellus blandit massa enim</a></h6>
                        <ul class="list_none blog_meta">
                            <li><a href="#"><i class="far fa-user"></i>by <span class="text_default">admin</span></a></li>
                            <li><a href="#"><i class="far fa-comments"></i>3 Comment</a></li>
                        </ul>
                        <p>Phasellus blandit massa enim elit variununc Lorems ipsum dolor sit consectetur industry. If you are use passage of Lorem Ipsum.</p>
                        <a href="#" class="blog_link">Read More <i class="ion-ios-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
            	<div class="blog_post blog_style1 radius_all_10 animation" data-animation="fadeInUp" data-animation-delay="0.06s">
                	<div class="blog_img">
                        <a href="#">
                            <img src="{{ asset('front/assets/images/blog_small_img3.jpg') }}" alt="blog_small_img3">
                        </a>
                        <div class="blog_date style1"><h4>08</h4><span>Aug</span></div>
                    </div>
                    <div class="blog_content">
                        <h6 class="blog_title"><a href="#">Varius Phasellus blandit massa enim</a></h6>
                        <ul class="list_none blog_meta">
                            <li><a href="#"><i class="far fa-user"></i>by <span class="text_default">admin</span></a></li>
                            <li><a href="#"><i class="far fa-comments"></i>5 Comment</a></li>
                        </ul>
                        <p>Phasellus blandit massa enim elit variununc Lorems ipsum dolor sit consectetur industry. If you are use passage of Lorem Ipsum.</p>
                        <a href="#" class="blog_link">Read More <i class="ion-ios-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BLOG -->

<!-- START SECTION CLIENT LOGO -->
<section class="small_pt">
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
                <div class="heading_s1 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
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