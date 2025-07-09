<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripOrder extends Model
{
    use HasFactory;
    protected $table = 'rizal_trip_order';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rizal_trip()
    {
        return $this->belongsTo(Trip::class ,'trip_id');
    }
}
