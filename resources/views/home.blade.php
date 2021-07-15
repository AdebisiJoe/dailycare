@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Registrations per day</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-calendar"></i></span><input type="text" name="range" id="range" />
                            </div>
                        </fieldset>
                    </form>

            <div id="placeholder">
                <div id="chart"></div>
                 
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
