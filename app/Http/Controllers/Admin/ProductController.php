<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show a list of products
    public function index()
    {
        $products = Product::all();
        return  view('products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|unique:products|min:2|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_detail' => 'required|string',
        ];

        // Validate the request data
        $request->validate($rules);

        // Store the product in the database
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->file('image')->store('product_images', 'product_images'), // 'product_images' disk configured in filesystem.php
            'product_detail' => $request->input('product_detail'),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
