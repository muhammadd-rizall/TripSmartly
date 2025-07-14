<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\RentalOrder;
use App\Models\Trip;
use App\Models\TripOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DahsboardController extends Controller
{
    public function dashboardView() {
        return view('admins.dashboard');
    }


    public function index()
    {
        // Summary Cards
        $totalTrip      = Trip::count();
        $orderTrip      = TripOrder::count();
        $totalRental    = RentalItem::count();
        $orderRental    = RentalOrder::count();
        $totalUser      = User::count();

        // Pendapatan
        $pendapatanTrip     = TripOrder::sum('total_price');
        $pendapatanRental   = RentalOrder::sum('total_price');
        $totalPendapatan    = $pendapatanTrip + $pendapatanRental;

        // Data order trip
        $dataOrderTrip = TripOrder::with(['user', 'rizal_trip.rizal_categories'])->latest()->take(5)->get();

        // Data order rental
        $dataOrderRental = RentalOrder::with(['user', 'rizal_rental_item'])->latest()->take(5)->get();


        // Data chart bulanan
        $allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlyRevenueData = [];

        // Revenue trip per bulan
        $tripRevenue = DB::table('rizal_trip_order')
            ->selectRaw('DATE_FORMAT(created_at, "%b") as month, COALESCE(SUM(total_price),0) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Revenue rental per bulan
        $rentalRevenue = DB::table('rizal_rental_orders')
            ->selectRaw('DATE_FORMAT(created_at, "%b") as month, COALESCE(SUM(total_price),0) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Gabungkan ke monthlyRevenueData
        foreach ($allMonths as $month) {
            $monthlyRevenueData[] = [
                'month' => $month,
                'trip'  => $tripRevenue[$month] ?? 0,
                'rental' => $rentalRevenue[$month] ?? 0,
            ];
        }

        // Kirim semua data ke Blade
        return view('admins.dashboard_home', [
            'totalTrip'         => $totalTrip,
            'orderTrip'         => $orderTrip,
            'totalRental'       => $totalRental,
            'orderRental'       => $orderRental,
            'totalUser'         => $totalUser,
            'pendapatanTrip'    => $pendapatanTrip,
            'pendapatanRental'  => $pendapatanRental,
            'totalPendapatan'   => $totalPendapatan,
            'dataOrderTrip'     => $dataOrderTrip,
            'dataOrderRental'   => $dataOrderRental,
            'monthlyRevenue'    => $monthlyRevenueData, // inilah yang dipakai di Blade
        ]);
    }
}
