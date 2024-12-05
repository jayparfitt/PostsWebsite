<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use App\Notifications\PostInteractionNotification;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request, Posts $post)
    {
        // Validate the request
        $validated = $request->validate([
            'body' => 'required|string|max:500',
        ]);

        // Get the authenticated user's ID
        $userId = $request->user()->id;

        // Create the comment
        $comment = $post->comments()->create([
            'body' => $validated['body'],
            'user_id' => $userId
        ]);

        // Notify the post owner
        if ($post->user_id !== $userId) { // Stops notifications from themselves
            $postOwner = $post->user; // Post Owner
            $interactionDetails = [
                'post_id' => $post->id,
                'comment_id' => $comment->id,
                'interactionName' => $request->user()->name,
                'message' => $request->user()->name . ' commented on your post',
            ];

            $postOwner->notify(new PostInteractionNotification($interactionDetails));
        }

        // Redirect back to the post with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Comment created successfully.');
    }


    // Display a specific comment
    public function show($id)
    {
        $comment = Comments::with('user', 'post')->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    // Show the form to edit an existing comment
    public function edit(Request $request, Comments $comment)
    {
        if ($request->user()->id !== $comment->user_id) {
            abort(403, 'Unauthorized Access');
        }
        return view('comments.editComment', compact('comment'));
    }

    // Update an existing comment
    public function update(Request $request, Comments $comment)
    {
        if ($request->user()->id !== $comment->user_id) {
            abort(403, 'Unauthorized Access');
        }
        $validated = $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $comment->update($validated);

        return redirect()->route('posts.show', $comment->post_id)
            ->with('success', 'Comment updated successfully.');
    }

    // Delete a comment
    public function destroy(Comments $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'Unauthorized Action');
        }
        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
