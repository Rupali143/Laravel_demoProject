<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Cart;
use Session;
use Charge;
use Stripe;

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

    //removed product from sesion cart
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

    public function checkoutPost(Request $request){;
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else {
            $oldCart = Session::get('cart');
            $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
            $total = number_format($totalWithTax, 2);
            //dd($totalWithTax);
            $token = $request->input('stripeToken');

//            Stripe::setApiKey(env('STRIPE_SECRET'));
//            Charge::create ([
//                "amount" => $total,
//                "currency" => "INR",
//                "source" => $request->input('stripeToken'),
//                "description" => "Test payment from itsolutionstuff.com."
//            ]);

            //return redirect('/')->with('success','Successfuly Purchased');
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                "amount" => $totalWithTax,
                "currency" => "INR",
                "source" => $token,
                "description" => "Test payment"
            ]);
            return redirect('/')->with('success','Successfuly Purchased');
//            Stripe::setApiKey(env('STRIPE_SECRET'));
//            try{
//                Charge::create(array(
//                    "amount" => $total,
//                    "currency" => "INR",
//                    "source" => $request->input('stripeToken'),
//                    "description" => "Test Charge"
//                ));
//
//            }catch (\Exception $e){
//                return redirect()->route('get.checkout')->with('error',$e->getMessage());
//            }
//            Session::forgot('cart');
//            return redirect('/')->with('success','Successfuly Purchased');
        }
    }
}
