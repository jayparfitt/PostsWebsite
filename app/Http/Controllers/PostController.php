<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        $modules = Module::all();

        return view('posts.create', ['modules' => $modules]);
    }

    // Store a new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'module_id' => 'nullable|exists:modules,id',
            'newModuleName' => 'nullable|string|max:255'
        ]);

        // for new module creation
        if (!empty($validated['newModuleName'])) {
            $newModule = Module::create([
                'name' => $validated['newModuleName'],
                'slug' => \Illuminate\Support\Str::slug($validated['newModuleName'])
            ]);
            $validated['module_id'] = $newModule->id;
        }

        // Check a module is associated
        if (empty($validated['module_id'])) {
            return redirect()->back()->withErrors(['module_id' => 'Please select or create a module']);
        }

        $validated['user_id'] = Auth::id();

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
