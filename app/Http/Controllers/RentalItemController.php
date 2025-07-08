<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\RentalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RentalItemController extends Controller
{

    //-------------
    //Rental items
    //-------------


    //tampilan tabel rental item
    public function itemRental()
    {
        $items = RentalItem::latest()->paginate(10);
        return view('itemRental.item_rental', compact('items'));
    }

    //tampilan input rental item
    public function create()
    {
        return view('itemRental.create_rental_item');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'description'   => 'nullable|string',
            'stock'         => 'required|integer|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'image'         => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);

        //ambil input file dan simpan ke storage
        $images = null;
        if ($request->hasFile('image')) {
            $images = $request->file('image')->store('Rental_item', 'public');
        }

        RentalItem::create(
            [
                'name'          => $validated['name'],
                'description'   => $validated['description'],
                'stock'         => $validated['stock'],
                'price_per_day' => $validated['price_per_day'],
                'image'         => $images
            ]
        );

        return redirect('/rental_item')->with('succes', 'Item Rental Saved Successfully');
    }

    //edit Rental Item
    public function edit($id)
    {
        $item = RentalItem::find($id);
        return view('itemRental.edit_rental_item', compact('item'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name'          => 'required|string',
            'description'   => 'nullable|string',
            'stock'         => 'required|integer|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'image'         => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);

        $item = RentalItem::findOrFail($id);

        if ($request->hasFile('image')) {
            $images = $request->file('image')->store('Rental_item', 'public');
            $item->image = $images;
        }

        //update data
        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->stock = $validated['stock'];
        $item->price_per_day = $validated['price_per_day'];
        $item->save();

        return redirect('/rental_item');
    }


    //delete rental item
    public function destroy($id)
    {
        $item = RentalItem::findOrFail($id);

        // Jika ada file gambar, hapus juga (opsional)
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect('/rental_item')->with('success', 'Item berhasil dihapus.');
    }



        //-------------
        //Rental Orders
        //-------------

    public function rentalOrder(){
        $rentalOrders = RentalOrder::latest()->paginate(10);
        return view('itemRental.rental_orders', compact('rentalOrders'));
    }
}
