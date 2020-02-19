<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Product_image;
use App\Eloquent\Model\Category;
use App\Eloquent\Model\Favourite;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    public function index(Request $request)
    {

        if (isset($request->id)) {
            $products = Product::with('image')->where('subcategory_id',$request->id)->paginate(3);
            $category = Category::all();
//            dd($product);
            $favourites = Favourite::all();
            return view('frontEnd/index', compact('products', 'category','favourites'));
        }else {
            $products = Product::with('image')->paginate(3);
            $category = Category::all();
            $favourites = Favourite::all();
            return view('frontEnd/index', compact('products', 'category','favourites'));
        }
    }

   public function addfavourite($productId){

       $customerId = \Auth::user()->id;
       $status = Favourite::where('customer_id',$customerId)->where('product_id',$productId)->first();
       if(isset($status->customer_id) and isset($productId))
       {
           return redirect()->back()->with('error', 'This item is already in your wishlist!');
       }else {
           $favourite = new Favourite();
           $favourite->product_id = $productId;
           $favourite->customer_id = $customerId;
          // $favourite->productimg_id = $imgId;
           $favourite->save();
           return redirect()->back()->with('success', 'Added to Favourite list successfully.');
       }
   }

    public function displayWishlist(){
        $customerId = \Auth::user()->id;
        $favourites = Favourite::with('productImages')->where('customer_id',$customerId)->paginate(3);
//        dd($favourites->all());
        return view('frontEnd.myWishlist',compact('favourites'));
    }


    public function deleteWishlist($id){

        $customerId = \Auth::user()->id;
        $product = Favourite::where('product_id',$id)->where('customer_id',$customerId)->delete();
        return redirect()->back()->with('success','Product deleted Successfully');
    }

    public function productDetails($id){
        $productDetails = Product::with('image')->where('id',$id)->get();
//        dd($productDetails);
        return view('frontEnd.productDetails',compact('productDetails'));
    }
}
