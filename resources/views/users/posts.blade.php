<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl font-bold">Posts and Comments by {{ $user->name }}</h1>
    </header>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        {{-- Display Posts --}}
        @if ($posts->count())
            <section>
                <h2 class="text-2xl font-semibold mb-4">Posts</h2>
                @foreach ($posts as $post)
                    <x-latestPost :post="$post" />
                @endforeach

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </section>
        @else
            <p class="text-center text-gray-600">This user has not created any posts yet.</p>
        @endif

        {{-- Display Comments --}}
        <section>
            <h2 class="text-2xl font-semibold mt-12 mb-4">Comments</h2>
            @if ($comments->count())
                @foreach ($comments as $comment)
                    <article class="bg-gray-100 p-4 rounded-lg mb-4">
                        <h3 class="font-bold text-lg">
                            Comment on: 
                            <a href="{{ route('posts.show', $comment->post->id) }}" class="text-blue-500">
                                {{ $comment->post->title }}
                            </a>
                        </h3>
                        <p class="mt-2 text-gray-700">
                            {{ $comment->body }}
                        </p>
                        <span class="text-sm text-gray-500">Posted {{ $comment->created_at->diffForHumans() }}</span>
                    </article>
                @endforeach
            @else
                <p class="text-center text-gray-600">This user has not written any comments yet.</p>
            @endif
        </section>
    </main>
</x-layout>
