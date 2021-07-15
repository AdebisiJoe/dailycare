<?php $__env->startSection('content'); ?>
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
                 <h4>$<?php echo e($totalearnings); ?></h4>
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
               
                 <h4 class="">Total :$ <?php echo e($walletbalance); ?></h4>
                 
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
                  <h4>$ <?php echo e($refferralbonus); ?></h4>
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
                  <h4>$ <?php echo e($levelbonus); ?></h4>
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
                  <h4>$ <?php echo e($completionbonus); ?></h4>
                </div>
                <div class="panel-footer"><!--Panel footer>--></div>
           </div>
          </div>
          <div class="col-md-6">
               <a href="<?php echo e(url('/showlock')); ?>"><h1>Login to use wallet</h1></a>
          </div>
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