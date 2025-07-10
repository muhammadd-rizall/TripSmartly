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
        Schema::create('rizal_rental_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('rental_items_id')->constrained('rizal_rental_items');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price',15,2);
            $table->enum('retrun_status',['belum kembali','kembali','terlambat', 'hilang'])->default('belum kembali');
            $table->text('pickup_location');
            $table->text('delivery_location');
            $table->string('payment_methods');
            $table->enum('payment_status',['pending', 'paid', 'failed'])->default('pending');
            $table->text('notes');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_rental_orders');
    }
};
