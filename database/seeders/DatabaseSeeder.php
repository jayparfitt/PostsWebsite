<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Calls the individual seeders for modules, users, posts, and comments
        $this->call([
            ModuleTableSeeder::class,
            UserTableSeeder::class,
            PostTableSeeder::class,
            CommentTableSeeder::class
        ]);

    }
}
