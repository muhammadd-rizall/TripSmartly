<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
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

        // Nama file random yang disalin ke storage
        $fakeFileName = 'trip/' . Str::random(10) . '.jpg';

        // Pastikan folder ada
        Storage::disk('public')->makeDirectory('trip');

        // Salin dari resources/seed_images/sample.jpg ke storage
        Storage::disk('public')->put(
            $fakeFileName,
            file_get_contents(resource_path('seed_images/sample1.jpg'))
        );

        return [
            'title'         => $this->faker->sentence(3),
            'description'   => $this->faker->optional()->paragraphs(3, true),
            'meeting_point' => $this->faker->city(),
            'quota'         => $this->faker->numberBetween(10, 100),
            'base_price'    => $this->faker->randomFloat(2, 100000, 5000000),
            'image'         => $fakeFileName,
            'includes'      => $this->faker->paragraph(),
            'excludes'      => $this->faker->paragraph(),
            'status'        => $this->faker->randomElement(['active', 'inactive']),
            'region_id'     => $this->faker->numberBetween(1, 10),
            'category_id'   => $this->faker->numberBetween(1, 5),

        ];
    }
}
