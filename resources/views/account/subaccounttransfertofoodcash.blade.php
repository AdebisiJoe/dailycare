@extends('layouts.app')

@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Payout cash to food cash</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
     <form class="form-inline">

     </form>


     <form class="form-horizontal" method = "post" action ="{{url('/subaccounttranfertofoodcash')}}">

       <div class="form-group">

        <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
        <div class="col-sm-10">
        <input type="hidden"  name="membershipid" value="{{$membershipid}}">
          <div class="input-group">
            <div class="input-group-addon">&#8358;</div>
            
            <input type="number" name="amount" class="form-control" id="exampleInputAmount" placeholder="Amount to transfer" required>
            <div class="input-group-addon">.00</div>
          </div>
        </div>
      </div>

      <!--<div class="form-group">

        <label for="inputEmail3" class="col-sm-2 control-label">choose Account</label>
        <div class="col-sm-10">

          <select class="form-control " name="accounttype"  required>
          <option class="0" disabled="true" selected="true">--Account type--</option>
            <option class="1" value="foodcash">Food cash</option>
            <option class="2" value="payoutcash">Payout</option>
          </select>
        </div>
      </div>-->




      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-danger">Transfer cash</button>
       </div>
     </div>
   </form>





    <a href="{{url('/')}}"></a>
 </div>
</div>
</section>

@endsection
@section('scripts')
<!-- The daterange picker bootstrap plugin -->

@endsection
