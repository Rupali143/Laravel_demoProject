<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Cart;
use Session;

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

    public function displayProductsCart(){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else{
            $oldCart = Session::get('cart');
            return view('frontEnd.myCart',['products'=>$oldCart->item,'totalPrice'=>$oldCart->totalPrice]);
        }
    }

    public function removeProductFromCart1($id){
        $cart = Session::get('cart');
        unset($cart->item[$id]);
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product Deleted Successfully from Session.');
    }


    public function removeProductFromCart2($id){
        $cart = Session::get('cart');
        unset($cart->item[$id]);
        Session::put('cart', $cart);
        $cart1 = Session::get('cart');
        dd($cart1);
        //$cart->afterDelete($cart);
        Session::put('cart', $cart1);
        return redirect()->back()->with('success', 'Product Deleted Successfully from Session.');
    }


    public function removeProductFromCart($id){
        $cart = Session::get('cart');
        $cart->afterDelete($cart,$id); //dd($cart);
        unset($cart->item[$id]);
        //Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product Deleted Successfully from Session.');
    }


    public function increaseQuantity(Request $request){
        if($request->id !=null || $request->id !='') {
            $qty = $request->quantity+1;
            $id = $request->id;
            $sessionData = Session::get('cart');

            if (array_key_exists($id, $sessionData->item)) {
                $storedItem = $sessionData->item[$id];
            }

            $storedItem['qty']++;
            if($storedItem['qty'] <= $storedItem['item']['quantity']){
                $storedItem['price'] = $storedItem['item']['price'] * $storedItem['qty'];
                $storedItem['totalQty'] = $storedItem['qty'] + 1;
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->updateAdd($storedItem, $id);
                $request->session()->put('cart',$cart);
                return response()->json(['products'=>$cart->item,'totalPrice'=>$cart->totalPrice]);
            }else{
                return response()->json(['id'=>$request->id,'status'=>false, 'message'=>"Sorry!! Out Of Stock"]);
            }

        }
    }


    public function decreaseQuantity(Request $request)
    {
        if($request->id !=null || $request->id !='') {
            $qty = $request->quantity-1;
            $id = $request->id;

            if($qty == 0){
                return response()->json(['id'=>$request->id,'status'=>false, 'message'=>"Sorry!! Can't decrease the quantity"]);
            }else {
                $sessionData = Session::get('cart');
                if (array_key_exists($id, $sessionData->item)) {
                    $storedItem = $sessionData->item[$id];
                }
                $storedItem['qty']--;
                $storedItem['price'] = $storedItem['item']['price'] * $storedItem['qty'];
                $storedItem['totalQty'] = $storedItem['qty'] - 1;
                $oldCart = Session::has('cart') ? Session::get('cart') : null;
                $cart = new Cart($oldCart);
                $cart->updateMinus($storedItem, $id);
                $request->session()->put('cart', $cart);
                return response()->json(['products' => $cart->item, 'totalPrice' => $cart->totalPrice]);
            }
        }
    }
}
