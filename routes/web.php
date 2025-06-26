<?php

use App\Http\Controllers\RentalItemController;
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
