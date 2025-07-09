<?php

namespace App\Http\Controllers;

use App\Models\ReviewRental;
use App\Models\ReviewTrip;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function rentalReviews(){
        $itemRvs = ReviewRental :: latest()->paginate(10);
        return view('reviews.rental_reviews', compact('itemRvs'));
    }

    public function tripReviews(){
        $reviews = ReviewTrip :: latest()->paginate(10);
        return view('reviews.trip_reviews', compact('reviews'));
    }
}
