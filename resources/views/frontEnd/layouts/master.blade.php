<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('frontEnd/js/html5shiv.js')}}"></script>
    <script src="{{asset('frontEnd/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontEnd')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontEnd/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontEnd/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontEnd/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>

@include('frontEnd/layouts/header')

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png"  class="pricing" alt="" />
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                <img src="images/home/pricing.png" class="pricing" alt="" />
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">

                    @yield('main-sidebar')
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                {{--<div class="features_items"><!--features_items-->--}}
                    {{--<h2 class="title text-center">Features Items</h2>--}}
                    {{--<div class="col-sm-4">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/product1.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                {{--</div>--}}
                                {{--<div class="product-overlay">--}}
                                    {{--<div class="overlay-content">--}}
                                        {{--<h2>$56</h2>--}}
                                        {{--<p>Easy Polo Black Edition</p>--}}
                                        {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="choose">--}}
                                {{--<ul class="nav nav-pills nav-justified">--}}
                                    {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-4">--}}
                        {{--<div class="product-image-wrapper">--}}
                            {{--<div class="single-products">--}}
                                {{--<div class="productinfo text-center">--}}
                                    {{--<img src="images/home/product2.jpg" alt="" />--}}
                                    {{--<h2>$56</h2>--}}
                                    {{--<p>Easy Polo Black Edition</p>--}}
                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                {{--</div>--}}
                                {{--<div class="product-overlay">--}}
                                    {{--<div class="overlay-content">--}}
                                        {{--<h2>$56</h2>--}}
                                        {{--<p>Easy Polo Black Edition</p>--}}
                                        {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="choose">--}}
                                {{--<ul class="nav nav-pills nav-justified">--}}
                                    {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div><!--features_items-->--}}

                {{--<div class="category-tab"><!--category-tab-->--}}
                    {{--<div class="col-sm-12">--}}
                        {{--<ul class="nav nav-tabs">--}}
                            {{--<li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>--}}
                            {{--<li><a href="#blazers" data-toggle="tab">Blazers</a></li>--}}
                            {{--<li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>--}}
                            {{--<li><a href="#kids" data-toggle="tab">Kids</a></li>--}}
                            {{--<li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="tab-content">--}}
                        {{--<div class="tab-pane fade active in" id="tshirt" >--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="product-image-wrapper">--}}
                                    {{--<div class="single-products">--}}
                                        {{--<div class="productinfo text-center">--}}
                                            {{--<img src="images/home/gallery1.jpg" alt="" />--}}
                                            {{--<h2>$56</h2>--}}
                                            {{--<p>Easy Polo Black Edition</p>--}}
                                            {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="tab-pane fade" id="blazers" >--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="product-image-wrapper">--}}
                                    {{--<div class="single-products">--}}
                                        {{--<div class="productinfo text-center">--}}
                                            {{--<img src="images/home/gallery4.jpg" alt="" />--}}
                                            {{--<h2>$56</h2>--}}
                                            {{--<p>Easy Polo Black Edition</p>--}}
                                            {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--<div class="tab-pane fade" id="sunglass" >--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="product-image-wrapper">--}}
                                    {{--<div class="single-products">--}}
                                        {{--<div class="productinfo text-center">--}}
                                            {{--<img src="images/home/gallery3.jpg" alt="" />--}}
                                            {{--<h2>$56</h2>--}}
                                            {{--<p>Easy Polo Black Edition</p>--}}
                                            {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--<div class="tab-pane fade" id="kids" >--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="product-image-wrapper">--}}
                                    {{--<div class="single-products">--}}
                                        {{--<div class="productinfo text-center">--}}
                                            {{--<img src="images/home/gallery1.jpg" alt="" />--}}
                                            {{--<h2>$56</h2>--}}
                                            {{--<p>Easy Polo Black Edition</p>--}}
                                            {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="tab-pane fade" id="poloshirt" >--}}
                            {{--<div class="col-sm-3">--}}
                                {{--<div class="product-image-wrapper">--}}
                                    {{--<div class="single-products">--}}
                                        {{--<div class="productinfo text-center">--}}
                                            {{--<img src="images/home/gallery2.jpg" alt="" />--}}
                                            {{--<h2>$56</h2>--}}
                                            {{--<p>Easy Polo Black Edition</p>--}}
                                            {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div><!--/category-tab-->--}}
                @yield('main-section')
            </div>

        </div>

    </div>

</section>

@include('frontEnd/layouts/footer')

<script src="{{asset('frontEnd/js/jquery.js')}}"></script>
<script src="{{asset('frontEnd/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontEnd/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontEnd/js/price-range.js')}}"></script>
<script src="{{asset('frontEnd/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontEnd/js/main.js')}}"></script>
</body>
</html>