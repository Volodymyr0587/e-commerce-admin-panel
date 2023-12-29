<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Product Details</h2>

        <div class="mb-4 dark:text-white">
            <strong>Name:</strong> {{ $product->name }}
        </div>

        <div class="mb-4 dark:text-white">
            <strong>Price:</strong> {{ $product->price }}
        </div>
        <strong class="mb-4 dark:text-white">Product Image:</strong>
        <div class="max-w-sm dark:text-white">

            @if($product->image)
                <img src="{{ asset('storage/product_images/' . $product->image) }}" alt="Product Image">
            @else
                <img src="{{ asset('default-images/no-image.png') }}" alt="Default Image">
            @endif
        </div>

        <div class="mb-4 dark:text-white">
            <strong>Product Detail:</strong> {{ $product->product_detail }}
        </div>

        <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Edit Product</a>
    </div>
</x-app-layout>
