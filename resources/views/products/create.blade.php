<x-app-layout>


    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-semibold mb-4 dark:text-white">Create Product</h2>

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
                <label for="category_id" class="block text-sm font-medium text-gray-600">Category</label>
                <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-md">
                    <option>--Category--</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="subcategory_id" class="block text-sm font-medium text-gray-600">Subcategory</label>
                <select name="subcategory_id" id="subcategory_id" class="getSubcategories mt-1 p-2 w-full border rounded-md">
                    <option>--SubCategory--</option>
                </select>
                @error('subcategory_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-600">Price</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" class="mt-1 p-2 w-full border rounded-md">
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

</x-app-layout>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){
            $(document).on('change','#category_id', function() {
                let category = $(this).val();
                $('#subcategory_id').show();
                $.ajax({
                    method: 'post',
                    url: "{{ route('getSubcategories') }}",
                    data: {
                        category_id: category
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.status == 'success') {
                            let all_options = "<option value=''>Select Sub Category</option>";
                            let all_subcategories = res.subCategories;
                            $.each(all_subcategories, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.name + "</option>";
                            });
                            $(".getSubcategories").html(all_options);
                        }
                    }
                })
            });
        });
    </script>
