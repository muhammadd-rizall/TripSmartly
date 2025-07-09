<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRental extends Model
{
    use HasFactory;
    protected $table = 'rizal_rental_reviews';
    protected $guarded = ['id'];

    public function rizal_rental_items()
    {
        return $this->belongsTo(RentalItem::class, 'rizal_rental_items_id');
    }
}
