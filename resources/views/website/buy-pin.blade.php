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
              <h2>Buy Pin</h2>
              
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Buy Pin</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End single page header -->
  <!-- Start contact section  -->
  <section id="contact">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="title-area">
              <h2 class="title">Buy pin</h2>
              <span class="line"></span>
              <p></p>
            </div>
         </div>
         <div class="col-md-12">
         <div class="col-md-offset-2 col-md-8">
             <p>You can pay to get your pin right now by entering email and clicking the pay button below</p>
           <form method='post' id='upay_form' name='upay_form' action='https://fidelitypaygate.fidelitybankplc.com/cipg/MerchantServices/MakePayment.aspx' target='_top'> 
                      <input type='hidden' name='mercId' value=''>
                      <input type='hidden' name='currCode' value=''>
                      <input type='hidden' name='amt' value=''>
                      <input type='hidden' name='orderId' value='67'> 
                      <input type='hidden' name='prod' value='title'>
                       <div class="row">
                          <div class="col-md-6">
                      <label>Enter Email</label>
                        <input type='email' class="form-control" name='email'> 
                      </div>
                       </div>
                     
                      
                      <input type='hidden' name='declineurl' value=''> 
                      <input type='hidden' name='exceptionurl' value=''> 
                      <input type='hidden' name='cancelurl' value=''> 

     
                      <input style="margin-top:20px" type='submit' name='submit' class='btn btn-success btn-lg' value='Pay'> 
                  </form>
         </div>
       
         </div>
       </div>
     </div>
  </section>
  <!-- End contact section  -->





@endsection
@section('scripts')

@endsection