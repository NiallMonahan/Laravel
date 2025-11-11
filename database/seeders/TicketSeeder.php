<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all event IDs
        $eventIds = DB::table('events')->pluck('id')->toArray();

        foreach (range(1, 200) as $index) {
            $eventId = $faker->randomElement($eventIds);

            // Generate realistic pricing
            $price = $faker->randomFloat(2, 15, 150);

            // Generate seat number (mix of numbered and general admission)
            $seatNumber = $faker->boolean(70) ?
                $faker->randomElement(['A', 'B', 'C', 'D', 'E']) . $faker->numberBetween(1, 50) :
                null;

            DB::table('tickets')->insert([
                'event_id' => $eventId,
                'holder_name' => $faker->name,
                'seat_number' => $seatNumber,
                'price' => $price,
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}