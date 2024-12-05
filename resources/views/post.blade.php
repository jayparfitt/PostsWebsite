<x-layout>
    <!doctype html>
    <title>{{ $post->title }}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <body style="font-family: Open Sans, sans-serif;">
        <section class="px-6 py-8">
            <!-- Post content -->
            <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
                <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                    <div class="col-span-8">
                        <!-- Post Title -->
                        <h1 class="font-bold text-3xl lg:text-4xl mb-10 text-center">{{ $post->title }}</h1>

                        <!-- Post Image -->
                        @if ($post->image_path)
                        <div class="mb-10">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover rounded-md">
                            @else
                            <img src="/images/placeholder.jpg" alt="Placeholder image" class="w-full h-full object-cover">
                        </div>
                        @endif

                        <!-- Post Details -->
                        <p class="text-sm text-gray-600 mb-6">
                            Posted by: <span class="font-bold">{{ $post->user->name }}</span>
                        </p>

                        <!-- Post Body -->
                        <p class="leading-loose text-gray-800">{{ $post->body }}</p>

                        <!-- Post Views -->
                        <div class="mt-4">
                            <p class="text-gray-500 text-sm">
                                <a href="{{ route('posts.viewers', $post->id) }}" class="text-blue-500 hover:underline">
                                    Views: {{ $post->views->count() }}
                                </a>
                            </p>
                        </div>

                        <!-- Edit Post Button (if user is the author) -->
                        @if (Auth::id() === $post->user_id)
                        <div class="mt-6">
                            <a href="{{ route('posts.edit', $post) }}"
                                class="transition-colors duration-300 bg-yellow-500 hover:bg-yellow-600 rounded-full text-xs font-semibold text-white uppercase py-2 px-4">
                                Edit Post
                            </a>
                        </div>
                        @endif
                    </div>
                </article>
            </main>

            <!-- Include the comments section -->
            @include('comments.comments', ['post' => $post])
        </section>
    </body>
</x-layout>