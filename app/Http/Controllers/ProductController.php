<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetch all the products from database
        $products = Product::all()->toArray();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $product = $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        // Save the reqwuest
        Product::create($product);

        return back()->with('success', 'Product has been added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Fetch the product for editing
        $product = Product::find($id);
        return view('products.edit',compact('product','id'));
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
        //Fetch the product
        $product = Product::find($id);
        //Validate the request
        $this->validate(request(), [
          'name' => 'required',
          'price' => 'required|numeric'
        ]);
        //Update the product
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        //Save the updated product
        $product->save();
        return redirect('products')->with('success','Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Fetch the product 
        $product = Product::find($id);
        //Delete the product
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
}
