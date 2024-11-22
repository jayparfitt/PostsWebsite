<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl font-bold">Posts by {{ $user->name }}</h1>
    </header>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
        @foreach ($posts as $post)
        <x-latestPost :post="$post" />
        @endforeach

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
        @else
        <p class="text-center text-gray-600">This user has not created any posts yet.</p>
        @endif
    </main>
</x-layout>