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
                'image' => 'https://1.bp.blogspot.com/-DYor1otWO7A/Xp_RCv8X3wI/AAAAAAAAEig/GZ1_-iCr9KwitpsMPyubRUbGWvo16PKdACLcBGAsYHQ/s640/beach%2Bpinky.jpg',
                'description' => 'Trip ke pantai, snorkeling, dan island hopping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gunung',
                'slug' => 'gunung',
                'image' => 'https://i.pinimg.com/originals/96/4e/e8/964ee85cbe115c93b093b7f39eea1e6c.jpg',
                'description' => 'Pendakian, wisata pegunungan, dan camping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wisata Kota',
                'slug' => 'wisata-kota',
                'image' => 'https://markastravel.com/wp-content/uploads/2022/06/Tempat-Wisata-Padang-1.jpg',
                'description' => 'City tour, landmark kota, belanja, dan kuliner.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wisata Alam',
                'slug' => 'wisata-alam',
                'image'=> 'https://www.rukita.co/stories/wp-content/uploads/2022/10/kota-banda-neira.jpeg',
                'description' => 'Air terjun, bukit, danau, hutan pinus, dan kebun.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sejarah & Budaya',
                'slug' => 'sejarah-dan-budaya',
                'image' => 'https://www.celebes.co/wp-content/uploads/2019/11/Rumah-Adat-Suku-Toraja.jpg',
                'description' => 'Candi, museum, keraton, dan kampung adat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agrowisata',
                'slug' => 'agrowisata',
                'image' => 'https://eticon.co.id/wp-content/uploads/2021/11/Agrowisata-Kopeng-Gunungsari.jpg',
                'description' => 'Petik buah, kebun teh, pertanian, dan edukasi alam.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Camping / Glamping',
                'slug' => 'camping-glamping',
                'image' => 'https://tse1.mm.bing.net/th/id/OIP.-wwO8tM1BuYP9TAyZGFOTwHaE8?rs=1&pid=ImgDetMain&o=7&rm=3',
                'description' => 'Camping dan glamping di alam terbuka.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Festival & Event',
                'slug' => 'festival-event',
                'image' => 'https://hypesrus.com/wp-content/uploads/2023/07/20230723-020512-Niclas_Ruehl-_1200.jpg',
                'description' => 'Trip ke festival budaya, musik, dan karnaval lokal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
