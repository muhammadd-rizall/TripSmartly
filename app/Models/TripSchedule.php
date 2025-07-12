<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripSchedule extends Model
{
    use HasFactory;
    protected $table = 'rizal_trip_schedules';
    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function rizal_trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
