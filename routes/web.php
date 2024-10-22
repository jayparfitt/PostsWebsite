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
    return view('post', [
        'post' => Posts::find($id)
    ]);
})->where('id', '[0-9]+');

