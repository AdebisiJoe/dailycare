@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Create Award Categories</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                <div class="col-md-12 pull-right"></div>

                <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="{{ url('/update/award/categories/')}}/{!!$awardCategory->id!!}">

                    {{csrf_field()}}

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Select Award Type</label>
                        <div class="col-sm-10">
                            <select name="award_type_id" class="form-control">
                                @foreach ($awardtypes as $awardtype)
                                    <option value="{!! $awardtype->id !!}"
                                    <?php if($awardCategory->awardtype->id == $awardtype->id) echo "selected" ?>
                                     >{!! $awardtype->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Award Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{$awardCategory->name}}" placeholder="Product Name" id="input-name1" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Award Category Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" value="{{$awardCategory->description}}" placeholder="Category Description" id="input-name1" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Award Month Duration</label>
                        <div class="col-sm-10">
                            <input type="number" min="1"  max="12" name="month_duration" value="{{$awardCategory->month_duration}}" placeholder="Award month duration" id="input-name1" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Award Stage</label>
                        <div class="col-sm-10">
                            <input type="number" min="0"  max="5" name="stage" value="{{$awardCategory->stage}}" placeholder="Stage Completed" id="input-name1" class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-2"></div>
                        <div class="col-md-10 ">
                            <button type="submit" class="btn btn-success clear-fix" >Submit</button>
                        </div>

                    </div>

                </form>


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

    <script>

        //Get Sub Category By CategoryID
        var subcategories = <?= $awardtypes; ?>;
        //console.log(subcategories);

        function subcategory() {
            //Get the ID of the current Selected Option
            //var e = document.getElementById("categoryID");
            // var currentCatID = e.options[e.selectedIndex].value;

            // var replyVal = "";

            for (var i =0; i < subcategories.length; i++) {
                // if(subcategories[i].cat_id == currentCatID) {
                $("#subCategoryID").append("<option value='"+ subcategories[i].id +"'>" + subcategories[i].slug + "</option>");

            }
        }

        function removeOptions(selectbox)
        {
            var i;
            for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
            {
                selectbox.remove(i);
            }
        }

        function getSubCategory() {
            removeOptions(document.getElementById("subCategoryID"));
            subcategory();
        }

        $(document).ready(function () {
            getSubCategory();
        });

    </script>
@endsection
