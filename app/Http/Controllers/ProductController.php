<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(){
    	return view('products.create');
    }


  /**
     * If you fill all the values then,
     * you will redirect to this page with the success message.
     * So, here One thing must be noticed.
     * GREEN: Product has been added
     */    

/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $product = $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        
        Product::create($product);

        return back()->with('success', 'Product has been added');;
    }


  /** Make an index page to list the Products
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->toArray();
        return view('products.index', compact('products'));
    }


  /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit',compact('product','id'));
    }


// ProductController.php

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->save();
        return redirect('products')->with('success','Product has been updated');
    }

// ProductController.php

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
}
