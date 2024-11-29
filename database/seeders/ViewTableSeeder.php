<?php

namespace Database\Seeders;

use App\Models\View;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Seeder;

class ViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are posts and users to associate views with
        Posts::factory()->count(10)->create()->each(function ($post) {
            // Attach random views for each post
            View::factory()->count(5)->create([
                'post_id' => $post->id,
            ]);
        });
    }
}
