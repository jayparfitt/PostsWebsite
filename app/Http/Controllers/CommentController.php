<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Display a list of all comments (optionally for a specific post)
    public function index()
    {
        $comments = Comments::with('user', 'post')->latest()->get();
        return view('comments.index', compact('comments'));
    }

    // Show the form for creating a new comment
    public function create()
    {
        return view('comments.create');
    }

    // Store a newly created comment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'post_id' => 'required|exists:posts,id',
        ]);

        // Optionally, add user_id if auth is set up
        // $validated['user_id'] = auth()->id();

        Comments::create($validated);
        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    // Display a specific comment
    public function show($id)
    {
        $comment = Comments::with('user', 'post')->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    // Show the form to edit an existing comment
    public function edit($id)
    {
        $comment = Comments::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    // Update an existing comment
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comments::findOrFail($id);
        $comment->update($validated);

        return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');
    }

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'Comment deleted successfully.');
    }
}
