<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

// Route for displaying all posts on the homepage
Route::get('/', [PostController::class, 'index']);

// Route for creating posts
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Route for displaying a single post with comments
Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');

// Route for displaying posts in a specific module by slug
Route::get('modules/{module:slug}', [ModuleController::class, 'show']);

// Auth routes from Laravel Breeze
require __DIR__.'/auth.php';