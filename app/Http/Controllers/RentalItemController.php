<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RentalItemController extends Controller
{

    //tampilan tabel rental item
    public function itemRental()
    {
        $items = RentalItem::latest()->paginate(10);
        return view('admins.item_rental', compact('items'));
    }

    //tampilan input rental item
    public function create()
    {
        return view('admins.create_rental_item');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string',
            'description'   => 'nullable|string',
            'stock'         => 'required|integer',
            'price_per_day' => 'required|decimal|min=15|max=2',
            'image'         => 'required|images|mimes:jpg,png,jpeg,webp'
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

        return redirect('/')->with('succes', 'Item Rental Saved Successfully');
    }

    //edit Rental Item
    public function edit($id)
    {
        $item = RentalItem::find($id);
        return view('admins.item-rental');
    }

    public function update(Request $request, $id): RedirectResponse {

        $validated = $request->validate([
            'name'          => 'required|string',
            'description'   => 'nullable|string',
            'stock'         => 'required|integer',
            'price_per_day' => 'required|decimal|min=15|max=2',
            'image'         => 'required|images|mimes:jpg,png,jpeg,webp'
        ]);

        $item = RentalItem::findOrFail($id);

        if($request->hasFile('image')){
            $images = $request->file('image')->store('Rental_item','public');
            $item->image = $images;
        }

        //update data
        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->stock = $validated['stock'];
        $item->price_per_day = $validated['price_per_day'];
        $item->save();

        return redirect('item_rental');
    }

    public function delete($id){
        
    }
}
