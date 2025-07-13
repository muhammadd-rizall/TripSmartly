<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class RentalCategories extends Model
{
    use HasFactory;
    protected $table = 'rizal_rental_categories';
}
