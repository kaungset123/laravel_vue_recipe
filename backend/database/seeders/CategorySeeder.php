<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Salad"
        ]);
        Category::create([
            "name" => "Fried Food"
        ]);
        Category::create([
            "name" => "Curry"
        ]);
        Category::create([
            "name" => "Juice"
        ]);
    }
}
