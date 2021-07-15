<?php $__env->startSection('stylesheet'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">password</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
    <h3>Ewallet password</h3>
      <form class="form-horizontal" method="POST" action="<?php echo e(url('/changewalletpassword')); ?>">
        <div class="form-group" id="oldpassword">
          <label  class="col-sm-2 control-label">Current Password</label>
          <div class="col-sm-6">
            <input type="text" name="oldpassword" class="form-control" id="inputoldpassword"  placeholder="Current password">
          </div>
        </div>
        <div class="form-group" id="newpassword">
          <label  class="col-sm-2 control-label">New password</label>
          <div class="col-sm-6">
            <input type="text" name="newpassword" class="form-control" id="inputnewpassword" placeholder="New password">
          </div>
        </div>
        <div class="form-group" id="confirmnewpassword">
          <label  class="col-sm-2 control-label">Confirm New password</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="confirmnewpassword" id="inputconfirmnewpassword" placeholder="Confirm new password">
          </div>
        </div>



        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">Update</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">

 $("#inputconfirmnewpassword").keyup(function (e) {

   var password1 = $('#inputnewpassword').val();
   var password2 = $('#inputconfirmnewpassword').val();

   if (password1==password2) {

     $("#newpassword").removeClass("has-error has-feedback");
     $("#confirmnewpassword").removeClass("has-error has-feedback");
     $("#inputconfirmnewpassword").removeAttr("data-toggle data-placement title");
     $('#inputconfirmnewpassword').tooltip('destroy');

   } else {

    $("#newpassword").addClass("has-error has-feedback");
    $("#confirmnewpassword").addClass("has-error has-feedback");
    $("#inputconfirmnewpassword").attr({'data-toggle':"tooltip",'data-placement':"right", title:"This password is not the same with the one above"});
    $('#inputconfirmnewpassword').tooltip('show');

  }



});


</script>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>