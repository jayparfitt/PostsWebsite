<x-layout>
    <h1 class="text-xl font-bold mb-4">Edit Comment</h1>

    <form method="POST" action="{{ route('comments.update', $comment) }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="body" class="block text-sm font-bold text-gray-700">Comment</label>
            <textarea id="body" name="body" rows="4" required
                class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">{{ old('body', $comment->body) }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
                Update Comment
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('comments.destroy', $comment) }}" onsubmit="return confirm('Are you sure you want to delete this comment?');" class="mt-4">
        @csrf
        @method('DELETE')

        <button type="submit"
            class="transition-colors duration-300 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full">
            Delete Comment
        </button>
    </form>
</x-layout>