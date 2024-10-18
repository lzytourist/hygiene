<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="antialiased">
                <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                    <h2 class="text-xl bg-white p-6 rounded-md shadow-sm font-semibold text-gray-900 sm:text-2xl">Order #{{ $order->id }}</h2>

                    <div class="mt-6 sm:mt-8 lg:flex lg:gap-8">
                        <div class="bg-white p-6 rounded-md w-full divide-y divide-gray-200 overflow-hidden border border-gray-200 lg:max-w-xl xl:max-w-2xl">
                            @foreach($order->items as $item)
                            <div class="space-y-4 p-6">
                                <div class="flex items-center gap-6">
                                    <a href="{{ route('product', $item->product->slug) }}" class="h-14 w-14 shrink-0">
                                        <img class="h-full w-full" src="{{ asset('storage/' . $item->product->images()?->first()?->image) }}" alt="imac image" />
                                    </a>

                                    <a href="{{ route('product', $item->product->slug) }}" class="min-w-0 flex-1 font-medium text-gray-900 hover:underline dark:text-white">{{ $item->product->name }}</a>
                                </div>

                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Product ID:</span> {{ $item->product_id }}</p>

                                    <div class="flex items-center justify-end gap-4">
                                        <p class="text-base font-normal text-gray-900 dark:text-white">x{{ $item->quantity }}</p>

                                        <p class="text-xl font-bold leading-tight text-gray-900 dark:text-white">&#2547; {{ $item->price }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="space-y-4 bg-gray-50 p-6 dark:bg-gray-800">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">&#2547; {{ $order->total }}</dd>
                                    </dl>

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="font-normal text-gray-500 dark:text-gray-400">Delivery charge</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">&#2547; 99</dd>
                                    </dl>

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">&#2547; 0</dd>
                                    </dl>
                                </div>

                                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                                    <dd class="text-lg font-bold text-gray-900 dark:text-white">&#2547; {{ $order->total + 99 }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-md mt-6 grow sm:mt-8 lg:mt-0">
                            <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-900">Order history</h3>

                                <ol class="relative ms-3 border-s border-gray-200">
                                    <li class="mb-10 ms-6">
                                        <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                            <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                                            </svg>
                                        </span>
                                        <h4 class="mb-0.5 text-base font-semibold text-gray-900 dark:text-white">Estimated delivery in {{ \Carbon\Carbon::make($order->created_at)->addDays(15)->format('d M, Y') }}</h4>
                                        <p class="text-sm text-gray-600">{{ $order->status }}</p>
                                    </li>

                                    <li class="ms-6 text-primary-700 dark:text-primary-500">
                                        <span class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-800">
                                            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                        </span>
                                        <div>
                                            <h4 class="mb-0.5 font-semibold">{{ \Carbon\Carbon::make($order->created_at)->format('d M, Y h:i a') }}</h4>
                                            <a href="#" class="text-sm font-medium hover:underline">Order placed</a>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
