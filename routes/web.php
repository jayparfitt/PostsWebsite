<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

// Route for displaying all posts on the homepage
Route::get('/', [PostController::class, 'index']);

// Route for displaying a single post with comments
Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');

// Route for displaying posts in a specific module by slug
Route::get('modules/{module:slug}', [ModuleController::class, 'show']);

// Auth routes from Laravel Breeze
require __DIR__.'/auth.php';