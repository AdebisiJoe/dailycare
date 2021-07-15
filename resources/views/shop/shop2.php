 <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i>Wishlist</a></li>
                    <li><a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Shopping Cart
                    @if(Session::has('cart'))
                     <span class="badge">{{Session::has('cart')?Session::get('cart')->totalQty :''}} </span>
                    @endif
                    </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User Account<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">

                            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>User Account</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>






    @if(Session::has('cart'))
              <div class="row">
              <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                 <ul class="list-group-item">
                @foreach($products as $product)
                      
                        <span class="badge">{{$product['qty']}}</span>
                        <strong>{{$product['item']['item_name']}}</strong>
                        <span class="label label-success">{{$product['price']}}</span>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span> </button>
                            <ul class="dropdown-menu">
                               <li><a href="#">Reduce by 1</a></li>
                               <li><a href="#">Reduce all</a></li>
                            </ul>
                        </div>
                         
                @endforeach
                 </ul>  
              </div> 
              </div>

              <div class="row">
              <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                 <strong>Total: {{$totalPrice}}</strong>
              </div> 
              </div>
              <hr>
              <div class="row">
              <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                 <button type="button" class="btn btn-success">Checkout</button>
              </div>  
              </div>
          @else
          <div class="row">
              <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                 <H2>No Items in Your Cart</H2> 
              </div>  
              </div>

          @endif









           <div id="similar-product" class="carousel slide" data-ride="carousel">
                                
                                  <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                        </div>
                                        <div class="item">
                                          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                        </div>
                                        <div class="item">
                                          <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                                          <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                                        </div>
                                        
                                    </div>

                                  <!-- Controls -->
                                  <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                  </a>
                                  <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                  </a>
                            </div>





// product add to cart many products

            <div class="row">  

       
           <div class="col-md-12 padding-right">
                    <div class="product-details"><!--product-details-->
                
                        <div class="col-md-7">
                       
                            <div class="product-information"><!--/product-information-->
                                <img src="{{url($product->image)}}" class="newarrival" alt="" />
                                <h2>{!!$product->item_name!!}  </h2>
                                <h4> <span><b>PRICE:&#8358;{!!$product->price!!}</b></span></h4>
                               
                                    
                                    <div class="row">
                                    <div class = "form-group">
                                <div class = "col-md-12">
                                    <label >Quantity:</label>
                                
                               
                                    <input type="text"  class = "form-control"  value="1">
                                
                    

                                    
                                    <button id="btn-savetocart_{!!$product->id!!}" class="btn btn-success pull-right bpid" style="margin-top:10px" >
                                     <i class="fa fa-shopping-cart"></i>

                                        Add to cart
                                    </button>
                                      
                                    </div>
                                    </div>
                                </div>
                                </span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> E-SHOPPER</p>
                                
                                <p>{!!$product->description!!}</p>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->
                    
           </div>
               
            </div><!-- /.row -->                            





                              <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
          <table class="table table-bordered">
                        <tr>
              <td class="text-right"><strong>Sub-Total:</strong></td>
              <td class="text-right">{{$product->price*$product->quantity}}</td>
            </tr>
                        <tr>
              <td class="text-right"><strong>Eco Tax (-2.00):</strong></td>
              <td class="text-right">$2.00</td>
            </tr>
                        <tr>
              <td class="text-right"><strong>VAT (20%):</strong></td>
              <td class="text-right">$16.00</td>
            </tr>
                        <tr>
              <td class="text-right"><strong>Total:</strong></td>
              <td class="text-right">$98.00</td>
            </tr>
                      </table>
        </div>
      </div>