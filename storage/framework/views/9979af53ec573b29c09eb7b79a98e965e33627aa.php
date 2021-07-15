<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Your Sub Accounts</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        
         <!--/.personal box -->

        <div class = "box-body">
    <?php if($results==null): ?>
       <H1>You have no sub account under your main account</H1>
    <?php else: ?>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                           
                            <th>Membership Id</th>
                            <th>Stage</th>

                            <th>Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
     <?php foreach($results as $result): ?>
         <tr>  
           <td><?php echo $result->membershipid; ?></td>
           <td><?php echo $result->stage; ?></td> 
           <td><a class="btn btn-success" href="<?php echo e(url('/subaccount')); ?>/<?php echo $result->membershipid; ?>">View Downlines</a>
           </td>
         </tr>          
    <?php endforeach; ?>
         </tbody>

      </table>                
      <?php endif; ?>  
                            
        </div>
    
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<!-- The daterange picker bootstrap plugin -->
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    $(document).ready(function () {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>