<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */



    public function up(): void
    {
        Schema::create('rizal_trip_destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('rizal_trip');
            $table->string('place_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_trip_destinations');
    }
};
