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
                        <li><a href="{{ url('fetchproducts/'.$subcategory->id )}}">{{ $subcategory->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('main-section')
 @if(!empty($fetchproduct))
    <div class="features_items">
        <h2 class="title text-center">Latest Products</h2>
        @foreach($product as $product)
            {{--@foreach($pro->image as $img1)<div class="row"> {{ $product->links() }} </div>--}}

            <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="/uploads/products/{{ $product->image[0]->images }}" alt="" value="{{ $product->image[0]->product_id }}" width="100px;" height="150px;"/>
                        <h2>$56</h2>
                        <p>{{ $product->name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

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

                        {{--@if(\Auth::check() && $favourite->product_id == $pro->image[0]->product_id)--}}
                            {{--@foreach($favourites as $favourite)--}}
                            {{--<li><a href="{{ route('favourite',[$pro->image[0]->product_id])}}" style="display: none;"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--<li><a href="{{ route('favourite',[$pro->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                        {{--@endif--}}

                        {{--@foreach($favourites as $favourite)--}}
                            {{--@dd($favourites->product_id)--}}
                            {{--@if($favourite->product_id == $pro->image[0]->product_id && \Auth::user()->id)--}}
                                {{--<li style="display: none;"><a href="{{ route('favourite',[$pro->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                            {{--@else--}}
                                {{--<li><a href="{{ route('favourite',[$pro->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                        @if(\Auth::check())
                            @if(isset($product->favourite) == false)
                                <li><a href="{{ route('favourite',[$product->id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('favourite',[$product->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
            {{--@endforeach--}}

        @endforeach
    </div>
    @else
     <div class="features_items">
         <h2 class="title text-center">Latest Products</h2>
        <div class="row"> {{ $product->links() }} </div>
         @foreach($product as $product)
             {{--@dd($pro->image[0])--}}
             {{--@foreach($pro->image as $img1)--}}

                 <div class="col-sm-4">
                     <div class="product-image-wrapper">
                         <div class="single-products">
                             <div class="productinfo text-center">
                                 <img src="/uploads/products/{{ $product->image[0]->images }}" alt="" value="{{ $product->image[0]->product_id }}" width="100px;" height="150px;"/>
                                 <h2>$56</h2>
                                 <p>{{ $product->name }}</p>
                                 <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

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
                                 {{--@if (in_array($favourites, $pro))--}}
                                     {{--<li style="display: none;"><a href="{{ route('favourite',[$pro->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                                 {{--@else--}}
                                     {{--<li><a href="{{ route('favourite',[$pro->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>--}}
                                 {{--@endif--}}

                                 @if(\Auth::check())
                                         @if(isset($product->favourite) == false)
                                         <li><a href="{{ route('favourite',[$product->id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                         @endif
                                 @else
                                     <li><a href="{{ route('favourite',[$product->image[0]->product_id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                 @endif
                                 {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>--}}
                             </ul>
                         </div>
                     </div>
                 </div>
                 {{--@endforeach--}}

         @endforeach
     </div>
    @endif
@endsection
