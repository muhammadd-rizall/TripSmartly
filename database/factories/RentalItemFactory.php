<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
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

        // Nama file random yang disalin ke storage
        $fakeFileName = 'rental_items/' . Str::random(10) . '.jpg';

        // Pastikan folder ada
        Storage::disk('public')->makeDirectory('rental_items');

        // Salin dari resources/seed_images/sample.jpg ke storage
        Storage::disk('public')->put(
            $fakeFileName,
            file_get_contents(resource_path('seed_images/sample1.jpg'))
        );
        return [
            'name'           => $this->faker->words(2, true),
            'rental_categories_id'   => $this->faker->numberBetween(1, 5),
            'description'    => $this->faker->paragraph(),
            'stock'          => $this->faker->numberBetween(1, 50),
            'price_per_day'  => $this->faker->randomFloat(2, 50000, 500000),  // Rp
            'image'          => $fakeFileName
        ];
    }
}
