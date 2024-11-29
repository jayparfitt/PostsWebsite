<?php

namespace Database\Factories;

use App\Models\View;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = View::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Posts::factory(), // Associate a post
            'user_id' => User::factory(),
            'ip_address' => $this->faker->unique()->ipv4, // Generate a random IP address
        ];
    }
}
