<x-app-layout>


    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Create Category</h2>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Category Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 p-2 w-full border rounded-md">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create Category</button>
            </div>

        </form>
    </div>

</x-app-layout>
