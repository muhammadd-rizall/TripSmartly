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
            $table->foreignId('user_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price,',15,2);
            $table->enum('retrun_status',['kembali','terlambat']);
            $table->text('pickup_location');
            $table->text('delevery_location');
            $table->string('payment_methods');
            $table->string('payment_status');
            $table->text('notes');
            $table->enum('status', ['pending', 'confirmed', 'cancelled']);
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
