<x-app-layout>
    <div class="bg-blue-100 py-12 mb-10 text-center">
        <h1 class="text-4xl font-bold text-blue-900">Welcome to Hygiene Foods</h1>
        <p class="mt-4 text-xl text-gray-600">Healthy, nutritious, and hygienic food products for everyone.</p>
        <a href="{{ route('products') }}" class="mt-6 inline-block bg-blue-600 text-white py-3 px-8 rounded-lg shadow hover:bg-blue-700">Shop Now</a>
    </div>

    <div class="container mx-auto">
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Special Offers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($promotions as $title => $description)
                    <div class="p-6 bg-white shadow rounded-lg">
                        <h3 class="text-xl font-bold text-blue-700">{{ $title }}</h3>
                        <p class="mt-2 text-gray-600">{{ $description }}</p>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Featured Products -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Featured Products</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
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
                @endforeach
            </div>
        </div>

        <!-- Posts -->
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Latest Posts</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-md">
                        <img class="w-full rounded-t-md" src="{{ asset('storage/' . $post->image) }}" alt="">
                        <div class="m-4 flex flex-col">
                            <h1 class="text-2xl">{{ $post->title }}</h1>
                            <p>{{ $post->excerpt }}</p>
                            <a class="self-end" href="{{ route('blog.details', $post->slug) }}">
                                <x-primary-button>Read more</x-primary-button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
