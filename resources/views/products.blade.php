<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="bg-white p-6 mb-6 rounded-md">
            <h1 class="text-3xl font-bold mb-4">Healthy Food Products</h1>

            <!-- Search and Filter Form -->
            <form action="{{ route('products') }}" method="GET" class="flex flex-wrap items-center mb-6">
                <div class="flex-1">
                    <!-- Search Bar -->
                    <x-input-label for="search" :value="__('Search')"/>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Search products..." class="mt-1 w-full border-gray-300 rounded-lg">
                </div>

                <div class="ml-4">
                    <!-- Category Filter -->
                    <x-input-label for="category_id" :value="__('Filter by Category')"/>
                    <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 rounded-lg">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="ml-4 mt-5">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="max-w-sm bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('product', $product->slug) }}" class="relative">
                        <span class="absolute top-5 left-1 rounded-md z-50 text-white bg-green-500 p-1">&#2547;{{ $product->price }}</span>
                        <img class="rounded-t-lg" src="{{ asset('storage/' . $product->images?->first()?->image) }}" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="{{ route('product', $product->slug) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>
                        </a>
                        <a href="{{ route('product', $product->slug) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Buy
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>

            @empty
                <p class="col-span-4 text-center text-gray-600">No products found.</p>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

    @push('scripts')
        <script>

        </script>
    @endpush
</x-app-layout>

