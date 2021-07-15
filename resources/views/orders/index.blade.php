@extends('layouts.app')
@section('stylesheet')
        <!-- DataTables CSS -->
    <link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Orders</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Customer ID</th>
                            <th>Order ID</th>
                            <th>Product(s)</th>
                            <th>Amount</th>
                            <th>Shipping Address</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     <?php $j = 0; ?>
     @foreach($orders as $order)
         <tr>
           <td><?= ++$j; ?></td>
           <td>{!!$order->CustomerID!!}</td> 
           <td>HWMG-00{!!$order->ID!!}</td> 
           <td>

              <?php
                $prodID = json_decode($order->ProductID);
                $prodQty = json_decode($order->ProductQty);
                $prodAmt = json_decode($order->ProductAmt);

                for ($i=0; $i < count($prodID); $i++) { 
                  echo "<p>" . $prodID[$i] . " x ".$prodQty[$i]." - " . $prodAmt[$i] . "</p>";
                }

              ?>

            </td> 
           <td>{!!$order->OrderAmount!!}</td> 
           <td>
            <?php
              $shippingAdd = json_decode($order->shippingAdd);
              echo "<p>" . $shippingAdd[2] . "</p>";
              echo "<p>" . $shippingAdd[1] . "</p>";
              echo "<p>" . $shippingAdd[0] . "</p>";
            ?>
           </td> 
           <td>{!!$order->UpdatedAt!!}</td> 
           <td>
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
              default:
                # code...
                break;
            }
          ?></td> 
           <td>
                <a onclick="return confirm('Are You Sure Want to Delete?');" href="{{url('/delete-order')}}/{!!$order->ID!!}" title="Delete" class="btn btn-danger"><span class="fa fa-trash"></span></a>

                <!-- Split button -->
                <div class="btn-group">
                  <a href="#" class="btn btn-success"><span class="fa fa-trash"></span></a>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{url('/order-status')}}/{!!$order->ID!!}/0">Pending</a></li>
                    <li><a href="{{url('/order-status')}}/{!!$order->ID!!}/1">Cancelled</a></li>
                    <li><a href="{{url('/order-status')}}/{!!$order->ID!!}/2">Shipped</a></li>
                    <li><a href="{{url('/order-status')}}/{!!$order->ID!!}/3">Delievered</a></li>
                  </ul>
                </div>
            </td>
         </tr>          
    @endforeach


                    </tbody>

                </table>

        </div>
    </div>
</section>

@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
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

    function confirmDelete(delUrl){
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this item!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: true
        },
        function(){
            document.location = delUrl;
        });
    }
</script>

@endsection



