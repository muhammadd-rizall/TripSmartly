<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\TripSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripSchedule>
 */
class TripScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TripSchedule::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('+1 week', '+2 months');
        $endDate = (clone $startDate)->modify('+' . rand(1, 5) . ' days');

        return [
            'trip_id'    => Trip::factory(),  // atau ->numberBetween(1,10) kalau sudah ada seed
            'start_date' => $startDate->format('Y-m-d'),
            'end_date'   => $endDate->format('Y-m-d'),
            'quota'      => $this->faker->optional()->numberBetween(10, 100),
            'price'      => $this->faker->optional()->randomFloat(2, 100000, 1000000),
            'status'     => $this->faker->randomElement(['open', 'closed', 'cancelled']),
        ];
    }
}
