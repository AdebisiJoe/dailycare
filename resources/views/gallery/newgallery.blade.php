@extends('layouts.app')
@section('stylesheet')

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

      <div class="col-sm-8">
       @if($galleries->count()>0)
           <table class="table table-striped table-bordered table-responsive">
             <thead>
               <tr class="info">
                 <th>Name of the Gallery</th>
                 <th></th>
               </tr>
             </thead>
             <tbody>
             @foreach($galleries as $gallery)
               <tr>
                 <td>
                   {{$gallery->name}}
                   <span class="pull-right">
                     {{$gallery->images->count()}}
                   </span>
                 </td>
                 <td>
                   <a href="{{url('gallery/view/'.$gallery->id)}}">View</a>/
                   <a href="{{url('gallery/delete/'.$gallery->id)}}">Deleted</a>
                 </td>
               </tr>
             @endforeach 
             </tbody>
           </table>
       @endif
      </div>

      <div class="col-sm-4">

       <form method="POST" action="{{url('gallery/save')}}">
         <input type="text" id="gallery_name" name="gallery_name" placeholder="Enter  the name of the gallery" class="form-control" value="{{old('gallery_name')}}">
         <button style="margin-top:5px;" class="btn btn-primary">Save</button>
       </form>

     </div>

   </div>
 </div>
</section>

@endsection
@section('scripts')



@endsection


