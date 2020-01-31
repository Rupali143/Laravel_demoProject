<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Category;
use Illuminate\Support\Facades\Redirect;

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
                $products = $products->where('name', $request->input('name'));
            }
            if (isset($request->status)) {
                $products = $products->where('status', $request->input('status'));
            }
            if (isset($request->category_id)) {
                $products = $products->where('category_id', $request->input('category_id'));
            }
        $products =$products->paginate(3);
//        dd($products);
//            return view('products.index', compact('products', 'category'));
//        }else{
//                $category = Category::all();
//                $products = Product::latest()->paginate(3);
                return view('products.index', compact('products', 'category','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
       $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($files = $request->file('images')) {
            $destinationPath = public_path('upload/images/');
            if(!is_dir('uploads/images')) {

                mkdir('uploads/images', 0755, true);
            }
            foreach ($files as $img) {
               $profileImage = $img->getClientOriginalName();
                $img->move($destinationPath, $profileImage);
                // Save In Database
                $product = new Product();
                $product->name = $request->input('name');
                $product->category_id = $request->input('category_id');
                $product->status = $request->input('status');
                $product->images ='upload/images/'.$profileImage;
                $product->save();
            }
//            dd($profileImage);
        }


        return redirect()->route('product.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $product = Product::find($id);
//                echo'<pre>';print_r($product);exit;
        return view('products.edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate =$request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'status'  => 'required'
        ]);

        Product::whereId($id)->update($validate);

        return redirect()->route('product.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();
        return redirect()->route('product.index')->with('success','Product deleted Successfully');
    }

//    public function destroy(Product $product)
//    {
//        $product->delete();
//        return redirect()->route('product.index')->with('success','Product deleted Successfully');
//    }
}
