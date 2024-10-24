<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates a sentence for the post's title
            'title' => $this ->faker->sentence(),
            // Generates a paragraph for the excerpt
            'excerpt' => $this ->faker->paragraph(),
            // Generates 3 sentences for the post's body 
            'body' => $this ->faker->paragraph(3, true),
            // Creates a user with the role of 'admin' and assigns it  to the user_id
            'user_id' => User::factory() ->state(['role'=>'admin'])
        ];
    }
}
