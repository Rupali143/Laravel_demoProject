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
                @if(count($products) > 0)
                @foreach($products as $product)
                    @foreach($product->cartProducts as $cartProduct)
                        <tr>
                            <td class="cart_product">
                                <a><img src="/uploads/products/{{$cartProduct->image[0]['images']}}" alt="" height="80px;" width="80px;"></a>
                            </td>
                            <td class="cart_description">
                                <h4><a>{{ $product['product']['name'] }}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p type="text" value="{{ $cartProduct->price }}">{{ $cartProduct->price }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <p class="cart_quantity_input" type="text" name="quantity">{{ $cartProduct->quantity }}</p>
                                </div>
                            </td>
                            <td class="cart_total">
                                <h4><p type="text">{{$cartProduct->price * $cartProduct->quantity }}</p></h4>
                            </td>
                        </tr>
                    @endforeach
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Amount </td>
                        <td><h4>{{ $product->total_amount }}</h4> <br>(2% Taxes Included.)</td>
                        <td></td>
                     </tr>
                @endforeach
                @else
                <tr><td><strong>No Items in Cart!!!</strong></td></tr>
                @endif
                </tbody>
            </table>
            <div class="row"> {{ $products->links() }} </div>
        </div>
    </section>
@endsection


