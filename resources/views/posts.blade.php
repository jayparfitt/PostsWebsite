@extends('layout')

@section('content')
    @foreach ($posts as $post)
        <article>
            <a href="/posts/{{ $post->id }}">
                <h1>{{ $post->title }}</h1>
            </a>
            <p>Posted by: {{ $post->user->name }}</p>
            <div>
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach
@endsection
