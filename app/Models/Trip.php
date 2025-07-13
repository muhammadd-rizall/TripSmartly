<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'rizal_trip';
    protected $guarded = ['id'];

    // Relasi ke kategori
    public function rizal_categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    // Relasi ke region
    public function rizal_regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Destinasi trip
    public function trip_destinations()
    {
        return $this->hasMany(TripDestination::class, 'trip_id');
    }

    // Itinerary trip
    public function trip_itineraries()
    {
        return $this->hasMany(TripItternary::class, 'trip_id');
    }

    public function trip_schedule()
    {
        return $this->hasOne(TripSchedule::class, 'trip_id');
    }
}
