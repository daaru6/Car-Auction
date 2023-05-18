<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Generic;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $test = 'test';
        
        return view('products.index', compact('title','products'));
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
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Generic::upload_image($image);
            $validated['image'] = $image;
        }

        $product = Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $image_name);
            $validated['image'] = $image_name;
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}