<?php

use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//route rental barang
Route::get('/rental_item', [RentalItemController::class, 'itemRental'])->name('itemRental');
Route::get('create-item-rental', [RentalItemController::class, 'create'])->name('createItemRental');
Route::post('/input-rental-item', [RentalItemController::class, 'store']);
Route::get('/edit-rental/{id}', [RentalItemController::class, 'edit']);
Route::post('/update-rental/{id}', [RentalItemController::class, 'update']);
Route::delete('/delete-rental/{id}', [RentalItemController::class, 'destroy']);


//route order
Route::get('/rental-order',[RentalItemController::class,'rentalOrder'])->name('rentalOrder');


//route trip
Route::get('/trip',[TripController::class, 'indexTrip'])->name('openTrip');
Route::get('create-trip',[TripController::class,'create']);
Route::post('/input-trip',[TripController::class, 'store']);
Route::get('/edit-trip/{id}',[TripController::class, 'edit']);
Route::post('/update-trip/{id}',[TripController::class, 'update']);
Route::delete('/delete-trip/{id}',[TripController::class, 'destroy']);


//route trip Schedule
Route::get('/trip-schedule', [TripController::class, 'indexSchedule'])->name('tripSchedule');
Route::get('create-trip-schedule', [TripController::class, 'createSchedule']);
Route::post('/input-trip-schedule', [TripController::class, 'storeSchedule']);
Route::get('/edit-trip-schedule/{id}', [TripController::class, 'editSchedule']);
Route::post('/update-trip-schedule/{id}', [TripController::class, 'updateSchedule']);
Route::delete('/delete-trip-schedule/{id}', [TripController::class, 'destroySchedule']);


//route trip Destiantion
Route::get('/trip-destination', [TripController::class, 'indexTd'])->name('tripDestination');
Route::get('createTD', [TripController::class, 'createTD']);
Route::post('/inputTD', [TripController::class, 'storeTD']);
Route::get('/editTD/{id}', [TripController::class, 'editTD']);
Route::post('/updateTD/{id}', [TripController::class, 'updateTD']);
Route::delete('/deleteTD/{id}', [TripController::class, 'destroyTD']);


//route trip internaries

Route::get('/itinerary', [TripController::class, 'indexIT'])->name('tripItineraries');
Route::get('create-itinerary', [TripController::class, 'createIT']);
Route::post('/input-itinerary', [TripController::class, 'storeIT']);
Route::get('/edit-itinerary/{id}', [TripController::class, 'editIT']);
Route::post('/update-itinerary/{id}', [TripController::class, 'updateIT']);
Route::delete('/delete-itinerary/{id}', [TripController::class, 'destroyIT']);


Route::get('dashboard', function () {
    return view('admins.dashboard');
})->name('dashboard');
