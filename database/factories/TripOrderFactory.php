<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'         => User::factory(),
            'trip_id'         => Trip::factory(),
            'total_price'     => $this->faker->randomFloat(2, 500000, 5000000),
            'participants'    => $this->faker->numberBetween(1, 10),
            'payment_methods' => $this->faker->randomElement(['transfer', 'cod', 'credit_card', 'qris']),
            'payment_status'  => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'notes'           => $this->faker->sentence(),
            'status'          => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
