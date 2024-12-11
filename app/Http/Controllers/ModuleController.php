<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // Display a listing of all modules 
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', ['modules' => $modules]);
    }

    // Show the form for creating a new module 
    public function create()
    {
        return view('modules.create');
    }

    // Store a newly created module 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:modules,slug|max:255',
        ]);

        Module::create($request->only(['name', 'slug']));
        return redirect()->route('modules.index');
    }

    // Display posts for a specific module based on its slug
    public function show(Module $module)
    {
        // Fetch posts for the specific module
        $posts = $module->posts()->orderBy('created_at', 'desc')->get();
        $modules = Module::all();

        return view('posts', compact('posts', 'modules'))->with('selectedModule', $module->id);
    }

    // Show the form for editing a module 
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    // Update the specified module 
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:modules,slug,' . $module->id . '|max:255',
        ]);

        $module->update($request->only(['name', 'slug']));
        return redirect()->route('modules.index');
    }

    // Delete a module
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index');
    }
}
