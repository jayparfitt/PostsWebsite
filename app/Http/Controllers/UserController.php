<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        // Retrieve all users or paginate them if there are many
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user and their posts.
     */
    public function show($id)
    {
        // Find user by ID, load their posts and any other relationships
        $user = User::with('posts', 'comments')->findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            // Additional validation rules as necessary
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('users.show', $user->id)->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
