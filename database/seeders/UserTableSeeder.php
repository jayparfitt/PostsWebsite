<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeds the 'user' table with test data using the User factory
     * Creates a total of 10 users: 3 admin and 7 regular users
     */
    public function run(): void
    {
        // Assigns the admin role to 3 users
        User::factory()->count(3)->state(['role' => 'admin'])->create();

        // Assigns the user role to 7 users
        User::factory()->count(7)->state(['role' => 'user'])->create();   
    }
}
