<x-app-layout>
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Subcategories</h2>

    {{-- <a href="{{ route('subcategories.create') }}">Create Category</a> --}}

    <ul class="dark:text-white">
        @foreach ($categories as $category)
            <li>
                <span class="w-fit border-solid border-b-4 border-amber-400">Category:</span>
                <span class="text-xl text-green-700 font-bold px-2 rounded-lg bg-amber-400">{{ $category->name }}</span>
                <ul class="m-4">
                    @foreach ($category->subcategories->pluck('name') as $subCategoryName)
                    <li>{{ $subCategoryName }}</li>
                    @endforeach
                </ul>
            </li>
            {{-- <li>
                <a href="{{ route('subcategories.edit', $category) }}">Edit</a>
                <form action="{{ route('subcategories.destroy', $category) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li> --}}
        @endforeach
    </ul>
    </div>
</x-app-layout>
