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
        Schema::create('rizal_trip', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('meeting_point');
            $table->decimal('price', 15, 2);
            $table->string('quota');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('region_id')->constrained('rizal_regions');
            $table->foreignId('category_id')->constrained('rizal_categories');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_trip');
    }
};
