<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="px-6 mb-6 rounded-md">
            <section class="antialiased">
                <div class="bg-white p-6 rounded-md shadow-sm">
                    <p class="text-sm text-gray-600">{{ $post->created_at->format('d M, Y h:i a') }} by {{ $post->author->name }}</p>
                    <h1 class="text-4xl font-bold">{{ $post->title }}</h1>

                    <img class="block w-full py-8" src="{{ asset('storage/' . $post->image) }}" alt="">

                    <div>{!! $post->body !!}</div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>

