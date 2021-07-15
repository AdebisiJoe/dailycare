@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <!-- Main content -->
    <style>
        .overlay{
            user-select: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0px;
            left: 0px;
            z-index: 1001;
            background: #000000;
            opacity: 0.8;
        }
        @media print { body { display:none } } 

        .checkbox
        {
            border: 3px solid #000;
        }
    </style>

    @if ($stat == 0)
    <div class="overlay" style="
   opacity: 1 !important;user-select: none;
">
           <div class="container" style="background: #000; user-select: none;">
               <form method="post" id="acceptForm">
                   <div class="container" style="position: fixed;top: 20%;max-width:80%;margin-left:0px;border:1px solid #eee;background: #000;">

                       <h3 class="text-center " style="color:#ffffff;">TERMS AND CONDITIONS</h3>
                       <hr>
                       <div class="form-group acceptForm">
                            <input type="hidden" name="memid" id="memid" value="{{$membershipid}}"/>

<div style="max-height: 300px; overflow: auto; color: #fff; user-select: none;">

<h1>Policy stays Here</h1>
<div class="form-group acceptForm">
                            <input type="checkbox" id="acceptBox" name="accept" class="checkbox lg" style="display: inline;"/> &nbsp; &nbsp; &nbsp;
                            <label for="accept" style="z-index: 10000; opacity: 1!important; color: #ffffff"> By checking this, you agree to the<span style="color: red;font-size:25px"> Revised </span>Terms and Conditions</a>  of Unique Realty Solutions</label>
                           <div class="btn btn-raised btn-success pull-right acceptbtn" onclick="this.preventDefault();">
                               Accept
                           </div>
                       </div>
               </div>
&nbsp; &nbsp; &nbsp;

                       </div>


                       <div class="clearfix" style="margin-bottom: 15px;"></div>

                       <span style="padding: 15px; display: none;" class="alert alert-success" id="infobox">

                    </span>
                       <div class="clearfix" style="margin-bottom: 20px;"></div>
                       <div class="btn btn-primary btn-md continue" style="display: none;">
                           Continue
                       </div>
                   </div>
               </form>


               <div class="loader" id="loader"></div>

           </div>

       </div>
    @endif

    <section class="content">
       <div class="col-md-offset-3 col-md-6">  <h3>Membershipid:  {{$membershipid}} Stage: <span id="stage">{{$stage}}</span></h3></div>
        <input type="hidden" name="" id="theusermembershipid" value="{{$membershipid}}">
        <div class="row">
            
            <!-- <div class="col-md-offset-3 col-md-9 col-lg-12 col-xs-12">
                <div class="col-md-3">
                    <div class="tile2">
                        <div class="col-md-offset-2 col-md-8">
                            <i style="color:#f39c12" class="fa fa-refresh fa-4x"></i>
                        </div>
                        <button  class="bonusbtn btn btn-danger">Calculate Bonus</button>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="tile2">
                        <div class="col-md-offset-2 col-md-8">
                            <i style="color:#f39c12" class="fa fa-user fa-4x"></i>
                        </div>

                        <button class="downlinesbtn btn btn-danger">Calculate Downlines</button>
                    </div>
                </div>

            </div> -->

            <div class="col-md-12 col-lg-12 col-xs-12">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                   

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-wallet"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Wallet</span>
                        <span class="info-box-number" id="walletbalance">$ {{$walletbalance}}</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                            <span class="progress-description">
                            <a style="color:#ffffff" href="{{url('/showaccountdetails')}}" class="small-box-footer">
                                See wallet <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                    

               

                    
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-network-wired"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Downlines</span>
                        <span class="info-box-number" id="downlines">{{$downlines}}</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                            <span class="progress-description">
                            <a style="color:#ffffff" href="{{url('/showdownlines')}}" class="small-box-footer">
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
                        <span class="info-box-number" id="">{{$reffered}}</span>

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

                    
                    <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Transactions</span>
                        <span class="info-box-number" id="">0</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                            <span class="progress-description">
                            <a style="color:#ffffff" href="#" class="small-box-footer">
                                See Transactions <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                    
                    <!-- ./col -->

                    <!--<div class="col-lg-3 col-xs-6">-->

                    <!--    <div class="small-box bg-lime-active">-->
                    <!--        <div class="inner">-->
                    <!--            <h3>0</h3>-->
                    <!--            <p>Awards</p>-->
                    <!--        </div>-->
                    <!--        <div class="icon">-->
                    <!--            <i class="fa fa-trophy"></i>-->
                    <!--        </div>-->
                    <!--        <a href="{{url('/awards')}}" class="small-box-footer">-->
                    <!--            More info <i class="fa fa-arrow-circle-right"></i>-->
                    <!--        </a>-->
                    <!--    </div>-->
                    <!--</div><!-- ./col -->

                </div><!-- /.row -->

            </div>
        </div>
        <meta name="_token" content="{!! csrf_token() !!}" />
    </section>

    <!---section where terms and condition are -->
    <div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog modal-lg animated zoomIn animated-3x" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                    <h3 class="modal-title ext-center color-primary mb-4" id="myModalLabel2">Unique Realty Solutions
                        COMPANY POLICIES AND PROCEDURES</h3>
                </div>
                <div class="modal-body" style="max-height:300px; overflow: scroll;">
                      <h1>Policy stays Here</h1>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

