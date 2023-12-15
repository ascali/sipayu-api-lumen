<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Nadran',
            'image' => '',
            'description' => 'test 1',
            'date_event' => '2023-12-25',
            'location' => 'jl abc kec sindang kab indramayu',
            'latitude' => '',
            'longitude' => ''
        ]);
        Event::create([
            'name' => 'Pasar rakyat',
            'image' => '',
            'description' => 'test 2',
            'date_event' => '2023-12-29',
            'location' => 'jl abc kec sindang kab indramayu',
            'latitude' => '',
            'longitude' => ''
        ]);
    }
}
