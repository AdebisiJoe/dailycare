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
            <h3 class="box-title">Edit {!! $category->cat_name !!} Category</h3>
            <div class="box-tools pull-right">
              <a href="{{ url('/shop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;User Shop</a>
              <a href="{{ url('/adminshop') }}" class="btn btn-danger"><i class="fa fa-home"></i>&nbsp;Admin Store</a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
        
          <form class="form-horizontal" method="post" action="{{ url('/category-update') }}">
              <input type="hidden" value="{!! $category->id !!}" name="id">
                <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name1">Category Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="categoryname" placeholder="Category Name" id="input-name1" class="form-control" value="{!! $category->cat_name !!}" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="categorydescription" placeholder="Description" id="input-description1" class="form-control summernote">{!! $category->description !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title1">Meta Tag Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="category_meta_title" value="{!! $category->meta_tag_title !!}" placeholder="Meta Tag Title" id="input-meta-title1" class="form-control" />
                                          </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description1">Meta Tag Description</label>
                    <div class="col-sm-10">
                      <textarea name="category_meta_description" rows="5" placeholder="Meta Tag Description" id="input-meta-description1" class="form-control">{!! $category->meta_tag_description !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword1">Meta Tag Keywords</label>
                    <div class="col-sm-10">
                      <textarea name="category_meta_keyword" rows="5" placeholder="Meta Tag Keywords" id="input-meta-keyword1" class="form-control">{!! $category->meta_tag_keywords !!}</textarea>
                    </div>
                  </div>
                   <div class="form-group">
                   <div class="col-md-2"></div>
                   <div class="col-md-10 ">
                   <button type="submit" class="btn btn-success clear-fix" >Update {!! $category->cat_name !!} Category</button>
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


                  
               
                            
