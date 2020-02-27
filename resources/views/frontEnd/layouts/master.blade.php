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
    <script src="https://js.stripe.com/v3/"></script>
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
    @yield('main-slider')
</section><!--/slider-->


<section>
    <div class="container">

        @if (session('error'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    @yield('main-sidebar')
                </div>
            </div>

            <div class="col-sm-9 padding-right">

                @yield('main-section')
            </div>

        </div>
            @yield('main-content')
    </div>

</section>

@include('frontEnd/layouts/footer')

<script src="{{asset('frontEnd/js/jquery.js')}}"></script>
<script src="{{asset('frontEnd/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontEnd/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('frontEnd/js/price-range.js')}}"></script>
<script src="{{asset('frontEnd/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontEnd/js/main.js')}}"></script>
@yield('scripts')

</body>
</html>