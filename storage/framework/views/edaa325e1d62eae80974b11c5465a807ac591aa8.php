<?php $__env->startSection('stylesheet'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">change User Transaction password</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="form-horizontal" method="POST" action="<?php echo e(url('/showchangetransactionpassword')); ?>">
                    <!--<div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">parent</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="ansector" name="ansector" placeholder="Parent">
                      </div
                    </div>-->
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Enter membership id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="membershipid" placeholder="Enter user membershipid" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="" name="password" placeholder="new password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Change Transaction password</button>
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