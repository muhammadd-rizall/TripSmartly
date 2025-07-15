<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DahsboardController;
use App\Http\Controllers\DetailTripController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TripController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUSer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//login

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//register
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);



Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('/dashboard', [DahsboardController::class, 'dashboardView']);

    Route::get('/dashboard-home', [DahsboardController::class, 'index'])->name('dashboarHome');

    //route rental barang
    Route::get('/rental_item', [RentalItemController::class, 'itemRental'])->name('itemRental');
    Route::get('create-item-rental', [RentalItemController::class, 'create'])->name('createItemRental');
    Route::post('/input-rental-item', [RentalItemController::class, 'store'])->name('inputItem');
    Route::get('/edit-rental/{id}', [RentalItemController::class, 'edit'])->name('editItem');
    Route::post('/update-rental/{id}', [RentalItemController::class, 'update'])->name('updateItem');
    Route::delete('/delete-rental/{id}', [RentalItemController::class, 'destroy'])->name('deleteItem');


    //route order
    Route::get('/trip-order', [OrderController::class, 'tripOrder'])->name('tripOrder');
    Route::patch('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/delete-trip-order/{id}', [OrderController::class, 'destroy'])->name('deleteOr');

    Route::get('/rental-order', [OrderController::class, 'rentalOrder'])->name('rentalOrder');
    Route::patch('/update-return-status/{id}', [OrderController::class, 'updateReturnStatus'])->name('updateReturn');
    Route::patch('/update-order-status/{id}', [OrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');
    Route::delete('/delete-rental-order/{id}', [OrderController::class, 'destroyRentalOrder'])->name('destroyRentalOrder');


    //route trip
    Route::get('/trip', [TripController::class, 'indexTrip'])->name('openTrip');
    Route::get('create-trip', [TripController::class, 'create'])->name('create-trip');
    Route::post('/input-trip', [TripController::class, 'store'])->name('input-trip');
    Route::get('/edit-trip/{id}', [TripController::class, 'edit'])->name('edit-trip');
    Route::post('/update-trip/{id}', [TripController::class, 'update'])->name('update-trip');
    Route::delete('/delete-trip/{id}', [TripController::class, 'destroy'])->name('delete-trip');


    //route trip Schedule
    Route::get('/trip-schedule', [TripController::class, 'indexSchedule'])->name('tripSchedule');
    Route::get('create-trip-schedule', [TripController::class, 'createSchedule'])->name('createSchedule');
    Route::post('/input-trip-schedule', [TripController::class, 'storeSchedule'])->name('inputSchedule');
    Route::get('/edit-trip-schedule/{id}', [TripController::class, 'editSchedule'])->name('editSchedule');
    Route::post('/update-trip-schedule/{id}', [TripController::class, 'updateSchedule'])->name('updateSchedule');
    Route::delete('/delete-trip-schedule/{id}', [TripController::class, 'destroySchedule'])->name('destroySchedule');


    //route trip Destiantion
    Route::get('/trip-destination', [TripController::class, 'indexTd'])->name('tripDestination');
    Route::get('createTD', [TripController::class, 'createTD'])->name('createTD');
    Route::post('/inputTD', [TripController::class, 'storeTD'])->name('inputTD');
    Route::get('/editTD/{id}', [TripController::class, 'editTD'])->name('editTD');
    Route::post('/updateTD/{id}', [TripController::class, 'updateTD'])->name('updateTD');
    Route::delete('/deleteTD/{id}', [TripController::class, 'destroyTD'])->name('destroyTD');


    //route trip internaries

    Route::get('/itinerary', [TripController::class, 'indexIT'])->name('tripItineraries');
    Route::get('create-itinerary', [TripController::class, 'createIT'])->name('createIT');
    Route::post('/input-itinerary', [TripController::class, 'storeIT'])->name('inputIT');
    Route::get('/edit-itinerary/{id}', [TripController::class, 'editIT'])->name('editIT');
    Route::post('/update-itinerary/{id}', [TripController::class, 'updateIT'])->name('updateIT');
    Route::delete('/delete-itinerary/{id}', [TripController::class, 'destroyIT'])->name('destroyIT');

    //reviews
    Route::get('/rental-reviews', [ReviewController::class, 'rentalReviews'])->name('rentalReviews');
    Route::get('/trip-reviews', [ReviewController::class, 'tripReviews'])->name('tripReviews');
});




Route::prefix('/')->group(function () {
    // PUBLIC routes
    Route::get('/', [LandingPageController::class, 'home'])->name('landingPageHome');
    Route::get('/trip-views', [LandingPageController::class, 'tripViews'])->name('tripViews');
    Route::get('/trip-views/{id}', [DetailTripController::class, 'tripDetails'])->name('tripDetails');
    Route::get('/rental-views', [LandingPageController::class, 'rentalViews'])->name('rentalViews');
    Route::get('/rental-views/{id}', [DetailTripController::class, 'rentalDetails'])->name('rentalDetails');

    // PROTECTED routes
    Route::middleware(['auth', IsUser::class])->group(function () {
        // Order Trip
        Route::get('/trip-views/{id}/order', [DetailTripController::class, 'bookTrip'])->name('tripOrders');
        Route::post('/trip-views/{id}/order', [DetailTripController::class, 'storeBooking'])->name('tripStore');

        // Order Rental
        Route::get('/rental-views/{id}/order', [DetailTripController::class, 'orderRental'])->name('orderRental');
        Route::post('/rental-views/{id}/order', [DetailTripController::class, 'storeRental'])->name('storeRental');



        // Order History
        Route::get('order/history', [DetailTripController::class, 'history'])->name('historiOrder');

        // Trip Review
        Route::get('/trip/review/{order}', [DetailTripController::class, 'tripForm'])->name('reviewTripForm');
        Route::post('/trip/review/{order}', [DetailTripController::class, 'tripSubmit'])->name('tripSubmit');

        // Rental Review
        Route::get('/rental/review/{order}', [ReviewController::class, 'rentalForm'])->name('reviewRentalForm');
        Route::post('/rental/review/{order}', [ReviewController::class, 'rentalSubmit'])->name('rentalSubmit');
    });
});


