@extends('layouts.app')
@section('stylesheet')
<!-- DataTables CSS -->
<link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

@endsection
@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Food Collection</h3>
            <span class="btn-sm label-success pull-right" id="food-balance"><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">Choose Account:</label>
                    <div class="col-sm-10">
                        <select name="" id="subaccount_holder" id="input" class="form-control" required="required" onchange="getAccountInfo('subaccount_holder')">
                            <option value="-1" selected>--Select ID--</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">Group Leader:</label>
                    <div class="col-sm-10">
                        <select name="" id="group-leader-id" id="input" class="form-control select2" required="required">
                            <option value="-1" selected>--Select Group Leader--</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                  <table class="table table-hover">
                      <meta name="_token" content="{!! csrf_token() !!}" />
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
    </div>


</section>

@endsection

@section('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
  
      //Initialize Select2 Elements
      $(".select2").select2();

    })

    var counter = 0;
    var products = '';
    var mainaccount = '';
    var subaccounts = '';
    var buyer_id = '';
    var itemInTable = [];

    // Load Products and Account Informations
    getProducts();


    function getProducts() {

        if(products == ''){
            $.ajax({
                type:"GET",
                url:"{!! URL::route('getProducts') !!}",
                dataType:'json',
                complete: function() {
                    $('#food-balance').html('Choose Account');
                },
                success:function(data){
                    products = data.products;
                    mainaccount = data.account;
                    subaccounts = data.subaccounts;
                    groups = data.groups;

                    $('#subaccount_holder')
                             .append($("<option></option>")
                                        .attr("value",(data.user_id + '_main'))
                                        .text(data.user_id)); 

                    //Load Membership ID's
                    if(data.subaccounts.length > 0){
                        $.each(data.subaccounts, function(key, value) {   
                             $('#subaccount_holder')
                                 .append($("<option></option>")
                                            .attr("value", value["userid"])
                                            .text(value["userid"])); 
                        });
                    }
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
            alert('Please select an account');
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

        var prods = '<select name="product_id[]" id="item_id'+counter+'" class="form-control select2" required="required" onchange="getProductPrice('+counter+')"><option value="0">---SELECT---</option>';
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
        // $('#totalQty').text(allVals);
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

    function getAccountInfo(id) {
        var user_id = $('#'+id).val(); 

        if(user_id < 0){
            $('#food-balance').html('Choose Account');
            buyer_id = '';
            return;
        }

        buyer_id = user_id;

        //If Main User else
        if(user_id.indexOf('main') > -1){
            var fields = user_id.split('_');
            user_id = fields[0];
            
            buyer_id = user_id;

            $('#food-balance').html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
            var total = parseFloat(mainaccount.foodcash) + parseFloat(mainaccount.payoutcash);
            $('#food-balance').html('Balance: $' + (total.toPrecision(3)));

        }else{
    
            $('#food-balance').html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
            $.each(subaccounts, function( key, value ) {
                if(value["userid"] == user_id){
                    var total = (parseFloat(value["foodcash"]) + parseFloat(value["payoutcash"]));
                    $('#food-balance').html('Balance: $' + (total.toPrecision(3)));
                }
            });
        }
        return;
    }
</script>

@endsection
