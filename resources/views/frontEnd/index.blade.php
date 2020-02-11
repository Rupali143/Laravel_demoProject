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
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading" style="color: #000;"><a href="{{asset('/')}}">All</a></div>--}}
            {{--@foreach($category as $cat)--}}
            {{--<div class="panel-heading">--}}
                {{--<h4 class="panel-title"><a href="{{ url('fetchproducts/'.$cat->id )}}">{{ $cat->name }}</a></h4>--}}
            {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    </div>
@endsection

@section('main-section')
 @if(!empty($fetchproduct))
    <div class="features_items">
        <h2 class="title text-center">Latest Products</h2>
        @foreach($product as $img)
            @foreach($img->image as $img1)
                <div class="row"> {{ $product->links() }} </div>
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="/uploads/products/{{ $img1->images }}" alt="" value="{{ $img->category_id }}" width="100px;" height="150px;"/>
                        <h2>$56</h2>
                        <p>{{ $img->name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$56</h2>
                            <p>{{ $img->name }}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>

                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
            @endforeach
        @endforeach
    </div>

    @else
     <div class="features_items">
         <h2 class="title text-center">Latest Products</h2>
        <div class="row"> {{ $product->links() }} </div>
         @foreach($product as $img)
             @foreach($img->image as $img1)
                 <div class="col-sm-4">
                     <div class="product-image-wrapper">
                         <div class="single-products">
                             <div class="productinfo text-center">
                                 <img src="/uploads/products/{{ $img1->images }}" alt="" value="{{ $img->category_id }}" width="100px;" height="150px;"/>
                                 <h2>$56</h2>
                                 <p>{{ $img->name }}</p>
                                 <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                             </div>
                             <div class="product-overlay">
                                 <div class="overlay-content">
                                     <h2>$56</h2>
                                     <p>{{ $img->name }}</p>
                                     <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                 </div>
                             </div>
                         </div>

                         <div class="choose">
                             <ul class="nav nav-pills nav-justified">
                                 <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                 <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             @endforeach
         @endforeach
     </div>
     {{--{{ $product->links() }}--}}
    @endif
@endsection
