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
        Schema::create('rizal_rental_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('rental_categories_id')->constrained('rizal_rental_categories');
            $table->text('description')->nullable();
            $table->integer('stock');
            $table->text('pickup_location');
            $table->decimal('price_per_day', 15,2);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_rental_items');
    }
};
