<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripSchedule extends Model
{
    use HasFactory;
    protected $table = 'rizal_trip_schedules';
    protected $guarded = ['id'];

    public function rizal_trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
