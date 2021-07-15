@extends('layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('assets/css/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lightbox.min.css') }}">
<style type="text/css">
  #gallery-images img{
    width:240px;
    height: 160px;
    border:2px solid black;
    margin-bottom: 10px;

  }
  #gallery-images ul{
    margin:0;
    padding:0;
  }
  #gallery-images li{
    margin:0;
    padding: 0;
    list-style: none;
    float:left;
    padding-right:10px;
    margin-top: 4px;
  }
</style>
@endsection
@section('content')
<script type="text/javascript">
  var baseUrl="{{url('/')}}";
</script>
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">View gallery</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <h1>{{$gallery->name}}</h1>
        </div>
      </div>
    
    <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><a href="#collapse-dropzone" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Upload pictures<i class="fa fa-caret-down"></i></a></h4>
</div>
<div id="collapse-dropzone" class="panel-collapse collapse">
        <div class="panel-body">

          <div class="row">
            <div class="col-md-12">
              <form  action="{{url('gallery/do-upload')}}" class="dropzone" id="addImages" enctype="multipart/form-data">
                <input type="hidden" name="gallery_id" value="{{$gallery->id}}">
              </form>

            </div>
          </div>


        </div>
      </div>
    </div>




      <div class="row">
        <div class="col-md-12">
          <div id="gallery-images">
            <ul>
              @foreach($gallery->images as $image)
              <li >
               <div class="row">
                 <div class="col-md-12" >
                  <a href="{{url($image->picpath)}}" data-lightbox="gallery">
                    <img src="{{url($image->picpath)}}">
                  </a>
                  
                </div>
                <div class="col-md-12">
                  <h5>Caption 1 :{{$image->caption1}}</h5>
                  <h5>Caption 1 :{{$image->caption2}}</h5>
                </div>
                <div class="col-md-3">
                  <a  href="{{url('gallery/delete-image')}}/{{$image->id}}" style="" class=" btn btn-danger">Delete</a> 
                </div>
                <div class="col-md-3">
                  <a  href="{{url('gallery/update-image/')}}/{{$image->id}}" style="" class=" btn btn-success">update</a> 
                </div>
              </div>
            </li>

            @endforeach
          </ul>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-md-12">
        <a href="{{url('gallery/list')}}" style="margin-top:5px" class="btn btn-primary">Back</a>
      </div>
    </div>





  </div>
</div>
</section>

@endsection
@section('scripts')

<script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/galleryjs.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.min.js') }}"></script>
@endsection


