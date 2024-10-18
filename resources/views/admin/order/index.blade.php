<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="">
                    <table class="w-full bg-white shadow-md rounded my-6">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-4">#</th>
                            <th class="text-left p-4">Status</th>
                            <th class="text-left p-4">Items</th>
                            <th class="text-left p-4">Total price</th>
                            <th class="text-left p-4">Order Date</th>
                            <th class="text-left p-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b">
                                <td class="p-4">{{ $order->id }}</td>
                                <td class="p-4">{{ ucfirst($order->status) }}</td>
                                <td class="p-4">{{ $order->items?->count() }}</td>
                                <td class="p-4">{{ $order->total }}</td>
                                <td class="p-4">{{ $order->created_at->format('d M, Y H:i a') }}</td>
                                <td class="p-4 flex">
                                    <a href="{{ route('admin.orders.edit', $order->id) }}">
                                        <x-primary-button>View</x-primary-button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
