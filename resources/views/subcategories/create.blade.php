<x-app-layout>


    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Add Subategory for {{ $categories->pluck('name', 'id')[$categoryId] }}: </h2>

        <form action="{{ route('subcategories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-600">Category</label>
                <select name="category_id" class="mt-1 p-2 w-1/2 border rounded-md">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ ($categoryId && $category->id == $categoryId) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- <input type="hidden" name="category_id" value="{{ $category->id }}"> --}}

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Subcategory Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 p-2 w-full border rounded-md">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Subategory</button>
            </div>

        </form>
    </div>

</x-app-layout>
