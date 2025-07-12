<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Trip;
use App\Models\TripSchedule;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function home(){
        $categories = Categories::all();

        // join Trip ke TripSchedule
        $openTrips = TripSchedule::with('rizal_trip.rizal_regions')->latest()->paginate(8);

        return view('layouts.home_views', compact('categories', 'openTrips'));
    }
    // public function categories(){
    //     $categories = Categories::all();
    //     return view('layouts.trip_views', compact('categories'));
    // }

    // public function tripHome(){
    //     $openTrips = Trip::latest()->paginate(10);
    //     return view('layouts.trip_views', compact('openTrips'));
    // }

}
