<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Cart;
use App\Eloquent\Model\Cart_product;
use App\Eloquent\Model\Order;
use Session;
use Charge;
use Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ShoppingCartController extends Controller
{

    public function index(Request $request, $id){
        $productDetails =Product::find($request->id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($productDetails, $request->id);
        if($cart->item[$id]['item']['quantity'] >= $cart->item[$id]['qty'])
        {
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Added Product to Cart list successfully.');
        }
          else{
              return redirect()->back()->with('error', 'Sorry!!Insufficient quantity');
           }

    }

    // for display product cart view
    public function displayProductsCart(){

            $oldCart = Session::get('cart');
            $cartItem = isset($oldCart->item) ? $oldCart->item : [];
            $grandTotal = isset($oldCart->totalPrice) ? $oldCart->totalPrice : 0;
            return view('frontEnd.myCart',['products'=>$cartItem,'totalPrice'=> $grandTotal]);
    }

    //removed product from session cart
    public function removeProductFromCart($id){
        $cart = Session::get('cart');
        $storedItem = $cart->item[$id];
        if($cart->item[$id] != $id){
            $cart->totalPrice = $cart->totalPrice - $storedItem['price'];
            $cart->totalQty = $cart->totalQty - $storedItem['qty'];
            unset($cart->item[$id]);
            Session::put('cart', $cart);
        }else{
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product Deleted Successfully from Session.');
    }

//Increased quantity
    public function increaseQuantity(Request $request){
            $qty = $request->quantity+1;
            $id = $request->id;
            $sessionData = Session::get('cart');
            if($sessionData->item[$id]['qty'] < $sessionData->item[$id]['item']['quantity']){
            $sessionData->item[$id]['qty']++;
            $sessionData->item[$id]['price'] = $sessionData->item[$id]['item']['price'] * $sessionData->item[$id]['qty'];
            $sessionData->totalPrice =  $sessionData->item[$id]['item']['price'] + $sessionData->totalPrice;
            Session::put('cart', $sessionData);
            return response()->json(['products'=>$sessionData->item,'totalPrice'=>$sessionData->totalPrice]);
            }else{
                return response()->json(['id'=>$request->id,'status'=>false, 'message'=>"Sorry!! Out Of Stock"]);
            }
    }

//Decreased quantity
    public function decreaseQuantity(Request $request)
    {
        $qty = $request->quantity-1;
        $id = $request->id;
        $sessionData = Session::get('cart');

        if($sessionData->item[$id]['qty'] == 1){
           return response()->json(['id'=>$request->id,'status'=>false, 'message'=>"Sorry!! Can't decrease the quantity"]);
        }else{
                $sessionData->item[$id]['qty']--;
                $sessionData->item[$id]['price'] = $sessionData->item[$id]['item']['price'] * $sessionData->item[$id]['qty'];
                $sessionData->totalPrice = $sessionData->totalPrice - $sessionData->item[$id]['item']['price'];
                Session::put('cart', $sessionData);
                return response()->json(['products' => $sessionData->item, 'totalPrice' => $sessionData->totalPrice]);
        }
    }

    //checkout page view
    public function getCheckout(){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else{
            $oldCart = Session::get('cart');
            $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
            $total = number_format($totalWithTax, 2);
            return view('frontEnd.checkout',['products'=>$oldCart->item,'total' => $total,'totalPrice'=>$oldCart->totalPrice]);
        }
    }
    //Place oder page view
    public function placeOrder(){
        $oldCart = Session::get('cart');
        $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
        $total = number_format($totalWithTax, 2);
//        dd($total);
        return view('frontEnd.placeOrder',['total' => $total]);
    }

    // After place order go to the payment page then save to the database table
    public function checkoutPost(Request $request){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else {
            $oldCart = Session::get('cart');
            $userId = \Auth::user()->id;
            $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
//            $total = number_format($totalWithTax, 2);
//            $totalWithTax =  $request->input('total_amount');
//            $total = number_format($totalWithTax, 2);
//            dd($totalWithTax);
            $dyanamicId = "order".'_'.$userId;
            $timestampId = $dyanamicId.'_'.time();
//            dd($request->all());
            $token = $request->input('stripeToken');
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            try{
                $charge = Stripe\Charge::create ([
                    "amount" => $totalWithTax * 100,
                    "currency" => "INR",
                    "source" => $token,
                    "description" => "Test payment"
                ]);
                $order = new Order();
                $order->user_id = $userId;
                $order->name = $request->input('fullName');
                $order->address = $request->input('address');
                $order->payment_id = $charge->id;
                $order->transaction_status = 1;
                $order->order_timestampID = $timestampId;
                $order->total_amount = $totalWithTax;
                $order->save();
                $orderTimestampID= $order->order_timestampID;
                $orderCreatedAt = $order->created_at;
                $orderAddress = $order->address;
                 //dd($orderTimestampID);
                $orderId = $order->id;
                foreach ($oldCart->item as $products){
                    $cartProduct = new Cart_product();
                    $cartProduct->product_id = $products['item']['id'];
                    $cartProduct->quantity = $products['qty'];
                    $cartProduct->price = $products['item']['price'];
                    $cartProduct->order_id = $orderId;
                    $cartProduct->save();
                }

            }catch (\Exception $e){
                return redirect()->route('my.order')->with('error',$e->getMessage());
            }
            session()->forget('cart');
            $userEmail = \Auth::user()->email;
            $this->send($userEmail,$orderTimestampID,$oldCart,$orderCreatedAt,$orderAddress);
            return redirect()->route('my.order')->with('success', 'Product Successfully Purchased. Your order id is:-  '.$orderTimestampID);
        }
    }

    /*order listing */
    public function myOrderProduct(){
        $userId = \Auth::user()->id;
        $products = Order::with('cartProducts','cartProducts.image')->where('user_id',$userId)->paginate(3);
//        dd($products);
        return view('frontEnd.myOrderProducts',compact('products'));
    }

    /*order details by order id*/
    public function myOrderDetails($id){
//        dd($id);
        $userId = \Auth::user()->id;
        $products = Order::with('cartProducts','cartProducts.image')->where('id',$id)->paginate(3);
        return view('frontEnd.myOrderDetails',compact('products'));
    }


    public function send($email,$orderTimestampID,$oldCart,$orderCreatedAt,$orderAddress)
    {
        $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
        $to_email = $email;
        $data = array("email" => $email,"orderCreatedAt"=>$orderCreatedAt,"totalWithTax"=>$totalWithTax ,"products" => $oldCart->item,"body" =>"Your order:-  ".$orderTimestampID,"orderAddress" =>$orderAddress);
        Mail::send('mail',$data,function ($message) use ($to_email){
            $message->to($to_email)->subject('Order Confirmation');
        });
    }

    public function test(Request $request){
//        dd($request->all());
        $totalWithTax =  $request->input('total_amount');
        $token = $request->input('stripeToken');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $charge = Stripe\Charge::create ([
                "amount" => $totalWithTax * 100,
                "currency" => "INR",
                "source" => $token,
                "description" => "Test payment"
            ]);
            return redirect()->back()->with('success-message', 'Payment done successfully !' );
        } catch ( \Exception $e ) {
            return redirect()->back()->with('fail-message', "Error! Please Try again." );
//            return redirect()->back ();
        }
    }

}
