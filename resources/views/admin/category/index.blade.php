<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Categories') }}
                </h2>
                <x-auth-session-status class="mt-2" :status="session('status')"/>
            </div>
            <a href="{{ route('admin.categories.create') }}">
                <x-primary-button>Add</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="w-full">
                <div class="px-6">
                    <table class="w-full bg-white shadow-md rounded my-6">
                        <thead>
                        <tr class="border-b">
                            <th class="text-left p-4">Name</th>
                            <th class="text-left p-4">Description</th>
                            <th class="text-left p-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b">
                                <td class="p-4">{{ $category->name }}</td>
                                <td class="p-4">{{ $category->description }}</td>
                                <td class="p-4 flex">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}">
                                        <x-secondary-button>Edit</x-secondary-button>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="bg-red-500 text-white px-4 py-2 rounded">Delete
                                        </x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
