<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Posts::all()->each(function ($post) {
            Comments::factory()->count(5)->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id
            ]);
        });
    }
}
