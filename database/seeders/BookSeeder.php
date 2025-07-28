<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Carbon\Carbon; // Import Carbon

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $publishers = Publisher::all();

        // Define the time range
        $startDate = Carbon::create(2025, 1, 1, 0, 0, 0)->timestamp;
        $endDate = Carbon::now()->timestamp;

        for ($i = 0; $i < 50; $i++) { // Assuming you are running this in a loop
            
            // Generate a random date within the range
            $randomTimestamp = mt_rand($startDate, $endDate);
            $randomDate = Carbon::createFromTimestamp($randomTimestamp);

            Book::create([
                'cover' => 'default-cover.png',
                'title' => 'SAMPLE TITLE ' . ($i + 1),
                'description' => 'SAMPLE DESCRIPTION.',
                'author' => 'Author Name ' . ($i + 1),
                'category_id' => $categories->random()->id,
                'publisher_id' => $publishers->random()->id,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }
}