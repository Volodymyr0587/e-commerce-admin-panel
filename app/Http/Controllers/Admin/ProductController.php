<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|unique:products|min:2|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_detail' => 'required|string',
        ];

        // Validate the request data
        $request->validate($rules);

        // Store the product in the database
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'product_detail' => $request->input('product_detail'),
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
        ]);

        if ($request->hasFile('image')) {
            $product->update([
                'image' => $request->file('image')->store('product_images', 'product_images'), // 'product_images' disk configured in filesystem.php

            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_detail' => 'required|string',
        ]);

        // Update product details
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'product_detail' => $request->input('product_detail'),
        ]);

        // Update product image if provided
        if ($request->hasFile('image')) {
            $product->update([
                'image' => $request->file('image')->store('product_images', 'product_images'),
            ]);
        }

        return redirect()->route('products.index', $product->id)->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
