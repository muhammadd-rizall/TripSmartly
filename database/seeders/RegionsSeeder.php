<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rizal_regions')->insert([
            [
                'name' => 'Aceh',
                'slug' => 'Banda-Aceh',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bali',
                'slug' => 'Denpasar',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bangka Belitung',
                'slug' => 'Pangkal-Pinang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banten',
                'slug' => 'Serang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bengkulu',
                'slug' => 'Bengkulu',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daerah Istimewa Yogyakarta',
                'slug' => 'Yogyakarta',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DkI Jakarta',
                'slug' => 'jakarta',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gorontalo',
                'slug' => 'gorontalo',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jambi',
                'slug' => 'Jambi',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jawa Barat',
                'slug' => 'Bandung',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jawa Tengah',
                'slug' => 'Semarang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jawa Timur',
                'slug' => 'Surabaya',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Kalimantan Barat',
                'slug' => 'Pontianak',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kalimantan Selatan',
                'slug' => 'Banjarbaru',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kalimantan Tengah',
                'slug' => 'Palangkaraya',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kalimantan Timur',
                'slug' => 'Samarinda',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kalimantan Utara',
                'slug' => 'Tanjung Selor',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kepualuan Riau',
                'slug' => 'Tanjung-Pinang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lampung',
                'slug' => 'Bandar Lampung',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maluku',
                'slug' => 'Ambon',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maluku Utara',
                'slug' => 'Sofifi',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nusa Tenggara Barat',
                'slug' => 'Mataram',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nusa Tenggara Timur',
                'slug' => 'Kupang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papua',
                'slug' => 'Jayapura',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papua Barat',
                'slug' => 'Manokwari',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papua Barat Daya',
                'slug' => 'Sorong',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papua Pegunungan',
                'slug' => 'Jayawijaya',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papua Selatan',
                'slug' => 'Marauke',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papua Tengah',
                'slug' => 'Nabire',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Riau',
                'slug' => 'Pekanbaru',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sulawesi Barat',
                'slug' => 'Mamuju',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sulawesi Selatan',
                'slug' => 'Makasar',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sulawesi Tengah',
                'slug' => 'Palu',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sulawesi Tenggara',
                'slug' => 'Kendari',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sulawesi Utara',
                'slug' => 'Manado',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sumatera Barat',
                'slug' => 'Padang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sumatera Selatan',
                'slug' => 'Palembang',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sumatera Utara',
                'slug' => 'Medan',
                'type' => 'provinsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
