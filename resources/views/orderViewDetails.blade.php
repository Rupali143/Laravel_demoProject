@extends('layouts.master')

@section('main-content')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Order Details </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Order Details
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
                                Total Amount
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
                        <div class="kt-widget5">
                            <div class="kt-widget5__item">
                                @foreach($products as $product)
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__section">
                                            <p class="kt-widget5__desc">
                                                <h5><strong>{{ $product->order_timestampID }}</strong></h5>
                                            </p>
                                            <div class="kt-widget5__info">
                                                <span>Customer Name:</span>
                                                <span class="kt-font-info">{{$product->name}}</span>
                                                <span>Purchased:</span>
                                                <span class="kt-font-info">{{$product->created_at->format('d-m-y')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-widget5__content">
                                        <div class="kt-widget5__stats">
                                            <span class="kt-widget5__number">{{ $product->total_amount }}</span>
                                            <span>(2% Taxes Included.)</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-invoice-1">
                    <div class="kt-invoice__body">
                        <div class="kt-invoice__container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        @foreach($product->cartProducts as $cartProduct)
                                            <tr>
                                                <td class="cart_product">
                                                    <a><img src="/uploads/products/{{$cartProduct->image[0]['images']}}" alt="" height="80px;" width="80px;"></a>
                                                </td>
                                                <td class="cart_price">
                                                    <p type="text" value="">{{ $cartProduct->price }}</p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        <p class="cart_quantity_input" type="text" name="quantity" value="{{ $cartProduct->quantity }}" autocomplete="off" size="2" id="quantity{{$product['item']['id']}}" readonly>{{ $cartProduct->quantity }}</p>
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p type="text" id="price" value="{{$cartProduct->price * $cartProduct->quantity }}" style="border: none;" readonly>{{$cartProduct->price * $cartProduct->quantity }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row"> {{ $products->links() }} </div>
@endsection