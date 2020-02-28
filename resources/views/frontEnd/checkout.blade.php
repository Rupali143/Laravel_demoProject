@extends('frontEnd/layouts/master')


@section('main-content')
    <style>
        .cart_info table tr td {
            margin: 20px;
        }
    </style>
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @if(count($products) > 0)
                @foreach($products as $product)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="/uploads/products/{{ $product['item']['image'][0]['images'] }}" alt="" height="80px;" width="80px;"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['item']['name'] }}</a></h4>
                        </td>
                        <td class="cart_price">
                            {{--id="price{{$product['item']['id']}}$product['price'] --}}
                            <input type="text" value="{{ $product['item']['price'] }}" style="border: none;" readonly>
                        </td>
                        <td class="cart_quantity">
                            <p align="center" class="message{{$product['item']['id']}}" id="message{{$product['item']['id']}}" style='color:red;'></p>
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2" id="quantity{{$product['item']['id']}}" readonly>
                                <a class="cart_quantity_down" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <h4><input type="text" id="price{{$product['item']['id']}}" value="{{ $product['price'] }}" style="border: none;" readonly></h4>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ route('deleteSession.product',[$product['item']['id']])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Cart Sub Total</td>
                                <td><input type="text" class="pull-right" id="totalprice1" value="{{ $totalPrice }}"  style="border: none;" readonly></td>
                            </tr>
                            <tr>
                                <td> Tax</td>
                                <td><input type="text" class="pull-right"  value="2%" style="border: none;" readonly></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                @php
                                    $totalWithTax = $totalPrice + $totalPrice * (0.02)
                                @endphp
                                <td><input type="text" id="totalWithTax" class="pull-right" value="{{ $totalWithTax }}" style="border: none;" readonly></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a  class="btn btn-primary" href="{{ route('place.order') }}" value="Place Order">Place Order</a></td>
                    <td></td>
                </tr>
                @else
                    <tr><td><strong>No Items in Cart!!!</strong></td></tr>
                @endif
                </tbody>
            </table>
        </div>

    </div>
</section>

@endsection
@section('scripts')
{{--<script>--}}

    {{--var stripe = Stripe('{{ env("STRIPE_KEY") }}');--}}

    {{--// Create an instance of Elements.--}}
    {{--var elements = stripe.elements();--}}

    {{--var style = {--}}
        {{--base: {--}}
            {{--color: '#32325d',--}}
            {{--lineHeight: '18px',--}}
            {{--fontFamily: '"Helvetica Neue", Helvetica, sans-serif',--}}
            {{--fontSmoothing: 'antialiased',--}}
            {{--fontSize: '16px',--}}
            {{--'::placeholder': {--}}
                {{--color: '#aab7c4'--}}
            {{--}--}}
        {{--},--}}
        {{--invalid: {--}}
            {{--color: '#fa755a',--}}
            {{--iconColor: '#fa755a'--}}
        {{--}--}}
    {{--};--}}

    {{--// Create an instance of the card Element.--}}
    {{--var card = elements.create('card', {style: style});--}}

    {{--// Add an instance of the card Element into the `card-element` <div>.--}}
    {{--card.mount('#card-element');--}}

    {{--// Handle real-time validation errors from the card Element.--}}
    {{--card.addEventListener('change', function(event) {--}}
        {{--var displayError = document.getElementById('card-errors');--}}
        {{--if (event.error) {--}}
            {{--displayError.textContent = event.error.message;--}}
        {{--} else {--}}
            {{--displayError.textContent = '';--}}
        {{--}--}}
    {{--});--}}

    {{--var form = document.getElementById('payment-form');--}}
    {{--form.addEventListener('submit', function(event) {--}}
        {{--event.preventDefault();--}}

        {{--stripe.createToken(card).then(function(result) {--}}
            {{--if (result.error) {--}}
                {{--// Inform the user if there was an error.--}}
                {{--var errorElement = document.getElementById('card-errors');--}}
                {{--errorElement.textContent = result.error.message;--}}
            {{--} else {--}}
                {{--// Send the token to your server.--}}
                {{--stripeTokenHandler(result.token);--}}
            {{--}--}}
        {{--});--}}
    {{--});--}}

    {{--// Submit the form with the token ID.--}}
    {{--function stripeTokenHandler(token) {--}}
        {{--// Insert the token ID into the form so it gets submitted to the server--}}
        {{--var form = document.getElementById('payment-form');--}}
        {{--var hiddenInput = document.createElement('input');--}}
        {{--hiddenInput.setAttribute('type', 'hidden');--}}
        {{--hiddenInput.setAttribute('name', 'stripeToken');--}}
        {{--hiddenInput.setAttribute('value', token.id);--}}
        {{--form.appendChild(hiddenInput);--}}

        {{--// Submit the form--}}
        {{--form.submit();--}}
    {{--}--}}
{{--</script>--}}
<script>
    $(document).ready(function () {
        $('.cart_quantity_up').click(function() {
            var id = $(this).data('id');
            var quantity = $('#quantity' + id).val();
            //var price = $('#price' + id).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("increase.quantity")}}',
                method: 'POST',
                data: {'id': id, 'quantity': quantity, "_token": "{{ csrf_token() }}"},
                dataType:'json',
                success: function (response) {
                    if(response.status == false){
                        $('.message'+response.id).fadeIn().html(response.message);
                        setTimeout(function() {
                            $('.message'+response.id).fadeOut("slow");
                        }, 2000 );
                        $('.cart_quantity_up'+response.id).attr("disabled","disabled");
                    }else {
                        $.each(response.products, function (i, item) {
                            $('#price' + i).val(item.price);
                            $('#quantity' + i).val(item.qty);
                        });
                        $('#totalPrice').val(parseFloat(response.totalPrice).toFixed(2));
                        $('#totalprice1').val(parseFloat(response.totalPrice).toFixed(2));
                        var totalPrice = response.totalPrice;
                        var totalWithTax = totalPrice+totalPrice* 0.02;
                        var num = parseFloat(totalWithTax).toFixed(2);
                        $('#totalWithTax').val(num);

                    }
                }
            });
        });

        $('.cart_quantity_down').click(function(){
            var id = $(this).data('id');
            var quantity = $('#quantity'+id).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("decrease.quantity") }}',
                method: 'POST',
                data: {'id': id, 'quantity': quantity, "_token": "{{ csrf_token() }}"},
                success:function(response){
                    if(response.status == false){
                        $('.message'+response.id).fadeIn().html(response.message);
                        setTimeout(function() {
                            $('.message'+response.id).fadeOut("slow");
                        }, 2000 );
                        $('.cart_quantity_down'+response.id).attr("disabled","disabled");
//                        $('.message'+response.id).text(response.message).delay(2000).fadeOut();
                    }else {
                        $.each(response.products, function (i, item) {
                            $('#price' + i).val(item.price);
                            $('#quantity' + i).val(item.qty);
                        });
                        $('#totalPrice').val(parseFloat(response.totalPrice).toFixed(2));
                        $('#totalprice1').val(parseFloat(response.totalPrice).toFixed(2));
                        var totalPrice = response.totalPrice;
                        var totalWithTax = totalPrice+totalPrice* 0.02;
                        var num = parseFloat(totalWithTax).toFixed(2);
                        $('#totalWithTax').val(num);
                    }
                }
            });

        });
    });
</script>
@endsection