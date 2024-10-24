<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Random Names
            'name' => $this->faker->name(),  
            // Unique emails
            'email' => $this->faker->unique()->safeEmail(),  
            // Hashed password
            'password' => Hash::make('password'), 
            // Randomly assigned roles
            'role' => $this->faker->randomElement(['user', 'admin']),  
            'remember_token' => Str::random(10),
        ];
    }
}
