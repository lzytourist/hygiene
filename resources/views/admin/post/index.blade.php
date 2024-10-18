<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Posts') }}
                </h2>
                <x-auth-session-status class="mt-2" :status="session('status')"/>
            </div>
            <a href="{{ route('admin.posts.create') }}">
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
                            <th class="text-left p-4">Title</th>
                            <th class="text-left p-4">Image</th>
                            <th class="text-left p-4">Created At</th>
                            <th class="text-left p-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr class="border-b">
                                <td class="p-4">{{ $post->title }}</td>
                                <td class="p-4">
                                    <img class="w-24" src="{{ asset('storage/' . $post->image) }}" alt="">
                                </td>
                                <td class="p-4">{{ $post->created_at->format('d M, Y') }}</td>
                                <td class="p-4 flex">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}">
                                        <x-secondary-button>Edit</x-secondary-button>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
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

                    {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
