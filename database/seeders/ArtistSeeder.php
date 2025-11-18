<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Artist::insert([
            ['name' => 'Playboi Carti', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Feng', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Joeyy', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bladee', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yung Lean', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ecco2k', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thaiboy Digital', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ken Carson', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Destroy Lonely', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Homixide Beno!', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Homixide Meechie', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sematary', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ghost Mountain', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hi-C', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acid Souljah', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shawty Sins', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marlon Dubois', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Henry Mosto', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Slug Christ', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lucki', 'bio' => '...', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
