@extends('layouts.app')
@section('stylesheet')
 <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
@endsection
@section('content')
<section class="content">
@include('shop.menu')

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="box-body">
            <div class="row">  
                @if (empty($products))
                    <div class="col-sm-6 col-md-12"><h2>SORRY! There's either no product available for your country or no product in this store.</h2></div>
                @else
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-3">

                            <div class="thumbnail">

                                <img src="{{asset('images/')}}/{!!$product->image!!}" alt="">

                                <div class="caption">
                                    <h3 class="text-center"><a href="{{ url('/details') }}/{{str_slug($product->item_name, $separator = "-")}}">{!!$product->item_name!!}</a></h3>

                                    <p>{!!str_limit($product->description, $limit = 80, $end = "...")!!}</p>

                                    <a class="btn btn-warning btn-sm btn-block text-bold" onclick="addToCart({{{$product->id}}})" style="background-color: #DD4B39" data-toggle="tooltip" title="Add to cart">Add to cart - ${!! number_format($product->price/200, 1, '.', ',') !!}</a>

                                    <p class="text-center">
                                        <button onclick="addToWishlist({!!$product->id!!})" data-toggle="tooltip" title="Add to wishlist" class="label label-success wish"><i class="fa fa-heart"></i>&nbsp;Add to wishlist</button>
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

