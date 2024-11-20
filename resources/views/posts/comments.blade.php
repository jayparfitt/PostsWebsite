<!-- resources/views/components/comments.blade.php -->
<section class="mt-10">
    <h2 class="text-2xl font-bold">Comments</h2>

    <!-- Display existing comments -->
    @if ($post->comments->count() > 0)
    @foreach ($post->comments as $comment)
    <div class="mt-4 border-b border-gray-300 pb-4">
        <p class="text-sm text-gray-600">{{ $comment->user->name ?? 'Anonymous' }} commented:</p>
        <p class="mt-2">{{ $comment->body }}</p>
    </div>
    @endforeach
    @else
    <p class="mt-4 text-gray-600">No comments yet. Be the first to comment!</p>
    @endif

    <!-- Add a comment form for logged-in users -->
    @auth
    <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-6">
        @csrf
        <textarea name="body" rows="3" required
            class="w-full mt-2 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
            placeholder="Write your comment...">{{ old('body') }}</textarea>
        <button type="submit"
            class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full">
            Submit Comment
        </button>
    </form>
    @else
    <p class="mt-6 text-gray-600">
        <a href="{{ route('login') }}" class="text-blue-500">Log in</a> or
        <a href="{{ route('register') }}" class="text-blue-500">register</a> to leave a comment.
    </p>
    @endauth
</section>