<!--end of section for terms and condition-->
@endsection
@section('scripts')
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

            $(document).ready(function() {

            //not using button   
            //var r=confirm("This Might take up to a minute click Ok to continue");

           

           // if(r==true){
                $("#downlines").empty();
                $("#downlines").html('<i class="fa fa-spinner fa-spin"></i><br/><span style="font-size:20px">Please wait</span>');

                var formdata={membershipid:$("#theusermembershipid").val()};
                //$(".downlinesbtn").attr("disabled",true);
               

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajaxq('MyQueue',{
                        // $.ajax({
                        type:"POST",
                        url:"{!!URL::route('calculatedownlines')!!}",
                        data:formdata,
                        dataType:'json',
                        success:function(data){
                            //$("#user-result").html(data);
                            console.log(data);

                            $("#downlines").empty();

                            $("#downlines").html(data.downlinescount);

                           // $('.downlinesbtn').removeAttr("disabled");
                        }
                    }

                );

            //}
        });
    </script>
    <script type = "text/javascript">

        //$('.bonusbtn').click(function() {
        $(document).ready(function() {

           // var r=confirm("This Might take up to a minute click Ok to continue");
           // if(r==true){

                //$(".bonusbtn").attr("disabled",true);

                $("#walletbalance").empty();
                $("#walletbalance").html('<i class="fa fa-spinner fa-spin"></i><br/><span style="font-size:20px">Please wait</span>');

                var formdata={membershipid:$("#theusermembershipid").val()};
               

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajaxq('MyQueue',{
                        type:"POST",
                        url:"{!!URL::route('calculatebonus')!!}",
                        data:formdata,
                        dataType:'json',
                        success:function(data){
                            //$("#user-result").html(data);
                            console.log(data);

                            $("#walletbalance").empty();

                            $("#walletbalance").html(data.walletbalance);
                            $("#stage").empty();
                            $("#stage").html(data.stage);
                           // $('.bonusbtn').removeAttr("disabled");
                        }
                    }
                );
                var run=$.ajaxq.isRunning('MyQueue');
                if(run==true){
                    $(window).bind('beforeunload',function(){
                        return 'are you sure you want to leave you still have a task Running?';
                    });
                }
           // }
        });

    </script>


    <script type = "text/javascript">
        //ACCEPTANCE OF TERMS AND CONDITIONS

         $(document).ready(function () {

            $(".acceptbtn").click(function () {

                if ($("#acceptBox").is(':checked')) {

                    var memberId = $("#memid").val();

                    $("#loader").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{!!URL::route('acceptTerms')!!}",
                        dataType: 'json',
                        data: {'membershipid': memberId},
                        success: function (data) {
//                            alert(data);
                            var json = data;
                            if (json.successful === "success") {

                                $(".acceptForm").hide();
                                $("#infobox").show();

                                $("#infobox").html('YOU HAVE ACCEPTED UFS"s TERMS AND CONDITIONS');

                                $(".continue").show();

                                $("#loader").hide();

                            } else {

                                alert('something went wrong: check connection status');

                            }
                        }

                    });
                }else {
                    alert('You must accept by selecting the checkbox');
                }
            });

            $('.continue').click(function() {
                location.reload();
            });

//            end document.ready
        });
    </script>


@endsection