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
            <h3 class="box-title">Category</h3>
            <div class="box-tools pull-left">
                <a href="{{ url('/shop') }}" class="btn btn-success"><i class="fa fa-home"></i>&nbsp;User Shop</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      
            <div class="col-md-12 pull-right">
              <a style="margin-bottom: 10px;" href="{{ url('/showinsertcategory') }}" title="Add New" class="btn  btn-lg btn-success">New Category&nbsp;<i class="fa fa-plus"></i></a>
            </div>

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Category</th>
                            <th>Latest Sub Categories</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     <?php $i = 0; ?>
     @foreach($category as $cat)
         <tr>
           <td><?= ++$i; ?></td>
           <td>{!!$cat->cat_name!!}</td> 
           <td>
           @foreach($subcategory as $sub)
                @if ($cat->id === $sub->cat_id)
                    <a href="{{url('/subcategory')}}/{!!$cat->id!!}/{!!$sub->id!!}">{!! $sub->sub_catname !!}</a>,
                @endif
           @endforeach
           </td>
           <td>
                <a title="View Sub Categories" class="btn btn-success" href="{{url('/subcategories')}}/{!!$cat->id!!}" >All Sub Categories</a>
                <a href="{{url('/category-edit')}}/{!!$cat->id!!}" title="Edit" data-target="#edit" class="btn btn-primary">Edit</a>
                <a onclick="return confirm('Are You Sure Want to Delete?');" href="{{url('/category-delete')}}/{!!$cat->id!!}" title="Delete" class="btn btn-danger">Delete</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

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


