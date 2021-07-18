@extends('website.mas')

@section('page-title')
Login
@endsection

@section('content')
<!-- START SECTION BANNER -->
<section class="bg_light_yellow breadcrumb_section background_bg bg_fixed bg_size_contain" data-img-src="{{ asset('front/assets/images/breadcrumb_bg.png') }}">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-12 text-center">
            	<div class="page-title">
            		<h1>Login</h1>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Login</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->
<section>
    <div class="container">
    	<div class="row">
        	<div class="col-md-12 mb-4 mb-md-0">   
                @if (Session::has('flash_danger'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{Session::get('flash_danger')}}</div>
                @endif
          </div>    


          <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4 mb-md-0">
                    <div class="heading_s2">
                        <h3>Login</h3>
                      </div>
                    <form class="login_form " method="POST" action="{{url('/login')}}">
                          <div class="form-group">
                              <label>Username  <span class="required">*</span></label>
                              <input type="text" required class="form-control" name="login" value="">
                          </div>
                          <div class="form-group">
                              <label>Password <span class="required">*</span></label>
                              <input class="form-control" type="password" name="password" placeholder="Password">
                          </div>
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <div class="form-group">
                              <button type="submit" class="btn btn-default"  value="Log in">Log in</button>
                          </div>
                          <div class="login_footer">
                              <a href="#">Lost your password?</a>
                              <label>
                                  <input name="remember" type="checkbox" value="forever"> <span>Remember me</span>
                              </label>
                          </div>
                      </form>
                  </div>
            </div>
          </div>
                    
                 
            
         
        </div>
    </div>
</section>


@endsection