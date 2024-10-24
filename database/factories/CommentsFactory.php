<?php

namespace Database\Factories;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates a paragraph for the comments body
            'body' => $this ->faker->paragraph(),
            // Associates a comment with a post, using the new post from PostsFactory
            'post_id' => Posts::factory(),
            // Associates a comment with a user, using the new user from UserFactory
            'user_id' => User::factory()
        ];
    }
}
