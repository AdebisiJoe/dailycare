@extends('layouts.app')
@section('stylesheet')
 <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
@endsection
@section('content')
<section class="content">
@include('awarduser.menu')

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-body">
            <div class="row">  
                @if (empty($awardcategories) || $awardcategories==null)
                    <div class="col-sm-6 col-md-3">
                        <p>No Products In This Sub Category</p></div>
                @else
                    @foreach($awardcategories as $awardcategory)
                        <div class="col-sm-6 col-md-6">

                            <div class="thumbnail">

                                <img src="{{asset('images/')}}" alt="">

                                <div class="caption">
                                    <h3 class="text-center"><a href="{{url('/viewawardproduct')}}/{{$awardcategory->id}}">{!!$awardcategory->name!!}</a></h3>

                                    <p class="text-center">{!!str_limit($awardcategory->description, $limit = 80, $end = "...")!!}</p>
                                    <a class="btn btn-warning btn-sm btn-block text-bold" href="{{url('/requestawardproduct')}}/{{$awardcategory->id}}/{{$membershipid}}" style="background-color: #DD4B39" data-toggle="tooltip" title="view all product in this category">Request</a>

                                    <p class="text-center">
                                        <button type="link" class="label label-success wish"><i class="fa fa-heart"></i>Month Duration: {{$awardcategory->month_duration}}</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div><!-- /.row -->
    </div><!-- /.box -->
</section>        

<meta name="_token" content="{!! csrf_token() !!}" />

@endsection
@section('scripts')
<script src=" {{ asset('assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src=" {{ asset('assets/js/metisMenu.min.js') }}"></script>
<script type="text/javascript">


    function addToWishlist(pid) {

        var productid = pid;
        var wishlisturl = "{{url('/')}}/add-to-whishlist/"+productid;
        var savetocarturl = "{{url('/')}}/add-to-cart/"+productid;
        var formdata = {prdid:productid};

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
          $.ajax({
            type:"POST",
            url:wishlisturl,
            data:formdata,
            dataType:'json',
            success:function(data){
                alert('Added to wishlist');
                console.log(data);
                var json=data;
                $("#thewhishlistspan").remove();
                $('a#mywishlist').append("<span id='thewhishlistspan' class='badge' >"+json.wishlist+ "</span>");
            }
        });
    }

    function addToCart(pid) {
        var productid=pid;
        var wishlisturl="{{url('/')}}/add-to-whishlist/" + productid;
        var savetocarturl="{{url('/')}}/add-to-cart/" + productid;
        var formdata={pqty:1};
    
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
          $.ajax({
            type:"POST",
            url:savetocarturl,
            data:formdata,
            dataType:'json',
            success:function(data){
                alert('Added to cart');
                var json=data;
                $("#thespan").remove();
                $('a#mycart').append("<span id='thespan' class='badge' >"+json.cart+ "</span>");
            }
        });
    }

</script>
 
 
@endsection

