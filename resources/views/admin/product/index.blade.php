<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Products') }}
                </h2>
                <x-auth-session-status class="mt-2" :status="session('status')"/>
            </div>
            <a href="{{ route('admin.products.create') }}">
                <x-primary-button>Add</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="w-full">
                <div class="px-6">
                    <table class="min-w-full bg-white shadow-md rounded my-6">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-4">Name</th>
                            <th class="text-left p-4">Category</th>
                            <th class="text-left p-4">Price</th>
                            <th class="text-left p-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr class="border-b">
                                <td class="p-4">{{ $product->name }}</td>
                                <td class="p-4">{{ $product->category->name }}</td>
                                <td class="p-4">{{ $product->price }}</td>
                                <td class="p-4 flex">
                                    <a href="{{ route('admin.products.edit', $product->id) }}">
                                        <x-secondary-button>Edit</x-secondary-button>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
