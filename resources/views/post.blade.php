<!doctype html>

<title>{{ $post->title }}</title> 

<link rel="stylesheet" href="/app.css">

<body>
<article>
    <h1>{{ $post->title }}</h1> 

    <p>
        {!! $post->body !!} 
    </p>
</article>

<a href="/">Go Back</a>
</body>
