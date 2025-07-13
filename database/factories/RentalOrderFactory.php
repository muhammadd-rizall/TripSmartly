<?php

namespace Database\Factories;

use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalOrder>
 */
class RentalOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = (clone $startDate)->modify('+' . rand(1, 7) . ' days');

        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'rental_items_id' => RentalItem::inRandomOrder()->value('id') ?? RentalItem::factory()->create()->id,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'quantity' => $this->faker->numberBetween(1,50),
            'total_price' => $this->faker->randomFloat(2, 50000, 1000000),
            'retrun_status' => $this->faker->randomElement(['belum kembali', 'kembali', 'terlambat', 'hilang']),
            'pickup_location' => $this->faker->address(),
            'delivery_location' => $this->faker->address(),
            'payment_methods' => $this->faker->randomElement(['transfer', 'cod', 'credit_card']),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'notes' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
