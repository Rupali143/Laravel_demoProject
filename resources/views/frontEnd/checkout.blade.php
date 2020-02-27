@extends('frontEnd/layouts/master')


@section('main-content')
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
                                <td>Exo Tax</td>
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
                        {{--<p>Bill To</p>--}}
                        <div class="form-one">
                            <form action="{{ route('post.checkout') }}" method="post" id="checkout-form">
                                @csrf()
                                <label class='control-label'>Name</label><input type="text" placeholder="Name" name="fullName" id="fullName" required value="{{Auth::user()->name}}">
                                <label class='control-label'>Address</label><input type="text" placeholder="Address" name="address" id="address" required>
                                <label class='control-label'>Card Holder Name</label><input type="text" placeholder="Card Holder Name" name="cardName" id="cardName" required>
                                <label class='control-label'>Card Number</label><input type="text" placeholder="Valid Card Number" name="cardNumber" id="cardNumber"  size="20" required>
                                <label class='control-label'>Expiration Month</label><input type="text" placeholder="MM" name="expiryMonth" id="expiryMonth" size="2" required>
                                <label class='control-label'>Expiration Year</label><input type="text" placeholder="YY" name="expiryYear" id="expiryYear" required>
                                <label class='control-label'>CVC</label><input type="text" placeholder="ex.123" name="cardCvc" id="cardCvc" size="4" required>
                                <button type="submit" class="button btn btn-primary check_out" value="">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section> <!--/#cart_items-->

@endsection
<script src="{{ asset('js/multipleImg3.2.1.min.js' )}}"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/checkout.js')}}"></script>
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
                        $('.message'+response.id).text(response.message).delay(2000).fadeOut();
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
                        $('.cart_quantity_down'+response.id).attr("disabled","disabled");
                        $('.message'+response.id).text(response.message).delay(2000).fadeOut();
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