@extends('frontEnd/layouts/master')


@section('main-content')
@if(Session::has('cart'))
    {{--@if(count($products) > 0)--}}
    <section id="cart_items">
        <div class="row table-responsive cart_info">
            <p align="center" class="message" style='margin-top:20px;color:red;'></p>
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
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete btn-danger" type="button" href="{{ route('deleteSession.product',[$product['item']['id']])}}" style="background: red;"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td><input type="text" id="totalPrice" value="{{ $totalPrice }}"  style="border: none;" readonly></td>
                    <td></td>
                </tr>
                @else
                        <tr><td><strong>No Items in Cart!!!</strong></td></tr>
                @endif

                </tbody>
            </table>

        </div>
    </section>
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <input type="text" class="pull-right" id="totalprice1" value="{{ $totalPrice }}"  style="border: none;" readonly></li>
                            <li>Eco Tax <span>2 %</span></li>
                            @php
                            $totalWithTax = $totalPrice + $totalPrice * (0.02)
                            @endphp
                            <li>Total <input type="text" id="totalWithTax" class="pull-right" value="{{ $totalWithTax }}" style="border: none;" readonly></li>
                        </ul>
                        <a class="btn btn-default check_out" href="{{ route('get.checkout') }}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
<script src="{{ asset('js/multipleImg3.2.1.min.js' )}}"></script>
<script>
    $(document).ready(function () {
        $('.cart_quantity_up').click(function() {
            var id = $(this).data('id');
            var quantity = $('#quantity' + id).val();
           // var price = $('#price' + id).val();
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
                        //$('.message'+response.id).text(response.message);
//                        $('.message'+response.id).text(response.message).fadeTo(1000,0);
                        $('.message'+response.id).fadeIn().html(response.message);
                        setTimeout(function() {
                            $('.message'+response.id).fadeOut("slow");
                        }, 2000 );
                        $('.cart_quantity_up'+response.id).attr("disabled","disabled");
                    }else {
                        $.each(response.products, function (i, item) {
                           // $('#price' + i).val(item.price);
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
//                             $('.message'+response.id).text(response.message).delay(2000).fadeOut();
                        }else {
                            $.each(response.products, function (i, item) {
                               // $('#price' + i).val(item.price);
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


