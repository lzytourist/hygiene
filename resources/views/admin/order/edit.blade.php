@php($status_list = ['pending', 'cancelled', 'delivered', 'completed', 'refunded'])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
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
                            <h3 class="text-xl font-semibold text-gray-900">Update</h3>

                            <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <x-input-label for="status">Status</x-input-label>
                                    <select id="status" name="status"
                                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @foreach($status_list as $status)
                                            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-primary-button type="submit">Update</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
