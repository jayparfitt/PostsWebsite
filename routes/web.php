<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route for displaying all posts on the homepage
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


// Route for creating posts
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
});

Route::get('/users/{user}/posts', [UserController::class, 'show'])->name('users.posts');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')
    ->middleware('auth');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
    ->name('comments.edit')
    ->middleware('auth');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])
    ->name('comments.update')
    ->middleware('auth');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route for displaying a single post with comments
Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');

// Route for displaying posts in a specific module by slug
Route::get('modules/{module:slug}', [ModuleController::class, 'show']);

// Auth routes from Laravel Breeze
require __DIR__ . '/auth.php';
