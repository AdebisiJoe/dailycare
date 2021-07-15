<?php $__env->startSection('stylesheet'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Unprinted Pins</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">


                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                    <tr>

                        <td>No of Pins</td>
                        <td>pins range</td>
                        
                        <td>Generated By</td>
                        <td>Date Generated</td>
                        
                    </tr>
                    </thead>
                    <tbody>


                    <?php foreach($unprintedpins as $unprintedpin): ?>
                        <tr>

                            <td><?php echo $unprintedpin->numberofpins; ?></td>
                            <td><?php echo $unprintedpin->minid; ?>---<?php echo $unprintedpin->maxid; ?></td>
                           
                            <td><?php echo $unprintedpin->generated_by; ?></td>
                            <td><?php echo $unprintedpin->date_generated; ?></td>

                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>