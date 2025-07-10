<?php

namespace Database\Seeders;

use App\Models\RentalItem;
use App\Models\RentalOrder;
use App\Models\Trip;
use App\Models\TripDestination;
use App\Models\TripItternary;
use App\Models\TripOrder;
use App\Models\TripSchedule;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Tambah 10 user acak
        // User::factory(10)->create();

        // Buat 10 trip
        TripSchedule::factory(20)->create();
        TripItternary::factory(20)->create();
        TripDestination::factory(20)->create();

        // Buat 20 order trip
        TripOrder::factory(20)->create();

        // Buat 10 rental items
        // Pastikan ada data user dan rental_item
       
        RentalItem::factory(10)->create();

        // Buat 20 rental order dengan foreign key valid
        RentalOrder::factory(20)->create();
    }
}
