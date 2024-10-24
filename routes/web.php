<?php

use App\Models\Module;
use App\Models\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Posts::latest()->with(['user', 'module'])->get();

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

Route::get('modules/{module:slug}', function (Module $module){
    $posts = Posts::with('user')->get();

    return view('posts', [
        'posts' => $module->posts
    ]);
});