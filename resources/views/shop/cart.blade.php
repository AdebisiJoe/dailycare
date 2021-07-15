@extends('layouts.app')

@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Shopping Cart</h3>
            <div class="box-tools pull-right">

            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          @if($total>0)
              <div class="row">
              <div class="col-sm-12 col-md-12 ">
                 <ul class="list-group-item">
              	
                      
                


               
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td class="text-center">Image</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Model</td>
                <td class="text-left">Quantity</td>
                <td class="text-right">Unit Price</td>
              </tr>
            </thead>
            <tbody>
            <?php $totalAmount = 0; ?>
            @foreach($infoFromCart as $product)
                            <tr>
                <td class="text-center">                  
                    <a href="{{ url('/details') }}/{{str_slug($product->item_name, $separator = "-")}}"><img src="{{asset('images/')}}/{!!$product->image!!}" alt="{{$product->item_name}}" title="{{$product->item_name}}" class="img-thumbnail" width="80px" height="80px" /></a>
                  </td>
                <td class="text-left"><a href="{{ url('/details') }}/{{str_slug($product->item_name, $separator = "-")}}">{{$product->item_name}}</a>
                
                 </td>
                <td class="text-left">{{$product->model}}</td>
                <td class="text-left">
                <div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="" id="pqty_{!!$product->pid!!}" value="{{$product->quantity}}" size="1" class="form-control" />

                    <input type="hidden" name="" id="pid_{!!$product->pid!!}" value="{{$product->pid}}" size="1" class="form-control" />

                    <span class="input-group-btn">
                    <button   id="refresh_{!!$product->pid!!}"  data-toggle="tooltip" title="Update" class="btn btn-primary torefresh"><i class="fa fa-refresh"></i></button>
                    <button  data-toggle="tooltip" title="Remove" id="remove_{!!$product->pid!!}" class="btn btn-danger remove" onclick=""><i class="fa fa-times-circle"></i></button>
                    </span>
                    </div>
                  </td>
                <td class="text-right">{{$product->price}}</td>
              </tr>
              <?php $totalAmount += ($product->price * $product->quantity) ?>
              @endforeach

              <tr>
                  <td colspan="3"></td>
                  <td><b style="float:right">Total</b></td>

                  <td><b style="float:right"><?= $totalAmount; ?></b></td>
              </tr>
            </tbody>
          </table>
        </div>

        
         
<h2>What would you like to do next?</h2>
        <div class="container-fluid">
            <a href="{{ url('/shop') }}" type="button" class="btn btn-success btn-lg pull-left"><span class="fa fa-shopping-cart"></span>&nbsp;Continue Shopping</a>
            <a href="{{ url('/checkout') }}" type="button" class="btn btn-warning btn-lg pull-right">Proceed to Checkout&nbsp;<span class="fa fa-sign-in"></span></a>
        </div>


    </div>

              	 </ul>  
              </div> 
              </div>
          @else
          <div class="row">
              <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                 <H2>No Items in Your Cart</H2> 
              </div>  
              </div>

          @endif
        </div>
    </div>
</section>
<meta name="_token" content="{!! csrf_token() !!}" />

@endsection
@section('scripts')
<script type="text/javascript">
$(document).on('click','.torefresh', function(){ 
     
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    
    var productid=$("input:hidden#pid_"+ id[1]).val();
    var wishlisturl="{{url('/')}}/add-to-whishlist/"+productid;
    var updatecarturl="{{url('/')}}/update-cart/"+productid;
    var formdata={pqty:$("input:text#pqty_"+ id[1]).val(),};
      //var productid=$("input:hidden#pid").val();
     // var wishlisturl="{{url('/')}}/add-to-whishlist/"+productid;
      //var savetocarturl="{{url('/')}}/add-to-cart/"+productid;
     // var formdata={pqty:$("input:text#pqty").val(),};
     
      

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
      $.ajax({
        type:"POST",
        url:updatecarturl,
        data:formdata,
        dataType:'json',
        success:function(data){
            alert('Update Successful');
            var json=data;
            $("#thespan").remove();
            $('a#mycart').append("<span id='thespan' class='badge' >"+json.cart+ "</span>");
            location.reload();
        }

    });
});

$(document).on('click','.remove', function(){ 


      id_arr = $(this).attr('id');
    id = id_arr.split("_");
    
    var productid=$("input:hidden#pid_"+ id[1]).val();
    var wishlisturl="{{url('/')}}/add-to-whishlist/"+productid;
    var updatecarturl="{{url('/')}}/delete-from-cart/"+productid;
    var formdata={pqty:$("input:text#pqty_"+ id[1]).val(),};
      //var productid=$("input:hidden#pid").val();
     // var wishlisturl="{{url('/')}}/add-to-whishlist/"+productid;
      //var savetocarturl="{{url('/')}}/add-to-cart/"+productid;
     // var formdata={pqty:$("input:text#pqty").val(),};
     
      
      $(this).parent().parent().parent().parent().remove();
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
      $.ajax({
        type:"POST",
        url:updatecarturl,
        data:formdata,
        dataType:'json',
        success:function(data){
            var json=data;
            $(this).parent().parent().parent().parent().remove();
            $("#thespan").remove();
            
            $('a#mycart').append("<span id='thespan' class='badge' >"+json.cart+ "</span>");
            location.reload();
        }

    });


 

 });
</script>
@endsection
