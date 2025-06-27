<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table = 'rizal_trip';
    protected $guarded = ['id'];

    public function rizal_categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function rizal_regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    protected $casts = [
        'includes' => 'array',
        'excludes' => 'array',
    ];
}
