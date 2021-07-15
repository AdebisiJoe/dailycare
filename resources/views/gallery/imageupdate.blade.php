@extends('layouts.app')
@section('stylesheet')
<style type="text/css">

#updateimage img{
    width:300px;
    height:200px;
    border:2px solid black;
    margin-bottom: 10px;
  }
</style>
@endsection
@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Create new gallery</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
    <div class="col-md-6" >
       <div id="updateimage">
         <img class="img-responsive" src="{{url($galleryimage->picpath)}}">
       </div>
      
    </div>
      <div class="col-md-12">

       <form method="POST" class="form-horizontal" action="{{url('/gallery/update-image')}}/{{$galleryimage->id}}">
      
         
         <div class="form-group">
         <div class="col-md-2">
           <label>First caption</label>
         </div>
          <div class="col-md-4">
          <input type="text" id="" name="caption1" placeholder="Enter the first caption" class="form-control" value="">
          </div>
           
         </div>

        <div class="form-group">
        <div class="col-md-2">
          <label>Second caption</label>
        </div>
          <div class="col-md-4">
            <input type="text" id="" name="caption2" placeholder="Enter  the second caption" class="form-control" value="">
          </div>
           
         </div>
         <button style="margin-top:5px;" type="submit" class="btn btn-primary">Update</button>
       </form>

     </div>

   </div>
 </div>
</section>

@endsection
@section('scripts')



@endsection


