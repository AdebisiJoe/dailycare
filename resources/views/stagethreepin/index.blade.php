@extends('layouts.app')
@section('stylesheets')
  <style type="text/css">
      @media print {
        .page-break { display: block; page-break-before: always; }
      }
  </style>
  <style type="text/css" href="{{asset('/plugins/toastr/toastr.min.css')}}"></style>
@endsection

@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Generate Stage 3 Pins
      </h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus">
          </i>
        </button>
        <button class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-remove">
          </i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Generate PINS
            </a>
          </li>
          <li role="presentation">
            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Print PINS
            </a>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <br />
            <div class="form-horizontal">
              <form action="{{ url('/generate-stage-three-pins') }}" method="POST">
                {!! csrf_field() !!}
                <div class="form-group">
                  <label for="inputOwnerID" class="col-sm-2 control-label">Stage 3 ID's
                  </label>
                  <div class="col-sm-10">
                    <textarea id="inputOwnerID" name="ids" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="numberofpins" class="col-sm-2 control-label text-right">
                    <span class="text-danger">*
                    </span> No of Pins per user
                  </label>
                  <div class="col-sm-10">
                    <select name="numberofpins" id="numberofpins" class="form-control">
                      <option value="1">1
                      </option>
                      <option value="2">2
                      </option>
                      <option value="3">3
                      </option>
                      <option value="4">4
                      </option>
                      <option value="5">5
                      </option>
                      <option value="6">6
                      </option>
                      <option value="7">7
                      </option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-success pull-right">
                      <i class="fa fa-save">
                      </i>&nbsp;
                      <span id="spinner">Generate PINS
                      </span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="profile">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" id="exampleInputFile">
                <p class="help-block">Example block-level help text here.</p>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Check me out
                </label>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Load Result Here -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Results
      </h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" onclick="printReport('reportForm')">
          <i class="fa fa-print">
          </i>
        </button>
        <button class="btn btn-box-tool" data-widget="collapse">
          <i class="fa fa-minus">
          </i>
        </button>
        <button class="btn btn-box-tool" data-widget="remove">
          <i class="fa fa-remove">
          </i>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div id="result" class="reportForm">
        <?php if(isset($name)){
          echo '<table  class="table table-condensed table-bordered">';
          foreach ($name as $key => $_name) {
            echo "<tr><td><strong>SERIAL NO</strong></td><td><strong>MEMBERSHIP ID</strong></td><td><strong>PIN</strong></td><td><strong>STAGE 3 OWNER<strong></td></tr>";
            echo "<tr><td><strong>".$_name["serial_no"]."</strong></td><td><strong>".$_name["pin_id"]."</strong></td><td><strong>".$_name["pin"]."</strong></td><td><strong>".$_name["owner_id"]."</strong></td></tr>";
          }
          echo '</table>';
        } ?>
      </div>
    </div>
  </div>
</section>
@endsection


@section('scripts')
<script src="{{ asset('plugins/country_state/country_state.js') }}"></script>

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
      url: '{{ url("/")}}/food-collection/groups/list',
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
      "loadCSS": "{{ asset('bootstrap/css/bootstrap.min.css') }}",
    });
  }

  function getProducts() {

    $.ajax({
        type:"GET",
        url: '{{ url("/")}}/admin-operation/get-products',
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
      url: '{{ url("/")}}/admin-operation/update-prod-info',
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
      url: '{{ url("/")}}/food-collection/groups/save',
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
      url: '{{ url("/")}}/food-collection/groups/delete',
      type: 'post',
      data:
      {
          "_token": "{{ csrf_token() }}",
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
      url: '{{ url("/")}}/food-collection/groups/update',
      type: 'post',
      data:
      {
          "_token": "{{ csrf_token() }}",
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
      url: '{{ url("/")}}/admin-operation/get-parent',
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
      url: '{{ url("/")}}/admin-operation/get-userinfo',
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
      url: '{{ url("/")}}/admin-operation/get-pin',
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
      url: '{{ url("/")}}/admin-operation/get-pin-status',
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
      url: '{{ url("/")}}/admin-operation/get-pin-reprint',
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
      url: '{{ url("/")}}/admin-operation/get-downlines',
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
      url: '{{ url("/")}}/admin-operation/get-matrix',
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
      url: '{{ url("/")}}/admin-operation/get-user-account-balance',
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
      url: '{{ url("/")}}/admin-operation/get-user-food-collection-log',
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
      url: '{{ url("/")}}/admin-operation/get-username',
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
      url: '{{ url("/")}}/admin-operation/is-username-unique',
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
      url: '{{ url("/")}}/admin-operation/change-username',
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
      url: '{{ url("/")}}/admin-operation/get-pin-information',
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
      url: '{{ url("/")}}/admin-operation/fix-pin-issue',
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
      url: '{{ url("/")}}/food-collection/find-group',
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
                url: '{{ url("/")}}/admin-operation/get-groups',
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
                url: '{{ url("/") }}/food-collection/submit',
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
                        // window.location.href = 'https://www.happyworldmealgate.com/home';
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
      url: '{{ url("/")}}/admin-operation/check-depth-issue',
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
      url: '{{ url("/")}}/admin-operation/fix-stage-one-depth-issue',
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
   * @desc Printing plug-in for jQuery
   * @author Jason Day
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
   *  - the loadCSS will load additional css (with or without @media print) into the iframe, adjusting layout
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
@endsection
