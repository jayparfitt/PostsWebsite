<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generates unique fake name, consisting of 3 words
        $name = $this->faker->unique()->words(2,true);
        
        return [
            // Generates the name
            'name' => $name,
            // Creates a URL slug from the name 
            'slug'=> Str::slug($name)
        ];
    }
}
