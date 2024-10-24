@extends('layout')

@section('content')
    @foreach ($posts as $post)
        <article>
            <a href="/posts/{{ $post->id }}">
                <h1>{{ $post->title }}</h1>
            </a>
            <p>Module: 
                <a href="/modules/{{ $post->module->slug }}"> {{ $post->module->name }} </a>
            </p>
            <p>Posted by: {{ $post->user->name }}</p>
            <div>
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach
@endsection
