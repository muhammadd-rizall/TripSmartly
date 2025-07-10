<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\TripDestination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripDestination>
 */
class TripDestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TripDestination::class;

    public function definition(): array
    {
        return [
            'trip_id'     => Trip::factory(),
            'place_name'  => $this->faker->city(),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
