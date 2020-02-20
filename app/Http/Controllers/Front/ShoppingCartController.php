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
        $productDetails = Product::with('image')->where('id',$request->id)->first();
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($productDetails);
        $cart->add($productDetails, $productDetails->id);
        $request->session()->put('cart',$cart);
//        dd($request->session()->get('cart'));
        return redirect()->route('cart.display');
    }

    public function displayProductsCart(){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else{
            $oldCart = Session::get('cart');
//            dd($oldCart);
            $cart = new Cart($oldCart);
//            dd($cart);
            return view('frontEnd.myCart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
        }
    }
//    public function index(Request $request){
//        $productDetails = Product::with('image')->where('id',$request->id)->first();
////        dd($productDetails->image[0]);
//        $cart = new Cart();
//        $cart->product_id = $productDetails->id;
//        $cart->product_name = $productDetails->name;
//        $cart->product_price = $productDetails->price;
//        $cart->save();
//        return redirect()->route('cart.display');
//    }
//
//    public function displayProductsCart(){
//        $cartDetails = Cart::all();
//        return view('frontEnd.myCart',compact('cartDetails'));
//    }
}
