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

        $adjectives = [
            'Epic',
            'Vibrant',
            'Magical',
            'Legendary',
            'Electric',
            'Midnight',
            'Golden',
            'Urban',
            'Cosmic',
            'Mystic',
            'Sunset',
            'Neon',
            'Wild',
            'Royal',
            'Chill'
        ];

        $nouns = [
            'Festival',
            'Gathering',
            'Showcase',
            'Night',
            'Celebration',
            'Carnival',
            'Rave',
            'Meetup',
            'Jam',
            'Summit',
            'Fiesta',
            'Expo',
            'Soirée',
            'Show',
            'Experience'
        ];

        $partySynonyms = [
            'Bash',
            'Party',
            'Gala',
            'Rendezvous',
            'Event',
            'Mixer',
            'Session',
            'Ceremony',
            'Occasion',
            'Blast'
        ];

        foreach (range(1, 50) as $index) {
            $title = $faker->randomElement($adjectives) . ' ' .
                $faker->randomElement($nouns) . ' ' .
                $faker->randomElement($partySynonyms);

            DB::table('events')->insert([
                'title' => $title,
                'description' => $faker->paragraph,
                'event_date' => $faker->dateTimeBetween('+1 week', '+1 year'),
                'location' => $faker->city,
                'capacity' => $faker->numberBetween(50, 500),
                'image' => 'PlaceHolder' . $faker->numberBetween(1, 2) . '.jpg', // ✅ Always use this image
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
