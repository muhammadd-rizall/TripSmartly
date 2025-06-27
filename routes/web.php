<?php

use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//route rental barang
Route::get('/rental_item', [RentalItemController::class, 'itemRental']);
Route::get('create-item-rental', [RentalItemController::class, 'create'])->name('createItemRental');
Route::post('/input-rental-item', [RentalItemController::class, 'store']);
Route::get('/edit-rental/{id}', [RentalItemController::class, 'edit']);
Route::post('/update-rental/{id}', [RentalItemController::class, 'update']);
Route::delete('/delete-rental/{id}', [RentalItemController::class, 'destroy']);


//route order
Route::get('/rental-order',[RentalItemController::class,'rentalOrder']);


//route trip
Route::get('/trip',[TripController::class, 'indexTrip']);
Route::get('create-trip',[TripController::class,'create']);
Route::post('/input-trip',[TripController::class, 'store']);
Route::get('/edit-trip/{id}',[TripController::class, 'edit']);
Route::post('/update-trip/{id}',[TripController::class, 'update']);
Route::delete('/delete-trip/{id}',[TripController::class, 'destroy']);
