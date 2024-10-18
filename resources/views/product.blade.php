<x-app-layout>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
        <link rel="stylesheet" type="text/css"
              href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.product-slider').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    slidesToShow: 1,
                    adaptiveHeight: true,
                });
            });
        </script>
    @endpush

    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="bg-white p-6 mb-6 rounded-md">
            <section class="p-4 bg-white dark:bg-gray-900 antialiased">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Product Image Slider -->
                    <div>
                        <div class="product-slider">
                            @foreach($product->images as $image)
                                <div class="slick-slide">
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image" class="w-full h-auto">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div>
                        <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>

                        <div class="mb-4">
                            <span class="text-xl font-bold">&#2547; {{ $product->price }}</span>
                        </div>

                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            @php($stock = $product->stocks->sum('quantity'))

                            @if($stock <= 0)
                                <p class="text-red-600">Out of stock</p>
                            @else
                                <div class="mb-4">
                                    <x-input-label for="quantity" :value="__('Quantity')"/>
                                    <x-text-input id="quantity" type="number" name="quantity" min="1" max="{{ $stock }}" class="w-24"
                                                  :value="old('quantity', 1)" required/>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </div>
                                <x-primary-button>Add to cart</x-primary-button>
                            @endif

                        </form>
                        <x-auth-session-status class="mt-2" :status="session('status')"/>

                    </div>
                </div>

                <p class="text-gray-700 mb-4">
                    {!! $product->description !!}
                </p>
            </section>
        </div>
    </div>
</x-app-layout>

