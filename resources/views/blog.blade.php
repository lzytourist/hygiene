<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="px-6 mb-6 rounded-md">
            <section class="antialiased">
                <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
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
            </section>
        </div>
    </div>
</x-app-layout>

