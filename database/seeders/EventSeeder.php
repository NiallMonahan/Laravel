<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('events')->insert([
                'title' => $faker->sentence(3),              // random event name
                'description' => $faker->paragraph,          // random description
                'event_date' => $faker->dateTimeBetween('+1 week', '+1 year'),
                'location' => $faker->city,                  // random city name
                'capacity' => $faker->numberBetween(50, 500),
                'image' => $faker->word . '.jpg',            // fake image filename
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
