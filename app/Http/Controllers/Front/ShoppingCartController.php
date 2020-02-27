<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Cart;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ShoppingCartController extends Controller
{

    public function index(Request $request, $id){
        $productDetails =Product::find($request->id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($productDetails, $request->id);
        //dd($cart);

        if($cart->item[$id]['item']['quantity'] >= $cart->item[$id]['qty'])
        {
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Added Product to Cart list successfully.');
        }
          else{
              return redirect()->back()->with('error', 'Sorry!!Insufficient quantity');
           }

    }

    public function displayProductsCart(){

            $oldCart = Session::get('cart');   //count($oldCart->item
            $cartItem = isset($oldCart->item) ? $oldCart->item : [];
        //dd($cartItem);
            $grandTotal = isset($oldCart->totalPrice) ? $oldCart->totalPrice : 0;
            return view('frontEnd.myCart',['products'=>$cartItem,'totalPrice'=> $grandTotal]);
    }

    public function removeProductFromCart($id){
        $cart = Session::get('cart');
        $cart->afterDelete($cart,$id);
        unset($cart->item[$id]);
        return redirect()->back()->with('success', 'Product Deleted Successfully from Session.');
    }


    public function increaseQuantity(Request $request){
            $qty = $request->quantity+1;
            $id = $request->id;
            $sessionData = Session::get('cart');
            //dd($sessionData->item[$id]['qty'] ,$sessionData->item[$id]['item']['quantity']);
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
            //dd($sessionData->totalPrice);
                Session::put('cart', $sessionData);
                return response()->json(['products' => $sessionData->item, 'totalPrice' => $sessionData->totalPrice]);
        }
    }

    public function getCheckout(){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else{
            $oldCart = Session::get('cart');
            $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
            $total = number_format($totalWithTax, 2);
           // dd($total);
            return view('frontEnd.checkout',['products'=>$oldCart->item,'total' => $total,'totalPrice'=>$oldCart->totalPrice]);
        }
    }

    public function checkoutPost(Request $request){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else {
            $oldCart = Session::get('cart');
            $totalWithTax = $oldCart->totalPrice + $oldCart->totalPrice* 0.02;
            $total = number_format($totalWithTax, 2);
            //dd($request->input('stripeToken'));
            Stripe::setApiKey(env('STRIPE_SECRET'));
            try{
                Charge::create(array(
                    "amount" => $total,
                    "currency" => "INR",
                    "source" => $request->input('stripeToken'),
                    "description" => "Test Charge"
                ));

            }catch (\Exception $e){
                return redirect()->route('get.checkout')->with('error',$e->getMessage());
            }
            Session::forgot('cart');
            return redirect('/')->with('success','Successfuly Purchased');
        }
    }
}
