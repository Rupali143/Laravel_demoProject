@extends('frontEnd/layouts/master')

@section('main-sidebar')
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian">
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #000;"><a href="{{asset('/')}}">All</a></div>
            @foreach($category as $cat)
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#{{ $cat->name }}">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        {{ $cat->name }}
                    </a>
                </h4>
            </div>
            <div id="{{ $cat->name }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        @foreach($cat->subcategories as $subcategory)
                        <li><a href="{{ route('fetch.products',[$subcategory->id])}}">{{ $subcategory->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('main-slider')
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
                                    <img src="{{asset('frontEnd/images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('frontEnd/images/home/pricing.png')}}"  class="pricing" alt="" />
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
                                    <img src="{{asset('frontEnd/images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('frontEnd/images/home/pricing.png')}}"  class="pricing" alt="" />
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
                                    <img src="{{asset('frontEnd/images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('frontEnd/images/home/pricing.png')}}" class="pricing" alt="" />
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
    @endsection


@section('main-section')
 @if(!empty($fetchproduct))
    <div class="features_items">
        <h2 class="title text-center">Latest Products</h2>
        @foreach($products as $product)
            {{--@foreach($pro->image as $img1)<div class="row">--}}
            <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="/uploads/products/{{ $product->image[0]->images }}" alt="" value="{{ $product->image[0]->product_id }}" width="100px;" height="150px;"/>
                        <h2>$56</h2>
                        <p>{{ $product->name }}</p>
                        <a href="{{ route('cart.add',[$product->image[0]->product_id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$56</h2>
                            <p>{{ $product->name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        @if(\Auth::check())
                            @if(isset($product->favourite) == false)
                                <li><a href="{{ route('favourite',[$product->id]) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('favourite',[$product->id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
            {{--@endforeach--}}
        @endforeach
    </div>
    <div class="row"> {{ $products->links() }} </div>
    @else
     <div class="features_items">
         <h2 class="title text-center">Latest Products</h2>
         @foreach($products as $product)
             {{--@foreach($favourites as $favourite)--}}
                 {{--@dd($favourites)--}}
             <a href="{{ route('product.details',[$product->image[0]->product_id])}}">
                 <div class="col-sm-4">
                         <div class="product-image-wrapper">
                          <div class="single-products">
                             <div class="productinfo text-center">
                                 <img src="/uploads/products/{{ $product->image[0]->images }}" alt="" value="{{ $product->image[0]->product_id }}" width="100px;" height="150px;"/>
                                 <h2>{{ $product->price }} /-</h2>
                                 <p>{{ $product->name }}</p>
                                 <a href="{{ route('cart.add',[$product->image[0]->product_id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                             </div>
                             <div class="product-overlay">
                                 <div class="overlay-content">
                                     <h2>{{ $product->price }} /-</h2>
                                     <p>{{ $product->name }}</p>
                                     <a href="{{ route('cart.add',[$product->image[0]->product_id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                 </div>
                             </div>
                          </div>
                         <div class="choose">
                             <ul class="nav nav-pills nav-justified">
                                 @if(\Auth::check())
                                     @if(isset($product->favourite) == false)
                                         <li><a href="{{ route('favourite',[$product->id]) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                     @endif
                                 @else
                                     <li><a href="{{ route('favourite',[$product->id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                 @endif
                             </ul>
                         </div>
                     </div>
                 </div></a>
                 {{--@endforeach--}}
         @endforeach
     </div>
     <div class="row"> {{ $products->links() }} </div>
    @endif
@endsection
