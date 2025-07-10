<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalItem>
 */
class RentalItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->words(2, true),          // e.g. "Camping Tent"
            'description'    => $this->faker->paragraph(),
            'stock'          => $this->faker->numberBetween(1, 50),
            'price_per_day'  => $this->faker->randomFloat(2, 50000, 500000),  // Rp
            'image'          => 'https://picsum.photos/seed/' . Str::random(10) . '/480/640',
        ];
    }
}
