<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\Generic;
use App\Models\Product;
use App\Models\ProductReview;
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

    public function add_review(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($product_id);

        $reviewData = [
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ];

        if (auth()->check()) {
            // User is logged in, associate the review with the user
            $reviewData['user_id'] = auth()->user()->id;
        } else {
            // User is a guest, store guest name and email
            $reviewData['guest_name'] = $request->name;
            $reviewData['guest_email'] = $request->email;
        }

        $review = ProductReview::create($reviewData);

        return redirect()->back()->with('success', 'Review added successfully.');
    }
}
