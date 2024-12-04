<div class="relative">
    <input
        type="text"
        wire:model.lazy="search"
        placeholder="Find something"
        class="bg-transparent placeholder-black font-semibold text-sm w-full" />

    @if ($posts->isNotEmpty())
    <div class="absolute mt-2 w-full bg-white rounded-lg shadow-lg">
        @foreach ($posts as $post)
        <a
            href="{{ route('posts.show', $post->id) }}"
            class="block px-4 py-2 hover:bg-gray-100">
            {{ $post->title }}
        </a>
        @endforeach
    </div>
    @elseif ($search)
    <p class="mt-2 text-gray-500">No results found for "{{ $search }}".</p>
    @endif
</div>