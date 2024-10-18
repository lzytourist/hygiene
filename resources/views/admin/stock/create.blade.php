<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create category') }}
            </h2>
            <a href="{{ route('admin.categories.index') }}">
                <x-secondary-button>Cancel</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="px-6">
                <form action="{{ route('admin.stocks.store') }}" method="POST" class="grid gap-4 grid-cols-2" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="">
                        <x-input-label for="product" :value="__('Product')" />
                        <select id="product" name="product_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="">
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" min="0" required />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="col-span-2 flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
