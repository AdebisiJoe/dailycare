<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Fund your account</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
           <form method='post' id='upay_form' name='upay_form' action='https://fidelitypaygate.fidelitybankplc.com/cipg/MerchantServices/MakePayment.aspx' target='_top' class="form-horizontal"> 
                      <input type='hidden' name='mercId' value='00037'>
                      <input type='hidden' name='currCode' value='566'>
                      
                    <div class="form-group">
    
    <label for="inputEmail3" class="col-sm-2 control-label">Amount</label>
    <div class="col-sm-10">
    <div class="input-group">
      <div class="input-group-addon">&#8358;</div>
      <input type="text" class="form-control" id="exampleInputAmount" name="amt" placeholder="Amount">
      <div class="input-group-addon">.00</div>
    </div>
    </div>
  </div>
                      <input type='hidden' name='orderId' value='67'> 
                      <input type='hidden' name='prod' value='Fund Account'>


                              <div class="form-group">
    
    <label for="inputEmail3" class="col-sm-2 control-label">Enter Email</label>
    <div class="col-sm-10">
    
      
      <input type="email" class="form-control" id="exampleInputAmount" name="email" placeholder="Email">
    
    </div>
  </div>

                      <input type='hidden' name='declineurl' value=''> 
                      <input type='hidden' name='exceptionurl' value=''> 
                      <input type='hidden' name='cancelurl' value=''> 

                       <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input style="margin-top:20px" type='submit' name='submit' class='btn btn-success btn-lg' value='Pay'> 
    </div>
  </div>
                  </form>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<!-- The daterange picker bootstrap plugin -->

<script src="<?php echo e(asset('plugins/daterangepicker/moment.min.js')); ?>"></script> 
<script src="<?php echo e(asset('plugins/daterangepicker/sugar.min.js')); ?>"></script> 

<script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script> 

<script src="<?php echo e(asset('plugins/daterangepicker/raphael.js')); ?>"></script> 

<script src="<?php echo e(asset('plugins/morris/morris.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/daterangepicker/morrischarthelp.js')); ?>"></script> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>