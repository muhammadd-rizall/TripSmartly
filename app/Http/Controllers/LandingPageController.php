<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Trip;
use App\Models\TripSchedule;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function home()
    {
        $categories = Categories::all();

        // join Trip ke TripSchedule
        $openTrips = TripSchedule::with('rizal_trip.rizal_regions')->latest()->paginate(8);

        return view('layouts.home_views', compact('categories', 'openTrips'));
    }
    // public function categories(){
    //     $categories = Categories::all();
    //     return view('layouts.trip_views', compact('categories'));
    // }
    public function tripViews(Request $request)
    {
        $categories = Categories::all();

        $query = TripSchedule::with(['rizal_trip.rizal_regions', 'rizal_trip.rizal_categories']);

        // Filter kategori
        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('rizal_trip.rizal_categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter pencarian (title trip atau region name)
        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('rizal_trip', function ($sub) use ($searchTerm) {
                    $sub->where('title', 'LIKE', '%' . $searchTerm . '%');
                })
                    ->orWhereHas('rizal_trip.rizal_regions', function ($sub) use ($searchTerm) {
                        $sub->where('name', 'LIKE', '%' . $searchTerm . '%');
                    });
            });
        }

        $allTrips = $query->get();

        // Kelompokkan berdasarkan kategori
        $openTrips = $allTrips->groupBy(function ($trip) {
            return $trip->rizal_trip->rizal_categories->name ?? 'Lainnya';
        });

        return view('layouts.trip_views', compact('openTrips', 'categories'));
    }
}
