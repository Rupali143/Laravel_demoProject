
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            {{--<li><a href="{{ url('auth/google') }}"><i class="fa fa-google-plus"></i></a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    {{--<div class="logo pull-left">--}}
                        {{--<a href="index.html"><img src="{{asset('frontEnd/images/home/logo.png')}}" alt="" /></a>--}}
                    {{--</div>--}}
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(Auth::user())
                                <li><a href="{{ url('/')}}"><i class="fa fa-user"></i> Home</a></li>
                                <li><a href="{{ route('profileDisplay')}}"><i class="fa fa-user"></i> My Account</a></li>
                                <li><a href="{{ route('myWishList') }}"><i class="fa fa-heart"></i>My WishList</a></li>
                                <li><a href="{{ route('cart.display') }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> My cart <span class="badge" style="color: black;">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span></a>

                                </li>
                                <li><a href="{{ route('changePassword')}}"><i class="fa fa-key"></i> Change Password</a></li>
                                {{--<ul class="nav navbar-nav collapse navbar-collapse">--}}
                                    {{--<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>--}}
                                        {{--<ul role="menu" class="sub-menu">--}}
                                            {{--<li><a href="shop.html">Products</a></li>--}}
                                            {{--<li><a href="product-details.html">Product Details</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                            <li><a href="{{ url('logout') }}"><i class="fa fa-lock"></i> Logout</a></li>
                            @else
                                <li><a href="{{ route('auth.google') }}"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="{{ url('userLoginForm') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!--/header-->
