<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Generic;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $title = "All Products";
        $products = Product::all();

        return view('admin.product.list', compact('title', 'products'));
    }


    public function create()
    {
        $title = "Add Product";
        return view('admin.product.create', compact('title'));
    }

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
            $image = Generic::upload_image($image);
            $validated['image'] = $image;
        }
        $validated['slug'] = Str::slug($validated['name'], '-');

        $product = Product::create($validated);

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
    }


    public function edit(Request $request)
    {
        $title = "Edit Product";

        $product = Product::findOrFail($request->id);

        return view('admin.product.edit', compact('title', 'product'));
    }


    public function update(Request $request)
    {

        $product = Product::findOrFail($request->id);

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image = Generic::upload_image($image);
            $validated['image'] = $image;
        }
        $validated['slug'] = Str::slug($validated['name'], '-');
        
        $product->update($validated);

        return redirect()->route('admin.product.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Request $request)
    {

        $product = Product::findOrFail($request->id);

        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', 'Product deleted successfully');
    }
}
