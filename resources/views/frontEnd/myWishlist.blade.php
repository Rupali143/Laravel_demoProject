@extends('frontEnd/layouts/master')
@section('main-section')
        <div class="features_items">
            <h2 class="title text-center">My WishList</h2>
            <div class="row"> {{ $favourites->links() }} </div>
            @foreach($favourites as $favourite)
                @if($favourite->customer_id == \Auth::user()->id)
                @foreach($favourite->productImages as $img)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="/uploads/products/{{ $img->images }}" alt="" value="" width="100px;" height="150px;"/>
                                    <h2>$56</h2>
                                    <p></p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>$56</h2>
                                        <p></p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>

                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="{{ url('deleteWishlist',$img->id) }}"><i class="fa fa-close"></i>Delete from Wishlist</a></li>
                                    {{--<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            @endforeach
        </div>
@endsection
