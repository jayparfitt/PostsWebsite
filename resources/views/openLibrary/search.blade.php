<x-layout>
    <h1 class="text-2xl font-bold mb-4">Search Books</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('openLibrary.search') }}" class="mb-6">
        <input type="text" name="query" value="{{ $query }}" placeholder="Enter book title or author"
            class="w-full p-2 border border-gray-300 rounded-lg">
        <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
            Search
        </button>
    </form>

    <!-- Display Books -->
    @if (count($books) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($books as $book)
        <div class="p-4 border border-gray-300 rounded-lg">
            <!-- Make the title clickable -->
            <h2 class="text-lg font-semibold">
                <a href="https://openlibrary.org{{ $book['key'] }}" target="_blank" class="text-blue-500 hover:underline">
                    {{ $book['title'] }}
                </a>
            </h2>
            <p class="text-sm text-gray-600">
                {{ isset($book['author_name']) ? implode(', ', $book['author_name']) : 'Unknown Author' }}
            </p>
            <p class="text-sm text-gray-600">
                Published: {{ isset($book['publish_year']) ? implode(', ', $book['publish_year']) : 'N/A' }}
            </p>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-gray-600">No books found for "{{ $query }}"</p>
    @endif
</x-layout>