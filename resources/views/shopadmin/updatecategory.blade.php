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
        <div class="box-header with-border">
            <h3 class="box-title">Category</h3>
            <div class="box-tools pull-right">
            <a href="{{ url('/shop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;User Shop</a>
            <a href="{{ url('/adminshop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;Admin Store</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>category</th>

                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
     @foreach($category as $cat)
         <tr>
           <td>1</td>
           <td>{!!$cat->id!!}</td>
           <td>{!!$cat->cat_name!!}</td> 
           <td> <button  data-toggle="modal" title="Edit" data-target="#edit" class="btn btn-primary"><i class="fa fa-pencil">Edit</button></td>
           <td><button  data-toggle="modal" title="Delete" class="btn btn-danger" data-target="#delete"><i class="fa fa-trash-o">Delete</button></td>
         </tr>          
         @endforeach



                     

                    </tbody>

                </table>





        <div class="col-md-12 pull-right">
<a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Copy" class="btn btn-default" ><i class="fa fa-copy"></i></button>
        

    
</div>
<form class="form-horizontal">
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name1">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="categoryname" value="" placeholder="Category Name" id="input-name1" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="categorydescription" placeholder="Description" id="input-description1" class="form-control summernote"></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title1">Meta Tag Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="category_meta_title" value="" placeholder="Meta Tag Title" id="input-meta-title1" class="form-control" />
                                          </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description1">Meta Tag Description</label>
                    <div class="col-sm-10">
                      <textarea name="category_meta_description" rows="5" placeholder="Meta Tag Description" id="input-meta-description1" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword1">Meta Tag Keywords</label>
                    <div class="col-sm-10">
                      <textarea name="category_meta_keyword" rows="5" placeholder="Meta Tag Keywords" id="input-meta-keyword1" class="form-control"></textarea>
                    </div>
                  </div>
</form>


             
          
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
</script>

@endsection