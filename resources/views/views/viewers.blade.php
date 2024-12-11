<!doctype html>
<html>

<head>
    <title>Viewers</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body style="font-family: Open Sans, sans-serif;">
    <section class="px-6 py-8">
        <h1 class="text-2xl font-bold mb-6">Viewers for "{{ $post->title }}"</h1>

        <!-- adding viewer name to views list -->
        <ul class="list-disc pl-6">
            @forelse ($viewers as $view)
            <li>
                @if ($view->user)
                {{ $view->user->name }}
                @else
                Guest
                @endif
            </li>
            @empty
            <p>No viewers yet.</p>
            @endforelse
        </ul>

        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline mt-4 block">
            Back to Post
        </a>
    </section>
</body>

</html>