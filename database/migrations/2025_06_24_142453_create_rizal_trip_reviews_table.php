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
            Schema::create('rizal_trip_reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('trip_id')->constrained('rizal_trip');
                $table->foreignId('user_id')->constrained('users');
                $table->integer('rating');
                $table->text('comment')->nullable();
                $table->integer('like')->default(0);
                $table->integer('dislike')->default(0);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_trip_reviews');
    }
};
