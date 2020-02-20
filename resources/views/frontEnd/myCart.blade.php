@extends('frontEnd/layouts/master')
@section('main-section')
    @if(Session::has('cart'))
    <section id="cart_items">
            <div class="row table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Product Image</td>
                        <td class="description">Product Name</td>
                        <td class="price">Price</td>
                        {{--<td class="quantity">Quantity</td>--}}
                        <td class="total">SubTotal</td>
                        <td>Action</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $product)
                        {{--@dd($product['item']['image'][0]['images'])--}}
                    <tr>
                        {{--<td> {{ $no++ }}</td>--}}
                        <td class="cart_product">
                            <a href=""><img src="/uploads/products/{{ $product['item']['image'][0]['images'] }}" alt="" height="80px;" width="80px;"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['item']['name'] }}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{ $product['price'] }}</p>
                        </td>
                        {{--<td class="cart_quantity">--}}
                            {{--<div class="cart_quantity_button">--}}
                                {{--<a class="cart_quantity_up" href=""> + </a>--}}
                                {{--<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">--}}
                                {{--<a class="cart_quantity_down" href=""> - </a>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                        <td class="cart_total">
                            {{--@php--}}
                                {{--$subTotal = 1 * $cartDetail->product_price;--}}
                            {{--@endphp--}}
                            {{--<p class="cart_total_price">{{ $subTotal }}</p>--}}
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{ $totalPrice }}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        <div class="row">
            <button class="btn btn-primary pull-right">Checkout</button>
        </div>
    </section>
    @else
        <div class="row">
            <h2>No Items in Cart!!!</h2>
        </div>

    @endif
@endsection