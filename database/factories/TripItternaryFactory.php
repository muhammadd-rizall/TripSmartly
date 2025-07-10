<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\TripItternary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripItternaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TripItternary::class;
    public function definition(): array
    {
        return [
            'trip_id'  => Trip::factory(),
            'day'      => 'Day ' . $this->faker->numberBetween(1, 7),
            'activity' => $this->faker->paragraph(),
        ];
    }
}
