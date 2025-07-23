<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['category_name' => 'Fiction']);
        Category::create(['category_name' => 'Science Fiction']);
        Category::create(['category_name' => 'Mystery']);
        Category::create(['category_name' => 'Non-Fiction']);
        Category::create(['category_name' => 'Biography']);
    }
}