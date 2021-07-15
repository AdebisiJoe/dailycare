@extends('layouts.app')
@section('stylesheet')
        <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border hidden-print">
            <h3 class="box-title">My Orders </h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive" id="print-this">
          <div class="box box-solid">
 
            <!-- /.box-header -->
            <div class="box-body" id="invoice">
              <div class="row">
                <div class="col-md-12">
                  <div class="pull-left">
                    <h1>feed the nations </h1>
                    <i>Happiness all the time</i>
                    {{-- <p>Company Address<br>City<br>Country</p> --}}
                  </div>
                  <div class="pull-right">
                    <img src="https://www.feedthenations.com/images/pagelogo.png" class="img img-responsive" alt="Logo">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="pull-left">
                    <h3>Invoice:</h3>
                    <p>
                      <b>Customer ID:</b> {{ $userInfo->membershipid }}<br>
                      <b>Customer Username:</b> {{ $order->CustomerID}}<br>
                      <b>Customer Phone:</b> {{ $userInfo->phonenumber }}<br>
                      <b>Order ID:</b> HWMG-00{{$id}}<br>
                      <b>Order Date:</b> {{ $order->CreatedAt}}<br>
                      <b>Date:</b> <?= date('Y-m-d'); ?><br>
                    </p>
                  </div>
                  <div class="pull-right">
                    <h3>Shipping Address:</h3>
                    <p>
                      <?php
                        $shippingAdd = json_decode($order->shippingAdd);
                        echo $shippingAdd[2] . "<br> ";
                        echo $shippingAdd[1] . "<br> ";
                        echo $shippingAdd[0] . ".";
                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12"><h4>Order Information</h4></div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th style="float:right">Amount</th>
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
                            <input type="hidden" required name="productQty[]" class="productqty" id="pqty{{$i + 1}}" name="" min="1" value="{{ $productQty[$i] }}"><?= $productQty[$i] ?>
                          </td>
                          <td><?= $productAmt[$i]; ?></td>
                          <td>
                            <input name="productAmt[]" type="hidden" class="productamt" id="tmp" value="<?= $productAmt[$i]; ?>"><b id="pamt{{$i + 1}}" style="float:right"><?= $productAmt[$i] * $productQty[$i]; ?> </b>
                          </td>
                        </tr>                      
                      @endfor
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td><b>Total</b></td>
                          <td><span id="total" style="float:right; font-weight: bold"></span><input type="hidden" id="price" name="price"></td>
                        </tr> 
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><b><u>Important Notice</u></b></h3>
                </div>
                <div class="panel-body">
                    <ol class="pull-left">
                      <li>Bring this slip to the collection center</li>
                      <li>Your order would be ready for collection 2 days after placing it</li>
                      <li>Do not touch or damage the code on the right side of this slip</li>
                      <li>Contact Feed the nations  for more information</li>
                    </ol>
                    <img class="img-responsive pull-right" src='https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=www.feedthenations.com/complete-order/HWMG-00{{$id}}'>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
    <div class="hidden-print" style="position: fixed;top: 150px;right: 5px;"><div style="background-color: #DD4B39; padding: 10px"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Print" onclick="window.print()"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;</button></div></div>    
    <div class="hidden-print" style="position: fixed;top: 200px;right: 5px;"><div style="background-color: #DD4B39; padding: 10px"><button type="button" class="btn btn-default" id="cmd" data-toggle="tooltip" data-placement="left" title="Download" ><i class="fa fa-download" aria-hidden="true"></i>&nbsp;</button></div></div>

<div id="editor"></div>

</section>

@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>

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


var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').click(function () {
    doc.fromHTML($('#print-this').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});


</script>

@endsection



