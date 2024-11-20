<!doctype html>
<title>{{ $post->title }}</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<body style="font-family: Open Sans, sans-serif;">
    <section class="px-6 py-8">
        <!-- Post content -->
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-8">
                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">{{ $post->title }}</h1>
                    <p>{{ $post->body }}</p>

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
        @include('components.comments.comments', ['post' => $post])
    </section>
</body>