<?php

namespace App\Livewire;

use App\Models\Posts;
use Livewire\Component;

class SearchPosts extends Component
{
    public $search = '';

    public function updatedSearch($value)
    {
        logger("Search updated: {$value}");
    }

    public function render()
    {
        logger("Search term: {$this->search}");
        $posts = collect(); // Initialize as an empty collection

        if (!empty($this->search)) {
            $posts = Posts::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                ->take(5) // Limit results to 5
                ->get(); // Fetch results as a collection
        }
        logger("Found posts: " . $posts->count());

        return view('livewire.search-posts', compact('posts'));
    }
}
