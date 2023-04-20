<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Http\Controllers\Controller;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        return view('products.products',compact('sections','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation_data= $request->validate([
            'Product_name'=>'required',
            'section_id'=>'required',
            'description'=>'required',
        ], [
            'Product_name.required' => 'يرجى ادخال اسم المنتج',
            'section_id.unique' => 'يرجى اختيار القسم',
            'description.required' => 'يرجى ادخال وصف المنتج',
        ]);


        products::create($request->all());
        session()->flash('added','تم اضافة المنتج بنجاح');
        return redirect('products');
//        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products)
    {

        $Products = Products::findOrFail($request->data_id);

        $Products->update([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);

        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        Products::findOrFail($request->data_id)->delete();
        session()->flash('delete','تم الحذف بنجاح');
        return back();

    }
}
