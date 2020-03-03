<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Category;
use App\Eloquent\Model\Product_image;
use DB;
use App\Eloquent\Model\Sub_categories;
use Illuminate\Support\Facades\Redirect;
use App\Eloquent\Model\Order;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $category = Category::all();
            $products = new Product();

            if (isset($request->name)) {
                $products = $products->where('name','LIKE', '%'.$request->input('name').'%');
            }
            if (isset($request->status)) {
                $products = $products->where('status', $request->input('status'));
            }
            if (isset($request->category_id)) {
                $products = $products->where('category_id', $request->input('category_id'));
            }
        $products =$products->paginate(3);
                return view('products.index', compact('products', 'category','request'));
    }

    /** Show the form for creating a new product. */
    public function create()
    {
        $category = Category::all();
        return view('products.create',compact('category'));
    }

    /* Store a newly created product.  */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'subcategory_id' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->status = $request->input('status');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->save();

        $lastId = $product->id;

        if ($files = $request->file('file')) {
            $destinationPath = public_path('uploads/products/');
            if(!is_dir('uploads/products')) {
                mkdir('uploads/products', 0755, true);
            }
            $i = 1;
            foreach ($files as $img) {
                $extension = $img->getClientOriginalExtension();
                $image = $img->getClientOriginalName();
                $name = explode('.', $image)[0].'_'.$lastId.'_'. $i++ .'.'. $extension;
                $img->move($destinationPath, $name);
                $productImage = new Product_image();
                $productImage->product_id = $lastId;
                $productImage->images = $name;
                $productImage->save();
            }
        }

        return redirect()->route('product.index')
            ->with('success','Product created successfully.');
    }

    /** Display the specified product.*/
    public function show($id)
    {
        $product = Product::find($id);
//        $productimage = Product_image::where('product_id',$id)->get();
        return view('products.show',compact('product'));
    }

    /* Show the form for editing the specified product*/
    public function edit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
       $catId = $product->category_id;
        $subcategory = Sub_categories::where('category_id',$catId)->get();
        return view('products.edit',compact('product','category','subcategory'));
    }

    /** Update the specified product **/
    public function update(Request $request, $id)
    {

        $validate =$request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'status'  => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);
        Product::whereId($id)->update($validate);

        if ($files = $request->file('file')) {
            $destinationPath = public_path('uploads/products/');

            if(!is_dir('uploads/products')) {
                mkdir('uploads/products', 0755, true);
            }
            $i=0;
            foreach ($files as $img) {
                $extension =$img->getClientOriginalExtension();
                $image = $img->getClientOriginalName();

                $name =explode('.',$image)[0].'_'.$id.'_'. $i++ .'.'.$extension;
                $img->move($destinationPath, $name);
                $productImage = new Product_image();
                $productImage->product_id = $id;
                $productImage->images = $name;
                $productImage->save();
            }

        }
        return redirect()->route('product.index')
            ->with('success','Product updated successfully');
    }

    /* Remove the specified product.*/
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->route('product.index')->with('success','Product deleted Successfully');
    }


    public function deleteorder($id)
    {
        $image = Product_image::find($id)->delete();
        $data = [
            'success' => true,
            'message'=> 'Image deleted Successfully'
        ] ;
        return response()->json($data);
    }

    /*Change active inactive status for products*/
    public function changeStatus(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    /*Fetched subcategory*/
    public function fetchsubCategory($id){
        $subcategories = Sub_categories::where('category_id',$id)->pluck('name','id');
        return json_encode($subcategories);
    }


    /*Display users product listing who purchased products*/
    public function orderList(Request $request){
        $products = Order::with('cartProducts','cartProducts.product');
        if (isset($request->userName)) {
            $products =  $products->where('name','LIKE','%'. $request->userName.'%');
        }
        if (isset($request->status)) {
            $products = $products->where('transaction_status', $request->status);
        }
        $products =$products->paginate(3);
        return view('usersOrder',compact('products','request'));
    }


   /*order details by order id*/
    public function orderDetails($id){
        $products = Order::with('cartProducts','cartProducts.image')->where('id',$id)->paginate(2);
        return view('orderViewDetails',compact('products'));
    }
}
