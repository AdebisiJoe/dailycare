<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
    <div class="col-md-offset-2 col-md-6">

       <div class="box box-default" style="margin-top:200px">
       
<?php if(Session::has('flash_error')): ?>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo e(Session::get('flash_error')); ?></div>
    <?php endif; ?>
                <div class="box-header with-border">
                  <h3 class="box-title">Login to Use your Wallet</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body" >
           <form class="form-horizontal"  method="POST" action="<?php echo e(url('/showaccount')); ?>"   >
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" name="transactionpass" placeholder="Account Password">
                      </div>
                    </div>
             <button type="submit" class="btn btn-danger">Sign in</button>
             </form>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    
                    
                  </div><!-- /.box-footer -->
                
              </div><!-- /.box -->
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
               

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>