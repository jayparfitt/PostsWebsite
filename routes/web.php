<?php

use App\Models\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Posts::with('user')->get();

    return view('posts', [
        'posts' => $posts
    ]);
    
});

Route::get('posts/{id}', function ($id) {
    $post = Posts::with('comments.user') ->findOrFail($id);

    return view('post', [
        'post' => $post
    ]);
})->where('id', '[0-9]+');

