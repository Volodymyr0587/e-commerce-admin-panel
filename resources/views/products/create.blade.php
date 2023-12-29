<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4">Create Product</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 p-2 w-full border rounded-md">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" class="mt-1 p-2 w-full border rounded-md">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-600">Product Image</label>
                <input type="file" name="image" id="image" class="mt-1 p-2 w-full border rounded-md">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="product_detail" class="block text-sm font-medium text-gray-600">Product Detail</label>
                <textarea name="product_detail" id="product_detail" class="mt-1 p-2 w-full border rounded-md">{{ old('product_detail') }}</textarea>
                @error('product_detail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create Product</button>
            </div>
        </form>
    </div>
@endsection
