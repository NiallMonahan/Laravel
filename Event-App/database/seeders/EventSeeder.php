<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'Summer Skate Jam',
                'description' => 'An outdoor skateboarding competition with live music and food trucks.',
                'event_date' => '2025-07-15',
                'location' => 'Dublin Skatepark',
                'capacity' => 200,
                'image' => 'skatejam.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Winter Chill Fest',
                'description' => 'Indoor skating event with pro demos and a DJ set.',
                'event_date' => '2025-12-05',
                'location' => 'Belfast Arena',
                'capacity' => 500,
                'image' => 'winterfest.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Street Skating Showdown',
                'description' => 'Head-to-head battles on custom street-style obstacles.',
                'event_date' => '2026-03-20',
                'location' => 'Cork City Center',
                'capacity' => 150,
                'image' => 'showdown.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
