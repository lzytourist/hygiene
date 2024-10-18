<x-app-layout>
    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/8bvh4aegi23m14xywi9uyd603djy8hhz3uqild82x6p7uf9m/tinymce/7/tinymce.min.js"
                referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code avdlist',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        </script>
    @endpush

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update product') }}
            </h2>
            <a href="{{ route('admin.products.index') }}">
                <x-secondary-button>Cancel</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                  class="px-6 grid gap-4 grid-cols-2" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="col-span-2">
                    <x-input-label for="name" :value="__('Product Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                  :value="old('name', $product->name)" required/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <x-input-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="4"
                              class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                </div>

                <!-- Category -->
                <div class="">
                    <x-input-label for="category" :value="__('Category')"/>
                    <select id="category" name="category_id"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                </div>

                <!-- Price -->
                <div class="">
                    <x-input-label for="price" :value="__('Price')"/>
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                                  :value="old('price', $product->price)" required/>
                    <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                </div>

                <!-- Product Images -->
                <div class="">
                    <x-input-label for="images" :value="__('Product Images')"/>
                    <input id="images" class="block mt-1 w-full" type="file" name="images[]" multiple/>
                    <x-input-error :messages="$errors->get('images')" class="mt-2"/>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex items-center justify-end">
                    <x-primary-button class="ml-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="col-span-2">
                <x-input-label for="existing-images" :value="__('Existing Images')"/>
                <div class="grid grid-cols-6 gap-4">
                    @foreach ($product->images as $image)
                        <div class="relative border rounded-md">
                            <img src="{{ Storage::url($image->image) }}" alt="Product Image"
                                 class="h-fit w-full object-cover">
                            <form action="{{ route('admin.products.images.destroy', $image->id) }}" method="POST"
                                  class="absolute top-2 right-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
