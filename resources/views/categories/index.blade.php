{{-- <x-app-layout>
    <h1 class="dark:text-white">Categories</h1>
    <a href="{{ route('products.categories.create') }}">Create Category</a>

    <ul>
        @foreach ($categories as $category)
            <li class="dark:text-white">
                {{ $category->name }}
                <a href="{{ route('products.categories.edit', $category) }}">Edit</a>
                <form action="{{ route('products.categories.destroy', $category) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout> --}}


<x-app-layout>


    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Categories List</h2>

        {{-- @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif --}}
        <x-flash-message />

        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Add Category</a>
        {{-- <a href="{{ route('products.subcategories') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 inline-block">Add Subcategory</a> --}}

        @if($categories->count() > 0)
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $category->id }}</td>
                            <td class="py-2 px-4 border-b">
                                {{ $category->name }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('categories.show' , $category->id) }}"
                                    class="text-blue-500 mr-2">View</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-yellow-500 mr-2">Edit</a>
                                <form class="inline-block" action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('Are you sure?') }}');">
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
            <p class="text-gray-600">No actegories available.</p>
        @endif
    </div>

    </x-app-layout>
