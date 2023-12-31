<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('subcategories.index', compact('subcategories', 'categories'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->route('category_id');

        return view('subcategories.create', compact('categories', 'categoryId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subcategories',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = new Subcategory([
            'name' => $request->input('name'),
        ]);

        $subcategory->category()->associate($request->input('category_id'));
        $subcategory->save();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|unique:subcategories,name,' . $subcategory->id,
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}
