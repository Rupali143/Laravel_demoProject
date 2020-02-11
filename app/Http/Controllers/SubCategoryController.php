<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Eloquent\Model\Category;

use App\Eloquent\Model\Sub_categories;



class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allSubcategories = Sub_categories::orderBy('id','ASC')->get();
//        $products =$allSubcategories->paginate(3);
        return view('subcategories.index',compact('allSubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('categoryOrderby','ASC')->get();
        return view('subcategories.create',compact('category'));
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
            'name' =>'required',
            'category_id' =>'required',
        ]);
        $subcategory = new Sub_categories();
        $subcategory->name = $request->input('name');
        $subcategory-> category_id = $request->input('category_id');
        $subcategory->save();
        return redirect()->route('subcategory.index')
            ->with('success','SubCategory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = Sub_categories::find($id);
        return view('subcategories.show',compact('subcategory'));
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
        $subcategory = Sub_categories::find($id);
        return view('subcategories.edit',compact('subcategory','category'));
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
        ]);

        Sub_categories::whereId($id)->update($validate);
        return redirect()->route('subcategory.index')->with('success','SubCategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Sub_categories::find($id)->delete();
        return redirect()->route('subcategory.index')->with('success','Subcategory deleted Successfully');
    }
}
