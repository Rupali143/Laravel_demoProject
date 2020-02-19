@extends('frontEnd/layouts/master')

@section('main-section')
    <div class="col-sm-9 padding-right">
        @foreach($productDetails as $productDetail)
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="/uploads/products/{{ $productDetail->image[0]->images }}" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="/uploads/products/{{ $productDetail->image[0]->images }}" alt="" height="100px;" width="100px;"></a>
                        </div>
                        @foreach($productDetail->image as $images)
                            {{--@dd($images->images)--}}
                        <div class="item">
                            <a href=""><img src="/uploads/products/{{ $images->images }}" alt="" height="100px;" width="100px;"></a>
                            {{--<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>--}}
                            {{--<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>--}}
                        </div>
                        @endforeach

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                    {{--@dd($productDetail->image)--}}
                <div class="product-information"><!--/product-information-->
                    {{--<img src="/uploads/products/{{$productDetail->image[0]->images}}" class="newarrival" alt="" />--}}
                    <img src="/uploads/products/{{ $productDetail->image[0]->images }}" alt="" value="" width="200px;" height="150px;"/>
                    <h2>{{ $productDetail->name}}</h2>
                    {{--<p>Web ID: 1089772</p>--}}
                    {{--<img src="images/product-details/rating.png" alt="" />--}}
								<span>
									<span>{{$productDetail->price}}</span>
									{{--<label>Quantity:</label>--}}
									{{--<input type="text" value="3" />--}}
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                    {{--<p><b>Availability:</b> In Stock</p>--}}
                    {{--<p><b>Condition:</b> New</p>--}}
                    {{--<p><b>Brand:</b> E-SHOPPER</p>--}}
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->

            </div>
        </div><!--/product-details-->
        @endforeach
    </div>
@endsection