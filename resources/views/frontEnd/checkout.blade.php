@extends('frontEnd/layouts/master')


@section('main-content')
    <style>


        form {
            width: 480px;
            margin: 20px 0;
        }

        .group {
            background: white;
            box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10), 0 3px 6px 0 rgba(0, 0, 0, 0.08);
            border-radius: 4px;
            margin-bottom: 20px;
        }

        label {
            position: relative;
            color: #8898AA;
            font-weight: 300;
            height: 40px;
            line-height: 40px;
            margin-left: 20px;
            display: flex;
            flex-direction: row;
        }

        .group label:not(:last-child) {
            border-bottom: 1px solid #F0F5FA;
        }

        label > span {
            width: 120px;
            text-align: right;
            margin-right: 30px;
        }

        .field {
            background: transparent;
            font-weight: 300;
            border: 0;
            color: #31325F;
            outline: none;
            flex: 1;
            padding-right: 10px;
            padding-left: 10px;
            cursor: text;
        }

        .field::-webkit-input-placeholder {
            color: #CFD7E0;
        }

        .field::-moz-placeholder {
            color: #CFD7E0;
        }

        button {
            float: left;
            display: block;
            background: #666EE8;
            color: white;
            box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10), 0 3px 6px 0 rgba(0, 0, 0, 0.08);
            border-radius: 4px;
            border: 0;
            margin-top: 20px;
            font-size: 15px;
            font-weight: 400;
            width: 100%;
            height: 40px;
            line-height: 38px;
            outline: none;
        }

        button:focus {
            background: #555ABF;
        }

        button:active {
            background: #43458B;
        }

        .outcome {
            float: left;
            width: 100%;
            padding-top: 8px;
            min-height: 24px;
            text-align: center;
        }

        .success,
        .error {
            display: none;
            font-size: 13px;
        }

        .success.visible,
        .error.visible {
            display: inline;
        }

        .error {
            color: #E4584C;
        }

        .success {
            color: #666EE8;
        }

        .success .token {
            font-weight: 500;
            font-size: 13px;
        }

    </style>
    <script src="https://js.stripe.com/v3/"></script>
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Product Image</td>
                    <td class="description">Product Name</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td></td>
                    <td>Action</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="/uploads/products/{{ $product['item']['image'][0]['images'] }}" alt="" height="80px;" width="80px;"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['item']['name'] }}</a></h4>
                        </td>
                        <td class="cart_price">
                            <input type="text" id="price{{$product['item']['id']}}" value="{{ $product['price'] }}" style="border: none;" readonly>
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
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete btn-danger" type="button" href="{{ route('deleteSession.product',[$product['item']['id']])}}" style="background: red;"><i class="fa fa-times"></i></a>
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
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2%</td>
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
                </tbody>
            </table>
        </div>
        <div class="shopper-informations">
            <div class="row">
                <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''}}">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{ Session::get('error') }}</div>
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <div class="form-one">
                            {{--<form action="{{ route('post.checkout') }}" method="post" id="payment-form" data-cc-on-file="false" data-stripe-publishable-key="pk_test_umCCVM2is5bywwiN4BRvPTGe00HC3kP7ia" class="require-validation">--}}
                                {{--<form role="form" action="{{ route('post.checkout') }}" method="post" class="require-validation"--}}
                                      {{--data-cc-on-file="false"--}}
                                      {{--data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"--}}
                                      {{--id="payment-form1">--}}
                                {{--@csrf()--}}
                                {{--<label class='control-label'>Name</label><input type="text" placeholder="Name" name="fullName" id="fullName" required value="{{Auth::user()->name}}">--}}
                                {{--<label class='control-label'>Address</label><input type="text" placeholder="Address" name="address" id="address" required>--}}
                                {{--<label class='control-label'>Card Holder Name</label><input type="text" placeholder="Card Holder Name" name="cardName" id="cardName" required>--}}
                                {{--<label class='control-label'>Card Number</label><input type="text" placeholder="Valid Card Number" name="cardNumber" id="cardNumber"  size="20" required>--}}
                                {{--<label class='control-label'>Expiration Month</label><input type="text" placeholder="MM" name="expiryMonth" id="expiryMonth" size="2" required>--}}
                                {{--<label class='control-label'>Expiration Year</label><input type="text" placeholder="YY" name="expiryYear" id="expiryYear" required>--}}
                                {{--<label class='control-label'>CVC</label><input type="text" placeholder="ex.123" name="cardCvc" id="cardCvc" size="4" required>--}}
                                {{--<button type="submit" class="button btn btn-primary check_out" value="">Place Order</button>--}}
                            {{--</form>--}}

                            {{--<form action="{{ route('post.checkout') }}" method="post" id="payment-form">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input type="hidden" name="token" />--}}
                                {{--<div class="group">--}}
                                    {{--<label>--}}
                                        {{--<span>Card number</span>--}}
                                        {{--<div id="card-number-element"  name="cardNumber" class="field" ></div>--}}
                                    {{--</label>--}}
                                    {{--<label>--}}
                                        {{--<span>Expiry date</span>--}}
                                        {{--<div id="card-expiry-element"  name="expiryMonth" class="field"></div>--}}
                                    {{--</label>--}}
                                    {{--<label>--}}
                                        {{--<span>CVC</span>--}}
                                        {{--<div id="card-cvc-element" name="cardCvc"  class="field"></div>--}}
                                    {{--</label>--}}
                                    {{--<label>--}}
                                        {{--<span>Postal code</span>--}}
                                        {{--<input id="postal-code" name="postal_code" class="field" placeholder="90210" />--}}
                                    {{--</label>--}}
                                    {{--<input type="hidden"  value="{{ $totalWithTax }}">--}}
                                {{--</div>--}}
                                {{--<input type="submit" value="Pay">--}}
                                {{--<div class="outcome">--}}
                                    {{--<div class="error"></div>--}}
                                    {{--<div class="success">--}}
                                        {{--Success! Your Stripe token is <span class="token"></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                            <div class="card">
                                <form action="{{ route('post1.checkout') }}" method="post" id="payment-form">
                                    @csrf
                                    <div class="form-group">
                                        <div class="card-header">
                                            <label for="card-element">
                                                Enter your credit card information
                                            </label>
                                        </div>
                                        <div class="card-body">
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                            {{--<input type="hidden" name="plan" value="{{ $plan->id }}" />--}}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-dark" type="submit">Pay</button>
                                    </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section> <!--/#cart_items-->

@endsection
@section('scripts')
<script>

    var stripe = Stripe('{{ env("STRIPE_KEY") }}');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
//    var stripe = Stripe('pk_test_umCCVM2is5bywwiN4BRvPTGe00HC3kP7ia');
//    var elements = stripe.elements();
//    var style = {
//        base: {
//            iconColor: '#666EE8',
//            color: '#31325F',
//            lineHeight: '40px',
//            fontWeight: 300,
//            fontFamily: 'Helvetica Neue',
//            fontSize: '15px',
//            '::placeholder': {
//                color: '#CFD7E0',
//            },
//        },
//    };
//
//    var cardNumberElement = elements.create('cardNumber', {
//        style: style
//    });
//    cardNumberElement.mount('#card-number-element');
//
//    var cardExpiryElement = elements.create('cardExpiry', {
//        style: style
//    });
//    cardExpiryElement.mount('#card-expiry-element');
//
//    var cardCvcElement = elements.create('cardCvc', {
//        style: style
//    });
//    cardCvcElement.mount('#card-cvc-element');
//
//    function setOutcome(result) {
//        var successElement = document.querySelector('.success');
//        var errorElement = document.querySelector('.error');
//        successElement.classList.remove('visible');
//        errorElement.classList.remove('visible');
//
//        if (result.token) {
//            successElement.querySelector('.token').textContent = result.token.id;
//            successElement.classList.add('visible');
//        } else if (result.error) {
//            errorElement.textContent = result.error.message;
//            errorElement.classList.add('visible');
//        }
//    }
//
//    cardNumberElement.on('change', function(event) {
//        setOutcome(event);
//    });
//
//    cardExpiryElement.on('change', function(event) {
//        setOutcome(event);
//    });
//
//    cardCvcElement.on('change', function(event) {
//        setOutcome(event);
//    });
//
//    document.querySelector('form').addEventListener('submit', function(e) {
//        e.preventDefault();
//        var options = {
//            address_zip: document.getElementById('postal-code').value,
//        };
//        stripe.createToken(cardNumberElement, options).then(setOutcome);
//    });
//
//    var form = document.getElementById('payment-form');
//    form.addEventListener('submit', function(event) {
//        event.preventDefault();
//
//        stripe.createToken(card).then(function(result) {
//            if (result.error) {
//                // Inform the user if there was an error.
//                var errorElement = document.getElementById('card-errors');
//                errorElement.textContent = result.error.message;
//            } else {
//                // Send the token to your server.
//                stripeTokenHandler(result.token);
//            }
//        });
//    });


</script>
<script>
    $(document).ready(function () {
        $('.cart_quantity_up').click(function() {
            var id = $(this).data('id');
            var quantity = $('#quantity' + id).val();
            var price = $('#price' + id).val();
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