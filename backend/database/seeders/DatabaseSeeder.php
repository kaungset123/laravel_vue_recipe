<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

     /*
    public function run(): void
    {
        Category::factory(5)
        ->has(Recipe::factory()->count(20), 'recipes')
        ->create();
    }
    */

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class
        ]);
    }
}
