<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightTripController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PassengerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/', [LocationController::class, 'create']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::put('/{id}', [LocationController::class, 'update']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
});

Route::prefix('/aircrafts')->group(function () {
    Route::get('/', [AircraftController::class, 'index']);
    Route::post('/', [AircraftController::class, 'create']);
    Route::get('/{id}', [AircraftController::class, 'show']);
    Route::put('/{id}', [AircraftController::class, 'update']);
    Route::delete('/{id}', [AircraftController::class, 'destroy']);
});

Route::prefix('/passengers')->group(function() {
    Route::get('/', [PassengerController::class, 'index']);
    Route::post('/', [PassengerController::class, 'create']);
    Route::get('/{id}', [PassengerController::class, 'show']);
    Route::put('/{id}', [PassengerController::class, 'update']);
    Route::delete('/{id}', [PassengerController::class, 'destroy']);
});

Route::prefix('/groups')->group(function() {
    Route::get('/', [GroupController::class, 'index']);
    Route::post('/', [GroupController::class, 'create']);
    Route::get('/{id}', [GroupController::class, 'show']);
    Route::put('/{id}', [GroupController::class, 'update']);
    Route::delete('/{id}', [GroupController::class, 'destroy']);
});

Route::prefix('/bookings')->group(function() {
    Route::get('/', [BookingController::class, 'index']);
    Route::post('/', [BookingController::class, 'create']);
    Route::get('/{id}', [BookingController::class, 'show']);
    Route::put('/{id}', [BookingController::class, 'update']);
    Route::delete('/{id}', [BookingController::class, 'destroy']);
});

Route::prefix('/flight-trips')->group(function() {
    Route::get('/', [FlightTripController::class, 'index']);
    Route::post('/', [FlightTripController::class, 'create']);
    Route::get('/{id}', [FlightTripController::class, 'show']);
    Route::put('/{id}', [FlightTripController::class, 'update']);
    Route::delete('/{id}', [FlightTripController::class, 'destroy']);
});

Route::prefix('/flights')->group(function() {
    Route::get('/', [FlightController::class, 'index']);
    Route::post('/', [FlightController::class, 'create']);
    Route::get('/{id}', [FlightController::class, 'show']);
    Route::put('/{id}', [FlightController::class, 'update']);
    Route::delete('/{id}', [FlightController::class, 'destroy']);
});
