@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
        <!-- Content Header (Page header) -->
      
<section class="content">
<h3>Membership Id  ({{$membershipid}}) Stage: {{$stage}}</h3>
<div class="row">
      
        <div class="col-md-12">        

              <!-- AREA CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Ewallet:</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
               </div><!-- /.box -->
        </div> 
     <div class="col-md-6">
              <!-- AREA CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">My Total Bonus</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
               </div><!-- /.box -->
       </div>
       <div class="col-md-6">   
              <!-- AREA CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Total Referral Bonus</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
               </div><!-- /.box -->
        </div>

        <div class="col-md-6">         
              <!-- AREA CHART -->
             <!-- <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Area Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                </div>S
               </div>--><!-- /.box -->
        </div>
      </div>

</section>




@endsection
@section('scripts')
<!-- The daterange picker bootstrap plugin -->

<script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script> 
<script src="{{ asset('plugins/daterangepicker/sugar.min.js') }}"></script> 

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> 

<script src="{{ asset('plugins/daterangepicker/raphael.js') }}"></script> 

<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/morrischarthelp.js') }}"></script> 
@endsection
