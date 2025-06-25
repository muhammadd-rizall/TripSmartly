<?php

use App\Http\Controllers\RentalItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//route rental barang
Route::get('/rental_item',[RentalItemController::class,'itemRental']);
Route::get('/create_item_rental',[RentalItemController::class, 'create'])->name('createRentalMovie');
Route::get('/', [RentalItemController::class,'store']);
Route::post('/', [RentalItemController::class,'store']);
