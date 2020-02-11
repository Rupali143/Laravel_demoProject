<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Category;
use App\Eloquent\Model\Product_image;
use DB;
use App\Eloquent\Model\Sub_categories;
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
                $products = $products->where('name','LIKE', '%'.$request->input('name').'%');
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
            'subcategory_id' => 'required',
//            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->status = $request->input('status');
        $product->save();

        $lastId = $product->id;

        if ($files = $request->file('file')) {
            $destinationPath = public_path('uploads/products/');
            if(!is_dir('uploads/products')) {
                mkdir('uploads/products', 0755, true);
            }
//            echo'<pre>';print_r($files);exit;
            $i = 1;
            foreach ($files as $img) {
                $extension = $img->getClientOriginalExtension();
                $image = $img->getClientOriginalName();
                $name = explode('.', $image)[0].'_'.$lastId.'_'. $i++ .'.'. $extension;
//                echo'<pre>';print_r($image);exit;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
//        $productimage = Product_image::where('product_id',$id)->get();
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
       $catId = $product->category_id;
        $subcategory = Sub_categories::where('category_id',$catId)->get();
//        $productimage = Product_image::where('product_id',$id)->get();
        return view('products.edit',compact('product','category','subcategory'));
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
            'subcategory_id' => 'required',
            'status'  => 'required',
        ]);
//        $validate1 =$request->validate([
//            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
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


    public function deleteorder($id)
    {
        $image = Product_image::find($id)->delete();
//        dd($image);
        $data = [
            'success' => true,
            'message'=> 'Image deleted Successfully'
        ] ;
        return response()->json($data);
    }

    public function changeStatus(Request $request)
    {
//        dd($request->all());
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
//        Product::whereId($request->id)->update($product);
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function fetchsubCategory($id){
        $subcategories = Sub_categories::where('category_id',$id)->pluck('name','id');
//        dd($subcategories);
        return json_encode($subcategories);

//        $subcategories = DB::table("sub_categories")->where("category_id",$id)->lists("name","id");
//
//        Project::where('project_active', 1)->lists('id','project_name');
//        dd($subcategories);
//        return json_encode($subcategories);
    }
}
