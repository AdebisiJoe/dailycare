@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Set food status</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
            <a href="{{url('/')}}" class="{{$btnstatus}}">{{$buttonvalue}}</a>
            </div>
        </div>
    </section>

@endsection
@section('scripts')



@endsection


