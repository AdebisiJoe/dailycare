@extends('layouts.app')

@section('content')



<section class="content">

@include('shop.menu')

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-body">

                <div class="row">     
                   <div class="col-md-12 padding-right">
                        <div class="product-details"><!--product-details-->
                    
                            <div class="col-md-7">
                                <div class="product-information"><!--/product-information--> 

                                    <div class="row">
                                        <div class="col-md-7 col-lg-7">
                                            <img src="{{asset('images/')}}/{!!$productDetail->image!!}" class="img-rounded img-responsive newarrival" alt="" />                                        
                                        </div>
                                        <div class="col-md-5 col-lg-5">
                                            <h2>{{{$productDetail->item_name}}}  </h2>
                                            <div class="form-group">
                                                <label for="inputPassword2" class="label label-danger">Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">&#8358;</span>
                                                    <input type="text" readonly value="{{{$productDetail->price}}}" class="form-control" id="inputPassword2">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPassword2" class="label label-danger">Availability</label>
                                                <input type="text" readonly value="In stock" class="form-control" id="inputPassword2">
                                            </div>
                                            <div class="form-group">
                                                <label for="pqty" class="label label-danger">Quantity</label>
                                                <input type="number" value="1" class="form-control" id="pqty" placeholder="1,2,3,4..." min="1">
                                                <input type="hidden" id="pid" value="{{{$productDetail->id}}}">
                                            </div>
                                              <button type="submit" onclick="addToCartFromItem({{{$productDetail->id}}})" class="btn btn-danger btn-block bpid"><i class="fa fa-shopping-cart"></i>&nbsp;Add to cart</button>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="media">
                                              <div class="media-body">
                                                <h4 class="media-heading">Product Description</h4>
                                                <p>{{{$productDetail->description}}}</p>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div><!--/product-information-->
                            </div>

                            <div class="col-md-5 col-lg-5" style="margin-bottom: 0px">
                                <h4>Recent Products</h4>

                                <?php $i = 0; ?>
                                @foreach($products as $product)
                                    @if ($i < 4)
                                        <div class="media" st>
                                          <div class="media-left">
                                            <a href="{{ url('/details') }}/{{str_slug($product->item_name, $separator = "-")}}">
                                              <img height="70" width="130" class="media-object" src="{{asset('images/')}}/{!!$product->image!!}" alt="...">
                                            </a>
                                          </div>
                                          <div class="media-body">
                                            <h4 class="media-heading"><a href="{{ url('/details') }}/{{str_slug($product->item_name, $separator = "-")}}">{!!$product->item_name!!}</a></h4>
                                            {!! str_limit($product->description, $limit = 150, $end = "...") !!}
                                            <br>
                                            <button onclick="addToCart({{{$product->id}}})" data-toggle="tooltip" value="Add to cart" class="label label-warning"><i class="fa fa-shopping-cart"></i></button>
                                            <button onclick="addToWishlist({!!$product->id!!})" data-toggle="tooltip" value="Add to wishlist" class="label label-danger"><i class="fa fa-heart"></i></button>
                                          </div>
                                        </div>
                                        <?php $i++; ?>
                                    @endif
                                @endforeach

                            </div>
                        </div><!--/product-details-->
                   </div>
                </div><!-- /.row -->

            </div><!-- /.box-body -->
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

    function addToCartFromItem(pid) {
        var productid=pid;
        var wishlisturl="{{url('/')}}/add-to-whishlist/" + productid;
        var savetocarturl="{{url('/')}}/add-to-cart/" + productid;
        var formdata={pqty:$('#pqty').val()};
    
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
