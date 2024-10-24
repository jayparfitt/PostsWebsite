<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeds the 'comments' table with test data.
     * Loops through each post, creating 5 random comments for each.
     * Each comment is associated with a randomly selected user
     */
    public function run(): void
    {
        // Loop through each post in the database
        Posts::all()->each(function ($post) {
            // create 5 comments for each post
            for ($i = 0; $i < 5; $i++) {
                // for each comment, select a random user
                Comments::factory()->create([
                    // assign post_id to the current post
                    'post_id' => $post->id,
                    //assign a random user as the commenter
                    'user_id' => User::inRandomOrder()->first()->id
                ]);
            }
        });
    }
}
