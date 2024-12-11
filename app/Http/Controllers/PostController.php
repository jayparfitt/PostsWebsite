<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    // Display a list of posts on the homepage
    public function index(Request $request)
    {
        $query = Posts::query();
        $selectedModule = null;

        if ($request->has('module') && $request->module) {
            $query->where('module_id', $request->module);
            $selectedModule = $request->module; // Checks the selected module
        }

        // orders by date added
        $posts = $query->orderBy('created_at', 'desc')->get();
        $modules = Module::all();

        return view('posts', compact('posts', 'modules', 'selectedModule'));
    }


    // Display a specific post with comments
    public function show(Request $request, $id)
    {
        $post = Posts::with('comments.user')->findOrFail($id);

        $ip = $request->ip();
        $userId = $request->user() ? $request->user()->id : null;

        // Check if a view already exists for this user/IP combination and post
        $hasViewed = $post->views()->where(function ($query) use ($userId, $ip) {
            $query->where('ip_address', $ip);
            if ($userId) {
                $query->orWhere('user_id', $userId);
            }
        })->exists();

        // Create a new view if it doesn't already exist
        if (!$hasViewed) {
            $post->views()->create([
                'ip_address' => $ip,
                'user_id' => $userId,
            ]);
        }

        return view('post', [
            'post' => $post,
            'viewCount' => $post->views->count(),
        ]);
    }

    // Show the form to create a new post
    public function create()
    {
        // ensures only users can complete this action
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
            'newModuleName' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle new module creation
        if (!empty($validated['newModuleName'])) {
            $newModule = Module::create([
                'name' => $validated['newModuleName'],
                'slug' => \Illuminate\Support\Str::slug($validated['newModuleName']),
            ]);
            $validated['module_id'] = $newModule->id;
        }

        // Check a module is associated
        if (empty($validated['module_id'])) {
            return redirect()->back()->withErrors(['module_id' => 'Please select or create a module']);
        }

        // Save the image if uploaded
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images', 'public');
        }

        $validated['user_id'] = Auth::id();

        Posts::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    // Show the form to edit an existing post
    public function edit(Posts $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized Action');
        }

        $modules = Module::all();
        return view('posts.edit', compact('post', 'modules'));
    }

    // Update an existing post
    public function update(Request $request, Posts $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save the new image if uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('images', 'public');
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    // Delete a post
    public function destroy(Posts $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized Action');
        }
        $post->delete();

        $module = $post->module;
        $post->delete();

        // If the only post in the module is deleted, then so is the module
        if ($module && $module->posts()->count() === 0) {
            $module->delete();
        }

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function viewers($id)
    {
        $post = Posts::with('views.user')->findOrFail($id);

        $viewers = $post->views()
            ->with('user') // Load associated user
            ->get();

        return view('views.viewers', [
            'post' => $post,
            'viewers' => $viewers
        ]);
    }
}
