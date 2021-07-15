<?php $__env->startSection('stylesheet'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Paid Payouts</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      

                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Payout  Id</th>
                            <th>User Id</th>
                            <th>Amount</th>
                            <th>Accountname</th>
                            <th>Account Number</th>
                            <th>Bank Name</th>
                            <th>Status</th>
                            <th>Date Requested</th>
                            <th>Date Paid</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
       <?php foreach($payouts as $payout): ?>
         <tr>
        
           <td><?php echo $payout->id; ?></td>
           <td><?php echo $payout->userid; ?></td>
           <td><?php echo $payout->amount; ?></td> 
           <td ><?php echo $payout->accountname; ?></td> 
           <td ><?php echo $payout->accountnumber; ?></td> 
           <td ><?php echo $payout->bankname; ?></td> 
           <td ><?php echo $payout->status; ?></td> 
           <td><?php echo $payout->created; ?></td> 
           <th><?php echo $payout->datepaid; ?></th>
           
         </tr>          
         <?php endforeach; ?>

                    </tbody>

                </table>
 <div class="pagination"> <?php echo e($payouts->links()); ?> </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>