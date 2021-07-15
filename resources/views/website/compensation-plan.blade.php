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
              <h2>Compensation Plan</h2>
              <p></p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Compensation Plan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>-->
  <!-- End single page header -->
  
  <!-- Start Feature -->
  <section id="feature">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Compensation Plan</h2>
            <span class="line"></span>
            <p>Check out our compensation plans below</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="feature-content">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                  <div class="title-area">
                      <h2 class="title">Farms Stage</h2>
                      <small>Registration</small><br/>

                      <span class="line"></span>
                      <p></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="single-feature wow zoomIn">


                          <h4 class="feat-title"></h4>
                          <p>
                              At the point of registering with $32, your page will be created on our DTC.At the FOOD FARM STAGE, you can either register for a 1 account,3 account or 7 accounts(automatically takes you to stage 1).
                          <ul>
                              <li>Referral Bonus: $6.4 </li>
                              <li>Level Bonus (LB):$38.4</li>
                              <li>Complete Stage: $16</li>
                          </ul>

                          <br/>
                          <b>NB: All payments at FARM STAGE are in FOOD ITEMS.</b>

                          </p>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <img src="{{asset('images/farm.JPG')}}" class="img-responsive">
                  </div>


              </div>
              <div class="col-md-12 col-sm-12">
                  <div class="title-area">
                      <h3 class="title"> Stage(1) <br/><br/>Green Garden</h3>

                      <span class="line"></span>
                      <p></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="single-feature wow zoomIn">
                          <h4 class="feat-title"></h4>
                          <p>
                              At Stage 1, all rewards are in FOOD ITEMS via the concept of ‘Feed yourself and help feed others’.
                          <ul>
                              <li>Referral Bonus: $6.4 </li>
                              <li>Level Bonus (LB):$224</li>
                              <li>Complete Stage (CS):$160</li>
                          </ul>

                          <br/>
                          <b>NB: All payments at this stage are in FOOD ITEMS.</b>


                          </p>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <img src="{{asset('images/greengarden.JPG')}}" class="img-responsive wow slideInRight">
                  </div>

              </div>
              <div class="col-md-12 col-sm-12">
                  <div class="title-area">
                      <h2 class="title">Golden Garden Stage(2)</h2>
                      <span class="line"></span>
                      <p></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="single-feature wow zoomIn">
                          <h4 class="feat-title"></h4>
                          <p>
                              Free food items worth $150 for Seven (7) months.
                          <ul>
                              <li>Referral Bonus: $6.4 </li>
                              <li>Level Bonus (LB):$560 </li>
                              <li>Complete Stage (CS):$360</li>
                          </ul>

                          <br/>
                          <b>NB:payment is 40% food items and 60% cash.</b>

                          </p>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <img src="{{asset('images/goldengarden.JPG')}}" class="img-responsive slideInRight">
                  </div>

              </div>
              <div class="col-md-12 col-sm-12">
                  <div class="title-area">
                      <h2 class="title">Stage(3)<br/><br/>Great Garden</h2>

                      <span class="line"></span>
                      <p></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="single-feature wow zoomIn">

                          <h4 class="feat-title"></h4>
                          <p>
                              40% food items and 60% cash. Free trip to Saudi Arabia for Hajj or Umrah (Lesser Hajj) or free trip to Israel or Dubai. All expenses paid inclusive of $5,000 Travelling Allowance.

                          <ul>
                              <li>Referral Bonus: $6.4 </li>
                              <li>Level Bonus (LB):$700  </li>
                              <li>Complete Stage (CS):$3,500</li>
                              <li>A brand new car worth $22,000.</li>

                          </ul>

                          <br/>

                          <b>NB:payment is 40% food items and 60% cash.</b>

                          </p>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <img src="{{asset('images/greatgarden.JPG')}}" class="img-responsive slideInRight">
                  </div>

              </div>
              <div class="col-md-12 col-sm-12">
                <div class="single-feature wow zoomIn">
                 
                </div>
              </div>
              <div class="col-md-12 col-sm-12">
                  <div class="title-area">
                      <h2 class="title"> Stage(4)<br/><br/>Famous Farm <br/></h2>

                      <span class="line"></span>
                      <p></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="single-feature wow zoomIn">

                          <h4 class="feat-title"></h4>
                          <p>
                              Members at this level will receive 40% food items and 60% cash. They will also be entitled to $250 worth of food items for 12 months.Moreso, a GRAND AWARD of a SUV worth $30,000 will be added to the package.
                          <ul>
                              <li>Referral Bonus: $6.4 </li>
                              <li>Level Bonus (LB): $2,240  </li>
                              <li>Complete Stage (CS):$5,000</li>
                              <li>A brand new SUV worth $30,000.</li>

                          </ul>

                          <br/>

                          <b>NB:payment is 40% food items and 60% cash.</b>

                          </p>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <img src="{{asset('images/famousfarm.jpg')}}" class="img-responsive slideInRight">
                  </div>

              </div>
              <div class="col-md-12 col-sm-12">
                  <div class="col-md-6 col-sm-6 col-xs-12">

                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                  </div>
                <div class="single-feature wow zoomIn">

                </div>
              </div>
              <div class="col-md-12 col-sm-12">
                  <div class="title-area">
                      <h2 class="title"> Stage(5)<br/><br/>Food Bank</h2>

                      <span class="line"></span>
                      <p></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                      <div class="single-feature wow zoomIn">
                          <h4 class="feat-title"> </h4>
                          <p>
                              At this final stage, you live to earn $6,000 from every team member that joins you. You’re also entitled to the unique privilege of profit sharing from the company.
                              <br/>

                              <b>NB:payment is 40% food items and 60% cash.</b>

                          </p>

                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 wow slideInRight">
                      <img src="{{asset('images/foodbank.jpg')}}" class="img-responsive slideInRight">
                  </div>

              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Feature -->



@endsection
@section('scripts')

@endsection