<?php $__env->startSection('stylesheet'); ?>
    <!-- DataTables CSS -->
    <link href="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(asset('plugins/datatables-responsive/css/dataTables.responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('chart_dist/css/jquery.orgchart.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Downlines</h3>
                <h2>Showing only 100 downlines per page. <small>Click on previous 100 or next 100 button to view more.</small></h2>

                <div>  
                    <!--<ul class="pagination no-margin pull-left">-->
                        <?php if($take < 2): ?>
                            <a class="btn btn-danger" href="<?php echo e(url('showmemberstablegraph/1/100')); ?>"> « Previous 100 </a>
                        <?php else: ?>
                            <a class="btn btn-danger" href="<?php echo e(url('showmemberstablegraph/' . ($take - 1) . '/100')); ?>"> « Previous 100 </a>
                        <?php endif; ?>
                        
                        <?php if($take == 0): ?>
                            <a class="btn btn-success"  href="<?php echo e(url('showmemberstablegraph/' . ($take + 2) . '/100')); ?>"> Next 100 »</a>
                        <?php else: ?>
                            <a class="btn btn-success"  href="<?php echo e(url('showmemberstablegraph/' . ($take + 1) . '/100')); ?>"> Next 100 »</a>
                        <?php endif; ?>
                    <!--</ul>-->
                </div>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">

                <h1>members to the left leg</h1>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                    <thead>
                    <tr>
                        <th>MembershipId</th>
                        <th>Username</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($firstrightchildmembers as $member): ?>
                        <tr>

                            <td><?php echo $member->membershipid; ?></td>
                            <td><?php echo $member->username; ?></td>
                            

                        </tr>
                    <?php endforeach; ?>




                    </tbody>

                </table>
                <div class="pagination"> </div>

                <h1>members to the right leg</h1>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                    <thead>
                    <tr>
                        <th>MembershipId</th>
                        <th>Username</th>
                        

                    </tr>
                    </thead>
                    <tbody>


                    <?php foreach($firstleftchildmembers  as $member): ?>
                        <tr>

                            <td><?php echo $member->membershipid; ?></td>
                            <td><?php echo $member->username; ?></td>
                            

                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>



                <!-- <button id="btn-export-hier" class="btn btn-success" >Get Hire</button>-->
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

    <script type="text/javascript" src="<?php echo e(asset('chart_dist/js/html2canvas.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('chart_dist/js/jquery.orgchart.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        $(document).ready(function () {
            $('#dataTables-example2').DataTable({
                responsive: true
            });
        });
        $(document).ready(function () {
            $('#dataTables-example3').DataTable({
                responsive: true
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>