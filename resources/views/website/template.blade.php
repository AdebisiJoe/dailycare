@extends('website.master')
@section('stylesheet')

@endsection
@section('content')


@endsection
@section('scripts')

@endsection

 <li><a href="{{url('/service')}}">Service</a></li>



  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{url('/blog-archive')}}">Blog Archive</a></li>                
                <li><a href="{{url('/blog-single-with-left-sidebar')}}">Blog Single with Left Sidebar</a></li>
                <li><a href="{{url('/blog-single-with-right-sidebar')}}">Blog Single with Right Sidebar</a></li>
                <li><a href="{{url('/blog-single-with-out-sidebar')}}">Blog Single with out Sidebar</a></li>           
              </ul>
            </li>