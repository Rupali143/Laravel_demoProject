@extends('layouts.master')

@section('main-content')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    User Cart </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
    <div class="kt-portlet__body">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                <div class="alert-text"><strong>
                        {!! session()->get('success') !!} !!
                    </strong></div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        @endif
    <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-portlet">
                    <!--begin::Form-->
                    <form class="kt-form" action="{{ route('users.cart') }}" method="">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label></label>
                                        <input type="text" class="form-control" placeholder="Enter Customer name" name="userName" value="">
                                    </div>
                                    {{--<div class="form-group col-md-3">--}}
                                        {{--<label></label>--}}
                                        {{--<input type="text" class="form-control" placeholder="Enter Product name" name="productName" value="">--}}
                                    {{--</div>--}}
                                    <div class="kt-form__actions col-md-3" style="margin-top: 16px;">
                                        <input type="submit" class="btn btn-success" value="Filter">
                                        {{--<i class="fa fa-filter"></i>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th> Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            {{--@dd($products)--}}
                            @foreach($products as $product)
                                <tr>
                                    {{--<td> {{ $i }}</td>--}}
                                    <td>{{ $product->order_timestampID }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->total_amount }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('users.cartDetails',$product->id) }}">View Details</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection