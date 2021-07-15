@extends('layouts.app')

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Account details</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-6">
            <div class="panel panel-danger">

               <div class="panel-heading">
                   <h3 class="panel-title">Total Earnings</h3>
               </div>
                <div class="panel-body">
                 <h4>${{$totalearnings}}</h4>
                </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>
          </div>
          <div class="col-md-6">
                
            <div class="panel panel-danger">
               <div class="panel-heading">
                   <h3 class="panel-title">E-Wallet</h3>
               </div>
                <div class="panel-body">
                 <h4 class="">Wallet Balance</h4>
               
                 <h4 class="">Total :$ {{$walletbalance}}</h4>
                 
              </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>
          </div>
          <div class="col-md-6">
              
            <div class="panel panel-danger">

               <div class="panel-heading">
                   <h3 class="panel-title">Total Refferal Bonus</h3>
               </div> 
                <div class="panel-body">
                  <h4>$ {{$refferralbonus}}</h4>
                </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>
          </div>
          <div class="col-md-6">
           
                  
            <div class="panel panel-danger">

               <div class="panel-heading">
                   <h3 class="panel-title">Total level Bonus Earned</h3>
               </div>
                <div class="panel-body">
                  <h4>$ {{$levelbonus}}</h4>
                </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>
          </div>

          <div class="col-md-6">
           
                  
            <div class="panel panel-danger">

               <div class="panel-heading">
                   <h3 class="panel-title">Total Stage completion Bonus Earned</h3>
               </div>
                <div class="panel-body">
                  <h4>$ {{$completionbonus}}</h4>
                </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>
          </div>
          <div class="col-md-6">
               <a href="{{url('/showlock')}}"><h1>Login to use wallet</h1></a>
          </div>
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
