<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rizal_rental_categories')->insert([
            [
                'name' => 'Peralatan Camping',
                'slug' => 'camping',
                'description' => 'Peralatan camping seperti tenda, sleeping bag, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hiking & Treaking',
                'slug' => 'hiking-treakih',
                'description' => 'Peralatan hiking dan trekking seperti sepatu, jaket, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Snorkeling & Diving',
                'slug' => 'snorkeling-diving',
                'description' => 'Peralatan snorkeling dan diving seperti masker, snorkel, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fotografi & Videografi',
                'slug' => 'fotografi-videografi',
                'description' => 'Peralatan fotografi dan videografi seperti kamera, tripod, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aksesoris & Safety',
                'slug' => 'aksesoris-safety',
                'description' => 'Aksesoris dan perlengkapan keselamatan seperti helm, sepatu, dll.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elektronik & Power',
                'slug' => 'elektronik-power',
                'description' => 'Peralatan elektronik dan power seperti baterai, charger, dll .',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
