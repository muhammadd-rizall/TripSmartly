<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use Illuminate\Http\Request;

class RentalItemController extends Controller
{
    public function itemRental(){
        $items = RentalItem:: latest()->paginate(10);
        return view('admins.item_rental', compact('items'));
    }
}
