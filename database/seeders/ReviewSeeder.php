<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Rating::create([
            'id_user' => 3, 
            'id_destination' => 1,
            'rating' => 4
        ]);
        Rating::create([
            'id_user' => 2, 
            'id_destination' => 1,
            'rating' => 5
        ]);
        Review::create([
            'id_user' => 3,
            'id_destination' => 1,
            'id_rating' => 1,
            'id_review_image' => null,
            'review' => 'Bagus semua keren.',
            'image' => ''
        ]);
        Review::create([
            'id_user' => 2,
            'id_destination' => 1,
            'id_rating' => 2,
            'id_review_image' => null,
            'review' => 'Bagus semua keren.',
            'image' => ''
        ]);
    }
}
