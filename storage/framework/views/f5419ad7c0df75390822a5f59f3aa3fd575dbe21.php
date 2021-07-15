<?php $__env->startSection('stylesheets'); ?>
  <style type="text/css">
      @media  print {
        .page-break { display: block; page-break-before: always; }
      }
  </style>
  <style type="text/css" href="<?php echo e(asset('/plugins/toastr/toastr.min.css')); ?>"></style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Operations</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->

    <div class="box-body">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs nav-horizontal">
          <li class="active"><a href="#tab_0" data-toggle="tab" aria-expanded="true">User Information</a></li>
          <li><a href="#tab_1" data-toggle="tab" aria-expanded="true">Food Collection</a></li>
          <li><a href="#tab_5" data-toggle="tab" aria-expanded="true">Depth Related Issues</a></li>
          <li><a href="#tab_2" data-toggle="tab" aria-expanded="false">Create Group</a></li>
          <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">PIN Issues</a></li>
          <li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Edit Product Info</a></li>
         <!-- <li><a href="#tab_5" data-toggle="tab" aria-expanded="false">Login Issues</a></li>-->
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_0">
            <div role="tabpanel" class="nav-tabs-custom">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#userInfo" aria-controls="userInfo" role="tab" data-toggle="tab">View User Info</a>
                </li>
                <li role="presentation">
                  <a href="#userParent" aria-controls="userParent" role="tab" data-toggle="tab">View User Parent</a>
                </li>
                <li role="presentation">
                  <a href="#userDownlines" aria-controls="userDownlines" role="tab" data-toggle="tab">View User Downlines</a>
                </li>
                <li role="presentation">
                  <a href="#userStageMatrix" aria-controls="userStageMatrix" role="tab" data-toggle="tab">View User Matrix</a>
                </li>
                <li role="presentation">
                  <a href="#userAccountBalance" aria-controls="userAccountBalance" role="tab" data-toggle="tab">View User Account Balance</a>
                </li>
                <li role="presentation">
                  <a href="#calculateBonus" aria-controls="calculateBonus" role="tab" data-toggle="tab">Calculate Bonus</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <!-- View User Information -->
                <div role="tabpanel" class="tab-pane active" id="userInfo">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="user_id1" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getUserInfo()"><span id="spinner1">User Info</span></button>
                    </span>
                  </div>
                </div>
                <!-- View User Parent -->
                <div role="tabpanel" class="tab-pane" id="userParent">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="user_id2" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getParent()"><span id="spinner2">Get Parent</span></button>
                    </span>
                  </div>
                </div>
                <!-- View User Downlines -->
                <div role="tabpanel" class="tab-pane" id="userDownlines">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="user_id_downlines" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getDownlines()"><span id="spinner_downlines">Get Downlines</span></button>
                    </span>
                  </div>
                </div>
                <!-- View User Stage Matrix -->
                <div role="tabpanel" class="tab-pane" id="userStageMatrix">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="user_id_matrix" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getUserMatrix()"><span id="spinner_matrix">Get User Matrix</span></button>
                    </span>
                  </div>
                </div>
                <!-- View USer Balance -->
                <div role="tabpanel" class="tab-pane" id="userAccountBalance">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="user_id_balance" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getUserAccountBalance()"><span id="spinner_balace">Get User Account Balance</span></button>
                    </span>
                  </div>
                </div>
                <!-- Calculate User Bonus -->
                <div role="tabpanel" class="tab-pane" id="calculateBonus">
                  <b>NOT YET AVAILABLE</b>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab_1">
            <div role="tabpanel" class="nav-tabs-custom">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#food_form" aria-controls="food_form" role="tab" data-toggle="tab">Form</a>
                </li>
                <li role="presentation">
                  <a href="#food_log" aria-controls="food_log" role="tab" data-toggle="tab">Log</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="food_form">
                  <div class="row">
                      <div class="form-group">
                          <label for="input" class="col-sm-2 control-label">Enter Membership ID:</label>
                          <div class="col-sm-10">
                              <input type="text" name="" placeholder="Membership ID" id="buyer_id" id="input" class="form-control" required="required">
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="form-group">
                          <label for="input" class="col-sm-2 control-label">Group Leader:</label>
                          <div class="col-sm-10">
                              <select name="" id="group-leader-id" id="input" class="form-control" required="required">
                                  <option value="-1" selected>--Select Group Leader--</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <meta name="_token" content="<?php echo csrf_token(); ?>" />
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody id="items">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td><span id="totalQty"></span></td>
                                    <td class="text-right"><strong><span id="totalAmount"></span></strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                      <button onclick="addNewItem();" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add New Item"><i class="fa fa-plus"></i></button>
                                      <button type="button" class="submit btn btn-success" onclick="submitForm()" data-toggle="tooltip" data-placement="top" title="Submit Form"><i class="fa fa-save"></i></button>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                     </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="food_log">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="user_id_food_log" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getUserFoodCollectionLog()"><span id="spinner_food_log">Get User Food Collection Log</span></button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <!-- </div> -->
          </div>
          
          <!-- /. end of tab -->
          <div class="tab-pane" id="tab_5">
            <div role="tabpanel" class="nav-tabs-custom">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#check_depth_issue" aria-controls="check_depth_issue" role="tab" data-toggle="tab">Check Issue</a>
                </li>
                <li role="presentation">
                  <a href="#fix_depth_issue" aria-controls="fix_depth_issue" role="tab" data-toggle="tab">Fix Stage 1 Depth Issue</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="check_depth_issue">

                <div class="form-group">
                  <label for="prodName">Enter Upline ID</label>
                    <input type="text" placeholder="Enter Upline ID" id="checkDepthIssue_upline" class="form-control">
                </div>
                <div class="form-group">
                  <label for="prodName">Membership ID</label>
                    <input type="text" placeholder="Enter Membership ID" id="checkDepthIssue_member" class="form-control">
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-info" onclick="checkDepthIssue()"><span id="spinner_food_log">Check Depth Issue</span></button>
                </div>
                
                </div>

                <div role="tabpanel" class="tab-pane" id="fix_depth_issue">
                  <div class="input-group">
                    <input type="text" placeholder="Enter Membership ID" id="fixStageOneDepthIssue" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="fixStageOneDepthIssue()"><span id="spinner_food_log">Fix Stage 1 Depth Issue</span></button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <!-- </div> -->
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="tab_2">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_grp" data-toggle="tab" aria-expanded="true">All Groups</a></li>
                <li class=""><a href="#tab_create" data-toggle="tab" aria-expanded="false">Create Group</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_grp">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Owner ID <i class="loader"></th>
                        <th>Group Name <i class="loader"></th>
                        <th>Country <i class="loader"></th>
                        <th>State <i class="loader"></th>
                        <th>Action <i class="loader"></th>
                      </tr>
                    </thead>
                    <tbody id="list-of-groups">

                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_create">
                  <div class="form-horizontal">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="inputOwnerID" class="col-sm-2 control-label">Owner ID </label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputOwnerID" placeholder="Owner ID">
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="inputGroupCountry" class="col-sm-2 control-label text-right"><span class="text-danger">*</span> Country</label>
                          <div class="col-sm-10">
                              <select name="country" id="inputGroupCountry" onchange="loadState()" class="form-control"></select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputGroupState" class="col-sm-2 control-label text-right"><span class="text-danger">*</span> State</label>
                          <div class="col-sm-10">
                              <select id="inputGroupState" name="state" class="form-control cs-states"></select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="inputGroupName" class="col-sm-2 control-label">Group Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputGroupName" placeholder="Group Name">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="button" data-loading-text="Creating Group" data-done-text="Group Created" data-reset-text="Create Group" class="btn btn-success pull-right" onclick="createGroup()"><i class="fa fa-save"></i>&nbsp;<span id="spinner">Create Group</span></button>
                    </div>
                    <!-- /.box-footer -->
                  </div>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
          </div>

          <div class="tab-pane" id="tab_3">
            <div role="tabpanel" class="nav-tabs-custom">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-horizontal" role="tablist">
                <li role="presentation" class="active">
                  <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Check PIN Status</a>
                </li>
                <li role="presentation">
                  <a href="#fix-pin" aria-controls="fix-pin" role="tab" data-toggle="tab">Fix Used PIN</a>
                </li>
                <li role="presentation">
                  <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Re-print PIN</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                  <br>
                  <div class="input-group">
                    <input type="text" id="pin_id" placeholder="Enter Membership ID" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getPINStatus()"><span id="spinner3">Check PIN Status</span></button>
                    </span>
                  </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="fix-pin">
                  <br>                
                  <div class="input-group">
                    <input type="text" id="fix-pin-membership-id" onkeyup="getPINInformation()" placeholder="Enter Membership ID" class="form-control">
                    <span class="input-group-btn"><button type="button" class="btn btn-info fix-pin-issue" onclick="fixUserPinIssue()"><span id="spinner4">Fix PIN Issue</span></button></span>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tab">
                  <br>
                  <div class="input-group">
                    <input type="text" id="pin_range" placeholder="Enter PIN ID Range e.g (300-305)" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info" onclick="getPINReprint()"><span id="spinner4">View PIN Re-print</span></button>
                    </span>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="tab_4">
            <div class="form-group">
              <label for="input_products">Select Product</label>
              <select name="" id="input_products" class="form-control" required="required" onchange="loadProductInfo()">
              </select>
            </div>
            <div class="form-group">
              <label for="prodName">Product Name</label>
              <input type="text" class="form-control" id="prodName" placeholder="Product Name">
            </div>
            <div class="form-group">
              <label for="prodPrice">Product Price</label>
              <input type="number"  onkeypress="return numbersonly(event);" class="form-control" id="prodPrice" placeholder="Product Price">
            </div>
            <div class="form-group">
              <button type="button" id="update-prod-info" onclick="updateProdInfo()" class="btn btn-info"><span id="spinner_product">Update Product Information</span></button>
            </div>
          </div>

          <div class="tab-pane" id="tab_5">
            <div role="tabpanel" class="nav-tabs-custom">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-horizontal" role="tablist">
                <li role="presentation" class="active">
                  <a href="#change-username" aria-controls="home" role="tab" data-toggle="tab">Change Username</a>
                </li>
