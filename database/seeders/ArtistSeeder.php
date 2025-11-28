<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Artist::insert([
            ['name' => 'Playboi Carti', 'genre' => 'Trap / Rage', 'bio' => 'Atlanta artist known for his baby voice era and high-energy rage sound.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Feng', 'genre' => 'Hyperpop / Pluggnb', 'bio' => 'Experimental artist blending airy vocals with cloud rap influences.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Joeyy', 'genre' => 'Pluggnb', 'bio' => 'UK-based pluggnb artist known for soft vocals and ethereal beats.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bladee', 'genre' => 'Drain / Cloud Rap', 'bio' => 'Member of Drain Gang, crafting emotional autotuned cloud-rap.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yung Lean', 'genre' => 'Cloud Rap', 'bio' => 'Swedish pioneer of the cloud-rap movement and founder of Sad Boys.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ecco2k', 'genre' => 'Experimental Pop', 'bio' => 'Artist blending ambient pop, fashion, and ethereal vocal styles.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thaiboy Digital', 'genre' => 'Cloud Rap / Drain', 'bio' => 'Drain Gang member with a melodic, dreamy rap style.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ken Carson', 'genre' => 'Rage', 'bio' => 'Opium rapper known for hard beats and aggressive rage vocals.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Destroy Lonely', 'genre' => 'Rage / Trap', 'bio' => 'Opium artist blending dark melodic flows with energetic trap.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Homixide Beno!', 'genre' => 'Trap', 'bio' => 'One half of Homixide Gang, known for raw and gritty trap energy.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Homixide Meechie', 'genre' => 'Trap', 'bio' => 'Atlanta artist from Homixide Gang with an intense vocal style.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sematary', 'genre' => 'Witch House / Trap Metal', 'bio' => 'Haunted Mound rapper with distorted vocals and dark production.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ghost Mountain', 'genre' => 'Witch House / Cloud Rap', 'bio' => 'Known for emotional, atmospheric tracks with haunting themes.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hi-C', 'genre' => 'Pluggnb', 'bio' => 'Pluggnb artist recognised for dreamy beats and melodic delivery.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acid Souljah', 'genre' => 'Underground Rap', 'bio' => 'Distinctive underground rapper with a cartoonish chaotic style.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shawty Sins', 'genre' => 'Pluggnb / Underground', 'bio' => 'Underground pluggnb vocalist known for emotional melodic flows.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marlon Dubois', 'genre' => 'Alternative Rap', 'bio' => 'Stylish experimental artist blending rap with avant-garde sounds.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Henry Mosto', 'genre' => 'Plug / Experimental', 'bio' => 'Berlin-based experimental rapper with soft-spoken surreal vocals.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Slug Christ', 'genre' => 'Alternative Trap', 'bio' => 'Cult underground figure mixing sad trap and gothic themes.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lucki', 'genre' => 'Alternative Trap', 'bio' => 'Chicago rapper known for druggy introspective flows and laid-back beats.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
