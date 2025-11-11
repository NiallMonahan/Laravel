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

        $ticketTypes = [
            'General Admission',
            'VIP',
            'Premium',
            'Early Bird',
            'Standard',
            'Gold',
            'Silver',
            'Bronze',
            'Student',
            'Senior'
        ];

        $statuses = ['active', 'cancelled', 'used', 'expired'];
        $statusWeights = [70, 10, 15, 5]; // 70% active, 10% cancelled, etc.

        // Get all event IDs and user IDs
        $eventIds = DB::table('events')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 200) as $index) {
            $eventId = $faker->randomElement($eventIds);
            $userId = $faker->randomElement($userIds);

            // Generate more realistic pricing based on ticket type
            $ticketType = $faker->randomElement($ticketTypes);
            $basePrice = match ($ticketType) {
                'VIP' => $faker->randomFloat(2, 80, 200),
                'Premium', 'Gold' => $faker->randomFloat(2, 50, 120),
                'Standard', 'General Admission' => $faker->randomFloat(2, 25, 60),
                'Silver' => $faker->randomFloat(2, 35, 80),
                'Bronze', 'Student' => $faker->randomFloat(2, 15, 40),
                'Early Bird' => $faker->randomFloat(2, 20, 45),
                'Senior' => $faker->randomFloat(2, 12, 35),
                default => $faker->randomFloat(2, 20, 60)
            };

            // Generate purchase date (mostly recent purchases)
            $purchaseDate = $faker->dateTimeBetween('-6 months', 'now');

            // Determine status based on weights
            $status = $faker->randomElement($statuses, $statusWeights);

            // Generate seat number (mix of numbered and general admission)
            $seatNumber = $faker->boolean(60) ?
                $faker->randomElement(['A', 'B', 'C', 'D', 'E']) . $faker->numberBetween(1, 50) :
                null;

            // Quantity is usually 1-4 tickets
            $quantity = $faker->randomElement([1, 1, 1, 1, 2, 2, 3, 4]);

            DB::table('tickets')->insert([
                'event_id' => $eventId,
                'user_id' => $userId,
                'ticket_type' => $ticketType,
                'price' => $basePrice,
                'quantity' => $quantity,
                'status' => $status,
                'purchase_date' => $purchaseDate,
                'ticket_code' => 'TKT-' . strtoupper($faker->bothify('??###??')),
                'seat_number' => $seatNumber,
                'notes' => $faker->boolean(20) ? $faker->sentence : null,
                'created_at' => $purchaseDate,
                'updated_at' => $purchaseDate,
            ]);
        }
    }
}