<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\RentalItem;
use App\Models\RentalOrder;
use App\Models\ReviewRental;
use App\Models\ReviewTrip;
use App\Models\Trip;
use App\Models\TripOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DetailTripController extends Controller
{


    // ===================== TRIP =====================
    public function tripDetails($id)
    {
        $openTrip = Trip::with([
            'rizal_regions',
            'rizal_categories',
            'trip_destinations',
            'trip_itineraries',
            'trip_schedule'
        ])->findOrFail($id);

        $tripReviews = ReviewTrip::where('trip_id', $id)->latest()->get();
        $averageRating = round($tripReviews->avg('rating') ?? 0, 1);

        $bookedPersons = TripOrder::where('trip_id', $id)
            ->where('payment_status', 'paid')
            ->sum('participants');
        $availableQuota = max($openTrip->quota - $bookedPersons, 0);

        $startDate = optional($openTrip->trip_schedule)->start_date ? Carbon::parse($openTrip->trip_schedule->start_date) : null;
        $endDate = optional($openTrip->trip_schedule)->end_date ? Carbon::parse($openTrip->trip_schedule->end_date) : null;

        $duration = $startDate && $endDate ? $startDate->diffInDays($endDate) + 1 : null;

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

        $startDateFormatted = $startDate?->format('d M Y');
        $endDateFormatted = $endDate?->format('d M Y');
        $startDayName = $startDate?->translatedFormat('l');
        $endDayName = $endDate?->translatedFormat('l');

        $relatedTrips = Trip::with(['rizal_regions', 'rizal_categories'])
            ->where('category_id', $openTrip->category_id)
            ->where('id', '!=', $openTrip->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        $openTrip->includes = $openTrip->includes ? preg_split('/,\s*/', $openTrip->includes) : [];
        $openTrip->excludes = $openTrip->excludes ? preg_split('/,\s*/', $openTrip->excludes) : [];

        if ($openTrip->trip_destinations) {
            foreach ($openTrip->trip_destinations as $destination) {
                $destination->places = $destination->place_name
                    ? preg_split('/,\s*/', $destination->place_name)
                    : [];
            }
        }

        if ($openTrip->trip_itineraries) {
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

        if (now()->gt(Carbon::parse($openTrip->start_date))) {
            return back()->with('error', 'Trip ini sudah dimulai atau berakhir');
        }

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
        $data = $request->validate([
            'participants'     => 'required|integer|min:1',
            'payment_methods'  => 'required|in:transfer,qris,cod',
            'special_request'  => 'nullable|string'
        ]);

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $openTrip = Trip::findOrFail($id);

        $bookedPersons = TripOrder::where('trip_id', $id)
            ->where('payment_status', 'paid')
            ->sum('participants');

        $availableQuota = max($openTrip->quota - $bookedPersons, 0);

        if ($data['participants'] > $availableQuota) {
            return back()->with('error', 'Kuota tidak mencukupi');
        }

        $totalPrice = $openTrip->base_price * $data['participants'];

        TripOrder::create([
            'trip_id'         => $id,
            'user_id'         => $userId,
            'participants'    => $data['participants'],
            'total_price'     => $totalPrice,
            'payment_methods' => $data['payment_methods'],
            'special_request' => $data['special_request'],
            'payment_status'  => 'pending',
        ]);

        return redirect()->route('tripDetails', $id)
            ->with('success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }


    // ===================== RENTAL =====================
    public function rentalDetails($id)
    {
        $rentalItem = RentalItem::findOrFail($id);
        $availableStock = $rentalItem->stock;

        $rentalReviews = $rentalItem->rental_reviews ?? collect();
        $averageRating = $rentalReviews->count() > 0 ? round($rentalReviews->avg('rating'), 1) : 0;

        return view('screens.detail_rental', compact(
            'rentalItem',
            'availableStock',
            'rentalReviews',
            'averageRating'
        ));
    }

    public function orderRental($id)
    {
        $rentalItem = RentalItem::with('rizal_rental_categories')->findOrFail($id);

        $bookedQuantity = RentalOrder::where('rental_items_id', $id)
            ->where('payment_status', 'paid')
            ->sum('quantity');

        $availableStock = max($rentalItem->stock - $bookedQuantity, 0);

        if ($availableStock <= 0) {
            return back()->with('error', 'Stock barang ini sudah habis!');
        }

        return view('screens.order_rental', compact('rentalItem', 'availableStock'));
    }

    public function storeRental(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1',
            'delivery_location' => 'required|string',
            'payment_methods' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // Ambil data rental item
        $rentalItem = RentalItem::findOrFail($id);

        // Cek ketersediaan stok berdasarkan tanggal
        $existingOrders = RentalOrder::where('rental_items_id', $id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->sum('quantity');

        $availableStock = $rentalItem->stock - $existingOrders;

        if ($availableStock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi untuk tanggal tersebut. Stok tersedia: ' . $availableStock);
        }

        // Hitung total harga
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $startDate->diff($endDate)->days + 1;
        $totalPrice = $rentalItem->price_per_day * $request->quantity * $days;

        try {
            // Simpan ke database
            $order = RentalOrder::create([
                'user_id' => Auth::id(), // Menggunakan Auth::id() yang benar
                'rental_items_id' => $id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
                'delivery_location' => $request->delivery_location,
                'payment_methods' => $request->payment_methods,
                'notes' => $request->notes,
                'status' => 'pending',
                'payment_status' => 'pending',
                'retrun_status' => 'belum kembali'
            ]);

            return redirect()->route('historiOrder')
                ->with('success', 'Pesanan rental berhasil dibuat! Total: Rp ' . number_format($totalPrice, 0, ',', '.'));
        } catch (\Exception $e) {
            Log::error('Error saving rental order: ' . $e->getMessage()); // Menggunakan Log::error yang benar
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pesanan: ' . $e->getMessage());
        }
    }

    // ===================== HISTORY =====================
    public function history(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.');
        }

        $tab = $request->query('tab', 'all');
        $search = $request->query('search', '');

        $tripOrdersQuery = TripOrder::where('user_id', $userId)
            ->whereHas('rizal_trip', function ($q) use ($search) {
                if ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                }
            });

        $rentalOrdersQuery = RentalOrder::where('user_id', $userId)
            ->whereHas('rizal_rental_item', function ($q) use ($search) {
                if ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                }
            });

        if ($tab === 'trip') {
            $tripOrders = $tripOrdersQuery->with('rizal_trip')->get();
            $rentalOrders = collect();
        } elseif ($tab === 'rental') {
            $tripOrders = collect();
            $rentalOrders = $rentalOrdersQuery->with('rizal_rental_item')->get();
        } else {
            $tripOrders = $tripOrdersQuery->with('rizal_trip')->get();
            $rentalOrders = $rentalOrdersQuery->with('rizal_rental_item')->get();
        }

        return view('screens.user_order', compact('tripOrders', 'rentalOrders', 'tab', 'search'));
    }
}
