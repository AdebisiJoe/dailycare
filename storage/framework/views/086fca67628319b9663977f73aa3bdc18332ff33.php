<?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" href="<?php echo e(asset('jssocials/jssocials.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('jssocials/jssocials-theme-flat.css')); ?>" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Marketting Tools
  </h1>
</section>

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Referral Link</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-10">
            <div class="form-group">
              <input class="form-control share_ref_link" id="foo" value="https://www.feedthenations.org/join-now/<?php echo e($username); ?>" type="text">
            </div>

             <div id="share_ref_link"></div>
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
<script src="<?php echo e(asset('jssocials/jssocials.min.js')); ?>"></script>
<script>
  $("#share_ref_link").jsSocials({
    url: "https://www.feedthenations.org/join-now/<?php echo e($username); ?>",
    text: "Invitation To feedthenations",
    showLabel: false,
    showCount: false,
    shareIn: "popup",
    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "whatsapp", "messenger"]
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>