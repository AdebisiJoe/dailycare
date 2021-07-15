@extends('layouts.app')
@section('stylesheet')
        <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">    

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">My Orders</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
          <div class="box box-solid">
 
            <!-- /.box-header -->
            <div class="box-body">
              @if ($order->status == 0 && $order->transfered == 2)
              <form action="{{ url('/update-order') }}" method="post">
              @endif
              <dl class="dl-horizontal">

                <input type="hidden" name="orderID" value="{{$id}}">
                <dt>Customer username</dt>
                <dd>{{ $order->CustomerID}}</dd>
                <dt>Order Date</dt>
                <dd>{{ $order->CreatedAt}}</dd>
                <dt>Shipping Address</dt>
                <dd>
                  <?php
                    $shippingAdd = json_decode($order->shippingAdd);
                    echo "<p>" . $shippingAdd[2] . ", ";
                    echo $shippingAdd[1] . ". ";
                    echo $shippingAdd[0] . ".</p>";
                  ?>
                </dd>
                <dt>Order Status</dt>
                <dd>
                  <?php
                    switch ($order->status) {
                      case 0:
                        echo '<span class="label label-warning">Pending</span>';
                        break;
                      case 1:
                        echo '<span class="label label-danger">Cancelled</span>';
                        break;
                      case 2:
                        echo '<span class="label label-info">Shipped</span>';
                        break;
                      case 3:
                        echo '<span class="label label-success">Delievered</span>';
                        break;
                    }
                  ?>
                </dd>
                <dt>Order Information</dt>
                <dd>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th style="float:right">Amount</th>
                        @if ($order->status == 0 && $order->transfered == 2) 
                        <th>Actions</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $products = json_decode($order->ProductID);
                      $productQty = json_decode($order->ProductQty);
                      $productAmt = json_decode($order->ProductAmt);
                    ?>
                      @for ($i = 0; $i < count($products); $i++)
                        <tr id="itemtr{{$i + 1}}">
                          <td><?= $i + 1; ?></td>
                          <td>
                            <input type="hidden" name="productItems[]" class="productitem" id="tmp" value="<?= $products[$i]; ?>"><?= $productList[$i]; ?>
                          </td>
                          <td>
                            <input type="number" required name="productQty[]" onchange="changeQty('{{$i + 1}}')" @if ($order->status > 0) disabled @elseif ($order->transfered == 1 || $order->transfered == 0) disabled @endif onkeyup="changeQty('{{$i + 1}}')" class="productqty" id="pqty{{$i + 1}}" name="" min="1" value="{{ $productQty[$i] }}"> 
                          </td>
                          <td><?= $productAmt[$i]; ?></td>
                          <td>
                            <input name="productAmt[]" type="hidden" class="productamt" id="tmp" value="<?= $productAmt[$i]; ?>"><b id="pamt{{$i + 1}}" style="float:right"><?= $productAmt[$i] * $productQty[$i]; ?> </b>
                          </td>

                          @if ($order->status == 0 && count($products) > 1 && $order->transfered == 2)
                            <td>
                                <button type="button" class="btn btn-warning" onclick="confirmDelete('{{$i + 1}}')" id="delItem{{$i + 1}}"><span class="fa fa-trash"></span></button>
                            </td>
                          @endif
                        </tr>                      
                      @endfor
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>Total</td>
                          <td><span id="total" style="float:right; font-weight: bold"></span><input type="hidden" id="price" name="price"></td>
                          <td>
                          @if ($order->status == 0 && $order->transfered == 2)
                            <a href="{{ url('/cancel-order/') }}/{{$id}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Cancel this Order"><span class="fa fa-ban"></span></a>
                            <button type="submit" onclick="updateOrder()" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Update this Order"><span class="fa fa-save"></span></button>
                          @endif
                          </td>
                        </tr> 
                    </tbody>
                  </table>
                </dd>
              </dl>
            @if ($order->status == 0 && $order->transfered == 2)
            </form>
            @endif
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    var total = 0;
    var qty = [];
    var amount = [];
    var items = [];

    var itemQty = 0;
    var itemTotal = 0;
    
    var Ntmptotal = 0;
    var Ntmpqty = [];
    var Ntmpamount = [];
    var Ntmpitems = [];

    var jsonItems = '';
    var jsonQty = '';
    var jsonAmt = '';
    var jsonTotal = 0;

    $(document).ready(function () {
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-full-width",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "3000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }

        //Delete Confirmation
        $('[data-toggle=confirmation]').confirmation({
          rootSelector: '[data-toggle=confirmation]',
          onConfirm: function() {

          },
          onCancel: function() {
            return;
          }
        });

        //Bootstrap ToolTip
        $('[data-toggle="tooltip"]').tooltip();
        
        $('#dataTables-example').DataTable({
            responsive: true
        });

        $(".productqty").each(function() {
          qty.push(this.value);
        });

        $('.productamt').each(function() {
          amount.push(this.value);
        });

        $('.productitem').each(function() {
          items.push(this.value);
        });

        for (var i = 0; i < amount.length; i++) {
          total += (qty[i] * amount[i]);
        }

        $('#total').text(total);
        $('#price').val(total);
        jsonItems = JSON.stringify(items);
        jsonQty = JSON.stringify(qty);
        jsonAmt = JSON.stringify(amount);


    });

    function computeTotal() {
        //Get All Order Amount
        var tmptotal = 0;
        var tmpqty = [];
        var tmpamount = [];
        var tmpitems = [];

        $(".productqty").each(function() {
          tmpqty.push(this.value);
        });

        $('.productamt').each(function() {
          tmpamount.push(this.value);
        });

        $('.productitem').each(function() {
          tmpitems.push(this.value);
        });

        for (var i = 0; i < tmpamount.length; i++) {
          tmptotal += (tmpqty[i] * tmpamount[i]);
        }

        $('#total').text(tmptotal);
        $('#price').val(tmptotal);

        Ntmptotal = tmptotal;
        Ntmpqty = tmpqty;
        Ntmpamount = tmpamount;
        Ntmpitems = tmpitems;

        jsonItems = JSON.stringify(tmpitems);
        jsonQty = JSON.stringify(tmpqty);
        jsonAmt = JSON.stringify(tmpamount);
    }

    function changeAmount(id, itemQty) {
      var itemTotal = amount[id-1] * itemQty;
      $('#pamt' + id).empty().text(itemTotal);
    }

    function changeQty(id) {
      var itemQty = $('#pqty' + id).val();

      if(itemQty == 0){
        return;
      }else{
        //Change Amount
        // $('#pqty' + id).after('&nbsp;&nbsp;<div class="btn-group"><button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Save"><i class="fa fa-check-circle"></i></button><button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Cancel"><i class="fa fa-times"></i></button></div>');
        changeAmount(id, itemQty);
        computeTotal();

        //Change Total
      }
    }

    function confirmDelete(id){

      $('#itemtr' + id).remove();

      // //Recompute totals
      computeTotal();

    }

</script>

@endsection



