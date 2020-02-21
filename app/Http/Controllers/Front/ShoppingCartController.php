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
//        $productDetails = Product::with('image')->where('id',$request->id)->first();
        $productDetails =Product::find($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($productDetails, $request->id);
        $request->session()->put('cart',$cart);
//        $totalItems = Session::get('cart')->totalQty; dd($totalItems);
//        dd($request->session()->get('cart'));
//        return redirect()->route('cart.display');
        return redirect()->back()->with('success', 'Added Product to Cart list successfully.');
    }

    public function displayProductsCart(){
        if(!Session::has('cart')){
            return view('frontEnd.myCart');
        }else{
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart); //dd($cart->item);
            return view('frontEnd.myCart',['products'=>$cart->item,'totalPrice'=>$cart->totalPrice]);
        }
    }

    public function removeProductFromCart($id){
        $cart = Session::get('cart');
        unset($cart->item[$id]);
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product Deleted Successfully from Session.');
    }

    public function updateQuantity($id,$val_id){
//       dd(Session::get('cart')->item);
        foreach(Session::get('cart')->item as $item){
            $selectedQuantity = $item['qty'] + $val_id;

            if($item['item']['id'] == $id){
                $item['qty'] = $selectedQuantity;
            }
//print_r($selectedQuantity);
//            dd($item);
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
//            dd($oldCart);
//            foreach($cart->item as $item){
//                $quantity = $item['item']['quantity'];
////                if($quantity > $items){
////                    echo'stock';
////                }else{
////                    echo'not in stock';
////                }
//                $item['qty']=$selectedQuantity;
//            }
//            $cart[$id]->item =$item['qty'];
//            dd($cart);

//            dd(Session::get('cart'));

            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product Quantity Successfully updated.');
        }

    }
}
