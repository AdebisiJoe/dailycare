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
            <h3 class="box-title"> &nbsp;Products</h3>
            <div class="box-tools pull-right">
            <a href="{{ url('/shop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;User Shop</a>
            <a href="{{ url('/adminshop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;Admin Store</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      
            <div class="col-md-12 pull-right">
                
            <a style="margin-bottom: 10px;" href="{{ url('/createproduct') }}" title="Add New" class="btn  btn-lg btn-success">New Product&nbsp;<i class="fa fa-plus"></i></a>
            </div>

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>S/No</th>
                            <th>Product Name</th>
                            <th>Brand Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     <?php $i = 0; ?>
     @foreach($products as $prod)
         <tr>
           <td><?= ++$i; ?></td>
           <td>{!!$prod->item_name!!}</td> 
           <td>{!!$prod->brand_name!!}</td> 
           <td>{!!$prod->quantity!!}</td> 
           <td>{!!$prod->price!!}</td> 
           <td>
              <a href="{{ url('/product/') }}/{!!$prod->id!!}" title="View {!!$prod->item_name!!}" class="btn btn-primary">View</a>
              <a onclick="return confirm('Are You Sure Want to Delete?');" href="{{url('/product-delete/')}}/{!!$prod->id!!}" title="Delete {!!$prod->item_name!!}" class="btn btn-danger">Delete</a>
           </td>
         </tr>          
         @endforeach



                     

                    </tbody>

                </table>

    
</div>
<!-- <form class="form-horizontal">
    <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name1">Product Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[1][name]" value="" placeholder="Product Name" id="input-name1" class="form-control" />
                                          </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="product_description[1][description]" placeholder="Description" id="input-description1" class="form-control summernote"></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title1">Meta Tag Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[1][meta_title]" value="" placeholder="Meta Tag Title" id="input-meta-title1" class="form-control" />
                                          </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description1">Meta Tag Description</label>
                    <div class="col-sm-10">
                      <textarea name="product_description[1][meta_description]" rows="5" placeholder="Meta Tag Description" id="input-meta-description1" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword1">Meta Tag Keywords</label>
                    <div class="col-sm-10">
                      <textarea name="product_description[1][meta_keyword]" rows="5" placeholder="Meta Tag Keywords" id="input-meta-keyword1" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tag1"><span data-toggle="tooltip" title="Comma separated">Product Tags</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[1][tag]" value="" placeholder="Product Tags" id="input-tag1" class="form-control" />
                    </div>
                  </div>

</form> -->


             
          
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

    $(document).ready(function() {
      
      

    });
</script>

@endsection                   




















