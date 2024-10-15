<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::get('/', function () {
    $posts = Post::all();

    return view('posts', [
        'posts' => $posts
    ]);
});

Route::get('posts/{slug}', function ($slug) {
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('slug', '[A-z_\-]+');

