<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpenLibraryController;
use Illuminate\Http\Request;

// Route for displaying all posts on the homepage
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


// Route for posts
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}/viewers', [PostController::class, 'viewers'])->name('posts.viewers');
});

// UserController Routes
Route::get('/users/{user}/posts', [UserController::class, 'show'])->name('users.posts');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::post('/logout', function () {
    FacadesAuth::logout();
    return redirect('/');
})->name('logout');

// CommentController Routes
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')
    ->middleware('auth');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
    ->name('comments.edit')
    ->middleware('auth');
Route::patch('/comments/{comment}', [CommentController::class, 'update'])
    ->name('comments.update')
    ->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware('auth');


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route for displaying a single post with comments
Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');

// Route for displaying posts in a specific module by slug
Route::get('modules/{module:slug}', [ModuleController::class, 'show']);

// External API: OpenLibrary
Route::get('/books/search', [OpenLibraryController::class, 'search'])->name('openLibrary.search');

// Notifications route
Route::post('/notifications/{id}/mark-as-read', function ($id, Request $request) {
    $user = \App\Models\User::find($request->user()->id);
    $notification = $user->notifications()->find($id);

    if (!$notification) {
        return response()->json(['error' => 'Notification not found'], 404);
    }

    $notification->markAsRead();
    return response()->json(['success' => true]);
});




// Auth routes from Laravel Breeze
require __DIR__ . '/auth.php';
