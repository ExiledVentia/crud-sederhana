<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $publishers = Publisher::all();

        if ($categories->isEmpty() || $publishers->isEmpty()) {
            $this->command->info('No categories or publishers found. Please seed them first.');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            Book::create([
                'cover' => 'default-cover.png',
                'title' => 'SAMPLE TITLE ' . ($i + 1),
                'description' => 'SAMPLE DESCRIPTION.',
                'author' => 'Author Name ' . ($i + 1),
                'category_id' => $categories->random()->id,
                'publisher_id' => $publishers->random()->id,
            ]);
        }
    }
}