<!--                 <li role="presentation">
                  <a href="#change-password" aria-controls="tab" role="tab" data-toggle="tab">Change Password</a>
                </li> -->
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="change-username">
                  <br>
                  <div class="form-group">
                    <label for="">Enter Membership ID</label>
                    <input type="text" id="change-username-membership-id" onkeyup="getMemberUsername();" placeholder="Enter Membership ID" class="form-control">
                  </div>
                
                  <label for="">Enter New Username</label>
                  <div class="input-group">
                    <input type="text" id="change-username-new-username" onkeyup="isUsernameUnique()" placeholder="Enter New Username" class="form-control">
                    <input type="hidden" id="change-username-new-user-id" value="">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info change-username" onclick="changeUsername()"><span id="spinner4">Change Username</span></button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
        </div>

        <!-- /.tab-content -->
      </div>

   </div>
 </div>
      <!-- Load Result Here -->
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Results</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" onclick="printReport('reportForm')"><i class="fa fa-print"></i></button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->

    <div class="box-body">
      <div id="result" class="reportForm"></div>
    </div>
</div>

<div class="modal fade" id="editGroupModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Group</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label for="inputOwnerID" class="col-sm-2 control-label">Owner ID </label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="modal-inputOwnerID" placeholder="Owner ID">
              </div>
            </div>

            <div class="form-group">
                <label for="inputGroupCountry" class="col-sm-2 control-label text-right"><span class="text-danger">*</span> Country</label>
                <div class="col-sm-10">
                    <select name="modal-country" id="modal-inputGroupCountry" onchange="loadStates()" class="form-control"></select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputGroupState" class="col-sm-2 control-label text-right"><span class="text-danger">*</span> State</label>
                <div class="col-sm-10">
                    <select id="modal-inputGroupState" name="modal-state" class="form-control cs-states"></select>
                </div>
            </div>
            <div class="form-group">
              <label for="inputGroupName" class="col-sm-2 control-label">Group Name</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="modal-inputGroupName" placeholder="Group Name">
                <input type="hidden" id="modal-id">
              </div>
            </div>
          </div>
          <!-- /.box-footer -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateGroup(1)">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('plugins/country_state/country_state.js')); ?>"></script>

