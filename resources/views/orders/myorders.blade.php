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
            <h3 class="box-title">My Orders</h3>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Order Amount</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     <?php $j = 0; ?>
     @foreach($orders as $order)
         <tr>
           <td><?= ++$j; ?></td>
           <td><b>HWMG-00{!!$order->ID!!}</b></td> 
           <td>{{ Carbon\Carbon::parse($order->UpdatedAt)->format('l d \of F, Y') }}</td> 
           <td>{!!$order->OrderAmount!!}</td> 
           <td>
           <?php
            if($order->transfered == 2 || $order->transfered == 1){
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
            }
            if($order->transfered == 1){
                echo '<br><span class="label label-success">In-Transfer</span>'; 
            }
            if($order->transfered == 0){
                echo '<span class="label label-success">Out-Transfer</span>'; 
            }
          ?>
            

          </td> 
           <td>
           {{-- @if ($order->transfered != 0 && $order->status == 0) --}}
             <a href="{{ url('edit-order/') }}/{!!$order->ID!!}" data-toggle="tooltip" data-placement="top" title="Details" class="btn btn-default"><span class="fa fa-file-text"></span></a>
             @if ($order->transfered > 0 && ($order->status == 0 || $order->status > 1))
               <a href="{{ url('/generate-invoice/') }}/{!!$order->ID!!}" data-toggle="tooltip" data-placement="top" title="Download Invoice" class="btn btn-default"><span class="fa fa-download"></span></a>
             @endif
             @if ($order->transfered == 2 && $order->status == 0)
               <a href="{{ url('/order-transfer/') }}/{!!$order->ID!!}" data-toggle="tooltip" data-placement="top" title="Transfer Order" class="btn btn-default"><span class="fa fa-send"></span></a>           
             @endif
           {{-- @endif --}}
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

        $('#editProduct').click(function(){
          $('.bs-example-modal-sm').modal('show')
        });

        //Bootstrap ToolTip
        $('[data-toggle="tooltip"]').tooltip();
        
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



