<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\RentalCategories;
use App\Models\RentalItem;
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

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('rizal_trip.rizal_categories', function ($q) use ($request) {
                $q->where('id', $request->category); // atau gunakan slug jika dropdown mengirim slug
            });
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('rizal_trip', function ($sub) use ($searchTerm) {
                    $sub->where('title', 'LIKE', '%' . $searchTerm . '%');
                })->orWhereHas('rizal_trip.rizal_regions', function ($sub) use ($searchTerm) {
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




    public function rentalViews(Request $request)
    {
        $categories = RentalCategories::all();

        $query = RentalItem::with('rizal_rental_categories');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('rental_categories_id', $request->category);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhereHas('rizal_rental_categories', function ($sub) use ($searchTerm) {
                        $sub->where('name', 'LIKE', '%' . $searchTerm . '%');
                    });
            });
        }

        $allRental = $query->get();

        $rentalItems = $allRental->groupBy(function ($item) {
            return optional($item->rizal_rental_categories)->name ?? 'Lainnya';
        });

        return view('layouts.rental_views', compact('categories', 'rentalItems'));
    }
}
