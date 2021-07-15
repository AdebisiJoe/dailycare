<?php $__env->startSection('stylesheet'); ?>
        <!-- DataTables CSS -->
    <link href="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(asset('plugins/datatables-responsive/css/dataTables.responsive.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Transactions</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Transaction Id</th>
                            <th>User Id</th>
                            <th>Type</th>

                            <th>Receiver Id</th>
                            <th>Amount</th>
                            <th>Time created</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
       <?php foreach($records as $record): ?>
         <tr>
        
           <td><?php echo $record->id; ?></td>
           <td><?php echo $record->userid; ?></td>
           <td><?php echo $record->type; ?></td> 
           <td><?php echo $record->receiverid; ?></td> 
           <td><?php echo $record->amount; ?></td> 
           <td><?php echo $record->created_at; ?></td> 
         </tr>          
         <?php endforeach; ?>

                    </tbody>

                </table>

      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
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



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>