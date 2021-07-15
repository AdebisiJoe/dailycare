@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <section class="content">

        @include('awarduser.menu')

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Award Details</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    @if (empty($awardcategoriescontent))
                        <div class="col-sm-6 col-md-3">
                            <p>No Products In This Sub Category</p>
                        </div>
                    @else
                        @foreach($awardcategoriescontent as $content)
                            <div class="col-sm-6 col-md-3">

                                <div class="thumbnail">

                                    <img src="{{asset('images/')}}" alt="">

                                    <div class="caption">
                                        <h3 class="text-center"><a href="#">{!!$content->product->item_name!!}</a></h3>

                                        <p class="text-center">{!!str_limit($content->product->description, $limit = 80, $end = "...")!!}</p>

                                        <p class="text-center">
                                            <button type="link" class="label label-success wish"><i class="fa fa-heart"></i>Quantity: {{$content->quantity}}</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>



            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <!-- The daterange picker bootstrap plugin -->

    <script src="{{ asset('plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/sugar.min.js') }}"></script>

    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('plugins/daterangepicker/raphael.js') }}"></script>

    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/morrischarthelp.js') }}"></script>
@endsection
