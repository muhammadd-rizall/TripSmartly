<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalOrder extends Model
{
    use HasFactory;
    protected $table = 'rizal_rental_orders';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rizal_rental_item()
    {
        return $this->belongsTo(RentalItem::class, 'rental_items_id');
    }
}
