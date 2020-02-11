@extends('frontEnd/layouts/master')

@section('main-sidebar')
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        <div class="panel panel-default">
            <div class="panel-heading" style="color: #000;"><a href="{{asset('/')}}">All</a></div>
            @foreach($category as $cat)
            <div class="panel-heading">
                <h4 class="panel-title"><a href="{{ url('fetchproducts/'.$cat->id )}}">{{ $cat->name }}</a></h4>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('main-section')
 @if(!empty($fetchproduct))
    <div class="features_items">
        <h2 class="title text-center">Latest Products</h2>
        @foreach($product as $img)
            @foreach($img->image as $img1)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="/uploads/products/{{ $img1->images }}" alt="" value="{{ $img->category_id }}" width="100px;" height="150px;"/>
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
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
         @foreach($product as $img)
             @foreach($img->image as $img1)
                 <div class="col-sm-4">
                     <div class="product-image-wrapper">
                         <div class="single-products">
                             <div class="productinfo text-center">
                                 <img src="/uploads/products/{{ $img1->images }}" alt="" value="{{ $img->category_id }}" width="100px;" height="150px;"/>
                                 <h2>$56</h2>
                                 <p>Easy Polo Black Edition</p>
                                 <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                             </div>
                             <div class="product-overlay">
                                 <div class="overlay-content">
                                     <h2>$56</h2>
                                     <p>Easy Polo Black Edition</p>
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
    @endif
@endsection
