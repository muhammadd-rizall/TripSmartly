<?php

namespace App\Http\Controllers;

use App\Models\RentalOrder;
use App\Models\TripOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function rentalOrder()
    {
        $rentalOrders = RentalOrder::latest()->paginate(10);
        return view('orders.rental_orders', compact('rentalOrders'));
    }

    public function tripOrder()
    {
        $TOs = TripOrder::latest()->paginate(10);
        return view('orders.trip_orders', compact('TOs'));
    }
}
