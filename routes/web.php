<?php

use App\Http\Controllers\MenuRestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RatingRestaurantController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
// Route::post('search', [RestaurantController::class, 'searchRestaurant']);




Route::middleware(['guest'])->group(function () {

    Route::get('/', [GuestController::class, 'guestDashboard'])->name('guestDashboard');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    Route::post('login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

    Route::post('register', [AuthController::class, 'register']);

    Route::get('/registerrestaurant', [AuthController::class, 'showRegisterRestaurantForm'])->name('registerRestaurant');

    Route::post('registerrestaurant', [AuthController::class, 'registerestaurant']);

    Route::get('/search', [GuestController::class, 'searchRestaurantbyGuest'])->name('search');
});

Route::middleware(['customer'])->group(function () {

    Route::get('/dashboardCustomer', [CustomerController::class, 'customerDashboard'])->name('customerDashboard');

    Route::get('/searchRestaurant', [RestaurantController::class, 'searchRestaurant'])->name('searchRestaurant');
    Route::get('/restaurantIndex/{id}', [RestaurantController::class, 'indexRestaurants'])->name('indexRestaurants');
    Route::get('/logoutCustomer', [AuthController::class, 'logout'])->name('logoutCustomer');
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('booking', [ReservationController::class, 'booking'])->name('booking');

    Route::post('/restaurantMenu/{id}', [MenuRestaurantController::class, 'show'])->name('indexMenu');

    Route::post('/detailOrder', [ReservationController::class, 'detailOrder'])->name('detailOrder');
    Route::post('/generateQris', [MidtransController::class, 'generateQris'])->name('generateQris');
    Route::post('/checkStatus', [MidtransController::class, 'checkStatus'])->name('checkStatus');

    Route::get('/history', [ReservationController::class, 'history'])->name('history');
    Route::post('/history', [ReservationController::class, 'filterDate'])->name('filter');
    Route::post('/reservation/{id}/cancel', [ReservationController::class, 'cancelOrder'])->name('reservation.cancelOrder');
    Route::post('/reservation/{id}/finish', [ReservationController::class, 'finishOrder'])->name('reservation.finishOrder');
    Route::post('/rating/store', [RatingRestaurantController::class, 'store'])->name('rating.store');

});

Route::middleware(['admin'])->group(function () {

    Route::get('/dashboardAdmin', [AuthController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/logoutAdmin', [AuthController::class, 'logout'])->name('logoutAdmin');
});

Route::middleware(['restaurant'])->group(function () {

    Route::get('/restaurantDashboard', [AuthController::class, 'restaurantDashboard'])->name('restaurantDashboard');

    //MANAGE MENU
    Route::get('/menu', [MenuRestaurantController::class, 'index'])->name('menu.index');
    Route::delete('/menu/{id}', [MenuRestaurantController::class, 'destroy'])->name('menu.destroy');
    Route::get('/menu/{id}/edit', [MenuRestaurantController::class, 'edit'])->name('menu.edit');
    Route::post('/menu/{id}/update', [MenuRestaurantController::class, 'update'])->name('menu.update');
    Route::post('/addMenu', [MenuRestaurantController::class, 'store'])->name('menu.store');

    //ORDER
    Route::get('/restaurant/reservation', [ReservationController::class, 'restaurantReservations'])->name('restaurant.reservations');
    Route::post('/reservation/{id}/confirm-arrival', [ReservationController::class, 'confirmArrival'])->name('reservation.confirmArrival');

    Route::get('/table', function () {
        return view('restaurant.table.index');
    })->name('table');

    Route::get('/order', function () {
        return view('restaurant.order.index');
    })->name('order');

    Route::get('/payment', function () {
        return view('restaurant.payment.index');
    })->name('payment');

    Route::get('/report', function () {
        return view('restaurant.report.index');
    })->name('report');

    Route::get('/settings', function () {
        return view('restaurant.home.index');
    })->name('settings');

    Route::get('/logoutRestaurant', [AuthController::class, 'logout'])->name('logoutRestaurant');
    Route::post('logout', [AuthController::class, 'logout']);
});
