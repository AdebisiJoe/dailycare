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
            <h3 class="box-title" style="">&nbsp;Sub Categories</h3>
            <div class="box-tools pull-left">
                <a href="{{ url('/shop') }}" class="btn btn-success"><i class="fa fa-home"></i>&nbsp;User Shop</a>
                <a href="{{ url('/adminshop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;Admin Store</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      
            <div class="col-md-12 pull-right">
                
            <a style="margin-bottom: 10px;" href="{{ url('/showinsertsubcategory') }}/{!! $catID !!}" title="Add New" class="btn  btn-lg btn-success">New Sub Category&nbsp;<i class="fa fa-plus"></i></a>
            </div>
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Sub Category</th>
                            <th>Latest Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>                               
                         <?php $i = 0 ?>
                         @foreach($subcategory as $sub)
                             <tr>
                               <td><?= ++$i; ?></td>
                               <td>{!!$sub->sub_catname!!}</td> 
                               <td>
                                   @foreach($products as $prod)
                                        @if ($sub->id === $prod->subcategoryid)
                                            <a href="{{url('/product')}}/{!!$prod->id!!}">{!! $prod->item_name !!}</a>,
                                        @endif
                                   @endforeach
                               </td>
                               <td>
                                    <a href="{{ url('/product-by-category/') }}/{!! $sub->id !!}" title="View All Products" class="btn btn-success" >All Products</a>
                                    <a href="{{ url('/edit-subcategory') }}/{!! $catID !!}/{!! $sub->id !!}" title="Edit" class="btn btn-primary">Edit</a>
                                    <a onclick="return confirm('Are You Sure Want to Delete?');" href="{{url('/subcategory-delete')}}/{!! $sub->id !!}" title="Delete" class="btn btn-danger">Delete</a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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


