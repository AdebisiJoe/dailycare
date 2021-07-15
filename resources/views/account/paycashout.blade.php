@extends('layouts.app')

@section('content')
<div class="callout callout-warning">
<h4>Payout Cash withdrawal involves an admin charge of 5% of the transferred amount!</h4>

  <p>Enter the amount below to continue.</p>
</div>
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Payout Cash</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <form method='post' id='' action = "{{url('/payoutcash')}}" class="form-horizontal"> 


        <div class="form-group">

          <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-addon">&#8358;</div>
              <input type="number" class="form-control" id="exampleInputAmount" name="amount" placeholder="Amount" required>
              <div class="input-group-addon">.00</div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input style="margin-top:20px" type='submit' name='submit' class='btn btn-danger' value='Cash Out'> 
          </div>
        </div>
      </form>
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
