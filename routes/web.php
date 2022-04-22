<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource("cities", CityController::class);
    Route::resource("trips", TripController::class);
    Route::resource("bookings", BookingController::class);
    Route::view("apis-docs", "apis.docs")->name("apis.docs");
});

require __DIR__ . '/auth.php';
