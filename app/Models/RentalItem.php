<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalItem extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    protected $table = 'rizal_rental_items';
    protected $guarded = ['id'];

    public function rizal_rental_categories(){
        return $this->belongsTo(RentalCategories::class, 'rental_categories_id');
    }

}
