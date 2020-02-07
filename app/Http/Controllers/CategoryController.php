<?php

namespace App\Http\Controllers;

use App\Eloquent\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $category = Category::orderBy('id', 'ASC')->get();
        $category = Category::orderBy('categoryOrderby','ASC')->get();
        return view('categories.index',compact('category'));
    }
    

    public function showData()
    {
        $category = Category::orderBy('categoryOrderby','ASC')->get();
        return view('categories.index',compact('category'));
    }

    public function updateOrder(Request $request)
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            foreach ($request->order as $order) {
                if ($order['id'] == $category->id) {
                    $category->update(['categoryOrderby' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            //'status' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->input('name');
        $category->status = 1;
        $category->save();
//        Category::create($request->all());
        return redirect()->route('category.index')
            ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $category = Category::all();
        $category = Category::find($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->input('name'));
        $validate =$request->validate([
            'name' => 'required',
         ]);

        Category::whereId($id)->update($validate);
//        return redirect()->back()->with('success','Product is successfully updated');
        return redirect()->route('category.index')
            ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

//        dd($category);
        if($category){
            //$this->updateOrderId($category->categoryOrderby);
            //$category1 = Category::find($id)->delete();
        }
            return redirect()->route('category.index')->with('success','Category deleted Successfully');
//        }
//        return redirect()->route('category.index')->with('success','Category deleted Successfully');
    }

    public function updateOrderId($orderValue){

        $category = Category::all();
//        dd($orderValue);
        $orderCategory = $category->where('categoryOrderby','>=',$orderValue);

        foreach($orderCategory as $order){
            $updateId = $order->categoryOrderby - 1;
            Category::whereId($order->id)->update(['categoryOrderby' => $updateId]);
        }
    }

//    public function updateSort($id){
////        $input = $request->all();
//        echo $id;
//        echo'hello';exit;
//    }


    public function updateSort(Request $request)
    {
        $idToDelete = $request->deleteId;
        $category = Category::find($idToDelete)->delete();

        $displayOrder = $request->order;
        if (($key = array_search($idToDelete, $displayOrder)) !== false) {
            unset($displayOrder[$key]);
        }

        $displayOrder = array_values($displayOrder);
        foreach ($displayOrder as $order => $catId) {
            Category::whereId($catId)->update(['categoryOrderby' => $order]);
            $data = [
                'success' => true,
                'message'=> 'Category deleted Successfully'
            ] ;
            return response()->json($data);
//            return redirect()->route('category.index')->with('success', 'Category deleted Successfully');
//        return response('Update Successfully.', 200);
        }
    }

    public function changeStatusCat(Request $request)
    {
//        dd($request->all());
        $category = Category::find($request->id);
        $category->status = $request->status;
        $category->save();
//        Product::whereId($request->id)->update($product);
        return response()->json(['success'=>'Status change successfully.']);
    }
}
