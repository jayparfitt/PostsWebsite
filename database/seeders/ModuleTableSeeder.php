<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Seeds the 'modules' table with test data using the Module factory
     * It creates 3 modules
     */
    public function run(): void
    {
        Module::factory()->count(3)->create();
    }
}