<script type="text/javascript">
  init('Nigeria','inputGroupCountry', 'inputGroupState');
  function loadState() {
    selectState('inputGroupCountry', 'inputGroupState'); 
  }

  function loadStates() {
    selectState('modal-inputGroupCountry', 'modal-inputGroupState'); 
  }
</script>

<script type="text/javascript">
  var products = '';
  var groups = '';

  getProducts();

  $(document).ready(function(){
    $('.loader').addClass("fa fa-spinner fa-spin fa-1x fa-fw");

    $.ajax({
      url: '<?php echo e(url("/")); ?>/food-collection/groups/list',
      type: 'get',
      dataType: 'html',
      complete: function() {
        $('.loader').removeClass("fa fa-spinner fa-spin fa-1x fa-fw");
      },
      success: function(data) {

        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  function printReport(divName) {
    $("." + divName).printThis({
      "importStyle": true,
      "loadCSS": "<?php echo e(asset('bootstrap/css/bootstrap.min.css')); ?>",
    });
  }

  function getProducts() {

    $.ajax({
        type:"GET",
        url: '<?php echo e(url("/")); ?>/admin-operation/get-products',
        dataType:'json',
        success:function(product){
            products = product;
            $('#input_products').find('option').remove().end().append('<option value="-1" selected>--Select Products--</option>').val('-1');
            $.each(product, function(key, value) {
               $('#input_products')
                   .append($("<option></option>")
                              .attr("value", value["id"])
                              .text(value["item_name"]));
            });
        }
    });
  }

  function loadProductInfo() {
    var e = document.getElementById('input_products');
    var selVal = e.options[e.selectedIndex].value;

    $.each( products, function( key, value ) {
        if(value["id"] == selVal){
            $('#prodName').val(value["item_name"]);
            $('#prodPrice').val(value["price"]);
        }
    });
  }

    function numbersonly(e) {
      var unicode = e.charCode ? e.charCode : e.keyCode
      if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
          if (unicode < 48 || unicode > 57)
              return false
      }
  }

  function updateProdInfo() {
    var e = document.getElementById('input_products');
    var prodID = e.options[e.selectedIndex].value;
    var prodName = $('#prodName').val();
    var prodPrice = $('#prodPrice').val();
    if(prodName == '' || prodPrice == ''){
      return false;
    }

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/update-prod-info',
      type: 'get',
      data: 'id=' + prodID + '&price=' + prodPrice + '&item_name=' + prodName,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner_product').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Updating Product Information...');
      },
      complete: function() {
        $('#spinner_product').html('Update Product Information');
      },
      success: function(data) {
        $('#prodName').val('');
        $('#prodPrice').val('');
        getProducts();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function createGroup() {
    // Check If Fields are empty
    var ownerID = $('#inputOwnerID').val();
    var groupName = $('#inputGroupName').val();
    var groupCountry = $('#inputGroupCountry').val();
    var groupState = $('#inputGroupState').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/food-collection/groups/save',
      type: 'get',
      data: 'owner_id=' + ownerID + '&group_name=' + groupName + '&group_country=' + groupCountry + '&group_state=' + groupState,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Creating Group...');

      },
      complete: function() {
        $('#spinner').html('Create Group');
      },
      success: function(data) {
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function deleteGroup(id) {
  	return false;
    $.ajax({
      url: '<?php echo e(url("/")); ?>/food-collection/groups/delete',
      type: 'post',
      data:
      {
          "_token": "<?php echo e(csrf_token()); ?>",
          "id": id,
      },
      dataType: 'html',
      beforeSend: function() {
        $('#delete' + id).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
      },
      success: function(data) {
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function updateGroup(id) {
    var id = $('#modal-id' + id).text();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/food-collection/groups/update',
      type: 'post',
      data:
      {        
          "_token": "<?php echo e(csrf_token()); ?>",
          "id": $('#modal-id').val(),
          "owner_id": $('#modal-inputOwnerID').val(),
          "group_name": $('#modal-inputGroupName').val(),
          "country": $('#modal-inputGroupCountry').val(),
          "state": $('#modal-inputGroupState').val(),
      },
      dataType: 'html',
      beforeSend: function() {
        $('#delete' + id).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
      },
      success: function(data) {
        $('#editGroupModal').modal('hide');
        $('#list-of-groups').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        return;
      }
    });
  }

  function getParent() {
    var user_id = $('#user_id2').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-parent',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner2').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Loading Parent...');
      },
      complete: function() {
        $('#spinner2').html('Get Parent');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getUserInfo() {
    var user_id = $('#user_id1').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-userinfo',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner1').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Loading User Info...');
      },
      complete: function() {
        $('#spinner1').html('Get user Info');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getPIN() {
    var pin_id = $('#pin_id').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-pin',
      type: 'get',
      data: 'pin_id=' + pin_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner1').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Loading User Info...');
      },
      complete: function() {
        $('#spinner1').html('Get user Info');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getPINStatus() {
    var pin_id = $('#pin_id').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-pin-status',
      type: 'get',
      data: 'pin_id=' + pin_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner3').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Get PIN Status...');
      },
      complete: function() {
        $('#spinner3').html('Check PIN Status');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getPINReprint() {
    var pin_range = $('#pin_range').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-pin-reprint',
      type: 'get',
      data: 'pin_range=' + pin_range,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner4').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Downloading PIN..');
      },
      complete: function() {
        $('#spinner4').html('View PIN Re-print');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getDownlines() {

    var user_id = $('#user_id_downlines').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-downlines',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner_downlines').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Downloading Downlines..');
      },
      complete: function() {
        $('#spinner_downlines').html('Get Downlines');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getUserMatrix() {

    var user_id = $('#user_id_matrix').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-matrix',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner_matrix').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Downloading Matrix..');
      },
      complete: function() {
        $('#spinner_matrix').html('Get User Matrix');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getUserAccountBalance() {

    var user_id = $('#user_id_balance').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-user-account-balance',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner_balace').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Account Balance ..');
      },
      complete: function() {
        $('#spinner_balace').html('Get User Account Balance');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function getUserFoodCollectionLog() {

    var user_id = $('#user_id_food_log').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-user-food-collection-log',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  // NEW ADDED BY EMMANUEL 27-04-2017
  function getMemberUsername() {

    var user_id = $('#change-username-membership-id').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-username',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'json',
      beforeSend: function() {
        $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        $('#change-username-new-username').val(data.username);
        $('#change-username-new-user-id').val(data.uid);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        $('#change-username-new-username').val('');
      }
    });
  }

  function isUsernameUnique() {

    var username = $('#change-username-new-username').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/is-username-unique',
      type: 'get',
      data: 'username=' + username,
      dataType: 'html',
      beforeSend: function() {
        // $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        // $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        if(data == 'NO'){
          $( ".change-username" ).prop( "disabled", true );
        }else{
          $('.change-username').prop('disabled', false);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        // $('#change-username-new-username').val('');
      }
    });
  }

  function changeUsername() {

    var user_id = $('#change-username-membership-id').val();
    var username = $('#change-username-new-username').val();
    var uid = $('#change-username-new-user-id').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/change-username',
      type: 'get',
      data: 'username=' + username + '&userid=' + user_id + '&uid=' + uid,
      dataType: 'json',
      beforeSend: function() {
        // $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        // $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        if(data == 'FALSE'){
          $('.change-username').prop('disabled', true);
        }else{
          $('.change-username').prop('disabled', false);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        // $('#change-username-new-username').val('');
      }
    });
  }

  function getPINInformation() {
    var pin_id = $('#fix-pin-membership-id').val();    

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/get-pin-information',
      type: 'get',
      data: 'pin_id=' + pin_id, // + '&userid=' + user_id + '&uid=' + uid,
      dataType: 'json',
      beforeSend: function() {
        // $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        // $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        if (data == null) {

        } else {
          if (data.membershipid == null && data.used != 0) {
            $( ".fix-pin-issue" ).prop( "disabled", false );
          } else {
            $( ".fix-pin-issue" ).prop( "disabled", true );
          } 
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        // $('#change-username-new-username').val('');
      }
    });    
  }

  function fixUserPinIssue() {
    var user_id = $('#fix-pin-membership-id').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/fix-pin-issue',
      type: 'get',
      data: 'userid=' + user_id,
      dataType: 'json',
      beforeSend: function() {
        // $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        // $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        if(data == 'FALSE'){
          $('.change-username').prop('disabled', true);
        }else{
          toastr["error"]("You cannot fix this PIN!")
          $('.change-username').prop('disabled', false);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        $('#change-username-new-username').val('');
        alert('Error');
      }
    }); 
  }

  function showEditGroupModal(id) {
    $.ajax({
      url: '<?php echo e(url("/")); ?>/food-collection/find-group',
      type: 'get',
      data:'id=' + id,
      dataType: 'json',
      success: function(data) {
        init(data.country,'modal-inputGroupCountry');
        selectState('modal-inputGroupCountry', 'modal-inputGroupState'); 
        
        $('#modal-id').val(id);
        $('#modal-inputOwnerID').val(data.owner_id);
        $('#modal-inputGroupName').val(data.group_name);
        $('#modal-inputGroupCountry').val(data.country);
        $('#modal-inputGroupState').val(data.state);
        $('#editGroupModal').modal('show');
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });

  }

</script>

<!-- FOOD COLLECTION SCRIPTS -->
<script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    var counter = 0;
    var buyer_id = '';
    var itemInTable = [];

    // Load Products and Account Informations
    getGroups();


    function getGroups() {

        if(products == ''){
            $.ajax({
                type:"GET",
                url: '<?php echo e(url("/")); ?>/admin-operation/get-groups',
                dataType:'json',
                complete: function() {
                    $('#food-balance').html('Choose Account');
                },
                success:function(data){
                    groups = data;

                    //Load Groups
                    $.each(groups, function(key, value) {
                         $('#group-leader-id')
                             .append($("<option></option>")
                                        .attr("value", value["id"])
                                        .text(value["group_name"]));
                    });
                }
            });
        }
    }

    function submitForm() {

        //Get All items
        var items = [];
        var qty = [];
        var group_leader_id = $('#group-leader-id').val();
        buyer_id = $('#buyer_id').val();

         $('[id^="item_id"]').each(function() {
            var item = $(this).val();
            if(item == 0){
                return false;
            }

            items.push(item);
         });

         $('[id^="input_quantity"]').each(function() {
            var quanty = $(this).val();
            if(quanty == 0){
                return false;
            }

            qty.push(quanty);
         });

        if(items.length == 0){
            return false;
        }

        if(buyer_id == ''){
            alert('Please enter Membership ID');
            return false;
        }

        if(group_leader_id == -1){
            alert('Please select a group');
            return false;
        }

        var r = confirm('Are you ready to submit your FOOD COLLECTION FORM?\n\nNOTE: This Action is not reversible')
        if(r){

            $.ajax({
                url: '<?php echo e(url("/")); ?>/food-collection/submit',
                type: 'post',
                data:
                {
                    group_leader_id: group_leader_id,
                    items:items,
                    qty:qty,
                    buyer_id:buyer_id
                },
                dataType: 'json',
                beforeSend: function() {
                    $('.submit').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                },
                complete: function() {
                    $('.submit').html('<i class="fa fa-save"></i>');
                },
                success: function(json) {
                    if(json == 'false'){
                        alert("YOU DO NOT ENOUGH FUND");
                    } else if(json == 'true'){
                        alert("YOU HAVE SUCCESSFULLY SUBMITTED YOUR FOOD COLLECTION FORM");
                        window.location.href = '/home';
                        // window.location.href = 'https://www.feedthenations.com/home';
                    }else{
                        alert(json);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });

        }else{
            return false;
        }
    }

    function addNewItem() {

        counter++;

        var prods = '<select name="product_id[]" id="item_id'+counter+'" class="form-control" required="required" onchange="getProductPrice('+counter+')"><option value="0">---SELECT---</option>';
        $.each( products, function( key, value ) {
            prods += '<option value="'+ value["id"] +'">'+ value["item_name"] +'</option>';
        });

        prods += '</select>';

        var html = '<tr id="item'+counter+'"><td>'+prods+'</td><td><input type="number" name="quantity[]" id="input_quantity'+counter+'" class="form-control" onkeyup="updateAmount('+counter+')" onchange="updateAmount('+counter+')" value="1" min="1" required="required" title=""></td><td class="text-right"><span id="item_price'+counter+'">0</span><span style="visibility: hidden;" id="product_id'+counter+'">0</span></td><td><button type="button" onclick="removeItem('+counter+')" class="btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i></button></td></tr>';

        $(html).appendTo("#items");
    }

    function removeItem(id) {
        var product_id = $('#product_id'+id).text();

        var index = $.inArray(product_id, itemInTable);
        itemInTable.splice(index, 1)


        console.log(itemInTable);

        $('#item'+id).remove();
        calculateQuantity();
        calculateTotal();
    }

    function getProductPrice(id) {
        var tmp = "item_id"+id;
        var e = document.getElementById(tmp);
        var strUser = e.options[e.selectedIndex].value;

        $.each( products, function( key, value ) {
            if(value["id"] == strUser){

                if($.inArray(value["id"], itemInTable) == -1){

                    var price_id = "item_price" + id;
                    $('#'+price_id).text(value["price"]);
                    $('#product_id'+id).text(value["id"]);


                    // Store Product ID in itemInTable to check for duplicate products
                    itemInTable.push(value["id"]);
                    console.log(itemInTable);
                }else{
                    // Not There, Delete Row
                    removeItem(id);
                    return;
                    // $('#item'+id).remove();
                }
            }
        });


        // Calc Total and QUantity
        calculateQuantity();
        calculateTotal();
    }

    function updateAmount(id) {
        var quantity = $("#input_quantity"+id).val();

        var tmp = "item_id"+id;
        var e = document.getElementById(tmp);
        var strUser = e.options[e.selectedIndex].value;

        $.each( products, function( key, value ) {
            if(value["id"] == strUser){
                var price_id = "item_price" + id;
                $('#'+price_id).text(value["price"] * quantity);
            }
        });
        calculateQuantity();
        calculateTotal();
    }

    function calculateQuantity() {
        var allVals = 0;
         $('[id^="input_quantity"]').each(function() {
            var quantity = $(this).text();
            if(!parseInt(quantity)){
                quantity = 0.0;
            }
           allVals += parseInt(quantity);
         });
    }

    function calculateTotal() {
        var allVals = 0.0;
         $('[id^="item_price"]').each(function() {
            var price = $(this).text();
            if(!parseFloat(price)){
                price = 0.0;
            }
           allVals += parseFloat(price);
         });
        $('#totalAmount').text(allVals);
    }
</script>


<!-- Check depth issues /script -->
<script type="text/javascript">

    function checkDepthIssue() {

    var parent_id = $('#checkDepthIssue_upline').val();
    var user_id = $('#checkDepthIssue_member').val();
    

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/check-depth-issue',
      type: 'get',
      data: 'user_id=' + user_id + '&parent_id=' + parent_id,
      dataType: 'html',
      beforeSend: function() {
        // $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        // $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  function fixStageOneDepthIssue() {

    var user_id = $('#fixStageOneDepthIssue').val();

    $.ajax({
      url: '<?php echo e(url("/")); ?>/admin-operation/fix-stage-one-depth-issue',
      type: 'get',
      data: 'user_id=' + user_id,
      dataType: 'html',
      beforeSend: function() {
        $('#spinner_food_log').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Getting User Food Log ..');
      },
      complete: function() {
        $('#spinner_food_log').html('Get User Food Collection Log');
      },
      success: function(data) {
        $('#result').html(data);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
</script>
<!-- PRINT THIS SCRIPT -->
<script type="text/javascript">
  /*
   * printThis v1.9.0
   * @desc  Printing plug-in for jQuery
   * @author  Jason Day
   *
   * Resources (based on) :
   *              jPrintArea: http://plugins.jquery.com/project/jPrintArea
   *              jqPrint: https://github.com/permanenttourist/jquery.jqprint
   *              Ben Nadal: http://www.bennadel.com/blog/1591-Ask-Ben-Print-Part-Of-A-Web-Page-With-jQuery.htm
   *
   * Licensed under the MIT licence:
   *              http://www.opensource.org/licenses/mit-license.php
   *
   * (c) Jason Day 2015
   *
   * Usage:
   *
   *  $("#mySelector").printThis({
   *      debug: false,               * show the iframe for debugging
   *      importCSS: true,            * import page CSS
   *      importStyle: false,         * import style tags
   *      printContainer: true,       * grab outer container as well as the contents of the selector
   *      loadCSS: "path/to/my.css",  * path to additional css file - us an array [] for multiple
   *      pageTitle: "",              * add title to print page
   *      removeInline: false,        * remove all inline styles from print elements
   *      printDelay: 333,            * variable print delay
   *      header: null,               * prefix to html
   *      footer: null,               * postfix to html
   *      base: false,                * preserve the BASE tag, or accept a string for the URL
   *      formValues: true            * preserve input/form values
   *      canvas: false               * copy canvas elements (experimental)
   *      doctypeString: '...'        * enter a different doctype for older markup
   *  });
   *
   * Notes:
   *  - the loadCSS will load additional css (with or without @media  print) into the iframe, adjusting layout
   */
  ;
  (function($) {
      var opt;
      $.fn.printThis = function(options) {
          opt = $.extend({}, $.fn.printThis.defaults, options);
          var $element = this instanceof jQuery ? this : $(this);

          var strFrameName = "printThis-" + (new Date()).getTime();

          if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {
              // Ugly IE hacks due to IE not inheriting document.domain from parent
              // checks if document.domain is set by comparing the host name against document.domain
              var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";
              var printI = document.createElement('iframe');
              printI.name = "printIframe";
              printI.id = strFrameName;
              printI.className = "MSIE";
              document.body.appendChild(printI);
              printI.src = iframeSrc;

          } else {
              // other browsers inherit document.domain, and IE works if document.domain is not explicitly set
              var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");
              $frame.appendTo("body");
          }


          var $iframe = $("#" + strFrameName);

          // show frame if in debug mode
          if (!opt.debug) $iframe.css({
              position: "absolute",
              width: "0px",
              height: "0px",
              left: "-600px",
              top: "-600px"
          });

          // $iframe.ready() and $iframe.load were inconsistent between browsers
          setTimeout(function() {

              // Add doctype to fix the style difference between printing and render
              function setDocType($iframe,doctype){
                  var win, doc;
                  win = $iframe.get(0);
                  win = win.contentWindow || win.contentDocument || win;
                  doc = win.document || win.contentDocument || win;
                  doc.open();
                  doc.write(doctype);
                  doc.close();
              }
              if(opt.doctypeString){
                  setDocType($iframe,opt.doctypeString);
              }

              var $doc = $iframe.contents(),
                  $head = $doc.find("head"),
                  $body = $doc.find("body"),
                  $base = $('base'),
                  baseURL;

              // add base tag to ensure elements use the parent domain
              if (opt.base === true && $base.length > 0) {
                  // take the base tag from the original page
                  baseURL = $base.attr('href');
              } else if (typeof opt.base === 'string') {
                  // An exact base string is provided
                  baseURL = opt.base;
              } else {
                  // Use the page URL as the base
                  baseURL = document.location.protocol + '//' + document.location.host;
              }

              $head.append('<base href="' + baseURL + '">');

              // import page stylesheets
              if (opt.importCSS) $("link[rel=stylesheet]").each(function() {
                  var href = $(this).attr("href");
                  if (href) {
                      var media = $(this).attr("media") || "all";
                      $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
                  }
              });

              // import style tags
              if (opt.importStyle) $("style").each(function() {
                  $(this).clone().appendTo($head);
              });

              // add title of the page
              if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");

              // import additional stylesheet(s)
              if (opt.loadCSS) {
                 if( $.isArray(opt.loadCSS)) {
                      jQuery.each(opt.loadCSS, function(index, value) {
                         $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");
                      });
                  } else {
                      $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");
                  }
              }

              // print header
              if (opt.header) $body.append(opt.header);

              if (opt.canvas) {
                  // add canvas data-ids for easy access after the cloning.
                  var canvasId = 0;
                  $element.find('canvas').each(function(){
                      $(this).attr('data-printthis', canvasId++);
                  });
              }

              // grab $.selector as container
              if (opt.printContainer) $body.append($element.outer());

              // otherwise just print interior elements of container
              else $element.each(function() {
                  $body.append($(this).html());
              });

              if (opt.canvas) {
                  // Re-draw new canvases by referencing the originals
                  $body.find('canvas').each(function(){
                      var cid = $(this).data('printthis'),
                          $src = $('[data-printthis="' + cid + '"]');

                      this.getContext('2d').drawImage($src[0], 0, 0);

                      // Remove the mark-up from the original
                      $src.removeData('printthis');
                  });
              }

              // capture form/field values
              if (opt.formValues) {
                  // loop through inputs
                  var $input = $element.find('input');
                  if ($input.length) {
                      $input.each(function() {
                          var $this = $(this),
                              $name = $(this).attr('name'),
                              $checker = $this.is(':checkbox') || $this.is(':radio'),
                              $iframeInput = $doc.find('input[name="' + $name + '"]'),
                              $value = $this.val();

                          // order matters here
                          if (!$checker) {
                              $iframeInput.val($value);
                          } else if ($this.is(':checked')) {
                              if ($this.is(':checkbox')) {
                                  $iframeInput.attr('checked', 'checked');
                              } else if ($this.is(':radio')) {
                                  $doc.find('input[name="' + $name + '"][value="' + $value + '"]').attr('checked', 'checked');
                              }
                          }

                      });
                  }

                  // loop through selects
                  var $select = $element.find('select');
                  if ($select.length) {
                      $select.each(function() {
                          var $this = $(this),
                              $name = $(this).attr('name'),
                              $value = $this.val();
                          $doc.find('select[name="' + $name + '"]').val($value);
                      });
                  }

                  // loop through textareas
                  var $textarea = $element.find('textarea');
                  if ($textarea.length) {
                      $textarea.each(function() {
                          var $this = $(this),
                              $name = $(this).attr('name'),
                              $value = $this.val();
                          $doc.find('textarea[name="' + $name + '"]').val($value);
                      });
                  }
              } // end capture form/field values

              // remove inline styles
              if (opt.removeInline) {
                  // $.removeAttr available jQuery 1.7+
                  if ($.isFunction($.removeAttr)) {
                      $doc.find("body *").removeAttr("style");
                  } else {
                      $doc.find("body *").attr("style", "");
                  }
              }

              // print "footer"
              if (opt.footer) $body.append(opt.footer);

              setTimeout(function() {
                  if ($iframe.hasClass("MSIE")) {
                      // check if the iframe was created with the ugly hack
                      // and perform another ugly hack out of neccessity
                      window.frames["printIframe"].focus();
                      $head.append("<script>  window.print(); </s" + "cript>");
                  } else {
                      // proper method
                      if (document.queryCommandSupported("print")) {
                          $iframe[0].contentWindow.document.execCommand("print", false, null);
                      } else {
                          $iframe[0].contentWindow.focus();
                          $iframe[0].contentWindow.print();
                      }
                  }

                  // remove iframe after print
                  if (!opt.debug) {
                      setTimeout(function() {
                          $iframe.remove();
                      }, 1000);
                  }

              }, opt.printDelay);

          }, 333);

      };

      // defaults
      $.fn.printThis.defaults = {
          debug: false,           // show the iframe for debugging
          importCSS: true,        // import parent page css
          importStyle: false,     // import style tags
          printContainer: true,   // print outer container/$.selector
          loadCSS: "",            // load an additional css file - load multiple stylesheets with an array []
          pageTitle: "",          // add title to print page
          removeInline: false,    // remove all inline styles
          printDelay: 333,        // variable print delay
          header: null,           // prefix to html
          footer: null,           // postfix to html
          formValues: true,       // preserve input/form values
          canvas: false,          // Copy canvas content (experimental)
          base: false,            // preserve the BASE tag, or accept a string for the URL
          doctypeString: '<!DOCTYPE html>' // html doctype
      };

      // $.selector container
      jQuery.fn.outer = function() {
          return $($("<div></div>").html(this.clone())).html();
      }
  })(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>