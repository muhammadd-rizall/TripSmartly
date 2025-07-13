<?php

namespace App\Http\Controllers;

use App\Models\{Categories, ReviewTrip, Trip, TripOrder};
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetailTripController extends Controller
{
    public function tripDetails($id)
    {
        $openTrip = Trip::with([
            'rizal_regions',
            'rizal_categories',
            'trip_destinations',
            'trip_itineraries',
            'trip_schedule'
        ])->findOrFail($id);

        // Reviews & Rating
        $tripReviews = ReviewTrip::where('trip_id', $id)->latest()->get();
        $averageRating = round($tripReviews->avg('rating') ?? 0, 1);

        // Kuota
        $bookedPersons = TripOrder::where('trip_id', $id)
            ->where('payment_status', 'paid')
            ->sum('participants');
        $availableQuota = max($openTrip->quota - $bookedPersons, 0);

        // Start & End Date dari trip_schedule relasi
        $startDate = $openTrip->trip_schedule && $openTrip->trip_schedule->start_date
            ? Carbon::parse($openTrip->trip_schedule->start_date)
            : null;

        $endDate = $openTrip->trip_schedule && $openTrip->trip_schedule->end_date
            ? Carbon::parse($openTrip->trip_schedule->end_date)
            : null;

        // Hitung Durasi
        $duration = null;
        if ($startDate && $endDate) {
            $duration = $startDate->diffInDays($endDate) + 1;
        }

        // Status Trip
        $tripStatus = 'unknown';
        if ($startDate && $endDate) {
            if (now()->lt($startDate)) {
                $tripStatus = 'upcoming';
            } elseif (now()->between($startDate, $endDate)) {
                $tripStatus = 'ongoing';
            } else {
                $tripStatus = 'completed';
            }
        }

        // Format untuk tampilan
        $startDateFormatted = $startDate ? $startDate->format('d M Y') : null;
        $endDateFormatted = $endDate ? $endDate->format('d M Y') : null;
        $startDayName = $startDate ? $startDate->translatedFormat('l') : null;
        $endDayName = $endDate ? $endDate->translatedFormat('l') : null;

        // Related trips
        $relatedTrips = Trip::with(['rizal_regions', 'rizal_categories'])
            ->where('category_id', $openTrip->category_id)
            ->where('id', '!=', $openTrip->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        // Convert includes & excludes ke array
        $openTrip->includes = $openTrip->includes
            ? preg_split('/,\s*/', $openTrip->includes)
            : [];

        $openTrip->excludes = $openTrip->excludes
            ? preg_split('/,\s*/', $openTrip->excludes)
            : [];

        // Convert trip_destinations
        if ($openTrip->trip_destinations && $openTrip->trip_destinations->count()) {
            foreach ($openTrip->trip_destinations as $destination) {
                $destination->places = $destination->place_name
                    ? preg_split('/,\s*/', $destination->place_name)
                    : [];
            }
        }

        // Convert trip_itineraries
        if ($openTrip->trip_itineraries && $openTrip->trip_itineraries->count()) {
            foreach ($openTrip->trip_itineraries as $itinerary) {
                $itinerary->activities = $itinerary->activity
                    ? preg_split('/,\s*/', $itinerary->activity)
                    : [];
            }
        }

        return view('screens.detail_trip', compact(
            'openTrip',
            'tripReviews',
            'averageRating',
            'availableQuota',
            'duration',
            'tripStatus',
            'relatedTrips',
            'startDateFormatted',
            'endDateFormatted',
            'startDayName',
            'endDayName'
        ));
    }

    public function bookTrip($id)
    {
        $openTrip = Trip::with(['rizal_regions', 'rizal_categories'])->findOrFail($id);

        // Cek tanggal mulai
        if (now()->gt(Carbon::parse($openTrip->start_date))) {
            return back()->with('error', 'Trip ini sudah dimulai atau berakhir');
        }

        // Hitung jumlah peserta yang sudah booked
        $bookedPersons = TripOrder::where('trip_id', $id)
            ->where('payment_status', 'paid')
            ->sum('participants');

        $availableQuota = max($openTrip->quota - $bookedPersons, 0);

        if ($availableQuota <= 0) {
            return back()->with('error', 'Kuota trip ini sudah penuh');
        }

        return view('screens.order_trip', compact('openTrip', 'availableQuota'));
    }


    public function storeBooking(Request $request, $id)
    {
        // Validasi sesuai form modal
        $data = $request->validate([
            'participants' => 'required|integer|min:1',
            'payment_methods' => 'required|in:transfer,qris,cod',
            'special_request' => 'nullable|string'
        ]);

        $openTrip = Trip::findOrFail($id);

        // Cek kuota
        $bookedPersons = TripOrder::where('trip_id', $id)
            ->where('payment_status', 'paid')
            ->sum('participants');

        $availableQuota = max($openTrip->quota - $bookedPersons, 0);

        if ($data['participants'] > $availableQuota) {
            return back()->with('error', 'Kuota tidak mencukupi');
        }

        // Hitung total harga
        $totalPrice = $openTrip->base_price * $data['participants'];

        // Simpan pesanan
        TripOrder::create([
            'trip_id' => $id,
            'participants' => $data['participants'],
            'total_price' => $totalPrice,
            'payment_method' => $data['payment_methods'],
            'special_request' => $data['special_request'],
            'payment_status' => 'pending'
        ]);

        return redirect()->route('tripDetails', $id)
            ->with('success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }

    public function submitReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000'
        ]);

        ReviewTrip::create([
            'trip_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_name' => $request->input('user_name', 'Guest')
        ]);

        return back()->with('success', 'Review berhasil disimpan!');
    }
}
