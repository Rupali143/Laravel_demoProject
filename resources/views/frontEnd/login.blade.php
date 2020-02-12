<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="{{asset('frontEnd/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <!--<script src="js/html5shiv.js"></script>-->
    <!--<script src="js/respond.min.js"></script>-->
    {{--<![endif]-->--}}
</head><!--/head-->
<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="{{ url('auth/google') }}"><i class="fa fa-google-plus"></i></a></li>
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
                    <div class="logo pull-left">
                        <a href="index.html"><img src="{{asset('frontEnd/images/home/logo.png')}}" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canada</a></li>
                                <li><a href="">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="">Canadian Dollar</a></li>
                                <li><a href="">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{--<div class="col-sm-8">--}}
                    {{--<div class="shop-menu pull-right">--}}
                        {{--<ul class="nav navbar-nav">--}}
                            {{--<li><a href=""><i class="fa fa-user"></i> Account</a></li>--}}
                            {{--<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>--}}
                            {{--<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>--}}
                            {{--<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>--}}
                            {{--<li><a href="{{ url('userloginform') }}" class="active"><i class="fa fa-lock"></i> Login</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div><!--/header-middle-->
</header><!--/header-->
{{--<hr>--}}
{{--<section id="form"><!--form-->--}}
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <div class="alert-text"><strong>
                        {!! session()->get('success') !!} !!
                    </strong>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{ url('login') }}" method="post">
                        @csrf
                        <input type="hidden" value="customer" name="customer">
                        <input type="email" placeholder="Email Address" name="email" required/>
                        <input type="password" placeholder="Password" name="password" required/>
                        <input type="submit" class="btn btn-primary" value="Login">
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{ url('userRegister' )}}" method="post">
                        @csrf
                        <input type="text" placeholder="Name" name="name" required/>
                        <input type="email" placeholder="Email Address" name="email" required/>
                        <input type="password" placeholder="Password" name="password" id="password" required/>
                        <input type="password" placeholder="Confirm Password" name="confirm_password"  id="confirm_password" required/>
                        <div id="display_error" style="color: #ff0000;"></div>
                        <input type="submit" class="btn btn-primary" value="Signup" onclick="return Validate()">
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
{{--</section><!--/form-->--}}

@extends('frontEnd/layouts/footer')
<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            $("#display_error").text('Passwords do not match.');
//            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
<script src="{{asset('frontEnd/js/jquery.js')}}"></script>
<script src="{{asset('frontEnd/js/bootstrap.min.js')}}"></script>
</body>
</html>