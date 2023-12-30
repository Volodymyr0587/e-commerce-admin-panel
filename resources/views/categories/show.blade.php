<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Category Details</h2>

        <div class="mb-4 dark:text-white">
            <strong>Name:</strong> {{ $category->name }}
        </div>

        <div class="mb-4 dark:text-white">
            <strong>Subcategories:</strong>
            <ul>
                @foreach ($category->subcategories as $subcategory)
                <li>{{ $subcategory->name }}</li>
                @endforeach

            </ul>
        </div>

        <a href="{{ route('subcategories.create', $category->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Add Subcategory</a>
        <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Edit Category</a>
    </div>
</x-app-layout>
