<?php $__env->startSection('stylesheet'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Registrations per day</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-calendar"></i></span><input type="text" name="range" id="range" />
                            </div>
                        </fieldset>
                    </form>

            <div id="placeholder">
                <div id="chart"></div>
                 
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