<?php

namespace Database\Seeders;

use App\Models\Posts;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeds the 'posts' table with test data using the Posts factory
     * It creates 10 posts, each associated with a user who created them
     */
    public function run(): void
    {
        // Creates 10 posts using the Posts factory
        Posts::factory()->count(10)->create();
    }
}
