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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->id)) {
            $product = Product::with('image')->where('subcategory_id',$request->id)->paginate(3);
            $category = Category::all();
//            dd($product);
            $favourites = Favourite::all();
            return view('frontEnd/index', compact('product', 'category','favourites'));
        }else {
            $product = Product::with('image')->paginate(3);

            $category = Category::all();
            $favourites = Favourite::all(); 
            return view('frontEnd/index', compact('product', 'category','favourites'));
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
        //dd($id);
        $product = Favourite::where('product_id',$id)->delete();
        return redirect()->back()->with('success','Product deleted Successfully');
    }
}
