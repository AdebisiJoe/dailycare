<?php $__env->startSection('stylesheet'); ?>
        <!-- DataTables CSS -->
    <link href="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(asset('plugins/datatables-responsive/css/dataTables.responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('chart_dist/css/jquery.orgchart.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <section class="content">
 <div class="col-md-offset-4 col-md-4"><h3>Membershipid:<?php echo e($membershipid); ?> Stage: <?php echo e($stage); ?></h3></div>
 <input type="hidden" name="" id="theusermembershipid" value="<?php echo e($membershipid); ?>">
<div class="row">
 <div class="col-md-offset-3 col-md-9 col-lg-12 col-xs-12">
 

  <!-- <div class="col-md-3">
    <div class="tile2">
      <div class="col-md-offset-2 col-md-8">
        <i style="color:#f39c12" class="fa fa-calculator fa-4x"></i>
      </div>
      <button  class="bonusbtn btn btn-danger">Calculate Bonus</button>
    </div>
  </div>  -->

   <!-- <div class="col-md-3">
    <div class="tile2">
      <div class="col-md-offset-2 col-md-8">
        <i style="color:#f39c12" class="fa fa-users fa-4x"></i>
      </div>
      
      <button class="downlinesbtn btn btn-danger">Calculate Downlines</button>
    </div>
  </div> -->

</div> 
<div class="col-md-12 col-lg-12 col-xs-12">
           <div class="row">


            
             <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-wallet"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Wallet</span>
                        <span class="info-box-number" id="walletbalance">$ <?php echo e($walletbalance); ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                            <span class="progress-description">
                            <a style="color:#ffffff" href="<?php echo e(url('/showaccountdetails')); ?>/<?php echo e($membershipid); ?>" class="small-box-footer">
                                See wallet <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div><!-- ./col -->
            <!--<div class="col-lg-3 col-xs-6">
              
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>0</h3>
                  <p>Orders</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>-->
           
           
            <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-network-wired"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Downlines</span>
                        <span class="info-box-number" id="downlines"><?php echo e($downlines); ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                            <span class="progress-description">
                            <a style="color:#ffffff" href="<?php echo e(url('/subaccountdownlinestable')); ?>/<?php echo e($membershipid); ?>" class="small-box-footer">
                                See downlines <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>


           
            <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-user-friends"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Referrals</span>
                        <span class="info-box-number" id=""><?php echo e($reffered); ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                            <span class="progress-description">
                            <a style="color:#ffffff" href="#" class="small-box-footer">
                                See Referrals <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>




          </div><!-- /.row -->

</div>

</div>


    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Stage Matrix</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body" style="overflow-y:hidden;overflow-x:scroll;">
         
          <div id="chart-container" >
              <?php echo $treedata; ?>

          </div>
       
        </div>
    </div>
  <meta name="_token" content="<?php echo csrf_token(); ?>" />
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
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
</script>
<script type="text/javascript">



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
         

          $node.children('.title').html('<img src="<?php echo e(url('/')); ?>/imgavatar/' +img+ '.jpg" widht="50%" height="50%">');
        } else {
    
          $node.children('.title').html('<p style="">'+firstname+' '+lastname+'</p><p style="">'+username+'</p><img src="<?php echo e(url('/')); ?>/imgavatar/' + img+ '.jpg" widht="50%" height="50%">');
        }
       
      }




    });

 
