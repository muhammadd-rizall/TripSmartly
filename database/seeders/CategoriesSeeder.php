<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rizal_categories')->insert([
            [
                'name' => 'Pantai',
                'slug' => 'pantai',
                'description' => 'Trip ke pantai, snorkeling, dan island hopping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gunung',
                'slug' => 'gunung',
                'description' => 'Pendakian, wisata pegunungan, dan camping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wisata Kota',
                'slug' => 'wisata-kota',
                'description' => 'City tour, landmark kota, belanja, dan kuliner.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wisata Alam',
                'slug' => 'wisata-alam',
                'description' => 'Air terjun, bukit, danau, hutan pinus, dan kebun.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sejarah & Budaya',
                'slug' => 'sejarah-dan-budaya',
                'description' => 'Candi, museum, keraton, dan kampung adat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agrowisata',
                'slug' => 'agrowisata',
                'description' => 'Petik buah, kebun teh, pertanian, dan edukasi alam.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Camping / Glamping',
                'slug' => 'camping-glamping',
                'description' => 'Camping dan glamping di alam terbuka.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Festival & Event',
                'slug' => 'festival-event',
                'description' => 'Trip ke festival budaya, musik, dan karnaval lokal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
