
@extends('website.master')
@section('stylesheet')

@endsection
@section('content')
<!-- Start single page header 
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Login</h2>
             
            </div>
          </div>
        
        </div>
      </div>
    </div>
  </section> -->
  <!-- End single page header -->
  <!-- Start error section  -->
          <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">LOGIN</h2>
            <span class="line"></span>
            <h3>login to your Account</h3>
          </div>
        </div>
  <section id="error">
    <div class="container">
      <div class="row">
      @if (Session::has('flash_danger'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{Session::get('flash_danger')}}</div>
    @endif
        <div class="col-md-offset-3 col-md-6">
           <form method="POST" action="{{url('/login')}}" >
           
            <div class="form-group">
              <input type="text" name="login" placeholder="Username " class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"> 
             <div class="loginbox">
              <label><input name="remember" type="checkbox"><span>Remember me</span></label>
              
              <button class="btn signin-btn" type="submit" name="" >SIGN IN</button>
                &nbsp; &nbsp; <small>Not Registered yet? &nbsp;</small>
                 <button class="btn btn-success" style=""><a href="feedthenations.com/join-now">Sign Up</a> </button>
            </div>                    
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- End error section  -->

 

@endsection
@section('scripts')

@endsection