</script>
<script>
(function($) {

    var queues = {};
    var activeReqs = {};

    // Register an $.ajaxq function, which follows the $.ajax interface, but allows a queue name which will force only one request per queue to fire.
    $.ajaxq = function(qname, opts) {

        if (typeof opts === "undefined") {
            throw ("AjaxQ: queue name is not provided");
        }

        // Will return a Deferred promise object extended with success/error/callback, so that this function matches the interface of $.ajax
        var deferred = $.Deferred(),
            promise = deferred.promise();

        promise.success = promise.done;
        promise.error = promise.fail;
        promise.complete = promise.always;

        // Create a deep copy of the arguments, and enqueue this request.
        var clonedOptions = $.extend(true, {}, opts);
        enqueue(function() {
            // Send off the ajax request now that the item has been removed from the queue
            var jqXHR = $.ajax.apply(window, [clonedOptions]);

            // Notify the returned deferred object with the correct context when the jqXHR is done or fails
            // Note that 'always' will automatically be fired once one of these are called: http://api.jquery.com/category/deferred-object/.
            jqXHR.done(function() {
                deferred.resolve.apply(this, arguments);
            });
            jqXHR.fail(function() {
                deferred.reject.apply(this, arguments);
            });

            jqXHR.always(dequeue); // make sure to dequeue the next request AFTER the done and fail callbacks are fired
            return jqXHR;
        });

        return promise;


        // If there is no queue, create an empty one and instantly process this item.
        // Otherwise, just add this item onto it for later processing.
        function enqueue(cb) {
            if (!queues[qname]) {
                queues[qname] = [];
                var xhr = cb();
                activeReqs[qname] = xhr;
            }
            else {
                queues[qname].push(cb);
            }
        }

        // Remove the next callback from the queue and fire it off.
        // If the queue was empty (this was the last item), delete it from memory so the next one can be instantly processed.
        function dequeue() {
            if (!queues[qname]) {
                return;
            }
            var nextCallback = queues[qname].shift();
            if (nextCallback) {
                var xhr = nextCallback();
                activeReqs[qname] = xhr;
            }
            else {
                delete queues[qname];
                delete activeReqs[qname];
            }
        }
    };

    // Register a $.postq and $.getq method to provide shortcuts for $.get and $.post
    // Copied from jQuery source to make sure the functions share the same defaults as $.get and $.post.
    $.each( [ "getq", "postq" ], function( i, method ) {
        $[ method ] = function( qname, url, data, callback, type ) {

            if ( $.isFunction( data ) ) {
                type = type || callback;
                callback = data;
                data = undefined;
            }

            return $.ajaxq(qname, {
                type: method === "postq" ? "post" : "get",
                url: url,
                data: data,
                success: callback,
                dataType: type
            });
        };
    });

    var isQueueRunning = function(qname) {
        return queues.hasOwnProperty(qname);
    };

    var isAnyQueueRunning = function() {
        for (var i in queues) {
            if (isQueueRunning(i)) return true;
        }
        return false;
    };

    $.ajaxq.isRunning = function(qname) {
        if (qname) return isQueueRunning(qname);
        else return isAnyQueueRunning();
    };

    $.ajaxq.getActiveRequest = function(qname) {
        if (!qname) throw ("AjaxQ: queue name is required");

        return activeReqs[qname];
    };

    $.ajaxq.abort = function(qname) {
        if (!qname) throw ("AjaxQ: queue name is required");
        
        var current = $.ajaxq.getActiveRequest(qname);
        delete queues[qname];
        delete activeReqs[qname];
        if (current) current.abort();
    };

    $.ajaxq.clear = function(qname) {
        if (!qname) {
            for (var i in queues) {
                if (queues.hasOwnProperty(i)) {
                    queues[i] = [];
                }
            }
        }
        else {
            if (queues[qname]) {
                queues[qname] = [];
            }
        }
    };

})(jQuery);
</script>
<script type = "text/javascript">



//$('.downlinesbtn').click(function() {
//var formdata={membershipid:$("#theusermembershipid").val(),accounttype:$("#registernum2").val()};

 $(document).ready(function() {



  $("#downlines").empty(); 
  $("#downlines").html('<i class="fa fa-spinner fa-spin"></i><br/><span style="font-size:20px">Please wait</span>');

var formdata={membershipid:$("#theusermembershipid").val()};
 $(".downlinesbtn").attr("disabled",true);
  //$("#pinvalue").html("<img src='<?php echo e(asset('images/availableimg/ajax-loader.gif')); ?>'/>");

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });
  $.ajaxq('MyQueue',{
  // $.ajax({
    type:"POST",
    url:"<?php echo URL::route('calculatedownlines'); ?>",
    data:formdata,
    dataType:'json',
    success:function(data){
  //$("#user-result").html(data); 
  console.log(data);
  
  $("#downlines").empty(); 
  
  $("#downlines").html(data.downlinescount);
  
  $('.downlinesbtn').removeAttr("disabled");
}
}

); 

});
</script>
<script type = "text/javascript">

 // $('.bonusbtn').click(function() {

$(document).ready(function() {   
    

  $(".bonusbtn").attr("disabled",true);
  $("#walletbalance").empty(); 
  $("#walletbalance").html('<i class="fa fa-spinner fa-spin"></i><br/><span style="font-size:20px">Please wait</span>');   
//var formdata={membershipid:$("#theusermembershipid").val(),accounttype:$("#registernum2").val()};
var formdata={membershipid:$("#theusermembershipid").val()};
  //$("#pinvalue").html("<img src='<?php echo e(asset('images/availableimg/ajax-loader.gif')); ?>'/>");

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });
  $.ajaxq('MyQueue',{
    type:"POST",
    url:"<?php echo URL::route('calculatebonus'); ?>",
    data:formdata,
    dataType:'json',
    success:function(data){
  //$("#user-result").html(data); 
  console.log(data);
  
  $("#walletbalance").empty(); 
  
  $("#walletbalance").html(data.walletbalance);
  $("#stage").empty(); 
  $("#stage").html(data.stage);
  $('.bonusbtn').removeAttr("disabled");
}
}
);
var run=$.ajaxq.isRunning('MyQueue');
if(run==true){
 $(window).bind('beforeunload',function(){
    return 'are you sure you want to leave you still have a task Running?';    
}); 
}   
        
});

</script>

<?php $__env->stopSection(); ?> 



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>