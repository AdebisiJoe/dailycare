<header class="header_wrap dark_skin main_menu_uppercase">
	<div class="top-header bg_gray">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                	<ul class="contact_detail border_list list_none text-center text-md-left">
                        <li><a href="#"><i class="ti-mobile"></i> <span>+123 456 7890</span></a></li>
                        <li><a href="#"><i class="ti-email"></i> <span><span class="__cf_email__" data-cfemail="4821262e270831273d3a25292124662b2725">[email&#160;protected]</span></span></a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul class="header_list border_list list_none header_dropdown text-center text-md-right">
                        <li>
                            <div class="custome_dropdown">
                                <select name="countries" class="custome_select">
                                    <option value='ng' data-title="English">Nigeria</option>
                                    <option value='fn' data-title="France">Ghana</option>
                                    <option value='us' data-title="United States">Kenya</option>
                                </select>
                            </div>
                        </li>
                        {{-- <li class="dropdown">
                          <a class="dropdown-toggle" href="#" data-toggle="dropdown">My Account</a>
                          <div class="dropdown-menu shadow dropdown-menu-right">
                            <ul>
                                <li><a class="dropdown-item" href="">My account</a></li>
                                <li><a class="dropdown-item" href="wishlist.html">Wishlist</a></li>
                                <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
                            </ul>
                          </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="{{ route('pages.index') }}">
                <img class="logo_light" src="{{ asset('front/assets/images/logo_white.png') }}" style="width:167px; height:68px" alt="logo" />
                <img class="logo_dark" src="{{ asset('front/assets/images/logo_dark.png') }}" style="width:167px; height:68px" alt="logo" />
                <img class="logo_default" src="{{ asset('front/assets/images/logo_dark.png') }}" style="width:167px; height:68px" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
				<ul class="navbar-nav">
                    <li>
                        <a class="nav-link active" href="{{ route('pages.index') }}">Home</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('pages.about') }}">About Us</a>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Packages</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="{{ route('pages.index') }}">Basic Package</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="index-2.html">Premium Package</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="index-3.html">Dollar Package</a></li> 
                            </ul>
                        </div>
                    </li> --}}
                    {{-- <li>
                        <a class="nav-link" href="blog-list-right-sidebar.html">Blog</a>
                    </li> --}}
                    <li>
                        <a class="nav-link" href="{{url('/compensation-plan')}}">Compenstaion Plan</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('pages.faq') }}">FAQ</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('/contact')}}">Contact</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('/join-now')}}">Join now</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{url('/login')}}">Login</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav attr-nav align-items-center">
                {{-- <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="ion-ios-search-strong"></i></a>
                    <div class="search-overlay">
                        <div class="search_wrap">
                            <form>
                                <div class="rounded_input">
                                	<input type="text" placeholder="Search" class="form-control" id="search_input">
                                </div>
                                <button type="submit" class="search_icon"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </li> --}}
                {{-- <li class="dropdown cart_wrap">
                	<a class="nav-link" href="#" data-toggle="dropdown"><i class="ion-bag"></i><span class="cart_count">2</span></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                <li>
                                    <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="{{ asset('front/assets/images/cart_thamb1.jpg') }}" alt="cart_thumb1">Fresh Organic Strawberry</a>
                                    <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span>78.00</span></span>
                                </li>
                                <li>
                                    <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="{{ asset('front/assets/images/cart_thamb2.jpg') }}" alt="cart_thumb2">Fresh Organic Grapes</a>
                                    <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span>81.00</span></span>
                                </li>
                            </ul>
                        <div class="cart_footer">
                            <p class="cart_total">Total: <span class="cart_amount"> <span class="price_symbole">$</span>159.00</span></p>
                            <p class="cart_buttons"><a href="cart.html" class="btn btn-default btn-radius view-cart">View Cart</a><a href="checkout.html" class="btn btn-dark btn-radius checkout">Checkout</a></p>
                        </div>
                    </div>
                </li> --}}
            </ul>
        </nav>
    </div>
</header>