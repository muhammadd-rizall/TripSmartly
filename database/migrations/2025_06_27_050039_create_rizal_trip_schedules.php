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
        Schema::create('rizal_trip_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('rizal_trip')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quota');
            $table->decimal('price', 15, 2)->nullable();
            $table->enum('status', ['open', 'closed', 'cancelled'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rizal_trip_schedules');
    }
};
