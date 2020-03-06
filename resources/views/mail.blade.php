<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation Mail</title>
    <style>
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 8px;
            padding-bottom: 8px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        div.solid {border-style: solid;}
        .default{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="solid">
<p class="default"><b>Thank you for your purchase from  <b><u>E-Shopper</u></b>.</b></p>
<p>{{ $body }}</p>
<p>Placed On date:-- {{ $orderCreatedAt->format('d-m-y') }}</p>
<p>Shipping Address:-- {{ $orderAddress }}</p>
    </div>
<br>
    <div class="container">
        <table id="customers"  border="1">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        {{--@dd($product)--}}
                                            <tr>
                                                <td>
                                                    <h5><strong>{{ $product['item']['name'] }}</strong></h5>
                                                    {{--<a><img src="{{ $product['item']['image'][0]['images'] }}" height="50px;" width="50px;"></a>--}}
                                                    <img src="data:image/png;base64,{{ $product['item']['image'][0]['images'] }}"/>
                                                </td>
                                                <td>
                                                    <p type="text" value="">{{ $product['item']['price'] }}</p>
                                                </td>
                                                <td>
                                                    <div class="cart_quantity_button">
                                                        <p class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}">{{ $product['qty']  }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p type="text" id="price" style="border: none;" readonly>{{ $product['item']['price'] * $product['qty']}}</p>
                                                </td>
                                            </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Amount (2% Taxes included.)</b></td>
                                        <td><b>Rs.{{$totalWithTax}}</b></td>
                                    </tr>
                                    </tbody>
                                </table>
    </div>
</body>
</html>