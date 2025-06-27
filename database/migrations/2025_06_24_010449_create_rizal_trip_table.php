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
            $table->integer('quota');
            $table->decimal('base_price', 15, 2);
            $table->string('image');
            $table->text('includes')->nullable();
            $table->text('excludes')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('region_id')->constrained('rizal_regions');
            $table->foreignId('category_id')->constrained('rizal_categories');
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
