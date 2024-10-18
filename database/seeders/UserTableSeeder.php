<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u = new User;
        $u->name = "Alice";
        $u->email = "alice@gmail.com";
        $u->password = "alice123";
        $u->role = "user";
        $u->save();

        User::factory()->count(10)->create();
        
    }
}
