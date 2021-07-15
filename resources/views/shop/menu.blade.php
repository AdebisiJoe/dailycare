    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/shop') }}">Store</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">
                    @foreach ($categories as $cat)
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown'>{{{ $cat->cat_name }}}</a>
                            <ul class='dropdown-menu multi-column columns-2'>
                                <div class='row'>
                                  <div class='col-sm-6'>
                                    <ul class='multi-column-dropdown'>

                                        @foreach ($subcategories as $sub)
                                            @if ($cat->id == $sub->cat_id)
                                                <li><a href='{{ url('/sub/') }}/{!! str_slug($sub->sub_catname, $separator = "-") !!}'>{{{ $sub->sub_catname }}}</a></li>
                                            @endif
                                        @endforeach
                                      </ul>
                                    </div>
                                </div>
                            </ul>
                        </li>                            
                    @endforeach   
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="mywishlist" href="{{ url('/wishlist') }}" title="My Wishlist">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            @if($mywishlist > 0)
                                <span id='thewhishlistspan' class='badge' >{{{ $mywishlist }}}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a id="mycart" href="{{ url('/cart') }}" title="My Cart">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            @if($mycart > 0)
                                <?php $totalAmount = 0; ?>
                                @foreach ($userCartInfo as $userCartInfo)
                                    <?php $totalAmount += ($userCartInfo->price * $userCartInfo->qty) ?>
                                @endforeach
                                <span id='thespan' class='badge' >{{{ $mycart }}} item(s) - <?= $totalAmount; ?> </span>
                            @endif
                        </a>
                    </li>
                   
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>