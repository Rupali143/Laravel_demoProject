@extends('frontEnd/layouts/master')
<style>
    .cart_info table tr td {
        margin: 20px;
    }
</style>
@section('main-content')
        <section id="cart_items">
            <div class="row table-responsive cart_info">
                <p align="center" class="message" style='margin-top:20px;color:red;'></p>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        {{--<td></td>--}}
                    </tr>
                    </thead>
                    <tbody>
                    {{--@if(count($products) > 0)--}}
                        @foreach($products as $product)
                            {{--@foreach($images as $image)--}}
                             {{--@dd( $product->cartProducts)--}}
                            @foreach($product->cartProducts as $cartProduct)
                                {{--@dd($cartProduct)--}}

                            <tr>
                                <td class="cart_product">
                                    <a><img src="/uploads/products/{{$cartProduct->image[0]['images']}}" alt="" height="80px;" width="80px;"></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a>{{ $product['product']['name'] }}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <input type="text" value="{{ $cartProduct->price }}" style="border: none;" readonly>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {{--<a class="cart_quantity_up" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> + </a>--}}
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $cartProduct->quantity }}" autocomplete="off" size="2" id="quantity{{$product['item']['id']}}" readonly>
                                        {{--<a class="cart_quantity_down" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> - </a>--}}
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <h4><input type="text" id="price" value="{{$cartProduct->price * $cartProduct->quantity }}" style="border: none;" readonly></h4>
                                </td>
                                {{--<td class="cart_delete">--}}
                                {{--<a class="cart_quantity_delete" href="{{ route('deleteSession.product',[$product['item']['id']])}}"><i class="fa fa-times"></i></a>--}}
                                {{--</td>--}}
                            </tr>
                            @endforeach
                               {{--@if($order->orders['user_id'] == \Auth::user()->id)--}}
                            {{--@if($product->orders['user_id'] == \Auth::user()->id)--}}
                            {{--<tr>--}}
                                {{--<td class="cart_product">--}}
                                    {{--<a><img src="/uploads/products/{{ $product->image[0]['images'] }}" alt="" height="80px;" width="80px;"></a>--}}
                                {{--</td>--}}
                                {{--<td class="cart_description">--}}
                                    {{--<h4><a>{{ $product['product']['name'] }}</a></h4>--}}
                                {{--</td>--}}
                                {{--<td class="cart_price">--}}
                                    {{--<input type="text" value="{{ $product['price'] }}" style="border: none;" readonly>--}}
                                {{--</td>--}}
                                {{--<td class="cart_quantity">--}}
                                    {{--<div class="cart_quantity_button">--}}
                                        {{--<a class="cart_quantity_up" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> + </a>--}}
                                        {{--<input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['quantity'] }}" autocomplete="off" size="2" id="quantity{{$product['item']['id']}}" readonly>--}}
                                        {{--<a class="cart_quantity_down" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> - </a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td class="cart_total">--}}
                                    {{--<h4><input type="text" id="price" value="{{ $product->orders['total_amount'] }}" style="border: none;" readonly></h4>--}}
                                {{--</td>--}}
                                {{--<td class="cart_delete">--}}
                                    {{--<a class="cart_quantity_delete" href="{{ route('deleteSession.product',[$product['item']['id']])}}"><i class="fa fa-times"></i></a>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                               {{--@endif--}}
                         {{--@endforeach--}}
                        @endforeach

                    {{--@else--}}
                        {{--<tr><td><strong>No Items in Cart!!!</strong></td></tr>--}}
                    {{--@endif--}}
                    </tbody>
                </table>
                <div class="row"> {{ $products->links() }} </div>
            </div>
        </section>
@endsection


