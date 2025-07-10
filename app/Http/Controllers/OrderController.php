<?php

namespace App\Http\Controllers;

use App\Models\RentalOrder;
use App\Models\TripOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan daftar rental orders
    public function rentalOrder()
    {
        $rentalOrders = RentalOrder::latest()->paginate(10);
        return view('orders.rental_orders', compact('rentalOrders'));
    }

    //  Update Status Pengembalian (SERAGAM)
    public function updateReturnStatus(Request $request, $id)
    {
        $request->validate([
            'retrun_status' => 'required|in:belum kembali,kembali,terlambat,hilang',
        ]);

        $order = RentalOrder::findOrFail($id);
        $order->retrun_status = $request->retrun_status;
        $order->save();

        return redirect()->back()->with('success', 'Status pengembalian berhasil diperbarui.');
    }

    //  Update Status Order (SERAGAM)
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $order = RentalOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status order berhasil diperbarui.');
    }

    //  Hapus rental order (SERAGAM)
    public function destroyRentalOrder($id)
    {
        $order = RentalOrder::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order berhasil dihapus.');
    }

    // ------------------------------------------------
    // TRIP ORDER
    // ------------------------------------------------

    public function tripOrder()
    {
        $TOs = TripOrder::latest()->paginate(10);
        return view('orders.trip_orders', compact('TOs'));
    }

    /**
     * Update status trip order (confirmed / cancelled / pending).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $order = TripOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Hapus trip order.
     */
    public function destroy($id)
    {
        $order = TripOrder::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order berhasil dihapus.');
    }

    /**
     * Show detail order (jika link Show mau dipakai).
     */
    public function show($id)
    {
        $order = TripOrder::with(['user', 'rizal_trip'])->findOrFail($id);
        return view('orders.show_trip_order', compact('order'));
    }
}
