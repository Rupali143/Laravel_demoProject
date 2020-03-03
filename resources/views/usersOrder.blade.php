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
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
                    <form class="kt-form" action="{{ route('users.order') }}" method="">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label></label>
                                        <input type="text" class="form-control" placeholder="Enter Customer name" name="userName" value="{{ $request->userName }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <select class="form-control" name="status" style="margin-top: 18px;">
                                            <option value="">Select</option>
                                            <option value="1" {{ '1' == $request->status ? 'selected="selected"' : ''}}>Success</option>
                                            <option value="0" {{ '0' == $request->status ? 'selected="selected"' : ''}}>Failure</option>
                                        </select>
                                    </div>
                                    <div class="kt-form__actions col-md-3" style="margin-top: 16px;">
                                        <input type="submit" class="btn btn-success" value="Filter">
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
                        <div class="row col-md-6">
                            <button class="btn btn-primary pull-right" id="exportBtn">Export into Excel</button>
                        </div>
                        <div id="cartTable">
                        <table class="table">
                            @php $i = 1; @endphp
                            <thead>
                            <tr>
                                <td>Sr.No.</td>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Total Amount</th>
                                <th> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products) > 0)
                            @foreach($products as $product)
                                @php $status = ($product->transaction_status == 1) ? 'Success' : 'Failure'; @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $product->order_timestampID }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->created_at->format("d-m-y") }}</td>
                                    <td>{{ $status }}</td>
                                    <td>{{ $product->total_amount }}</td>
                                    <td><a class="btn btn-primary" href="{{ route('users.orderDetails',$product->id) }}">View Details</a></td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td><strong>No Items in Order!!!</strong></td></tr>
                            @endif
                            </tbody>
                        </table>
                            </div>
                        <div class="row"> {{ $products->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
@endsection

@section('scripts')
    <script>
     $(document).ready(function(){
         $("#exportBtn").click(function (e) {
             window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('#cartTable').html()));
             e.preventDefault();
         });
     });
    </script>
@endsection