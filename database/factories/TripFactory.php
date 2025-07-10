<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Trip::class;
    public function definition(): array
    {


        return [
            'title'         => $this->faker->sentence(3),
            'description'   => $this->faker->optional()->paragraphs(3, true),
            'meeting_point' => $this->faker->city(),
            'quota'         => $this->faker->numberBetween(10, 100),
            'base_price'    => $this->faker->randomFloat(2, 100000, 5000000),
            'image'         => 'https://picsum.photos/seed/' . Str::random(10) . '/480/640',
            'includes'      => $this->faker->optional()->paragraph(),
            'excludes'      => $this->faker->optional()->paragraph(),
            'status'        => $this->faker->randomElement(['active', 'inactive']),
            'region_id'     => $this->faker->numberBetween(1, 10),
            'category_id'   => $this->faker->numberBetween(1, 5),

        ];
    }
}
