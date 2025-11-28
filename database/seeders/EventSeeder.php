<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Event;
use App\Models\Artist;


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

        // 10 Irish cities with 3 venues each
        $venues = [
            // Dublin venues
            ['name' => 'Dublin Arena', 'lat' => 53.3498, 'lng' => -6.2603],
            ['name' => 'Dublin Convention Centre', 'lat' => 53.3467, 'lng' => -6.2439],
            ['name' => 'Dublin Castle', 'lat' => 53.3429, 'lng' => -6.2674],

            // Cork venues
            ['name' => 'Cork Opera House', 'lat' => 51.8985, 'lng' => -8.4756],
            ['name' => 'Cork City Hall', 'lat' => 51.8998, 'lng' => -8.4729],
            ['name' => 'Cork Event Centre', 'lat' => 51.9012, 'lng' => -8.4712],

            // Galway venues
            ['name' => 'Galway Bay Hotel', 'lat' => 53.2707, 'lng' => -9.0568],
            ['name' => 'Galway Arts Centre', 'lat' => 53.2721, 'lng' => -9.0541],
            ['name' => 'Galway Cathedral Hall', 'lat' => 53.2693, 'lng' => -9.0595],

            // Limerick venues
            ['name' => 'Limerick Concert Hall', 'lat' => 52.6638, 'lng' => -8.6267],
            ['name' => 'Limerick City Gallery', 'lat' => 52.6651, 'lng' => -8.6240],
            ['name' => 'Limerick Sports Complex', 'lat' => 52.6625, 'lng' => -8.6294],

            // Waterford venues
            ['name' => 'Waterford Crystal Centre', 'lat' => 52.2593, 'lng' => -7.1101],
            ['name' => 'Waterford Theatre', 'lat' => 52.2606, 'lng' => -7.1074],
            ['name' => 'Waterford Marina', 'lat' => 52.2580, 'lng' => -7.1128],

            // Kilkenny venues
            ['name' => 'Kilkenny Castle Grounds', 'lat' => 52.6541, 'lng' => -7.2448],
            ['name' => 'Kilkenny Arts Festival Hall', 'lat' => 52.6554, 'lng' => -7.2421],
            ['name' => 'Kilkenny Sports Centre', 'lat' => 52.6528, 'lng' => -7.2475],

            // Belfast venues
            ['name' => 'Belfast Waterfront', 'lat' => 54.5973, 'lng' => -5.9301],
            ['name' => 'Belfast Ulster Hall', 'lat' => 54.5986, 'lng' => -5.9274],
            ['name' => 'Belfast Titanic Centre', 'lat' => 54.6000, 'lng' => -5.9328],

            // Derry venues
            ['name' => 'Derry Guildhall', 'lat' => 54.9966, 'lng' => -7.3086],
            ['name' => 'Derry Millennium Forum', 'lat' => 54.9979, 'lng' => -7.3059],
            ['name' => 'Derry City Centre', 'lat' => 54.9953, 'lng' => -7.3113],

            // Sligo venues
            ['name' => 'Sligo IT Arena', 'lat' => 54.2766, 'lng' => -8.4761],
            ['name' => 'Sligo Hawks Well Theatre', 'lat' => 54.2779, 'lng' => -8.4734],
            ['name' => 'Sligo Town Hall', 'lat' => 54.2753, 'lng' => -8.4788],

            // Tralee venues
            ['name' => 'Tralee Sports Complex', 'lat' => 52.2700, 'lng' => -9.7016],
            ['name' => 'Tralee Convention Centre', 'lat' => 52.2713, 'lng' => -9.6989],
            ['name' => 'Tralee Rose Hotel', 'lat' => 52.2687, 'lng' => -9.7043],
        ];

        foreach (range(1, 50) as $index) {
            $title = $faker->randomElement($adjectives) . ' ' .
                $faker->randomElement($nouns) . ' ' .
                $faker->randomElement($partySynonyms);

            // Pick a random venue
            $venue = $faker->randomElement($venues);

            $event = Event::create([
                'title' => $title,
                'description' => $faker->paragraph,
                'event_date' => $faker->dateTimeBetween('+1 week', '+1 year'),
                'location' => $venue['name'],
                'latitude' => $venue['lat'] + $faker->randomFloat(4, -0.01, 0.01), // Small variation around venue
                'longitude' => $venue['lng'] + $faker->randomFloat(4, -0.01, 0.01), // Small variation around venue
                'capacity' => $faker->numberBetween(50, 500),
                'image' => 'PlaceHolder' . $faker->numberBetween(1, 6) . '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Attach artists
            $event->artists()->attach(Artist::inRandomOrder()->take(2)->pluck('id'));
        }
    }
}
