@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Create Award Categories Content</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                <div class="col-md-12 pull-right"></div>

                <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="{{ url('/create/award/categories/contents') }}">

                    {{csrf_field()}}

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Good Type</label>
                        <div class="col-sm-10">
                            <select name="award_type_id" class="form-control" name="good_type" id="categoryID" onselect="getSubCategory()" onchange="getSubCategory()">
                                <option value="fooditem">Food items</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Select Award Type</label>
                        <div class="col-sm-10">
                            {{--<input type="number" min="1"  max="50" name="award_category_id" value="" id="input-name1" class="form-control" />--}}
                            <select name="award_category_id" class="form-control">
                                {{--@foreach ($awardcategories as $awardcategory)$awardcategories--}}
                                    <option value="{!! $awardcategories->id !!}">{!! $awardcategories->name !!}</option>
                                {{--@endforeach--}}
                            </select>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">Product</label>
                        <div class="col-sm-10">

                            <select name="product_id" id="subCategoryID" class="form-control">
                            </select>
                        </div>
                    </div>


                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">quantity</label>
                        <div class="col-sm-10">
                            <input type="number" min="1"  max="50" name="quantity" value="" placeholder="Quantity of Goods" id="input-name1" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-name1">visibility to customer</label>
                        <div class="col-sm-10">
                            <input type="number" min="0"  max="1" name="visibility" value="" placeholder="Stage Completed" id="input-name1" class="form-control" />
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
        var subcategories1 = <?= $products; ?>;
        var subcategories2 = <?= $accessories; ?>;

        //console.log(subcategories);

        function subcategory() {
            //Get the ID of the current Selected Option
            var e = document.getElementById("categoryID");
            var currentCatID = e.options[e.selectedIndex].value;

            if(currentCatID === 'fooditem'){
                sendOptions1(subcategories1)
            }

            if(currentCatID === 'accessories'){
                sendOptions2(subcategories2)
            }

        }

        function sendOptions1(subcategories) {
            for (var i =0; i < subcategories.length; i++) {
                // if(subcategories[i].cat_id == currentCatID) {
                $("#subCategoryID").append("<option value='"+ subcategories[i].id +"'>" + subcategories[i].item_name + "</option>");

            }
        }

        function sendOptions2(subcategories) {
            for (var i =0; i < subcategories.length; i++) {
                // if(subcategories[i].cat_id == currentCatID) {
                $("#subCategoryID").append("<option value='"+ subcategories[i].id +"'>" + subcategories[i].name + "</option>");

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