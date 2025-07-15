<?php

namespace App\Http\Controllers;

use App\Models\RentalOrder;
use App\Models\ReviewRental;
use App\Models\ReviewTrip;
use App\Models\TripOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    // ===================== REVIEWS =====================
    public function tripForm($orderId)
    {
        $order = TripOrder::findOrFail($orderId);
        return view('screens.reviews_order', [
            'type' => 'trip',
            'order' => $order,
        ]);
    }

    public function tripSubmit(Request $request, $orderId)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        ReviewTrip::create([
            'trip_order_id' => $orderId,
            'user_id'       => $userId,
            'rating'        => $validated['rating'],
            'comment'       => $validated['comment'],
        ]);

        return redirect()->route('historiOrder')->with('success', 'Review berhasil disimpan!');
    }

    public function rentalForm($orderId)
    {
        $order = RentalOrder::findOrFail($orderId);
        return view('screens.reviews_order', [
            'type' => 'rental',
            'order' => $order,
        ]);
    }

    public function rentalSubmit(Request $request, $orderId)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        ReviewRental::create([
            'rental_order_id' => $orderId,
            'user_id'         => $userId,
            'rating'          => $validated['rating'],
            'comment'         => $validated['comment'],
        ]);

        return redirect()->route('historiOrder')->with('success', 'Review berhasil disimpan!');
    }
}
