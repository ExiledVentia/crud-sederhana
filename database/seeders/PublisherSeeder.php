<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher; // <-- Import the Publisher model

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use the create method to add records
        Publisher::create(['publisher_name' => 'Ozma PMC']);
        Publisher::create(['publisher_name' => 'Penguin Classics']);
        Publisher::create(['publisher_name' => 'English Classics']);
        Publisher::create(['publisher_name' => 'Covenant']);
    }
}