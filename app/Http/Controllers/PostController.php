<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a list of posts on the homepage
    public function index()
    {
        $posts = Posts::latest()->with(['user', 'module'])->get();

        return view('posts', [
            'posts' => $posts
        ]);
    }

    // Display a specific post with comments
    public function show($id)
    {
        $post = Posts::with('comments.user')->findOrFail($id);

        return view('post', [
            'post' => $post
        ]);
    }

    // Show the form to create a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'module_id' => 'required|exists:modules,id'
        ]);

        // Optionally, add auth()->id() if authentication is set up.
        // $validated['user_id'] = auth()->id(); 

        Posts::create($validated);
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    
    // Show the form to edit an existing post
    public function edit($id)
    {
        $post = Posts::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Update an existing post
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'module_id' => 'required|exists:modules,id'
        ]);

        $post = Posts::findOrFail($id);
        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete a post
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
