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
        Schema::create('rizal_rental_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_order_id')->constrained('rizal_rental_orders');
            $table->foreignId('rental_item_id')->constrained('rizal_rental_items');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_rental_order_items');
    }
};
