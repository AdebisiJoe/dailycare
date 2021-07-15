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
            <h3 class="box-title">Stage Matrix Tree</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">
 
          <div id="chart-container" >
              <?php echo $data; ?>

          </div>
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
<script type="text/javascript">
//var  data="<?php echo URL::route('jsonfortree'); ?>";

     //$('#chart-container').orgchart({
    
      //'data' :data ,
      //'depth': 2,
      //'nodeContent': 'name'
   // });
 //var baseurl = window.location.origin+window.location.pathname;
 //var baseurl = window.location.origin+window.location;
 //var baseurl=location.protocol + "//" + location.hostname;
function getRootUrl() {
  // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   //indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
//return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') +'/';
  
  return window.location.origin;
}
var baseurl=getRootUrl();

    $('#chart-container').orgchart({
     
      'data' : $('#ul-data'),
      //'nodeContent':'stage',
      'exportButton': true,
      'exportFilename': 'My Downlines',
    
      'createNode': function($node, data) {
    //id_arr = $("li").attr('id');
      
        value = data.id.split("_");
        var img=value[0];
        var username=value[1];
        var firstname=value[2];
        var lastname=value[3];
        var empty="empty";
        if (username==empty) {
          /*$node.children('.title').html('<img src="http://localhost:800/mywebsites/laravel%20MLM/public/imgavatar/' +img+ '.jpg" widht="50%" height="50%">');*/

          $node.children('.title').html('<img src="<?php echo e(url('/')); ?>/imgavatar/' +img+ '.jpg" widht="50%" height="50%">');
        } else {
          /*$node.children('.title').html('<p style="">'+firstname+' '+lastname+'</p><p style="">'+username+'</p><img src="http://localhost:800/mywebsites/laravel%20MLM/public/imgavatar/' + img+ '.jpg" widht="50%" height="50%">');*/
          $node.children('.title').html('<p style="">'+firstname+' '+lastname+'</p><p style="">'+username+'</p><img src="<?php echo e(url('/')); ?>/imgavatar/' + img+ '.jpg" widht="50%" height="50%">');
        }
       
      
        
         
         // $node.children('.title').append('<img src="http://localhost:800/mywebsites/laravel%20MLM/public/imgavatar/' + data.id + '.jpg" widht="100%" height="100%">');
      }




    });

   // $('#btn-export-hier').on('click', function() {
     // if (!$('pre').length) {
       // var hierarchy = $('#chart-container').orgchart('getHierarchy');
        //$('#btn-export-hier').after('<pre>').next().append(JSON.stringify(hierarchy, null, 2));
     // }
   // });

//  });  
</script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>