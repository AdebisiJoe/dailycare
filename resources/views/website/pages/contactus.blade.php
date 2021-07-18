@extends('website.mas')

@section('page-title')
 Contact Us
@endsection

@section('content')

<!-- START SECTION BANNER -->
<section class="bg_light_yellow breadcrumb_section background_bg bg_fixed bg_size_contain" data-img-src="{{ asset('front/assets/images/breadcrumb_bg.png') }}">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-12 text-center">
            	<div class="page-title">
            		<h1>Contact Us</h1>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

<!-- START SECTION CONTACT -->
<section>
	<div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
            	<div class="heading_s2 mb-3 animation" data-animation="fadeInUp" data-animation-delay="0.1s">
                	<h3>Get In touch</h3>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                <ul class="contact_info contact_info_style2 list_none">
                    <li>
                        <span class="ti-mobile"></span>
                        <p>+123 456 7890</p>
                    </li>
                    <li>
                        <span class="ti-email"></span>
                        <a href="https://bestwebcreator.com/cdn-cgi/l/email-protection#bfd6d1d9d0ffc6d0cacdd2ded6d391dcd0d2"><span class="__cf_email__" data-cfemail="ec85828a83ac9583999e818d8580c28f8381">[email&#160;protected]</span></a>
                    </li>
                    <li>
                        <span class="ti-location-pin"></span>
                        <address>123 Street, Old Trafford, NewYork, USA</address>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8 col-md-6 mt-4 mt-lg-0">
            	<div class="field_form animation" data-animation="fadeInLeft" data-animation-delay="0.1s">
                        <form method="post" name="enq">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input required="required" placeholder="Enter Name *" id="first-name" class="form-control" name="name" type="text">
                             </div>
                            <div class="form-group col-lg-6">
                                <input required="required" placeholder="Enter Email *" id="email" class="form-control" name="email" type="email">
                            </div>
                            <div class="form-group col-12">
                                <input placeholder="Enter Subject" id="subject" class="form-control" name="subject" type="text">
                            </div>
                            <div class="form-group col-lg-12">
                                <textarea required="required" placeholder="Message *" id="description" class="form-control" name="message" rows="5"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" title="Submit Your Message!" class="btn btn-default" id="submitButton" name="submit" value="Submit">Submit</button>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div id="alert-msg" class="alert-msg text-center"></div>
                            </div>
                        </div>
                    </form>		
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CONTACT -->

<div class="p-0">
	<div class="container-fluid p-0">
    	<div class="row no-gutters">
            <div class="col-md-12">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193229.77301255226!2d-74.05531241936525!3d40.823236500441624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f613438663b5%3A0xce20073c8862af08!2sW+123rd+St%2C+New+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1533565007513" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection