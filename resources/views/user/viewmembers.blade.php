@extends('layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{asset('assets/css/jquery.orgchart.css')}}">

<style type="text/css">
  .content {
    min-height:100px;
    padding:6px;
   min-width:120px;
  }
    .orgchart {
    background: #fff;
    border: 0;
    padding: 0;
  }
    .orgchart .node .title {
    background-color: #fff;
    color: #000;
    height:50px;
    border-radius: 0;
  }
</style>
@endsection
@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
    <h3 class="box-title">View members under you</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
    <div class="col-md-10">
      <!--<input type="hidden" name="" id="membershipidvalue" value="{{$membershipid}}">
           <div class="form-group">-->
            
             <input type="text" placeholder="search members id" name="searchid" id="searchid" class="form-control col-md-8" >

             <div class="form-group" style="margin-top:50px">
             <button onclick="displaychildtree()" class="btn btn-danger">Search</button>

           </div>
           </div>
           
        
    
        

         <div class="col-md-12">

            
            <div id="chart-container">
              
            </div>
          </div>
       
      

    </div>
  </div>
</section>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('assets/js/jquery.orgchart.js') }}"></script> 

<script type="text/javascript">
//var  data="{!!URL::route('jsonfortree')!!}";
//var membershipid=$("#membershipidvalue").val();
var initdata = "{{url('/')}}/members-chart-init";

var ajaxURLs = {

  'children': function(nodeData) {
    return  "{{url('/')}}/members-chart-children/" + nodeData.id;
  }
};



$('#chart-container').orgchart({
  'data' :initdata,
  'nodeContent': 'id',
  'ajaxURL': ajaxURLs,
  'nodeContent': 'title',
  'nodeId': 'id',
  'pan': true,
  'zoom': true,
 'createNode': function($node, data) {
$node.children('.title').html('<img src="{{url('/')}}/imgavatar/' +data.title+ '.jpg" widht="100%" height="100%">');

//$node.children('.content').html('<img src="{{url('/')}}/imgavatar/' +data.title+ '.jpg" widht="100%" height="100%">');
$node.children('.content').html('<p style="margin-top:0px">'+data.id+'</p><p> Stage:'+data.stage+'</p>'+'</p><p> Username:<br>'+data.username+'</p>');
    //$node.on('mouseover', function() {
      //alert('who are you');
      //});
  }
}).on('touchmove', function(event) {
  event.preventDefault();
});

</script>
<script type="text/javascript">

 
function displaychildtree(){
  $("#chart-container").empty();
  

var membershipid=$("#searchid").val();
var initdata = "{{url('/')}}/members-chart-init2/"+membershipid;

var ajaxURLs = {

  'children': function(nodeData) {
    return  "{{url('/')}}/members-chart-children/" + nodeData.id;
  }
};



$('#chart-container').orgchart({
  'data' :initdata,
  'nodeContent': 'id',
  'ajaxURL': ajaxURLs,
  'nodeContent': 'title',
  'nodeId': 'id',
  'pan': true,
  'zoom': true,
 'createNode': function($node, data) {
  console.log(data.id);
 if(data.id=="empty"){
$("#chart-container").html("<h1>This Membership Id is not under you</h1>");
 }else{

$node.children('.title').html('<img src="{{url('/')}}/imgavatar/' +data.title+ '.jpg" widht="100%" height="100%">');

//$node.children('.content').html('<img src="{{url('/')}}/imgavatar/' +data.title+ '.jpg" widht="100%" height="100%">');
$node.children('.content').html('<p style="margin-top:0px">'+data.id+'</p><p> Stage:'+data.stage+'</p>'+'</p><p> Username:<br>'+data.username+'</p>');
    //$node.on('mouseover', function() {
      //alert('who are you');
      //});
    }
  }
}).on('touchmove', function(event) {
  event.preventDefault();
});
 
} 
</script>
@endsection







