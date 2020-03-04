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
                        <td>Sr.No.</td>
                        <th>Order Id</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Total Amount</th>
                        <th> Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($products) > 0)
                    @php $i = 1; @endphp
                        @foreach($products as $product)
                            {{--@foreach($images as $image)--}}
                             {{--@dd( $product)--}}
                            @php $status = ($product->transaction_status == 1) ? 'Success' : 'Failure'; @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $product->order_timestampID }}</td>
{{--                                <td>{{ $product->name }}</td>--}}
                                <td>{{ $product->created_at->format("d-m-y") }}</td>
                                <td>{{ $status }}</td>
                                <td>{{ $product->total_amount }}</td>
                                <td><a class="btn btn-primary" href="{{ route('my.orderDetails',$product->id) }}">View Details</a></td>
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


