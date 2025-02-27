<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.\App\Models\User::all();
     */
    public function run(): void
    {
        $categories = ['Tops', 'Bottoms', 'Shoes', 'Accessories'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
