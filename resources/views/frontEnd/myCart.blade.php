@extends('frontEnd/layouts/master')


@section('main-content')
@if(Session::has('cart'))
    <section id="cart_items">
        <div class="row table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Product Image</td>
                    <td class="description">Product Name</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    {{--<td class="total">SubTotal</td>--}}
                    <td></td>
                    <td>Action</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)
                    {{--@dd($product['item']['id'])--}}
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="/uploads/products/{{ $product['item']['image'][0]['images'] }}" alt="" height="80px;" width="80px;"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['item']['name'] }}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p id="price{{$product['item']['id']}}" value="{{ $product['price'] }}">{{ $product['price'] }}</p>
                        </td>
                        <td class="cart_quantity">
                            {{--<div class="cart_quantity_button">--}}
                                {{--<a class="cart_quantity_up" href="{{ route('update.quantity',[$product['item']['id'],1])}}" onclick="updateQty($product['item']['id'],1);"> + </a>--}}
                                {{--<input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2">--}}
                                {{--<a class="cart_quantity_down" href="{{ route('update.quantity',[$product['item']['id'],-1])}}"> - </a>--}}
                            {{--</div>--}}
 <br>
                            <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2" id="quantity{{$product['item']['id']}}">
                            <a class="cart_quantity_down" href="JavaScript:void(0);"  data-id="{{ $product['item']['id'] }}"> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            {{--@php--}}
                            {{--$subTotal = 1 * $cartDetail->product_price;--}}
                            {{--@endphp--}}
                            {{--<p class="cart_total_price">{{ $subTotal }}</p>--}}
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{ route('deleteSession.product',[$product['item']['id']])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td id="totalPrice">{{ $totalPrice }}</td>
                    <td></td>
                </tr>
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
                            <li>Cart Sub Total <span>{{ $totalPrice }}</span></li>
                            <li>Eco Tax <span>2 %</span></li>
                            {{--<li>Shipping Cost <span>Free</span></li>--}}
                            @php
                            $totalWithTax = $totalPrice + $totalPrice * (0.02)
                            @endphp

                            <li>Total <span>{{ $totalWithTax }}</span></li>
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <div class="row">
        <h2>No Items in Cart!!!</h2>
    </div>

@endif
@endsection
<script src="{{ asset('js/multipleImg3.2.1.min.js' )}}"></script>
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
                    alert(response);
                    //var total = response.qty * response.item.price;
                  //  $('#price'+response.item.id).val(response.price);
                    $('#quantity'+response.id).val(response.qty);
                    //alert(total);

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
                        alert(response);
//                        var total = response.qty * response.price;
//                        alert(total);
                    }
                });


                });
    });


//        $('.cart_quantity_up').click(function () {
//            if ($(this).prev().val() < 3) {
//                $(this).prev().val(+$(this).prev().val() + 1);
//            }
//        });
//        $('.cart_quantity_down').click(function () {
//            if ($(this).next().val() > 1) {
//                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
//            }
//        });


//        calcula/te();
//        $(".cart_quantity_up").click(function(){
//            changeQuantity(+1);
//            calculate();
//        });
//        $(".cart_quantity_down").click(function(){
//            changeQuantity(-1);
////            calculate();
//        });

//        $(":input[name='quantity']").keyup(function(e){
//            if (e.keyCode == 38) changeQuantity(1);
//            if (e.keyCode == 40) changeQuantity(-1);
////            calculate();
//        });

//        $(".cart_quantity_up").on("click",function(){
//
//            var counter = $('.cart_quantity_input').val();
//            alert(counter);
//
//            $('.cart_quantity_up').each(function() {
//                var quantity = $(this).find('.cart_quantity_input').val();
//                alert(quantity);
////                var price = $(this).find(".po-price").val();
////                subtotal += quantity * price;
//            });




//        });
</script>


<script>
    function changeItemQuantity( id , num ) { alert(num);
        var qty_id = $("#quantity").val(); alert(qty_id);
        var currentVal = parseInt( $(qty_id).value );
        if ( currentVal != NaN )
        {
            $(qty_id).value = currentVal + num;
//            $("products-table-basket").val();
        }
    }
    </script>

