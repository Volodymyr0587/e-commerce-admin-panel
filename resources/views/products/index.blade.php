@extends('layouts.app')
@section('content')

<div class="container mx-auto mt-8">
    <h2 class="text-3xl font-semibold mb-4">Product List</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Add Product</a>

    @if($products->count() > 0)
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 mr-2">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-500 mr-2">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No products available.</p>
    @endif
</div>

@endsection
