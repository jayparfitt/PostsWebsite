<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

Route::get('/', function () {
    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach ($files as $file) {
       $document =  YamlFrontMatter::parseFile($file);

       $posts[] = new Post(
        $document -> title,
        $document -> excerpt,
        $document -> date,
        $document -> body(),
        $document -> slug
       );
    }

    return view('posts', [
        'posts' => $posts
    ]);
});

Route::get('/posts/{slug}', function ($slug) {
    return view('post', [
        'post' => Post::find($slug)
    ]);
})->where('slug', '[A-z_\-]+');
