<?php $__env->startSection('stylesheet'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">change users password</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" method="POST" action="<?php echo e(url('/generatepin')); ?>">

                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Number of pins to Generate</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="inputnumber" name="inputnumber"  placeholder="Enter Number of Pins to Generate">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6">
                            <button style="margin-top:15px" type="submit" id="submit" class="btn btn-danger">Generate Pin</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>