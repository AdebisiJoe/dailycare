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
                 <h4 class="">Food Cash : <span class="pull-right">Payout cash :</span></h4>
                 <h4>$ {{$foodcash}} <span class="pull-right">$ {{$payoutcash}}</span></h4>
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
               

            <div class="panel panel-danger">

               <div class="panel-heading">
                   <h3 class="panel-title">Wallet functions</h3>
               </div>
                <div class="panel-body">
                <div class="row">
                  <div class="col-md-6">
                    <a class="btn btn-danger" href="{{url('/transfertomain')}}/{{$membershipid}}">Transfer cash to main Account</a>
                  </div>
                  <div class="col-md-6" >
                    <a class="btn btn-danger" href="{{url('/subaccounttranfertofoodcash')}}/{{$membershipid}}">Transfer payout cash to food cash</a>
                  </div>
                </div> 
                </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>

          </div>
       </div>
    </div>
</section>

@endsection
@section('scripts')
<script type="text/javascript">
  
</script>
<script type="text/javascript"></script>
@endsection
