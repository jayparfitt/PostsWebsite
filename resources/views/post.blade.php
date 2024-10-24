<!doctype html>

<title>{{ $post->title }}</title> 

<link rel="stylesheet" href="/app.css">

<body>
<article>
    <h1>{{ $post->title }}</h1> 

    <div>
        <p>{!! $post->body !!}</p>
</div>
</article>

<section>
    <h2>Comments</h2>

    @if ($post->comments->count() > 0)
        @foreach ($post->comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->name ?? 'Anonymous'}}:</strong></p>
                <p>{{ $comment-> body }}</p>
            </div>
        @endforeach
    @else
        <p>No comments</p>
    @endif
</section>

<a href="/">Go Back</a>
</body>
