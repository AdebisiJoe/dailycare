@extends('layouts.app')

@section('content')
<section class="content">
    @include('shop.menu')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">WishList</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">  
                @if (empty($wishlist))
                <div class="col-sm-12 col-md-12 text-center" ><p>No Items  In your Wish List</p></div>
                @else
               
                    @foreach($products as $product)
                     @foreach ($wishlist as $wish)
                      @if ($product->id == $wish->product_id)
                    <div class="col-sm-6 col-md-3" id="remCol{{{$product->id}}}">
                    <div class="thumbnail">

                        <img src="{{asset('images/')}}/{!!$product->image!!}" alt="">

                        <div class="caption">
                            <h3 class="text-center"><a href="{{ url('/details') }}/{{str_slug($product->item_name, $separator = "-")}}">{!!$product->item_name!!}</a></h3>

                            <p>{!!str_limit($product->description, $limit = 80, $end = "...")!!}</p>

                            <a class="btn btn-warning btn-sm btn-block text-bold" onclick="addToCart({{{$product->id}}})" style="background-color: #DD4B39" data-toggle="tooltip" title="Add to cart">Add to cart - &#8358;{!!$product->price!!}</a>

                            <p class="text-center">
                                <button onclick="removeFromWishlist({!!$product->id!!})" data-toggle="tooltip" title="Add to wishlist" class="label label-success wish"><i class="fa fa-heart"></i>&nbsp;Remove</button>
                            </p>
                        </div>
                    </div> 
                  </div>   
                      @endif
                     @endforeach



                    @endforeach
                
                @endif
            </div>

        </div>
    </div>
</section>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
<script type="text/javascript">
 $(document).ready(function(){
    var productid=$("input:hidden#pid").val();
    var wishlisturl="{{url('/')}}/add-to-whishlist/"+productid;
    var savetocarturl="{{url('/')}}/add-to-cart/"+productid;
    var formdata={prdid:$("input:hidden#pid").val(),};
    
});

function removeFromWishlist(pid) {
        var productid = pid;
        var wishlisturl = "{{url('/')}}/remove-from-wishlist/"+productid;
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
                console.log(data);
                var json=data;
                $("#remCol" + pid).remove();
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
            var json=data;
            $("#thespan").remove();
            $('a#mycart').append("<span id='thespan' class='badge' >"+json.cart+ "</span>");
            removeFromWishlist(pid);
        }
    });
}
</script>

@endsection
