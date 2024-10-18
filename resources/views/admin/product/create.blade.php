<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create product') }}
            </h2>
            <a href="{{ route('admin.products.index') }}">
                <x-secondary-button>Cancel</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-4 grid-cols-2">
                @csrf

                <!-- Name -->
                <div class="col-span-2">
                    <x-input-label for="name" :value="__('Product Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                  required autofocus/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Category -->
                <div class="">
                    <x-input-label for="category_id" :value="__('Category')"/>
                    <select id="category_id" name="category_id"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                </div>

                <!-- Price -->
                <div class="">
                    <x-input-label for="price" :value="__('Base Price')"/>
                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')"
                                  required/>
                    <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                </div>

                <!-- Product Images -->
                <div class="">
                    <x-input-label for="images" :value="__('Product Images')" />
                    <input id="images" class="block mt-1 w-full" type="file" name="images[]" multiple />
                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 flex items-center justify-end">
                    <x-primary-button class="ml-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
